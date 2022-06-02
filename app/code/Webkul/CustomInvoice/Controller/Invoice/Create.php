<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomInvoice
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\CustomInvoice\Controller\Invoice;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Webkul\CustomInvoice\Helper\Data;
use Webkul\MarketplaceBaseShipping\Model\ShippingSettingRepository;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Webkul\DelhiveryExtend\Model\ShipmentFactory;
use Webkul\CustomInvoice\Model\SellerInvoiceFactory;

class Create extends \Magento\Framework\App\Action\Action
{
    /**
     * @var string
     */
    public const FONT_ARIAL = BP.'/app/code/Webkul/CustomInvoice/view/frontend/web/font/arial-cufonfonts/ARIAL.TTF';

    /**
     * @var string
     */
    public const FONT_ARIAL_BOLD = BP.'/app/code/Webkul/CustomInvoice/view/frontend/web/font/arial-cufonfonts/ARIALBD 1.TTF';

    /**
     * @var \Magento\Customer\Model\Url
     */
    protected $url;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $session;

    /**
     * @var \Webkul\CustomInvoice\Helper\Data
     */
    protected $mpRmaHelper;

    /**
     * @var \Webkul\CustomInvoice\Model\DetailsFactory
     */
    protected $details;

    /**
     * @var \Magento\Customer\Model\Customer
     */
    protected $customer;

    /**
     * @var \Magento\Sales\Model\Order\Item
     */
    protected $orderItem;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $fileSystem;

    /**
     * @var \Magento\Sales\Model\Order\Item
     */
    protected $items;

    /**
     * @param Context $context
     * @param \Magento\Customer\Model\Url $url
     * @param \Magento\Customer\Model\Session $session
     * @param \Webkul\CustomInvoice\Helper\Data $mpRmaHelper
     * @param \Webkul\CustomInvoice\Model\DetailsFactory $details
     * @param \Webkul\CustomInvoice\Model\ItemsFactory $items
     * @param \Magento\CustomInvoice\Model\Customer $customer
     * @param \Magento\Sales\Model\Order\Item $orderItem
     * @param \Magento\Framework\Filesystem $fileSystem
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
     */
    public function __construct(
        Context $context,
        HttpContext $httpContext,
        DirectoryList $directoryList,
        \Magento\Customer\Model\Url $url,
        \Magento\Customer\Model\Session $session,
        \Magento\Customer\Model\Customer $customer,
        \Magento\Sales\Model\Order\Item $orderItem,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem\Driver\File $fileDriver,
        \Webkul\CustomInvoice\Block\Invoice\Items $sellerItems,
        \Webkul\CustomInvoice\Model\GstStateCodeFactory $gstStateCodeFactory,
        \Webkul\CustomInvoice\Logger\Logger $logger,
        ShippingSettingRepository $shippingSetting,
        ScopeConfigInterface $scopeConfig,
        ShipmentFactory $shipmentFactory,
        SellerInvoiceFactory $sellerInvoice
    ) {
        $this->httpContext = $httpContext;
        $this->directoryList = $directoryList;
        $this->url = $url;
        $this->session = $session;
        $this->customer = $customer;
        $this->orderItem = $orderItem;
        $this->orderFactory = $orderFactory;
        $this->fileFactory = $fileFactory;
        $this->fileDriver = $fileDriver;
        $this->sellerItems = $sellerItems;
        $this->gstStateCodeFactory = $gstStateCodeFactory;
        $this->logger = $logger;
        $this->shippingSetting = $shippingSetting;
        $this->scopeConfig = $scopeConfig;
        $this->shipmentFactory = $shipmentFactory;
        $this->sellerInvoice = $sellerInvoice;
        parent::__construct($context);
    }

