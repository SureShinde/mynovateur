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
namespace Webkul\MarketplaceGstIndia\Model\Sales\Pdf;

/**
 * Sales order total for PDF, taking into account GST
 */
class Gst extends \Magento\Sales\Model\Order\Pdf\Total\DefaultTotal
{
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $mpGstHelper;

    /**
     * @param \Magento\Tax\Helper\Data $taxHelper
     * @param \Magento\Tax\Model\Calculation $taxCalculation
     * @param \Magento\Tax\Model\ResourceModel\Sales\Order\Tax\CollectionFactory $ordersFactory
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Tax\Helper\Data $taxHelper,
        \Magento\Tax\Model\Calculation $taxCalculation,
        \Magento\Tax\Model\ResourceModel\Sales\Order\Tax\CollectionFactory $ordersFactory,
        \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper,
        array $data = []
    ) {
        $this->mpGstHelper = $mpGstHelper;
        parent::__construct($taxHelper, $taxCalculation, $ordersFactory, $data);
    }

    /**
     * Check if gst total amount should be included or excluded
     *
     * @return array
     */
    public function getTotalsForDisplay()
    {
        /** @var $items \Magento\Sales\Model\Order\Item[] */
        $items = $this->getSource()->getAllItems();

        $gstTotal = $this->mpGstHelper->getTotalGst($items);

        // If we have no gst, check if we still need to display it
        if (!$gstTotal && !filter_var($this->getDisplayZero(), FILTER_VALIDATE_BOOLEAN)) {
            return [];
        }

        // Display the gst total amount
        $fontSize = $this->getFontSize() ? $this->getFontSize() : 7;
        $title = __($this->getTitle());
        if ($this->mpGstHelper->showIncludeExclude() == 1) {
            $title = __('Inclusive GST');
            if ($this->mpGstHelper->isGstExclude()) {
                $title = __('Exclusive GST');
            }
        }

        $totals = [
            [
                'amount' => $this->getOrder()->formatPriceTxt($gstTotal),
                'label' => $title . ':',
                'font_size' => $fontSize,
            ],
        ];

        return $totals;
    }
    
    /**
     * Check if we can display Gst total information in PDF
     *
     * @return bool
     */
    public function canDisplay()
    {
        $items = $this->getSource()->getAllItems();
        $amount = $this->mpGstHelper->getTotalGst($items);
        return $this->getDisplayZero() === 'true' || $amount != 0;
    }
}
