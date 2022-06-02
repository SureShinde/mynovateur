<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\MarketplaceGstIndia\Model\Marketplace\Order\Pdf;

use Magento\Customer\Model\Session;

/**
 * Marketplace Order Creditmemo PDF model
 */
class Creditmemo extends \Webkul\Marketplace\Model\Order\Pdf\Creditmemo
{
    /**
     * @var \Webkul\Marketplace\Helper\Data
     */
    protected $mpHelper;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var \Magento\Framework\Stdlib\StringUtils
     */
    protected $_string;
    /**
     * @var \Magento\Framework\StringUtils
     */
    protected $_order;

    /**
     * @param \Webkul\Marketplace\Helper\Data $mpHelper
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Payment\Helper\Data $paymentData
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Sales\Model\Order\Pdf\Config $pdfConfig
     * @param \Magento\Sales\Model\Order\Pdf\Total\Factory $pdfTotalFactory
     * @param \Magento\Sales\Model\Order\Pdf\ItemsFactory $pdfItemsFactory
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Sales\Model\Order\Address\Renderer $addressRenderer
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Locale\ResolverInterface $localeResolver
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $gstHelper
     * @param \Webkul\MarketplaceGstIndia\Model\Order\Pdf\Creditmemo $creditmemo
     * @param \Magento\Store\Model\App\Emulation $appEmulation
     * @param array $data
     */
    public function __construct(
        \Webkul\Marketplace\Helper\Data $mpHelper,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Sales\Model\Order\Pdf\Config $pdfConfig,
        \Magento\Sales\Model\Order\Pdf\Total\Factory $pdfTotalFactory,
        \Magento\Sales\Model\Order\Pdf\ItemsFactory $pdfItemsFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Sales\Model\Order\Address\Renderer $addressRenderer,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Locale\ResolverInterface $localeResolver,
        \Webkul\MarketplaceGstIndia\Helper\Data $gstHelper,
        \Webkul\MarketplaceGstIndia\Model\Order\Pdf\Creditmemo $creditmemo,
        \Magento\Store\Model\App\Emulation $appEmulation,
        array $data = []
    ) {
        $this->helper = $mpHelper;
        $this->_objectManager = $objectManager;
        $this->_string = $string;
        $this->creditmemo = $creditmemo;
        $this->_gstHelper = $gstHelper;
        $this->_localeResolver = $localeResolver;
        parent::__construct(
            $mpHelper,
            $paymentData,
            $string,
            $scopeConfig,
            $filesystem,
            $pdfConfig,
            $pdfTotalFactory,
            $pdfItemsFactory,
            $localeDate,
            $inlineTranslation,
            $addressRenderer,
            $storeManager,
            $appEmulation,
            $data
        );
    }
    
    /**
     * Return PDF document
     *
     * @param  array $creditmemos
     * @return \Zend_Pdf
     */
    public function getPdf($creditmemos = [])
    {
        $isEnabled = $this->_gstHelper->getConfigValue('status');
        if (!$isEnabled) {
            return parent::getPdf($creditmemos);
        }

        $this->_beforeGetPdf();
        $this->_initRenderer('creditmemo');

        $pdf = new \Zend_Pdf();
        $this->_setPdf($pdf);
        $style = new \Zend_Pdf_Style();
        $this->_setFontBold($style, 10);

        foreach ($creditmemos as $creditmemo) {
            if ($creditmemo->getStoreId()) {
                $this->_localeResolver->emulate($creditmemo->getStoreId());
                $this->_storeManager->setCurrentStore($creditmemo->getStoreId());
            }
            $page = $this->newPage();
            $order = $creditmemo->getOrder();
            $this->creditmemo->_order = $order;
            /* Add image */
            $this->insertLogo($page, $creditmemo->getStore());
            /* Add address */
            $this->insertAddress($page, $creditmemo->getStore());
            /* Add head */
            $this->insertOrder(
                $page,
                $order,
                $this->_scopeConfig->isSetFlag(
                    self::XML_PATH_SALES_PDF_CREDITMEMO_PUT_ORDER_ID,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    $order->getStoreId()
                )
            );
            /* Add document text and number */
            $this->insertDocumentNumber($page, __('Credit Memo # ') . $creditmemo->getIncrementId());
            if ($isEnabled && $this->_gstHelper->getCountryFromOrder($order) == 'IN') {
                $seller = $this->helper->getCustomer();
                if ($seller) {
                    $this->creditmemo->insertGstNumber($page, __('GSTIN # ') . $seller->getSellerGstin());
                } else {
                    $this->creditmemo->insertGstNumber($page, __('GSTIN # ') .
                    $this->_gstHelper->getConfigValue('gstin'));
                }
            }
            $itemCount = 0;
            $this->creditmemo->_drawHeader($page, 537);
            /* Add body */
            foreach ($creditmemo->getAllItems() as $item) {
                if ($item->getOrderItem()->getParentItem()) {
                    continue;
                }
                /* Draw item */
                $this->_drawItem($item, $page, $order);
                $page = end($pdf->pages);
            }
            /* Add totals */
            $this->creditmemo->insertTotals($page, $creditmemo);
        }
        $this->_afterGetPdf();
        if ($creditmemo->getStoreId()) {
            $this->_localeResolver->revert();
        }
        return $pdf;
    }