    /**
     * Check customer authentication.
     *
     * @param RequestInterface $request
     *
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        $loginUrl = $this->url->getLoginUrl();
        if (!$this->session->authenticate($loginUrl)) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }

        return parent::dispatch($request);
    }

    /**
     * Create New Customer Rma
     */
    public function execute()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                $this->messageManager->addError(__('Something went wrong.'));
                return $this->resultRedirectFactory->create()->setPath('marketplace/order/history');
            }
            $data = $this->getRequest()->getParams();
            $sellerId = $this->httpContext->getValue('customer_id');
            $sellerAddress = $this->shippingSetting->getBySellerId($sellerId)->getData();
            if (!empty($sellerAddress)) {
                if ($this->getRequest()->isPost() && !empty($data)) {
                    $sellerInvoice = $this->sellerInvoice->create()->getCollection()
                                            ->addFieldToFilter('order_id', $data['order_id'])
                                            ->addFieldToFilter('seller_id', $sellerId)
                                            ->setPageSize(1)->setCurPage(1)->getFirstItem();
                    if (!$sellerInvoice->getEntityId()) {
                        $sellerInvoice = $this->sellerInvoice->create();
                        $data['seller_id'] = $sellerId;
                        $sellerInvoice->setData($data);
                        $sellerInvoice->save();
                    } else {
                        $data = $sellerInvoice->getData();
                    }
                }

                $order = $this->orderFactory->create()->load($data['order_id']);
                $shippingAdd = $order->getShippingAddress()->getData();
                $billingAdd = $order->getBillingAddress()->getData();
                $this->sellerItems->getRequest()->setParam('id', $data['order_id']);
                $perPageItem = 27; //one page contain 27 items
                $invoiceItems = $this->sellerItems->getInvoiceItems();

                $seller = $this->customer->load($sellerId);
                $customer = $this->customer->load($order->getCustomerId());
                $totalItem = $invoiceItems->getSize();
                $totalPages = intval($totalItem / $perPageItem) + (fmod($totalItem, $perPageItem) ? 1 : 0);
                $isSameState = $this->isSameState($shippingAdd, $billingAdd, $sellerAddress);
                $hight = 895-350;
                $pdf = new \Zend_Pdf();
                $sno = 0;
                $fmt = new \NumberFormatter('hi_IN', \NumberFormatter::CURRENCY );
                $page = $this->getPreparedPage(
                    $pdf,
                    $data,
                    $order,
                    $shippingAdd,
                    $billingAdd,
                    $sellerAddress,
                    $seller,
                    $customer,
                    $isSameState
                );
                $pageTotal = 0;
                $pageQty = 0;
                //$pageTax = 0;
                $pageTaxAbleTotal = 0;
                $itemHeignt = $hight;
                $pageItemCount = 0;
                $pageSgstTotal = 0;
                $pageIgstTotal = 0;
                foreach ($invoiceItems as $key => $invItem) {
                    $sno++;
                    $pageItemCount++;
                    $invItem = $this->getOrderItemDetails($invItem['order_item_id']);
                    $productOptions = $invItem->getProductOptions()['options'] ?? [];
                    //$invItem->setName($invItem->getName()." ".$invItem->getName()." ".$invItem->getName());
                    $nOfRow = round((strlen($invItem->getName()) / 24) +.5, 0);
                    $lineHeignt = ($nOfRow*10)+ (count($productOptions)*10) + 5;
                    $itemName = str_split($invItem->getName(), 24);
                    $namePos = $itemHeignt;
                    foreach ($itemName as $key => $slice) {
                        $page->drawText(trim($slice), 25, $namePos, 'UTF-8'); // product Name
                        $namePos -= 10;
                    }
                    foreach ($productOptions as $option) {
                        $page->drawText(trim($option['label']." : ".$option['value']), 25, $namePos, 'UTF-8'); // product Name
                        $namePos -= 10;
                    }
                    $page->drawText($sno.".", 6, $itemHeignt, 'UTF-8'); // S No

                    $page->drawText($invItem->getSku(), 130, $itemHeignt, 'UTF-8'); // SKU
                    $pageQty += $invItem->getQtyOrdered();
                    $page->drawText(floatval($invItem->getQtyOrdered()), 180, $itemHeignt, 'UTF-8'); //qty
                    $page->drawText($fmt->formatCurrency($invItem->getPrice(), "INR"), 215, $itemHeignt, 'UTF-8'); // rate
                    $page->drawText(__('xx'), 250, $itemHeignt, 'UTF-8'); // unit
                    $page->drawText(floatval($invItem->getDiscountPercent())." %", 285, $itemHeignt, 'UTF-8'); // discount
                    $taxAblTotal = $invItem->getRowTotal() - $invItem->getDiscountAmount();
                    $pageTaxAbleTotal += $taxAblTotal;
                    $page->drawText($fmt->formatCurrency($taxAblTotal, "INR"), 325, $itemHeignt, 'UTF-8'); // taxable value after discount
                    $itemIgst = 0;
                    if ($shippingAdd['region_id'] == $sellerAddress['region_id']) {
                        $itemIgst = $invItem->getCgst();
                        $page->drawText(floatval($invItem->getCgstPercent())." %", 385, $itemHeignt, 'UTF-8'); //CGST %
                        $page->drawText($fmt->formatCurrency($itemIgst, "INR"), 430, $itemHeignt, 'UTF-8'); //CGST
                    } else {
                        $itemIgst = $invItem->getIgst();
                        $page->drawText(floatval($invItem->getIgstPercent())." %", 385, $itemHeignt, 'UTF-8'); //IGST %
                        $page->drawText($fmt->formatCurrency($itemIgst, "INR"), 430, $itemHeignt, 'UTF-8'); //IGST
                    }
                    $pageIgstTotal += $itemIgst;

                    $itemSgst = $invItem->getSgst();
                    $pageSgstTotal += $itemSgst;
                    $page->drawText(floatval($invItem->getSgstPercent())." %", 470, $itemHeignt, 'UTF-8'); //SGST %
                    $page->drawText($fmt->formatCurrency($itemSgst, "INR"), 510, $itemHeignt, 'UTF-8'); //SGST
                    $totalAmt = ($invItem->getRowTotalInclTax() - $invItem->getDiscountAmount());
                    $pageTotal += $totalAmt;
                    //$pageTax += 0;
                    $page->drawText($fmt->formatCurrency($totalAmt, "INR"), 543, $itemHeignt, 'UTF-8'); //Total
                    $itemHeignt = $itemHeignt - $lineHeignt;
                    //if ($pageItemCount == $perPageItem || $totalItem == $sno) {
                    if ($itemHeignt <= ($hight-398) || $totalItem == $sno) {
                        $style = new \Zend_Pdf_Style();
                        $style->setLineColor(new \Zend_Pdf_Color_Rgb(0,0,0));
                        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES_BOLD);
                        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL_BOLD);
                        $style->setFont($font,9);
                        $page->setStyle($style);
                        $page->drawText(__('Total '), 100, $hight-398, 'UTF-8');

                        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);
                        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL);
                        $style->setFont($font,9);
                        $page->setStyle($style);

                        $page->drawText($pageQty, 178, $hight-398, 'UTF-8');
                        $page->drawText($fmt->formatCurrency($pageTaxAbleTotal, "INR"), 325, $hight-398, 'UTF-8');
                        $page->drawText($fmt->formatCurrency($pageIgstTotal, "INR"), 430, $hight-398, 'UTF-8');
                        $page->drawText($fmt->formatCurrency($pageSgstTotal, "INR"), 512, $hight-398, 'UTF-8');
                        //$page->drawText($fmt->formatCurrency($pageIgstTotal, "INR")."xx", 522, $hight-398, 'UTF-8');

                        $style->setFont($font,8);
                        $page->setStyle($style);
                        $page->drawText('E.& O.E.', 560, $hight-410, 'UTF-8');

                        $style = new \Zend_Pdf_Style();
                        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES_BOLD);
                        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL_BOLD);
                        $style->setFont($font,9);
                        $page->setStyle($style);
                        $page->drawText($fmt->formatCurrency($pageTotal, "INR"), 543, $hight-398, 'UTF-8');
                        $totalInWords = ucwords($this->getIndianCurrency($pageTotal));
                        $page->drawText($totalInWords, 145, $hight-415, 'UTF-8');

                        $totalInWords = ucwords($this->getIndianCurrency($pageIgstTotal));
                        $page->drawText($totalInWords, 110, $hight-448, 'UTF-8');

                        $pdf->pages[] = $page;
                        $page = $this->getPreparedPage(
                            $pdf,
                            $data,
                            $order,
                            $shippingAdd,
                            $billingAdd,
                            $sellerAddress,
                            $seller,
                            $customer,
                            $isSameState
                        );
                        $pageTotal = 0;
                        $pageQty = 0;
                        $pageTax = 0;
                        $pageTaxAbleTotal = 0;
                        $itemHeignt = $hight;
                        $pageItemCount = 0;
                    }
                }
                $fileName = 'invoice-'.$data['invoice_number'].'_'.$order->getIncrementId().'.pdf';
                return $this->fileFactory->create(
                   $fileName,
                   $pdf->render(),
                   \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR, // this pdf will be saved in var directory with the name magedelight.pdf
                   'application/pdf'
                );
            } else {
                $this->messageManager->addError(__('Seller Shipping address not set.'));
            }
        } catch (\Exception $e) {
            $this->logger->addError(__('CustomInvoice : %1', $e->getMessage()));
            $this->logger->addError('seller Address '.json_encode($sellerAddress));
            $this->messageManager->addError(__('Something went wrong.'));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/view/id/'.$data['order_id']);
    }

    /**
     * Get Order Item Details
     *
     * @param int $itemId
     * @return array
     */
    public function getOrderItemDetails($itemId)
    {
        $orderItemDetails = $this->orderItem->load($itemId);
        return $orderItemDetails;
    }

    /**
     * GetPreparedPage
     */
    public function getPreparedPage(
        $pdf,
        $data,
        $order,
        $shippingAdd,
        $billingAdd,
        $sellerAddress,
        $seller,
        $customer,
        $isSameState
    ) {
        $page = $pdf->newPage(\Zend_Pdf_Page::SIZE_A4); // this will get reference to the first page.
        $style = new \Zend_Pdf_Style();
        $style->setLineColor(new \Zend_Pdf_Color_Rgb(0,0,0));
        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);
        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL);
        $style->setFont($font,11);
        $page->setStyle($style);
        $width = $page->getWidth(); //595
        $hight = $page->getHeight(); //842
        $x = 30;
        $pageTopalign = 775;
        $this->y = 765;
        $style->setLineWidth(1.5);
        $page->setStyle($style);
        //Page Border
        $page->drawRectangle(2, 15, $page->getWidth()-2, $hight-2, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
        //1st block on top
        $page->drawLine(2, $hight-40, $page->getWidth()-1, $hight-40);
        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES_BOLD);
        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL_BOLD);
        $style->setFont($font, 16);
        $page->setStyle($style);
        $page->drawText(__('Tax Invoice'), (($width/2) - 30), ($hight-25), 'UTF-8');
        $base = $this->directoryList->getPath('media');
        //$customFont = $this->directoryList->getPath('app');
        $position = $this->scopeConfig->getValue('custom_invoice/options/logo_position');
        $logoFile = $this->scopeConfig->getValue('custom_invoice/options/invoice_logo');
        $imagePath = $base."/invoicelogo/".$logoFile;
        if ($this->fileDriver->isExists($imagePath)) {
            $image = \Zend_Pdf_Image::imageWithPath($imagePath);
            if ($position) {
                $page->drawImage($image, ($width/2)+150, ($hight-37), ($width/2)+238, ($hight-5));
            } else {
                $page->drawImage($image, 5, ($hight-37), 93, ($hight-5));
            }
        }
        // 2nd Block
        $hight = $hight-40;
        $style->setLineWidth(.5);
        $page->setStyle($style);
        $page->drawRectangle(30, $hight - 80, (($width/2) - 50), $hight - 20, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
        $page->drawLine(2, $hight-80, $page->getWidth()-1, $hight-80);
        $b1XP = ($width/2) - 50;
        $page->drawLine(30, $hight-65, $b1XP, $hight-65);
        $page->drawLine(30, $hight-50, $b1XP, $hight-50);
        $page->drawLine(30, $hight-35, $b1XP, $hight-35);
        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);

        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL);
        $style->setFont($font,8);
        $page->setStyle($style);

        $page->drawText(__('Invoice No.'), 32, $hight-33, 'UTF-8');
        $page->drawText($data['invoice_number'], 118, $hight-33, 'UTF-8');

        $page->drawText(__('Invoice Date'), 32, $hight-48, 'UTF-8');
        $page->drawText(date("d/m/Y"), 118, $hight-48, 'UTF-8');

        $page->drawText(__('Customer Order No.'), 32, $hight-63, 'UTF-8');
        $page->drawText('#'.$order->getIncrementId(), 118, $hight-63, 'UTF-8');

        $page->drawText(__('Customer Order Date'), 32, $hight-78, 'UTF-8');
        $page->drawText(date("d M Y h:i:s a", strtotime($order->getCreatedAt())), 118, $hight-78, 'UTF-8');
        $page->drawLine(115, $hight-80, 115, $hight-20);

        $page->drawRectangle((($width/2) + 50), $hight - 80, $width - 2, $hight - 35, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
        $b2XP = (($width/2) + 50);
        $page->drawLine($b2XP, $hight-65, $width - 2, $hight-65);
        $page->drawLine($b2XP, $hight-50, $width - 2, $hight-50);

        $page->drawText(__('Internal Doc. Control No.'), $b2XP+2, $hight-48, 'UTF-8');
        $page->drawText($data['int_doc_ctr_n'], 455, $hight-48, 'UTF-8');

        $page->drawText(__('Consignment No.'), $b2XP+2, $hight-63, 'UTF-8');
        $shipmentList = $this->shipmentFactory->create()->getCollection()
                            ->addFieldToFilter('order_id', $order->getEntityId())
                            ->addFieldToFilter('seller_id', $seller->getEntityId())
                            ->setPageSize(2)->setCurPage(1)
                            ->getColumnValues('tracking_number');
        $page->drawText(implode(", ", $shipmentList), 455, $hight-63, 'UTF-8');

        $page->drawText(__('Payment Mode:'), $b2XP+2, $hight-78, 'UTF-8');
        $paymentMode = $order->getPayment()->getMethodInstance()->getTitle();
        $page->drawText($paymentMode, 455, $hight-78, 'UTF-8');
        $page->drawLine(450, $hight-80, 450, $hight-35);

        $hight = $hight-80;
        $page->drawText(__('Bill To / Place of Supply'), 8, $hight-35, 'UTF-8');
        $page->drawLine(2, $hight-40, ($width/2)/2, $hight-40);
        //set Billing address
        $page->drawText($billingAdd['firstname'].' '.$billingAdd['lastname'], 10, $hight-50, 'UTF-8');
        $page->drawText($billingAdd['company'], 10, $hight-60, 'UTF-8');
        $page->drawText($billingAdd['street'].", ".$billingAdd['city'], 10, $hight-70, 'UTF-8');
        $stateCode = $isSameState[$billingAdd['region_id']] ?? 'Not set';
        $page->drawText(
            'State Code : '.$stateCode.' '.$billingAdd['region'],
            10,
            $hight-80,
            'UTF-8'
        );
        $page->drawText($billingAdd['country_id'].' - '.$billingAdd['postcode'], 10, $hight-90, 'UTF-8');
        $page->drawText('Mo. - '.$billingAdd['telephone'], 10, $hight-100, 'UTF-8');
        $page->drawText('Email - '.$billingAdd['email'], 10, $hight-110, 'UTF-8');
        $gstin = isset($billingAdd['gstin']) && $billingAdd['gstin'] ? 'GSTIN - '.$billingAdd['gstin'].' ' : '';
        $page->drawText($gstin.'PAN - '.$customer->getPan(), 10, $hight-120, 'UTF-8');

        $page->drawText(__('Ship To / Place of Delivery'), (($width/2)/2)+10, $hight-35, 'UTF-8');
        $page->drawLine((($width/2)/2)+10, $hight-40, ($width/2), $hight-40);
        // Set shipping address
        $page->drawText($shippingAdd['firstname'].' '.$shippingAdd['lastname'], (($width/2)/2)+10, $hight-50, 'UTF-8');
        $page->drawText($shippingAdd['company'], (($width/2)/2)+10, $hight-60, 'UTF-8');
        $page->drawText($shippingAdd['street'].', '.$shippingAdd['city'], (($width/2)/2)+10, $hight-70, 'UTF-8');
        $stateCode = $isSameState[$shippingAdd['region_id']] ?? 'Not set';
        $page->drawText(
            'State Code : '.$stateCode.' '.$shippingAdd['region'],
            (($width/2)/2)+10,
            $hight-80,
            'UTF-8'
        );
        //$page->drawText($shippingAdd['city'].', '.$shippingAdd['region'], (($width/2)/2)+10, $hight-80, 'UTF-8');
        $page->drawText($shippingAdd['country_id'].' - '.$shippingAdd['postcode'], (($width/2)/2)+10, $hight-90, 'UTF-8');
        $page->drawText('Mo. - '.$shippingAdd['telephone'], (($width/2)/2)+10, $hight-100, 'UTF-8');
        $page->drawText('Email - '.$shippingAdd['email'], (($width/2)/2)+10, $hight-110, 'UTF-8');

        $page->drawText(__('Seller'), ($width/2)+35, $hight-35, 'UTF-8');
        $page->drawLine(($width/2)+35, $hight-40, $width-2 , $hight-40);
        $page->drawText($sellerAddress['company'], ($width/2)+35, $hight-50, 'UTF-8');
        $street = json_decode($sellerAddress['street']);
        $page->drawText(implode(', ',$street).", ".$sellerAddress['city'], ($width/2)+35, $hight-60, 'UTF-8');
        $stateCode = $isSameState[$sellerAddress['region_id']] ?? 'Not set';
        $page->drawText(
            'State Code : '.$stateCode.' '.$sellerAddress['region'],
            ($width/2)+35,
            $hight-70,
            'UTF-8'
        );
        //$page->drawText($sellerAddress['city'].', '.$sellerAddress['region'], ($width/2)+35, $hight-70, 'UTF-8');
        $page->drawText($sellerAddress['country_id'].' - '.$sellerAddress['postal_code'], ($width/2)+35, $hight-80, 'UTF-8');
        $page->drawText('Mo.- '.$sellerAddress['telephone'], ($width/2)+35, $hight-90, 'UTF-8');
        $page->drawText('CIN - '.$seller->getCin(), ($width/2)+35, $hight-100, 'UTF-8');
        $page->drawText(
            'GSTIN - '.$seller->getSellerGstin().', PAN - '.$seller->getPan(),
            ($width/2)+35,
            $hight-110,
            'UTF-8'
        );

        $hight = $hight-55;
        $page->drawLine(2, $hight-75, $width-2 , $hight-75);
        $page->drawLine(2, $hight-105, $width-2 , $hight-105);

        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES_BOLD);
        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL_BOLD);
        $style->setFont($font,8);
        $page->setStyle($style);
        $page->drawLine(2, $hight-510, $width-2 , $hight-510);
        $page->drawLine(2, $hight-525, $width-2 , $hight-525);
        $page->drawText(__('S.'), 7, $hight - 83, 'UTF-8');
        $page->drawText(__('No.'), 7, $hight - 96, 'UTF-8');

        $page->drawLine(22, $hight-75, 22, $hight-525);
        $page->drawText(__('Description of Goods'), 25, $hight - 96, 'UTF-8');

        $page->drawLine(125, $hight-75, 125, $hight-525);
        $page->drawText(__('HSN/SAC'), 128, $hight - 96, 'UTF-8');

        $page->drawLine(175, $hight-75, 175, $hight-525);
        $page->drawText(__('Quantity'), 176, $hight - 96, 'UTF-8');

        $page->drawLine(210, $hight-75, 210, $hight-525);
        $page->drawText(__('Rate'), 213, $hight - 83, 'UTF-8');
        $page->drawText(__('Rs.'), 213, $hight - 96, 'UTF-8');

        $page->drawLine(245, $hight-75, 245, $hight-525);
        $page->drawText(__('Unit of'), 246, $hight - 83, 'UTF-8');
        $page->drawText(__('Measure'), 246, $hight - 96, 'UTF-8');

        $page->drawLine(280, $hight-75, 280, $hight-525);
        $page->drawText(__('Discount'), 283, $hight - 96, 'UTF-8');

        $page->drawLine(320, $hight-75, 320, $hight-525);
        $page->drawText(__('Taxable Value'), 322, $hight - 83, 'UTF-8');
        $page->drawText(__('(after discount)'), 321, $hight - 94, 'UTF-8');
        $page->drawText(__('Rs.'), 326, $hight - 103, 'UTF-8');

        $page->drawLine(380, $hight-75, 380, $hight-525);
        $orderTax = '';

        if ($shippingAdd['region_id'] == $sellerAddress['region_id']) {
            $page->drawText(__('CGST'), 413, $hight - 86, 'UTF-8');
        } else {
            $page->drawText(__('IGST'), 413, $hight - 86, 'UTF-8');
        }
        $page->drawLine(380, $hight-90, 540, $hight-90);
        $page->drawLine(425, $hight-90, 425, $hight-525);
        $page->drawText(__('Rate %'), 385, $hight - 100, 'UTF-8');
        $page->drawText(__('Rs.'), 435, $hight - 100, 'UTF-8');

        $page->drawLine(465, $hight-75, 465, $hight-525);
        $page->drawText(__('SGST'), 490, $hight - 86, 'UTF-8');
        $page->drawLine(505, $hight-90, 505, $hight-525);
        $page->drawText(__('Rate %'), 472, $hight - 100, 'UTF-8');
        $page->drawText(__('Rs.'), 515, $hight - 100, 'UTF-8');

        $page->drawLine(540, $hight-75, 540, $hight-525);
        $page->drawText(__('Amount'), 543, $hight - 86, 'UTF-8');
        // bottom block
        //$font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);
        $font = \Zend_Pdf_Font::fontWithPath(self::FONT_ARIAL);
        $style->setFont($font,9);
        $page->setStyle($style);

        $page->drawText(__('Amount Chargreable (in words) :-'), 5, $hight-537, 'UTF-8');
        $page->drawLine(2, $hight-560, $width-2, $hight-560);

        $page->drawText(__('Tax Amount (in words) :- '), 5, $hight-570, 'UTF-8');

        if ($position) {
            $page->drawText(__('Declaration'), 5, $hight-590, 'UTF-8');
            $page->drawLine(2, $hight-592, 55, $hight-592);
            $page->drawText(__('We declare that this invoice shows the actual price of the'), 5, $hight-603, 'UTF-8');
            $page->drawText(__('Services/goods described and that all particulars are true and correct.'), 5, $hight-613, 'UTF-8');
            $page->drawRectangle(($width/2), 15, $width-2, 80, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
            $page->drawText(__('For Supplier - '.$sellerAddress['company']), 400, 70, 'UTF-8');
            $page->drawText(__('Authorised Signatory'), 505, 18, 'UTF-8');

            $logoFile = $this->scopeConfig->getValue('custom_invoice/options/bottom_logo');
            $imagePath = $base."/invoicelogo/".$logoFile;
            if ($this->fileDriver->isExists($imagePath)) {
                $image = \Zend_Pdf_Image::imageWithPath($imagePath);
                $page->drawImage($image, 5, 20, 103, 50);
            }
        } else {
            $page->drawText(__('Declaration'), 5, $hight-612, 'UTF-8');
            $page->drawLine(2, $hight-614, 55, $hight-614);
            $page->drawText(__('We declare that this invoice shows the actual price of the'), 5, $hight-625, 'UTF-8');
            $page->drawText(__('Services/goods described and that all particulars are true and correct.'), 5, $hight-635, 'UTF-8');
            $page->drawText(__('Whether supply is liable to reverse charge- NO'), 5, $hight-645, 'UTF-8');
            $page->drawRectangle(($width/2), 15, $width-2, 67, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
            $page->drawText(__('For Supplier - '.$sellerAddress['company']), 400, 57, 'UTF-8');
            $page->drawText(__('Authorised Signatory'), 505, 18, 'UTF-8');
        }

        $page->drawText(__('This is a Computer Generated Invoice'), ($width/2), 3, 'UTF-8');
        return $page;
    }

    function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        $rsText = $paise ? 'Rupees and' : 'Rupees';
        return ($Rupees ? $Rupees . $rsText.' ' : '') . $paise .'Only';
    }

    /**
     * Is SameState
     *
     * @param array $shippingAdd
     * @param array $billingAdd
     * @return array
     */
    private function isSameState($shippingAdd, $billingAdd, $sellerAddress)
    {
        $stateList = $this->gstStateCodeFactory->create()->getCollection()
                            ->addFieldToFilter(
                                'state_code',
                                ['in' => [
                                    $shippingAdd['region_id'],
                                    $billingAdd['region_id'],
                                    $sellerAddress['region_id']
                                ]]
                            );
        $stateGstCode = [];
        foreach($stateList as $state){
            $stateGstCode[$state->getStateCode()] = $state->getGstStateCode();
        }
        return $stateGstCode;
    }
}
