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
namespace Webkul\MarketplaceGstIndia\Plugin\Model\Quote\Item;

class ToOrderItem
{
    /**
     * Get gst
     *
     * @param \Magento\Quote\Model\Quote\Item\ToOrderItem $subject
     * @param callable $proceed
     * @param \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @param array $additional
     */
    public function aroundConvert(
        \Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
        \Closure $proceed,
        \Magento\Quote\Model\Quote\Item\AbstractItem $item,
        $additional = []
    ) {
        /** @var $orderItem Item */
        $orderItem = $proceed($item, $additional);
        $orderItem->setSgst($item->getSgst());
        $orderItem->setSgstPercent($item->getSgstPercent());
        $orderItem->setCgst($item->getCgst());
        $orderItem->setCgstPercent($item->getCgstPercent());
        $orderItem->setIgst($item->getIgst());
        $orderItem->setIgstPercent($item->getIgstPercent());
        $orderItem->setUtgst($item->getUtgst());
        $orderItem->setUtgstPercent($item->getUtgstPercent());
        $orderItem->setGst($item->getGst());
        $orderItem->setHsn($item->getHsn());
        return $orderItem;
    }
}
