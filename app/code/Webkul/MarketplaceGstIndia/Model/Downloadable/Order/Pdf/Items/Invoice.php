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
 * Sales Order Invoice PDF model
 */
class Invoice extends \Magento\Downloadable\Model\Sales\Order\Pdf\Items\Invoice
{
    /**
     * Core string
     *
     * @var \Magento\Framework\Stdlib\StringUtils
     */
    protected $string;

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
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Downloadable\Model\Link\PurchasedFactory $purchasedFactory
     * @param \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $itemsFactory
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
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Downloadable\Model\Link\PurchasedFactory $purchasedFactory,
        \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $itemsFactory,
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
        $item = $this->getItem();
        $pdf = $this->getPdf();
        $page = $this->getPage();
        $lines = [];

        $isEnabled = $this->mpGstHelper->getConfigValue('status');
        if ($this->mpGstHelper->getCountryFromOrder($order) != 'IN') {
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

        $taxPercent = $item->getOrderItem()->getData('tax_percent');

        // draw Product name
        $lines[0] = [['text' => $this->string->split($item->getName(), 35, true, true), 'feed' => 35]];

        $sku = $this->string->split($this->getSku($item), 17);
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

        // draw QTY
        $lines[0][] = ['text' => $item->getQty() * 1, 'feed' => 265, 'align' => 'left'];

        // draw item Prices
        $i = 0;
        $prices = $this->getItemPricesForDisplay();
        $feedPrice = 250;
        $feedSubtotal = 565;
        foreach ($prices as $priceData) {
            if (isset($priceData['label'])) {
                // draw Price label
                $lines[$i][] = ['text' => $priceData['label'], 'feed' => $feedPrice, 'align' => 'left'];
                // draw Subtotal label
                $lines[$i][] = ['text' => $priceData['label'], 'feed' => $feedSubtotal, 'align' => 'right'];
                $i++;
            }
            // draw Price
            $lines[$i][] = [
                'text' => $priceData['price'],
                'feed' => $feedPrice,
                'font' => 'bold',
                'align' => 'right',
            ];
            // draw Subtotal
            $lines[$i][] = [
                'text' => $priceData['subtotal'],
                'feed' => $feedSubtotal,
                'font' => 'bold',
                'align' => 'right',
            ];
            $i++;
        }

        // draw Tax
        $lines[0][] = [
            'text' => [$order->formatPriceTxt($sgst), (($sgst == 0) ? '' : '('.(float)($sgstPercent).'%)')],
            'feed' => 350,
            'align' => 'right',
        ];

        $lines[0][] = [
            'text' => [$order->formatPriceTxt($cgst), (($cgst == 0) ? '' : '('.(float)($cgstPercent).'%)')],
            'feed' => 420,
            'align' => 'right',
        ];
        $lines[0][] = [
            'text' => [$order->formatPriceTxt($igst), (($igst == 0) ? '' : '('.(float)($igstPercent).'%)')],
            'feed' => 470,
            'align' => 'right',
        ];
        $lines[0][] = [
            'text' => [$order->formatPriceTxt($utgst), (($utgst == 0) ? '' : '('.(float)($utgstPercent).'%)')],
            'feed' => 470,
            'align' => 'right',
        ];
        $lines[0][] = [
            'text' => $order->formatPriceTxt($item->getData('gst')),
            'feed' => 510,
            'font' => 'bold',
            'align' => 'right',
        ];

        // custom options
        $customOptionsUpdated = $this->getItemOptions();
        if ($customOptionsUpdated) {
            foreach ($customOptionsUpdated as $optionUpdated) {
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

                if ($optionUpdated['value']) {
                    if (isset($optionUpdated['print_value'])) {
                        $printValue = $optionUpdated['print_value'];
                    } else {
                        $printValue = $this->filterManager->stripTags($optionUpdated['value']);
                    }
                    $values = explode(', ', $printValue);
                    foreach ($values as $value) {
                        $lines[][] = ['text' => $this->string->split($value, 30, true, true), 'feed' => 40];
                    }
                }
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