    /**
     * Get string
     *
     * @return \Magento\Framework\Stdlib\StringUtils
     */
    public function getString()
    {
        return $this->_string;
    }

    /**
     * Object manager
     *
     * @return \Magento\Framework\ObjectManagerInterface
     */
    public function getObjectManager()
    {
        return $this->_objectManager;
    }

    /**
     * Insert order to seller's order pdf page
     *
     * @param \Zend_Pdf_Page\Zend_Pdf_Page $sellerPdfPageUpdated
     * @param \Magento\Sales\Model\Order $sellerOrderObj
     * @param bool $putOrderId
     * @return void
     */
    protected function insertOrder(&$sellerPdfPageUpdated, $sellerOrderObj, $putOrderId = true)
    {
        if ($sellerOrderObj instanceof \Magento\Sales\Model\Order) {
            $sellerShipment = null;
            $sellerOrder = $sellerOrderObj;
        } elseif ($sellerOrderObj instanceof \Magento\Sales\Model\Order\Shipment) {
            $sellerShipment = $sellerOrderObj;
            $sellerOrder = $sellerShipment->getOrder();
        }

        $isEnabled = $this->_gstHelper->getConfigValue('status');
        $this->y = $this->y ? $this->y : 815;
        $top = $this->y;

        $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0.45));
        $sellerPdfPageUpdated->setLineColor(new \Zend_Pdf_Color_GrayScale(0.45));
        $sellerPdfPageUpdated->drawRectangle(25, $top, 570, $top - 55);
        $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(1));
        $this->setDocHeaderCoordinates([25, $top, 570, $top - 55]);
        $this->_setFontRegular($sellerPdfPageUpdated, 10);

        if ($putOrderId) {
            $sellerPdfPageUpdated->drawText(
                __('Order # ') . $sellerOrder->getRealOrderId(),
                35,
                $top -= 30,
                'UTF-8'
            );
        }
        $sellerPdfPageUpdated->drawText(
            __('Order Date: ') .
            $this->_localeDate->formatDate(
                $this->_localeDate->scopeDate(
                    $sellerOrder->getStore(),
                    $sellerOrder->getCreatedAt(),
                    true
                ),
                \IntlDateFormatter::MEDIUM,
                false
            ),
            35,
            $top -= 15,
            'UTF-8'
        );

        $top -= 10;
        $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
        $sellerPdfPageUpdated->setLineColor(new \Zend_Pdf_Color_GrayScale(0.5));
        $sellerPdfPageUpdated->setLineWidth(0.5);
        $sellerPdfPageUpdated->drawRectangle(25, $top, 275, $top - 25);
        $sellerPdfPageUpdated->drawRectangle(275, $top, 570, $top - 25);

        if ($this->helper->getSellerProfileDisplayFlag()) {
            /* Calculate blocks info */
            $this->doInsertOrderExecution($sellerPdfPageUpdated, $sellerOrder, $sellerShipment, $top);
        } else {
            /* Calculate blocks info */

            /* Billing Address */
            $billingAddress = $this->_formatAddress(
                $this->addressRenderer->format(
                    $sellerOrder->getBillingAddress(),
                    'pdf'
                )
            );
            if ($isEnabled) {
                $billingAddress[] = "GSTIN: ".$sellerOrder->getBillingAddress()->getGstin();
            }

            /* Shipping Address and Method */
            if (!$sellerOrder->getIsVirtual()) {
                /* Shipping Address */
                $shippingAddress = $this->_formatAddress(
                    $this->addressRenderer->format($sellerOrder->getShippingAddress(), 'pdf')
                );
                if ($isEnabled) {
                    $shippingAddress[] = "GSTIN: ".$sellerOrder->getShippingAddress()->getGstin();
                }
                $shippingMethod = $sellerOrder->getShippingDescription();
            }

            $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
            $this->_setFontBold($sellerPdfPageUpdated, 12);
            $sellerPdfPageUpdated->drawText(__('Payment Method:'), 35, $top - 15, 'UTF-8');
            if (!$sellerOrder->getIsVirtual()) {
                $sellerPdfPageUpdated->drawText(__('Shipping Method:'), 285, $top - 15, 'UTF-8');
            }

            $addressesHeight = $this->_calcAddressHeight($billingAddress);
            if (isset($shippingAddress)) {
                $addressesHeight = max($addressesHeight, $this->_calcAddressHeight($shippingAddress));
            }

            $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(1));
            if (!$sellerOrder->getIsVirtual()) {
                $tracks = [];
                if ($sellerShipment) {
                    $tracks = $sellerShipment->getAllTracks();
                }
                if (count($tracks)) {
                    $addressesHeight = 30 * count($tracks) + $addressesHeight;
                }
                $sellerPdfPageUpdated->drawRectangle(25, $top - 25, 570, $top - 33 - $addressesHeight);
            } else {
                $sellerPdfPageUpdated->drawRectangle(25, $top - 25, 570, $top - 65);
            }
            $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
            $this->_setFontRegular($sellerPdfPageUpdated, 10);
            $this->y = $top - 40;
            $this->y -= 15;

            if (!$sellerOrder->getIsVirtual()) {
                $topMargin = 15;
                $methodStartY = $this->y;

                foreach ($this->string->split($shippingMethod, 45, true, true) as $_value) {
                    $sellerPdfPageUpdated->drawText(strip_tags(trim($_value)), 285, $this->y, 'UTF-8');
                    $this->y -= 15;
                }

                $yShipments = $this->y;
                $totalShippingChargesText = "(" . __(
                    'Total Shipping Charges'
                ) . " " . $sellerOrder->formatPriceTxt(
                    $sellerOrder->getShippingAmount()
                ) . ")";

                $sellerPdfPageUpdated->drawText(
                    $totalShippingChargesText,
                    285,
                    $yShipments - $topMargin,
                    'UTF-8'
                );
                $yShipments -= $topMargin + 10;

                $tracks = [];
                if ($sellerShipment) {
                    $tracks = $sellerShipment->getAllTracks();
                }
                if (count($tracks)) {
                    $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
                    $sellerPdfPageUpdated->setLineWidth(0.5);
                    $sellerPdfPageUpdated->drawRectangle(285, $yShipments, 510, $yShipments - 10);
                    $sellerPdfPageUpdated->drawLine(400, $yShipments, 400, $yShipments - 10);

                    $this->_setFontRegular($sellerPdfPageUpdated, 9);
                    $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
                    $sellerPdfPageUpdated->drawText(__('Title'), 290, $yShipments - 7, 'UTF-8');
                    $sellerPdfPageUpdated->drawText(__('Number'), 410, $yShipments - 7, 'UTF-8');

                    $yShipments -= 20;
                    $this->_setFontRegular($sellerPdfPageUpdated, 8);
                    foreach ($tracks as $track) {
                        $maxTitleLen = 45;
                        $endOfTitle = strlen($track->getTitle()) > $maxTitleLen ? '...' : '';
                        $truncatedTitle = substr($track->getTitle(), 0, $maxTitleLen) . $endOfTitle;
                        $sellerPdfPageUpdated->drawText($truncatedTitle, 292, $yShipments, 'UTF-8');
                        $sellerPdfPageUpdated->drawText($track->getNumber(), 410, $yShipments, 'UTF-8');
                        $yShipments -= $topMargin - 5;
                    }
                } else {
                    $yShipments -= $topMargin - 5;
                }

                $currentY = min($this->y, $yShipments);

                $this->y = $currentY;
                $this->y -= 15;
            } else {
                $this->y -= 55;
            }
        }
    }

    /**
     * Insert Seller logo to seller pdf page.
     *
     * @param \Zend_Pdf_Page $sellerPdfPageUpdated
     * @param null           $store
     */
    protected function insertLogo(&$sellerPdfPageUpdated, $store = null)
    {
        $sellerImageUpdated = '';
        $sellerImageFlag = 0;
        $sellerId = $this->helper->getCustomerId();
        // get seller data for store in which order is placed
        $collection = $this->helper->getSellerCollectionObj($sellerId);
        foreach ($collection as $row) {
            $sellerImageUpdated = $row->getLogoPic();
            if ($sellerImageUpdated) {
                $sellerImageFlag = 1;
            }
        }

        if ($sellerImageUpdated == '') {
            $sellerImageUpdated = $this->_scopeConfig
            ->getValue(
                'sales/identity/logo',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $store
            );
            $sellerImageFlag = 0;
        }
        $this->y = $this->y ? $this->y : 815;
        if ($sellerImageUpdated) {
            if ($sellerImageFlag == 0) {
                $sellerImagePath = '/sales/store/logo/'.$sellerImageUpdated;
            } else {
                $sellerImagePath = '/avatar/'.$sellerImageUpdated;
            }
            if ($this->_mediaDirectory->isFile($sellerImagePath)) {
                $sellerImageUpdated = \Zend_Pdf_Image::imageWithPath(
                    $this->_mediaDirectory->getAbsolutePath($sellerImagePath)
                );
                $imageTop = 830; //top border of the page
                $imageWidthLimit = 270; //image width half of the page width
                $imageHeightLimit = 270;
                $imageWidth = $sellerImageUpdated->getPixelWidth();
                $imageHeight = $sellerImageUpdated->getPixelHeight();

                //preserving seller image aspect ratio
                $imageRatio = $imageWidth / $imageHeight;
                if ($imageRatio > 1 && $imageWidth > $imageWidthLimit) {
                    $imageWidth = $imageWidthLimit;
                    $imageHeight = $imageWidth / $imageRatio;
                } elseif ($imageRatio < 1 && $imageHeight > $imageHeightLimit) {
                    $imageHeight = $imageHeightLimit;
                    $imageWidth = $imageHeight * $imageRatio;
                } elseif ($imageRatio == 1 && $imageHeight > $imageHeightLimit) {
                    $imageHeight = $imageHeightLimit;
                    $imageWidth = $imageWidthLimit;
                }
                $y1Axis = $imageTop - $imageHeight;
                $y2Axis = $imageTop;
                $x1Axis = 25;
                $x2Axis = $x1Axis + $imageWidth;
                //seller image coordinates after transformation seller image are rounded by Zend
                $sellerPdfPageUpdated->drawImage($sellerImageUpdated, $x1Axis, $y1Axis, $x2Axis, $y2Axis);
                $this->y = $y1Axis - 10;
            }
        }
    }

    /**
     * Insert seller address address and other info to pdf page.
     *
     * @param \Zend_Pdf_Page $sellerPdfPageUpdated
     * @param object $store
     */
    protected function insertAddress(&$sellerPdfPageUpdated, $store = null)
    {
        $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
        $font = $this->_setFontRegular($sellerPdfPageUpdated, 10);
        $sellerPdfPageUpdated->setLineWidth(0);
        $this->y = $this->y ? $this->y : 815;
        $imageTop = 815;

        $address = '';
        $sellerId = $this->helper->getCustomerId();
        // get seller data for store in which order is placed
        $collection = $this->helper->getSellerCollectionObj($sellerId);
        foreach ($collection as $row) {
            $address = $row->getOthersInfo();
        }

        if ($address == '') {
            $address = $this->_scopeConfig->getValue(
                'sales/identity/address',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $store
            );
        }

        foreach (explode("\n", $address) as $value) {
            if ($value !== '') {
                $value = preg_replace('/<br[^>]*>/i', "\n", $value);
                foreach ($this->string->split($value, 45, true, true) as $_value) {
                    $sellerPdfPageUpdated->drawText(
                        trim(strip_tags($_value)),
                        $this->getAlignRight($_value, 130, 440, $font, 10),
                        $imageTop,
                        'UTF-8'
                    );
                    $imageTop -= 10;
                }
            }
        }
        $this->y = $this->y > $imageTop ? $imageTop : $this->y;
    }

    /**
     * Do Insert Order Execution
     *
     * @param \Zend_Pdf_Page $sellerPdfPageUpdated
     * @param object $sellerOrder
     * @param object $sellerShipment
     * @param int $top
     * @return void
     */
    protected function doInsertOrderExecution($sellerPdfPageUpdated, $sellerOrder, $sellerShipment, $top)
    {
        /* Billing Address */
        $billingAddress = $this->_formatAddress(
            $this->addressRenderer->format(
                $sellerOrder->getBillingAddress(),
                'pdf'
            )
        );
        $isEnabled = $this->_gstHelper->getConfigValue('status');
        if ($this->_gstHelper->getCountryFromOrder($sellerOrder) != 'IN') {
            $isEnabled = false;
        }
        if ($isEnabled) {
            $billingAddress[] = "GSTIN: ".$sellerOrder->getBillingAddress()->getGstin();
        }

        /* Shipping Address and Method */
        if (!$sellerOrder->getIsVirtual()) {
            /* Shipping Address */
            $shippingAddress = $this->_formatAddress(
                $this->addressRenderer->format($sellerOrder->getShippingAddress(), 'pdf')
            );
            if ($isEnabled) {
                $shippingAddress[] = "GSTIN: ".$sellerOrder->getShippingAddress()->getGstin();
            }
            $shippingMethod = $sellerOrder->getShippingDescription();
        }

        $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
        $this->_setFontBold($sellerPdfPageUpdated, 12);
        $sellerPdfPageUpdated->drawText(__('Sold to:'), 35, $top - 15, 'UTF-8');

        if (!$sellerOrder->getIsVirtual()) {
            $sellerPdfPageUpdated->drawText(__('Ship to:'), 285, $top - 15, 'UTF-8');
        } else {
            $sellerPdfPageUpdated->drawText(__('Payment Method:'), 285, $top - 15, 'UTF-8');
        }

        $addressesHeight = $this->_calcAddressHeight($billingAddress);
        if (isset($shippingAddress)) {
            $addressesHeight = max($addressesHeight, $this->_calcAddressHeight($shippingAddress));
        }

        $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(1));
        $sellerPdfPageUpdated->drawRectangle(25, $top - 25, 570, $top - 33 - $addressesHeight);
        $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
        $this->_setFontRegular($sellerPdfPageUpdated, 10);
        $this->y = $top - 40;
        $addressesStartY = $this->y;

        foreach ($billingAddress as $value) {
            $sellerPdfPageUpdated = $this->calculateBillingYaxis($value, $sellerPdfPageUpdated);
        }

        $addressesEndY = $this->y;

        if (!$sellerOrder->getIsVirtual()) {
            $this->y = $addressesStartY;
            foreach ($shippingAddress as $value) {
                $sellerPdfPageUpdated = $this->calculateShippingYaxis($value, $sellerPdfPageUpdated);
            }

            $addressesEndY = min($addressesEndY, $this->y);
            $this->y = $addressesEndY;

            $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
            $sellerPdfPageUpdated->setLineWidth(0.5);
            $sellerPdfPageUpdated->drawRectangle(25, $this->y, 275, $this->y - 25);
            $sellerPdfPageUpdated->drawRectangle(275, $this->y, 570, $this->y - 25);

            $this->y -= 15;
            $this->_setFontBold($sellerPdfPageUpdated, 12);
            $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
            $sellerPdfPageUpdated->drawText(__('Payment Method'), 35, $this->y, 'UTF-8');
            $sellerPdfPageUpdated->drawText(__('Shipping Method:'), 285, $this->y, 'UTF-8');

            $this->y -= 10;
            $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(1));

            $this->_setFontRegular($sellerPdfPageUpdated, 10);
            $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));

            $paymentLeft = 35;
            $yPayments = $this->y - 15;
        } else {
            $yPayments = $addressesStartY;
            $paymentLeft = 285;
        }

        if ($sellerOrder->getIsVirtual()) {
            // replacement of Shipments-Payments rectangle block
            $yPayments = min($addressesEndY, $yPayments);
            $sellerPdfPageUpdated->drawLine(25, $top - 25, 25, $yPayments);
            $sellerPdfPageUpdated->drawLine(570, $top - 25, 570, $yPayments);
            $sellerPdfPageUpdated->drawLine(25, $yPayments, 570, $yPayments);

            $this->y = $yPayments - 15;
        } else {
            $topMargin = 15;
            $methodStartY = $this->y;
            $this->y -= 15;

            foreach ($this->string->split($shippingMethod, 45, true, true) as $_value) {
                $sellerPdfPageUpdated->drawText(strip_tags(trim($_value)), 285, $this->y, 'UTF-8');
                $this->y -= 15;
            }

            $yShipments = $this->y;
            $totalShippingChargesText = "(" . __(
                'Total Shipping Charges'
            ) . " " . $sellerOrder->formatPriceTxt(
                $sellerOrder->getShippingAmount()
            ) . ")";

            $sellerPdfPageUpdated->drawText($totalShippingChargesText, 285, $yShipments - $topMargin, 'UTF-8');
            $yShipments -= $topMargin + 10;

            $tracks = [];
            if ($sellerShipment) {
                $tracks = $sellerShipment->getAllTracks();
            }
            if (count($tracks)) {
                $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
                $sellerPdfPageUpdated->setLineWidth(0.5);
                $sellerPdfPageUpdated->drawRectangle(285, $yShipments, 510, $yShipments - 10);
                $sellerPdfPageUpdated->drawLine(400, $yShipments, 400, $yShipments - 10);

                $this->_setFontRegular($sellerPdfPageUpdated, 9);
                $sellerPdfPageUpdated->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
                $sellerPdfPageUpdated->drawText(__('Title'), 290, $yShipments - 7, 'UTF-8');
                $sellerPdfPageUpdated->drawText(__('Number'), 410, $yShipments - 7, 'UTF-8');

                $yShipments -= 20;
                $this->_setFontRegular($sellerPdfPageUpdated, 8);
                foreach ($tracks as $track) {
                    $maxTitleLen = 45;
                    $endOfTitle = strlen($track->getTitle()) > $maxTitleLen ? '...' : '';
                    $truncatedTitle = substr($track->getTitle(), 0, $maxTitleLen) . $endOfTitle;
                    $sellerPdfPageUpdated->drawText($truncatedTitle, 292, $yShipments, 'UTF-8');
                    $sellerPdfPageUpdated->drawText($track->getNumber(), 410, $yShipments, 'UTF-8');
                    $yShipments -= $topMargin - 5;
                }
            } else {
                $yShipments -= $topMargin - 5;
            }

            $currentY = min($yPayments, $yShipments);

            // replacement of Shipments-Payments rectangle block
            $sellerPdfPageUpdated->drawLine(25, $methodStartY, 25, $currentY);
            //left
            $sellerPdfPageUpdated->drawLine(25, $currentY, 570, $currentY);
            //bottom
            $sellerPdfPageUpdated->drawLine(570, $currentY, 570, $methodStartY);
            //right

            $this->y = $currentY;
            $this->y -= 15;
        }
    }

    /**
     * Calculate Billing Y-axis
     *
     * @param int $value
     * @param \Zend_Pdf_Page $sellerPdfPageUpdated
     * @return \Zend_Pdf_Page
     */
    protected function calculateBillingYaxis($value, $sellerPdfPageUpdated)
    {
        if ($value !== '') {
            $text = [];
            foreach ($this->string->split($value, 45, true, true) as $_value) {
                $text[] = $_value;
            }
            foreach ($text as $part) {
                $sellerPdfPageUpdated->drawText(strip_tags(ltrim($part)), 35, $this->y, 'UTF-8');
                $this->y -= 15;
            }
        }
        return $sellerPdfPageUpdated;
    }

    /**
     * Calculate Shipping Y-axis
     *
     * @param int $value
     * @param \Zend_Pdf_Page $sellerPdfPageUpdated
     * @return \Zend_Pdf_Page
     */
    protected function calculateShippingYaxis($value, $sellerPdfPageUpdated)
    {
        if ($value !== '') {
            $text = [];
            foreach ($this->string->split($value, 45, true, true) as $_value) {
                $text[] = $_value;
            }
            foreach ($text as $part) {
                $sellerPdfPageUpdated->drawText(strip_tags(ltrim($part)), 285, $this->y, 'UTF-8');
                $this->y -= 15;
            }
        }
        return $sellerPdfPageUpdated;
    }
}
