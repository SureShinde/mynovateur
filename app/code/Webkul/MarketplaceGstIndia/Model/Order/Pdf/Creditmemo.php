<?php
/**
 * Webkul Software
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 *
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Model\Order\Pdf;

use Magento\Sales\Model\ResourceModel\Order\Invoice\Collection;
use Magento\Sales\Model\Order\Pdf\AbstractPdf;

/**
 * Sales Order Invoice PDF model
 */
class Creditmemo extends \Magento\Sales\Model\Order\Pdf\Creditmemo
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Locale\ResolverInterface
     */
    protected $_localeResolver;

    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $_mpGstHelperData;
    /**
     * @var \Webkul\MarketplaceGstIndia\Model\Data
     */
    public $_order;

    /**
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
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelperData
     * @param \Magento\Store\Model\App\Emulation $appEmulation
     * @param array $data
     */
    public function __construct(
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
        \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelperData,
        \Magento\Store\Model\App\Emulation $appEmulation,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_localeResolver = $localeResolver;
        $this->_mpGstHelperData = $mpGstHelperData;
        parent::__construct(
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
     * Draw table header for product items
     *
     * @param  \Zend_Pdf_Page $pagememo
     * @param  int $y
     * @return void
     */
    protected function _drawHeader(\Zend_Pdf_Page $pagememo, $y = 525)
    {
        $this->y = $y;
        $isEnabled = $this->_mpGstHelperData->getConfigValue('status');
        if ($this->_mpGstHelperData->getCountryFromOrder($this->_order) != 'IN') {
            $isEnabled = false;
        }
        if (!$isEnabled) {
            parent::_drawHeader($pagememo);
            return;
        }

        $this->_setFontRegular($pagememo, 10);
        $pagememo->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
        $pagememo->setLineColor(new \Zend_Pdf_Color_GrayScale(0.5));
        $pagememo->setLineWidth(0.5);
        $pagememo->drawRectangle(25, $this->y, 570, $this->y - 15);
        $this->y -= 10;
        $pagememo->setFillColor(new \Zend_Pdf_Color_Rgb(0, 0, 0));

        //columns headers
        $lines[0][] = ['text' => __('Products'), 'feed' => 35];

        $lines[0][] = [
            'text' => $this->string->split(__('Total (ex)'), 12, true, true),
            'feed' => 220,
            'align' => 'right',
        ];

        $lines[0][] = [
            'text' => $this->string->split(__('Discount'), 12, true, true),
            'feed' => 268,
            'align' => 'right',
        ];

        $lines[0][] = [
            'text' => $this->string->split(__('Qty'), 12, true, true),
            'feed' => 300,
            'align' => 'right',
        ];

        if ($isEnabled) {
            $lines[0][] = [
                'text' => $this->string->split(__('SGST'), 12, true, true),
                'feed' => 340,
                'align' => 'right'
            ];
            $lines[0][] = [
                'text' => $this->string->split(__('CGST'), 12, true, true),
                'feed' => 380,
                'align' => 'right'
            ];
            $lines[0][] = [
                'text' => $this->string->split(__('IGST'), 12, true, true),
                'feed' => 420,
                'align' => 'right'
            ];
            $lines[0][] = [
                'text' => $this->string->split(__('UTGST'), 12, true, true),
                'feed' => 460,
                'align' => 'right'
            ];
            $lines[0][] = [
                'text' => $this->string->split(__('GST'), 12, true, true),
                'feed' => 510,
                'align' => 'right'
            ];
        } else {
            $lines[0][] = [
                'text' => $this->string->split(__('Tax'), 12, true, true),
                'feed' => 520,
                'align' => 'right'
            ];
        }

        $lines[0][] = [
            'text' => $this->string->split(__('Total (inc)'), 12, true, true),
            'feed' => 565,
            'align' => 'right',
        ];

        $lineBlock = ['lines' => $lines, 'height' => 10];

        $this->drawLineBlocks($pagememo, [$lineBlock], ['table_header' => true]);
        $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
        $this->y -= 20;
    }

    /**
     * Return PDF document
     *
     * @param  array $creditmemos
     * @return \Zend_Pdf
     */
    public function getPdf($creditmemos = [])
    {
        if (!$this->_mpGstHelperData->getConfigValue('status')) {
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
            $pagememo = $this->newPage();
            $order = $creditmemo->getOrder();
            if ($this->_mpGstHelperData->getCountryFromOrder($order) != 'IN') {
                return parent::getPdf($creditmemos);
            }
            $this->_order = $order;
            /* Add image */
            $this->insertLogo($pagememo, $creditmemo->getStore());
            /* Add address */
            $this->insertAddress($pagememo, $creditmemo->getStore());
            /* Add head */
            $this->insertOrder(
                $pagememo,
                $order,
                $this->_scopeConfig->isSetFlag(
                    self::XML_PATH_SALES_PDF_CREDITMEMO_PUT_ORDER_ID,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    $order->getStoreId()
                )
            );
            /* Add document text and number */
            $this->insertDocumentNumber($pagememo, __('Credit Memo # ') . $creditmemo->getIncrementId());
            if ($this->_mpGstHelperData->getConfigValue('status') &&
                $this->_mpGstHelperData->getCountryFromOrder($order) == 'IN') {
                $this->insertGstNumber($pagememo, __('GSTIN # ') . $this->_mpGstHelperData->getConfigValue('gstin'));
            }
            /* Add table head */
            $this->_drawHeader($pagememo);
            /* Add body */
            foreach ($creditmemo->getAllItems() as $item) {
                if ($item->getOrderItem()->getParentItem()) {
                    continue;
                }
                /* Draw item */
                $this->_drawItem($item, $pagememo, $order);
                $pagememo = end($pdf->pages);
            }
            /* Add totals */
            $this->insertTotals($pagememo, $creditmemo);
        }
        $this->_afterGetPdf();
        if ($creditmemo->getStoreId()) {
            $this->_localeResolver->revert();
        }
        return $pdf;
    }

    /**
     * Insert title and number for concrete document type
     *
     * @param  \Zend_Pdf_Page $pagememo
     * @param  string $text
     * @return void
     */
    public function insertGstNumber(\Zend_Pdf_Page $pagememo, $text)
    {
        $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(1));
        $this->_setFontRegular($pagememo, 10);
        $docHeader = $this->getDocHeaderCoordinates();
        $pagememo->drawText($text, 286, $docHeader[1] - 15, 'UTF-8');
    }

    /**
     * Insert order to pdf page
     *
     * @param \Zend_Pdf_Page $pagememo
     * @param \Magento\Sales\Model\Order $obj
     * @param bool $putOrderId
     * @return void
     */
    protected function insertOrder(&$pagememo, $obj, $putOrderId = true)
    {
        if ($obj instanceof \Magento\Sales\Model\Order) {
            $shipment = null;
            $order = $obj;
        } elseif ($obj instanceof \Magento\Sales\Model\Order\Shipment) {
            $shipment = $obj;
            $order = $shipment->getOrder();
        }

        $isEnabled = $this->_mpGstHelperData->getConfigValue('status');
        if ($this->_mpGstHelperData->getCountryFromOrder($order) != 'IN') {
            $isEnabled = false;
        }
        if (!$isEnabled) {
            AbstractPdf::insertOrder($pagememo, $obj, $putOrderId);
            return;
        }

        $this->y = $this->y ? $this->y : 815;
        $top = $this->y;

        $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(0.45));
        $pagememo->setLineColor(new \Zend_Pdf_Color_GrayScale(0.45));
        $pagememo->drawRectangle(25, $top, 570, $top - 55);
        $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(1));
        $this->setDocHeaderCoordinates([25, $top, 570, $top - 55]);
        $this->_setFontRegular($pagememo, 10);

        if ($putOrderId) {
            $pagememo->drawText(__('Order # ') . $order->getRealOrderId(), 35, $top -= 30, 'UTF-8');
            $top +=15;
        }

        $top -=30;
        $pagememo->drawText(
            __('Order Date: ') .
            $this->_localeDate->formatDate(
                $this->_localeDate->scopeDate(
                    $order->getStore(),
                    $order->getCreatedAt(),
                    true
                ),
                \IntlDateFormatter::MEDIUM,
                false
            ),
            35,
            $top,
            'UTF-8'
        );

        $top -= 10;
        $pagememo->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
        $pagememo->setLineColor(new \Zend_Pdf_Color_GrayScale(0.5));
        $pagememo->setLineWidth(0.5);
        $pagememo->drawRectangle(25, $top, 275, $top - 25);
        $pagememo->drawRectangle(275, $top, 570, $top - 25);

        /* Calculate blocks info */

        /* Billing Address */
        $billingAddress = $this->_formatAddress($this->addressRenderer->format($order->getBillingAddress(), 'pdf'));
        $billingAddress[] = "GSTIN: ".$order->getBillingAddress()->getGstin();

        /* Payment */
        $paymentInfo = $this->_paymentData->getInfoBlock($order->getPayment())->setIsSecureMode(true)->toPdf();
        $paymentInfo = htmlspecialchars_decode($paymentInfo, ENT_QUOTES);
        $payment = explode('{{pdf_row_separator}}', $paymentInfo);
        foreach ($payment as $key => $value) {
            if (strip_tags(trim($value)) == '') {
                unset($payment[$key]);
            }
        }
        reset($payment);

        /* Shipping Address and Method */
        if (!$order->getIsVirtual()) {
            /* Shipping Address */
            $shippingAddress = $this->_formatAddress(
                $this->addressRenderer->format($order->getShippingAddress(), 'pdf')
            );
            $shippingAddress[] = "GSTIN: ".$order->getShippingAddress()->getGstin();
            $shippingMethod = $order->getShippingDescription();
        }

        $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
        $this->_setFontBold($pagememo, 12);
        $pagememo->drawText(__('Sold to:'), 35, $top - 15, 'UTF-8');

        if (!$order->getIsVirtual()) {
            $pagememo->drawText(__('Ship to:'), 285, $top - 15, 'UTF-8');
        } else {
            $pagememo->drawText(__('Payment Method:'), 285, $top - 15, 'UTF-8');
        }

        $addressesHeight = $this->_calcAddressHeight($billingAddress);
        if (isset($shippingAddress)) {
            $addressesHeight = max($addressesHeight, $this->_calcAddressHeight($shippingAddress));
        }

        $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(1));
        $pagememo->drawRectangle(25, $top - 25, 570, $top - 33 - $addressesHeight);
        $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
        $this->_setFontRegular($pagememo, 10);
        $this->y = $top - 40;
        $addressesStartY = $this->y;

        foreach ($billingAddress as $value) {
            if ($value !== '') {
                $text = [];
                foreach ($this->string->split($value, 45, true, true) as $_value) {
                    $text[] = $_value;
                }
                foreach ($text as $part) {
                    $pagememo->drawText(strip_tags(ltrim($part)), 35, $this->y, 'UTF-8');
                    $this->y -= 15;
                }
            }
        }

        $addressesEndY = $this->y;

        if (!$order->getIsVirtual()) {
            $this->y = $addressesStartY;
            foreach ($shippingAddress as $value) {
                if ($value !== '') {
                    $text = [];
                    foreach ($this->string->split($value, 45, true, true) as $_value) {
                        $text[] = $_value;
                    }
                    foreach ($text as $part) {
                        $pagememo->drawText(strip_tags(ltrim($part)), 285, $this->y, 'UTF-8');
                        $this->y -= 15;
                    }
                }
            }

            $addressesEndY = min($addressesEndY, $this->y);
            $this->y = $addressesEndY;

            $pagememo->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
            $pagememo->setLineWidth(0.5);
            $pagememo->drawRectangle(25, $this->y, 275, $this->y - 25);
            $pagememo->drawRectangle(275, $this->y, 570, $this->y - 25);

            $this->y -= 15;
            $this->_setFontBold($pagememo, 12);
            $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
            $pagememo->drawText(__('Payment Method'), 35, $this->y, 'UTF-8');
            $pagememo->drawText(__('Shipping Method:'), 285, $this->y, 'UTF-8');

            $this->y -= 10;
            $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(1));

            $this->_setFontRegular($pagememo, 10);
            $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(0));

            $paymentLeft = 35;
            $yPayments = $this->y - 15;
        } else {
            $yPayments = $addressesStartY;
            $paymentLeft = 285;
        }

        foreach ($payment as $value) {
            if (trim($value) != '') {
                //Printing "Payment Method" lines
                $value = preg_replace('/<br[^>]*>/i', "\n", $value);
                foreach ($this->string->split($value, 45, true, true) as $_value) {
                    $pagememo->drawText(strip_tags(trim($_value)), $paymentLeft, $yPayments, 'UTF-8');
                    $yPayments -= 15;
                }
            }
        }

        if ($order->getIsVirtual()) {
            // replacement of Shipments-Payments rectangle block
            $yPayments = min($addressesEndY, $yPayments);
            $pagememo->drawLine(25, $top - 25, 25, $yPayments);
            $pagememo->drawLine(570, $top - 25, 570, $yPayments);
            $pagememo->drawLine(25, $yPayments, 570, $yPayments);

            $this->y = $yPayments - 15;
        } else {
            $topMargin = 15;
            $methodStartY = $this->y;
            $this->y -= 15;

            foreach ($this->string->split($shippingMethod, 45, true, true) as $_value) {
                $pagememo->drawText(strip_tags(trim($_value)), 285, $this->y, 'UTF-8');
                $this->y -= 15;
            }

            $yShipments = $this->y;
            $totalShippingChargesText = "(" . __(
                'Total Shipping Charges'
            ) . " " . $order->formatPriceTxt(
                $order->getShippingAmount()
            ) . ")";

            $pagememo->drawText($totalShippingChargesText, 285, $yShipments - $topMargin, 'UTF-8');
            $yShipments -= $topMargin + 10;

            $tracks = [];
            if ($shipment) {
                $tracks = $shipment->getAllTracks();
            }
            if (count($tracks)) {
                $pagememo->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
                $pagememo->setLineWidth(0.5);
                $pagememo->drawRectangle(285, $yShipments, 510, $yShipments - 10);
                $pagememo->drawLine(400, $yShipments, 400, $yShipments - 10);
                //$pagememo->drawLine(510, $yShipments, 510, $yShipments - 10);

                $this->_setFontRegular($pagememo, 9);
                $pagememo->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
                //$pagememo->drawText(__('Carrier'), 290, $yShipments - 7 , 'UTF-8');
                $pagememo->drawText(__('Title'), 290, $yShipments - 7, 'UTF-8');
                $pagememo->drawText(__('Number'), 410, $yShipments - 7, 'UTF-8');

                $yShipments -= 20;
                $this->_setFontRegular($pagememo, 8);
                foreach ($tracks as $track) {
                    $maxTitleLen = 45;
                    $endOfTitle = strlen($track->getTitle()) > $maxTitleLen ? '...' : '';
                    $truncatedTitle = substr($track->getTitle(), 0, $maxTitleLen) . $endOfTitle;
                    $pagememo->drawText($truncatedTitle, 292, $yShipments, 'UTF-8');
                    $pagememo->drawText($track->getNumber(), 410, $yShipments, 'UTF-8');
                    $yShipments -= $topMargin - 5;
                }
            } else {
                $yShipments -= $topMargin - 5;
            }

            $currentY = min($yPayments, $yShipments);

            // replacement of Shipments-Payments rectangle block
            $pagememo->drawLine(25, $methodStartY, 25, $currentY);
            //left
            $pagememo->drawLine(25, $currentY, 570, $currentY);
            //bottom
            $pagememo->drawLine(570, $currentY, 570, $methodStartY);
            //right

            $this->y = $currentY;
            $this->y -= 15;
        }
    }
}
