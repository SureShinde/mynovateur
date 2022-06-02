<?php
namespace Webkul\MarketplaceGstIndia\Plugin\Marketplace\Block\Order\Creditmemo;

class Totals
{
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $helper;
    
    /**
     * @param \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $helper
     */
    public function __construct(
        \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository,
        \Webkul\MarketplaceGstIndia\Helper\Data $helper
    ) {
        $this->orderItemRepository = $orderItemRepository;
        $this->helper = $helper;
    }

    /**
     * Get all item
     *
     * @param \Webkul\Marketplace\Block\Order\Creditmemo\Totals $orderTotals
     * @param object $result
     * @return object
     */
    public function afterGetSource(
        \Webkul\Marketplace\Block\Order\Creditmemo\Totals $orderTotals,
        $result
    ) {
        $gst = 0;
        foreach ($result->getAllItems() as $item) {
            $gst += $item->getGst();
        }
        $result->setTaxAmount($gst);
        return $result;
    }

    /**
     * Get gst from order
     *
     * @param \Webkul\Marketplace\Block\Order\Totals $orderTotals
     * @param array $result
     * @return array
     */
    public function afterGetOrderTotals(
        \Webkul\Marketplace\Block\Order\Creditmemo\Totals $orderTotals,
        $result
    ) {

        if ($this->helper->getConfigValue('status')) {
            $result['tax']['label'] = __('Gst');
        }
        return $result;
    }
}
