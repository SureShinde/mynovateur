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
namespace Webkul\MarketplaceGstIndia\Model\Bundle\Order\Pdf\Items;

use Magento\Framework\Serialize\Serializer\Json;

/**
 * Sales Order Invoice PDF model
 */
class Invoice extends \Magento\Bundle\Model\Sales\Order\Pdf\Items\Invoice
{
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $mpGstHelper;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Tax\Helper\Data $taxData
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param \Magento\Framework\Stdlib\StringUtils $coreString
     * @param Json $serializer
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper
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
        \Magento\Framework\Stdlib\StringUtils $coreString,
        Json $serializer,
        \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->mpGstHelper = $mpGstHelper;
        parent::__construct(
            $context,
            $registry,
            $taxData,
            $filesystem,
            $filterManager,
            $coreString,
            $serializer,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Draw the pdf
     */
    public function draw()
    {
        $order = $this->getOrder();
        $item = $this->getItem();
        $pdf = $this->getPdf();
        $page = $this->getPage();

        $this->_setFontRegular();
        $items = $this->getChildren($item);

        $isEnabled = $this->mpGstHelper->getConfigValue('status');
        if ($this->mpGstHelper->getCountryFromOrder($order) != 'IN') {
            $isEnabled = false;
        }
        if (!$isEnabled) {
            parent::draw();
            return;
        }

        $prevOptionId = '';
        $drawItems = [];

        foreach ($items as $childItem) {
            $line = [];

            $attributes = $this->getSelectionAttributes($childItem);
            if (is_array($attributes)) {
                $optionId = $attributes['option_id'];
            } else {
                $optionId = 0;
            }

            if (!isset($drawItems[$optionId])) {
                $drawItems[$optionId] = ['lines' => [], 'height' => 15];
            }

            if ($childItem->getOrderItem()->getParentItem()) {
                if ($prevOptionId != $attributes['option_id']) {
                    $line[0] = [
                        'font' => 'italic',
                        'text' => $this->string->split($attributes['option_label'], 45, true, true),
                        'feed' => 35,
                    ];

                    $drawItems[$optionId] = ['lines' => [$line], 'height' => 15];

                    $line = [];
                    $prevOptionId = $attributes['option_id'];
                }
            }

            /* in case Product name is longer than 80 chars - it is written in a few lines */
            if ($childItem->getOrderItem()->getParentItem()) {
                $feed = 40;
                $name = $this->getValueHtml($childItem);
            } else {
                $feed = 35;
                $name = $childItem->getName();
            }
            $line[] = ['text' => $this->string->split($name, 35, true, true), 'feed' => $feed];

            // draw SKUs
            if (!$childItem->getOrderItem()->getParentItem()) {
                $hsnCode = $childItem->getData('hsn');
                $sku = [];
                foreach ($this->string->split($item->getSku(), 17) as $part) {
                    $sku[] = $part;
                }

                $sku[0] = __('SKU').': '.$sku[0];
                if ($hsnCode != '') {
                    $hsn[0] = __('HSN').': '.$hsnCode;
                    $sku = $this->mpGstHelper->arrayMerge($sku, $hsn);
                }
                // draw SKU
                $drawItems[1]['lines'][0][0] = [
                    'text' => $sku,
                    'feed' => 35,
                    'align' => 'left',
                ];
            }

            // draw prices
            if ($this->canShowPriceInfo($childItem)) {
                $sgst = $childItem->getData('sgst');
                $cgst = $childItem->getData('cgst');
                $igst = $childItem->getData('igst');
                $utgst = $childItem->getData('utgst');
                $sgstPercent = $childItem->getOrderItem()->getData('sgst_percent');
                $cgstPercent = $childItem->getOrderItem()->getData('cgst_percent');
                $igstPercent = $childItem->getOrderItem()->getData('igst_percent');
                $utgstPercent = $childItem->getOrderItem()->getData('utgst_percent');

                $taxPercent = $childItem->getOrderItem()->getData('tax_percent');

                $price = $order->formatPriceTxt($childItem->getPrice());
                $line[] = ['text' => $price, 'feed' => 240, 'font' => 'bold', 'align' => 'right'];
                $line[] = ['text' => $childItem->getQty() * 1, 'feed' => 265, 'font' => 'bold'];

                // draw Tax
                $line[] = [
                    'text' => [$order->formatPriceTxt($sgst), (($sgst == 0) ? '' : '('.(float)($sgstPercent).'%)')],
                    'feed' => 350,
                    'align' => 'right',
                ];

                $line[] = [
                    'text' => [$order->formatPriceTxt($cgst), (($cgst == 0) ? '' : '('.(float)($cgstPercent).'%)')],
                    'feed' => 420,
                    'align' => 'right',
                ];
                $line[] = [
                    'text' => [$order->formatPriceTxt($igst), (($igst == 0) ? '' : '('.(float)($igstPercent).'%)')],
                    'feed' => 470,
                    'align' => 'right',
                ];
                $line[] = [
                    'text' => [$order->formatPriceTxt($utgst), (($utgst == 0) ? '' : '('.(float)($utgstPercent).'%)')],
                    'feed' => 470,
                    'align' => 'right',
                ];
                $line[] = [
                    'text' => $order->formatPriceTxt($childItem->getData('gst')),
                    'feed' => 510,
                    'font' => 'bold',
                    'align' => 'right',
                ];

                $row_total = $order->formatPriceTxt($childItem->getRowTotal());
                $line[] = ['text' => $row_total, 'feed' => 565, 'font' => 'bold', 'align' => 'right'];
            }

            $drawItems[$optionId]['lines'][] = $line;
        }

        // custom options
        $options = $item->getOrderItem()->getProductOptions();
        if ($options) {
            if (isset($options['options'])) {
                foreach ($options['options'] as $option) {
                    $lines = [];
                    $lines[][] = [
                        'text' => $this->string->split(
                            $this->filterManager->stripTags($option['label']),
                            40,
                            true,
                            true
                        ),
                        'font' => 'italic',
                        'feed' => 35,
                    ];

                    if ($option['value']) {
                        $text = [];
                        $printValue = isset(
                            $option['print_value']
                        ) ? $option['print_value'] : $this->filterManager->stripTags(
                            $option['value']
                        );
                        $values = explode(', ', $printValue);
                        foreach ($values as $value) {
                            $text = $this->splitArray($text, $value);
                        }

                        $lines[][] = ['text' => $text, 'feed' => 40];
                    }

                    $drawItems[] = ['lines' => $lines, 'height' => 15];
                }
            }
        }

        $page = $pdf->drawLineBlocks($page, $drawItems, ['table_header' => true]);

        $this->setPage($page);
    }

    /**
     * Split Array
     *
     * @param array $text
     * @param array $value
     * @return array
     */
    public function splitArray($text, $value)
    {
        foreach ($this->string->split($value, 30, true, true) as $subValue) {
            $text[] = $subValue;
        }
        return $text;
    }
}
