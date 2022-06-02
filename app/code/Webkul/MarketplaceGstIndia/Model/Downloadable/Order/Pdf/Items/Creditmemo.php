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
namespace Webkul\MarketplaceGstIndia\Model\Downloadable\Order\Pdf\Items;

/**
 * Sales Order Creditmemo Pdf default items renderer
 */
class Creditmemo extends \Magento\Downloadable\Model\Sales\Order\Pdf\Items\Creditmemo
{
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $mpGstHelperData;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Tax\Helper\Data $taxData
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Downloadable\Model\Link\PurchasedFactory $purchasedFactory
     * @param \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $itemsFactory
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelperData
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
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Downloadable\Model\Link\PurchasedFactory $purchasedFactory,
        \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $itemsFactory,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelperData,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->mpGstHelperData = $mpGstHelperData;
        parent::__construct(
            $context,
            $registry,
            $taxData,
            $filesystem,
            $filterManager,
            $scopeConfig,
            $purchasedFactory,
            $itemsFactory,
            $string,
            $resource,
            $resourceCollection,
            $data
        );
    }
    /**
     * Get sgst, cgst, igst, utgst
     */
    public function draw()
    {
        $order = $this->getOrder();
        $itemData = $this->getItem();
        $pdf = $this->getPdf();
        $page = $this->getPage();
        $lines = [];

        $isEnabled = $this->mpGstHelperData->getConfigValue('status');
        if ($this->mpGstHelperData->getCountryFromOrder($order) != 'IN') {
            $isEnabled = false;
        }
        if (!$isEnabled) {
            parent::draw();
            return;
        }

        $sgst = $itemData->getData('sgst');
        $cgst = $itemData->getData('cgst');
        $igst = $itemData->getData('igst');
        $utgst = $itemData->getData('utgst');
        $hsnCode = $itemData->getData('hsn');
        $sgstPercent = $itemData->getOrderItem()->getData('sgst_percent');
        $cgstPercent = $itemData->getOrderItem()->getData('cgst_percent');
        $igstPercent = $itemData->getOrderItem()->getData('igst_percent');
        $utgstPercent = $itemData->getOrderItem()->getData('utgst_percent');

        $taxPercent = $itemData->getOrderItem()->getData('tax_percent');

        // draw Product name
        $lines[0] = [['text' => $this->string->split($itemData->getName(), 35, true, true), 'feed' => 35]];

        $sku = $this->string->split($this->getSku($itemData), 17);
        $sku[0] = __('SKU').': '.$sku[0];
        if ($hsnCode != '') {
            $hsn[0] = __('HSN').': '.$hsnCode;
            $sku = array_merge($sku, $hsn);
        }

        // draw SKU
        $lines[1][] = [
            'text' => $sku,
            'feed' => 35,
            'align' => 'left',
        ];

        // draw Total (ex)
        $lines[0][] = [
            'text' => $order->formatPriceTxt($itemData->getRowTotal()),
            'feed' => 215,
            'font' => 'bold',
            'align' => 'right',
        ];

        // draw Discount
        $lines[0][] = [
            'text' => $order->formatPriceTxt(-$itemData->getDiscountAmount()),
            'feed' => 260,
            'font' => 'bold',
            'align' => 'right',
        ];

        // draw QTY
        $lines[0][] = ['text' => $itemData->getQty() * 1, 'feed' => 295, 'font' => 'bold', 'align' => 'right'];

        // draw Tax
        $sgstArray[] = $order->formatPriceTxt($sgst);
        if ($sgst != 0) {
            $sgstArray[] = '('.(float)($sgstPercent).'%)';
        }
        $lines[0][] = [
            'text' => $sgstArray,
            'feed' => 350,
            'align' => 'right',
        ];

        $cgstArray[] = $order->formatPriceTxt($cgst);
        if ($cgst != 0) {
            $cgstArray[] = '('.(float)($cgstPercent).'%)';
        }
        $lines[0][] = [
            'text' => $cgstArray,
            'feed' => 405,
            'align' => 'right',
        ];

        $igstArray[] = $order->formatPriceTxt($igst);
        if ($igst != 0) {
            $igstArray[] = '('.(float)($igstPercent).'%)';
        }
        $lines[0][] = [
            'text' => $igstArray,
            'feed' => 460,
            'align' => 'right',
        ];

        $utgstArray[] = $order->formatPriceTxt($utgst);
        if ($utgst != 0) {
            $utgstArray[] = '('.(float)($utgstPercent).'%)';
        }
        $lines[0][] = [
            'text' => $utgstArray,
            'feed' => 460,
            'align' => 'right',
        ];
        if ($isEnabled) {
            $lines[0][] = [
                'text' => $order->formatPriceTxt($itemData->getData('gst')),
                'feed' => 510,
                'font' => 'bold',
                'align' => 'right',
            ];
        } else {
            $lines[0][] = [
                'text' => $order->formatPriceTxt($itemData->getTaxAmount()),
                'feed' => 510,
                'font' => 'bold',
                'align' => 'right',
            ];
        }

        // draw Total (inc)
        $subtotal = $itemData->getRowTotal() +
            $itemData->getTaxAmount() +
            $itemData->getDiscountTaxCompensationAmount() -
            $itemData->getDiscountAmount();
        $lines[0][] = [
            'text' => $order->formatPriceTxt($subtotal),
            'feed' => 565,
            'font' => 'bold',
            'align' => 'right',
        ];

        // draw options
        $drawOptionsUpdated = $this->getItemOptions();
        if ($drawOptionsUpdated) {
            foreach ($drawOptionsUpdated as $optionUpdated) {
                // draw options label
                $lines[][] = [
                    'text' => $this->string->split(
                        $this->filterManager->stripTags($optionUpdated['label']),
                        40,
                        true,
                        true
                    ),
                    'font' => 'italic',
                    'feed' => 35,
                ];

                // draw options value
                $printValue = isset(
                    $optionUpdated['print_value']
                ) ? $optionUpdated['print_value'] : $this->filterManager->stripTags(
                    $optionUpdated['value']
                );
                $lines[][] = ['text' => $this->string->split($printValue, 30, true, true), 'feed' => 40];
            }
        }

        // downloadable Items
        $purchasedItemsUpdated = $this->getLinks()->getPurchasedItems();

        // draw Links title
        $lines[][] = [
            'text' => $this->string->split($this->getLinksTitle(), 70, true, true),
            'font' => 'italic',
            'feed' => 35,
        ];

        // draw Links
        foreach ($purchasedItemsUpdated as $link) {
            $lines[][] = ['text' => $this->string->split($link->getLinkTitle(), 50, true, true), 'feed' => 40];
        }

        $lineBlock = ['lines' => $lines, 'height' => 20];

        $page = $pdf->drawLineBlocks($page, [$lineBlock], ['table_header' => true]);
        $this->setPage($page);
    }
}
