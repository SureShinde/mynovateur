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
namespace Webkul\MarketplaceGstIndia\Plugin\Model\Sales\Order\Creditmemo;

class Item
{
    /**
     * Register invoice
     *
     * Apply to order, order items etc.
     *
     * @param \Magento\Sales\Model\Order\Creditmemo\Item $item
     * @return \Magento\Sales\Model\Order\Creditmemo\Item
     */
    public function afterRegister(
        \Magento\Sales\Model\Order\Creditmemo\Item $item
    ) {
        if ($item->getQty() > 0) {
            $orderItem = $item->getOrderItem();
            $orderItemQty = $orderItem->getQtyOrdered();
            if ($item->getQty() == $orderItemQty) {
                return $item;
            }
            $ratio = $item->getQty() / $orderItemQty;

            $itemSgst = $orderItem->getData('sgst');
            $itemCgst = $orderItem->getData('cgst');
            $itemIgst = $orderItem->getData('igst');
            $itemUtgst = $orderItem->getData('utgst');
            $itemGst = $orderItem->getData('gst');
            
            $sgst = ($itemSgst > 0) ? ($itemSgst * $ratio) : 0;
            $cgst = ($itemCgst > 0) ? ($itemCgst * $ratio) : 0;
            $igst = ($itemIgst > 0) ? ($itemIgst * $ratio) : 0;
            $utgst = ($itemUtgst > 0) ? ($itemUtgst * $ratio) : 0;
            $gst = ($itemGst > 0) ? ($itemGst * $ratio) : 0;

            $item->setSgst($sgst);
            $item->setCgst($cgst);
            $item->setIgst($igst);
            $item->setUtgst($utgst);
            $item->setGst($gst);
        }

        return $item;
    }
}
