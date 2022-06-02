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

/**
 * Sales Order Creditmemo Pdf default items renderer
 */
class Creditmemo extends \Magento\Bundle\Model\Sales\Order\Pdf\Items\Creditmemo
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
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     * @param \Magento\Framework\Stdlib\StringUtils $string
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
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        \Magento\Framework\Stdlib\StringUtils $string,
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
            $serializer,
            $string,
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

        $items = $this->getChildren($item);
        $prevOptionId = '';
        $drawItemsUpdated = [];
        $leftBound = 35;
        $rightBound = 565;

        $isEnabled = $this->mpGstHelper->getConfigValue('status');
        if ($this->mpGstHelper->getCountryFromOrder($order) != 'IN') {
            $isEnabled = false;
        }
        if (!$isEnabled) {
            parent::draw();
            return;
        }

        foreach ($items as $childItem) {
            $x = $leftBound;
            $line = [];

            $attributes = $this->getSelectionAttributes($childItem);
            if (is_array($attributes)) {
                $optionId = $attributes['option_id'];
            } else {
                $optionId = 0;
            }

            if (!isset($drawItemsUpdated[$optionId])) {
                $drawItemsUpdated[$optionId] = ['lines' => [], 'height' => 15];
            }

            // draw selection attributes
            if ($childItem->getOrderItem()->getParentItem()) {
                if ($prevOptionId != $attributes['option_id']) {
                    $line[0] = [
                        'font' => 'italic',
                        'text' => $this->string->split($attributes['option_label'], 38, true, true),
                        'feed' => $x,
                    ];

                    $drawItemsUpdated[$optionId] = ['lines' => [$line], 'height' => 15];

                    $line = [];
                    $prevOptionId = $attributes['option_id'];
                }
            }

            // draw product titles
            if ($childItem->getOrderItem()->getParentItem()) {
                $feed = $x + 5;
                $name = $this->getValueHtml($childItem);
            } else {
                $feed = $x;
                $name = $childItem->getName();
            }

            $line[] = ['text' => $this->string->split($name, 35, true, true), 'feed' => $feed];

            $x += 220;

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
                $drawItemsUpdated[1]['lines'][0][0] = [
                    'text' => $sku,
                    'feed' => 35,
                    'align' => 'left',
                ];
            }

            $x += 100;

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
                // draw Total(ex)
                $text = $order->formatPriceTxt($childItem->getRowTotal());
                $line[] = ['text' => $text, 'feed' => 170, 'font' => 'bold', 'align' => 'right', 'width' => 50];
                $x += 50;

                // draw Discount
                $text = $order->formatPriceTxt(-$childItem->getDiscountAmount());
                $line[] = ['text' => $text, 'feed' => 215, 'font' => 'bold', 'align' => 'right', 'width' => 50];
                $x += 50;

                // draw QTY
                $text = $childItem->getQty() * 1;
                $line[] = [
                    'text' => $childItem->getQty() * 1,
                    'feed' => 265,
                    'font' => 'bold',
                    'align' => 'right',
                    'width' => 30,
                ];
                $x += 30;

                // draw Tax
                $line[] = [
                    'text' => [$order->formatPriceTxt($sgst), (($sgst == 0) ? '' : '('.(float)($sgstPercent).'%)')],
                    'feed' => 360,
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
                    'text' => $order->formatPriceTxt($item->getData('gst')),
                    'feed' => 510,
                    'font' => 'bold',
                    'align' => 'right',
                ];
                $x += 45;

                // draw Total(inc)
                $text = $order->formatPriceTxt(
                    $childItem->getRowTotal() + $childItem->getTaxAmount() - $childItem->getDiscountAmount()
                );
                $line[] = ['text' => $text, 'feed' => $rightBound, 'font' => 'bold', 'align' => 'right'];
            }

            $drawItemsUpdated[$optionId]['lines'][] = $line;
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
                        'feed' => $leftBound,
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

                        $lines[][] = ['text' => $text, 'feed' => $leftBound + 5];
                    }

                    $drawItemsUpdated[] = ['lines' => $lines, 'height' => 15];
                }
            }
        }

        $page = $pdf->drawLineBlocks($page, $drawItemsUpdated, ['table_header' => true]);
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
