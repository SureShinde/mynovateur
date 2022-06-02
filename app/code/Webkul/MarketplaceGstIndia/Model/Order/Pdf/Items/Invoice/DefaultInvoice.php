<?php
/**
 * Webkul Software
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Model\Order\Pdf\Items\Invoice;

/**
 * Sales Order Invoice PDF model
 */
class DefaultInvoice extends \Magento\Sales\Model\Order\Pdf\Items\Invoice\DefaultInvoice
{
    /**
     * Core string
     *
     * @var \Magento\Framework\Stdlib\StringUtils
     */
    protected $string;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Tax\Helper\Data $taxData
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Tax\Helper\Data $taxData,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Filter\FilterManager $filterManager,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->string = $string;
        parent::__construct(
            $context,
            $registry,
            $taxData,
            $filesystem,
            $filterManager,
            $string,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Draw item line
     *
     * @return void
     */
    public function draw()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $mpGstHelper = $objectManager->get(\Webkul\MarketplaceGstIndia\Helper\Data::class);
        $order = $this->getOrder();
        $item = $this->getItem();
        $pdf = $this->getPdf();
        $page = $this->getPage();
        $lines = [];
        $isEnabled = $mpGstHelper->getConfigValue('status');
        if ($mpGstHelper->getCountryFromOrder($order) != 'IN') {
            $isEnabled = false;
        }
        if (!$isEnabled) {
            parent::draw();
            return;
        }

        $sgst = $item->getData('sgst');
        $cgst = $item->getData('cgst');
        $igst = $item->getData('igst');
        $utgst = $item->getData('utgst');
        $hsnCode = $item->getData('hsn');
        $sgstPercent = $item->getOrderItem()->getData('sgst_percent');
        $cgstPercent = $item->getOrderItem()->getData('cgst_percent');
        $igstPercent = $item->getOrderItem()->getData('igst_percent');
        $utgstPercent = $item->getOrderItem()->getData('utgst_percent');

        // draw Product name
        $name = $this->string->split($item->getName(), 60, true, true);
        $sku = $this->string->split($this->getSku($item), 60);
        $sku[0] = __('SKU').': '.$sku[0];
        $nameWithSku = array_merge($name, $sku);
        if ($hsnCode != '') {
            $hsn[0] = __('HSN').': '.$hsnCode;
            $nameWithSku = array_merge($nameWithSku, $hsn);
        }
        $lines[0] = [['text' => $nameWithSku, 'feed' => 35]];

        // draw QTY
        $lines[0][] = ['text' => $item->getQty() * 1, 'feed' => 275, 'align' => 'right'];

        // draw item Prices
        $i = 0;
        $prices = $this->getItemPricesForDisplay();
        $feedPrice = 245;
        $feedSubtotal = $feedPrice + 320;
        foreach ($prices as $priceDataUpdated) {
            if (isset($priceDataUpdated['label'])) {
                // draw Price label
                $lines[$i][] = ['text' => $priceDataUpdated['label'], 'feed' => $feedPrice, 'align' => 'right'];
                // draw Subtotal label
                $lines[$i][] = ['text' => $priceDataUpdated['label'], 'feed' => $feedSubtotal, 'align' => 'right'];
                $i++;
            }
            // draw Price
            $lines[$i][] = [
                'text' => $priceDataUpdated['price'],
                'feed' => $feedPrice,
                'font' => 'bold',
                'align' => 'right',
            ];
            // draw Subtotal
            $lines[$i][] = [
                'text' => $priceDataUpdated['subtotal'],
                'feed' => $feedSubtotal,
                'font' => 'bold',
                'align' => 'right',
            ];
            $i++;
        }

        // draw Tax
        $lines[0][] = [
            'text' => [$order->formatPriceTxt($sgst), (($sgst == 0) ? '' : '('.(float)($sgstPercent).'%)')],
            'feed' => 345,
            'align' => 'right',
        ];

        $lines[0][] = [
            'text' => [$order->formatPriceTxt($cgst), (($cgst == 0) ? '' : '('.(float)($cgstPercent).'%)')],
            'feed' => 385,
            'align' => 'right',
        ];
        $lines[0][] = [
            'text' => [$order->formatPriceTxt($igst), (($igst == 0) ? '' : '('.(float)($igstPercent).'%)')],
            'feed' => 425,
            'align' => 'right',
        ];
        $lines[0][] = [
            'text' => [$order->formatPriceTxt($utgst), (($utgst == 0) ? '' : '('.(float)($utgstPercent).'%)')],
            'feed' => 465,
            'align' => 'right',
        ];
        $lines[0][] = [
            'text' => $order->formatPriceTxt($item->getData('gst')),
            'feed' => 505,
            'font' => 'bold',
            'align' => 'right',
        ];
        // custom options
        $options = $this->getItemOptions();
        if ($options) {
            foreach ($options as $option) {
                // draw options label
                $lines[][] = [
                    'text' => $this->string->split($this->filterManager->stripTags($option['label']), 40, true, true),
                    'font' => 'italic',
                    'feed' => 35,
                ];

                // Checking whether option value is not null
                if ($option['value']!= null) {
                    if (isset($option['print_value'])) {
                        $printValue = $option['print_value'];
                    } else {
                        $printValue = $this->filterManager->stripTags($option['value']);
                    }
                    $values = explode(', ', $printValue);
                    foreach ($values as $value) {
                        $lines[][] = ['text' => $this->string->split($value, 30, true, true), 'feed' => 40];
                    }
                }
            }
        }

        $lineBlock = ['lines' => $lines, 'height' => 20];

        $page = $pdf->drawLineBlocks($page, [$lineBlock], ['table_header' => true]);
        $this->setPage($page);
    }
}
