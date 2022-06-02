<?php
namespace Webkul\MarketplaceGstIndia\Plugin\Marketplace\Block\Order;

class Items
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
     * Get items
     *
     * @param \Webkul\Marketplace\Block\Order\Items $orderItems
     * @param array $result
     * @return array
     */
    public function afterGetItems(
        \Webkul\Marketplace\Block\Order\Items $orderItems,
        $result
    ) {
        if ($this->helper->getConfigValue('status')) {
            foreach ($result as $item) {
                $item->setTaxAmount($item->getGst());
                $item->setBaseTaxAmount($item->getGst());
                $item->setTotalTax($item->getGst());
            }
        }
        return $result;
    }
}
