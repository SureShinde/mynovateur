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
namespace Webkul\MarketplaceGstIndia\Plugin\Marketplace\Block\Order;

use Webkul\Marketplace\Model\ResourceModel\Saleslist\Collection;

class Totals
{
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $helper;
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $gst = 0;
    
    /**
     * @param \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $helper
     * @param \Webkul\Marketplace\Helper\Data $mphelper
     * @param Collection $orderCollection
     */
    public function __construct(
        \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository,
        \Webkul\MarketplaceGstIndia\Helper\Data $helper,
        \Webkul\Marketplace\Helper\Data $mphelper,
        Collection $orderCollection
    ) {
        $this->orderItemRepository = $orderItemRepository;
        $this->orderCollection = $orderCollection;
        $this->helper = $helper;
        $this->mphelper = $mphelper;
    }

    /**
     * Get order total
     *
     * @param \Webkul\Marketplace\Block\Order\Totals $orderTotals
     * @param array $result
     * @return array
     */
    public function afterGetSource(
        \Webkul\Marketplace\Block\Order\Totals $orderTotals,
        $result
    ) {
        $countryCode = $this->helper->getCountryFromOrder($orderTotals->getOrder());
        if ($countryCode == 'IN') {
            $basegstTotal = 0;
            if ($this->helper->getConfigValue('status')) {
                $collection = $this->orderCollection
                    ->addFieldToFilter(
                        'main_table.order_id',
                        $orderTotals->getOrder()->getId()
                    )->addFieldToFilter(
                        'main_table.seller_id',
                        $this->mphelper->getCustomerId()
                    );
                foreach ($collection as $item) {
                    $orderItem = $this->orderItemRepository->get($item['order_item_id']);
                    $baseitemPrice = $orderItem->getBaseOriginalPrice();
                    $taxPercent = $orderItem->getTaxPercent();
                    $this->gst += $orderItem->getData('gst');
                    $basegstTotal += (($baseitemPrice*$orderItem->getQtyOrdered())*$taxPercent)/100;
                }
                foreach ($result as $idx => $item) {
                    $result[$idx]['total_tax'] = $basegstTotal;
                }
            }
        }
        return $result;
    }

    /**
     * Get Order Totals
     *
     * @param \Webkul\Marketplace\Block\Order\Totals $orderTotals
     * @param array $result
     * @return array
     */
    public function afterGetOrderTotals(
        \Webkul\Marketplace\Block\Order\Totals $orderTotals,
        $result
    ) {
        $countryCode = $this->helper->getCountryFromOrder($orderTotals->getOrder());
        if ($countryCode == 'IN' && $this->helper->getConfigValue('status')) {
                $result['tax']['label'] = __('Gst');
        }
        return $result;
    }
}
