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
namespace Webkul\MarketplaceGstIndia\Plugin\Model\Sales\Convert;

class Order
{
    /**
     * Item To Invoice Item
     *
     * @param \Magento\Sales\Model\Convert\Order $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Item $item
     * @return object
     */
    public function aroundItemToInvoiceItem(
        \Magento\Sales\Model\Convert\Order $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Item $item
    ) {
        $invoiceItem = $proceed($item);
        $invoiceItem->setSgst($item->getSgst());
        $invoiceItem->setSgstPercent($item->getSgstPercent());
        $invoiceItem->setCgst($item->getCgst());
        $invoiceItem->setCgstPercent($item->getCgstPercent());
        $invoiceItem->setIgst($item->getIgst());
        $invoiceItem->setIgstPercent($item->getIgstPercent());
        $invoiceItem->setUtgst($item->getUtgst());
        $invoiceItem->setUtgstPercent($item->getUtgstPercent());
        $invoiceItem->setGst($item->getGst());
        $invoiceItem->setHsn($item->getHsn());
        return $invoiceItem;
    }
    /**
     * Order Address
     *
     * @param Magento\Quote\Model\Quote\Address\ToOrderAddress $subject
     * @param callable $proceed
     * @param Address $item
     * @return \Magento\Sales\Model\Order\Address
     */
    public function aroundItemToCreditmemoItem(
        \Magento\Sales\Model\Convert\Order $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Item $item
    ) {
        $creditmemoItem = $proceed($item);
        $creditmemoItem->setSgst($item->getSgst());
        $creditmemoItem->setSgstPercent($item->getSgstPercent());
        $creditmemoItem->setCgst($item->getCgst());
        $creditmemoItem->setCgstPercent($item->getCgstPercent());
        $creditmemoItem->setIgst($item->getIgst());
        $creditmemoItem->setIgstPercent($item->getIgstPercent());
        $creditmemoItem->setUtgst($item->getUtgst());
        $creditmemoItem->setUtgstPercent($item->getUtgstPercent());
        $creditmemoItem->setGst($item->getGst());
        $creditmemoItem->setHsn($item->getHsn());
        return $creditmemoItem;
    }
}
