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
namespace Webkul\MarketplaceGstIndia\Block\Item\Price;

use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Sales\Model\Order\CreditMemo\Item as CreditMemoItem;
use Magento\Sales\Model\Order\Invoice\Item as InvoiceItem;
use Magento\Sales\Model\Order\Item as OrderItem;

/**
 * Item price render block
 */
class Renderer extends \Magento\Tax\Block\Item\Price\Renderer
{
    /**
     * Return the total amount minus discount
     *
     * @param OrderItem|InvoiceItem|CreditMemoItem $item
     * @return mixed
     */
    public function getTotalAmount($item)
    {
        $itemQty = $item->getQty();
        if ($item instanceof \Magento\Sales\Model\Order\Item) {
            $itemQty = $item->getQtyOrdered();
        }
        $gst = ($itemQty > 0) ? $item->getGst() : 0;
        if ((($item instanceof \Magento\Sales\Model\Order\Invoice\Item)
            || ($item instanceof \Magento\Sales\Model\Order\Creditmemo\Item))
            && $itemQty > 0
        ) {
            $orderItem = $item->getOrderItem();
            $ratio = $itemQty / $orderItem->getQtyOrdered();
            $gst = ($orderItem->getData('gst') * $ratio);
        }
        $totalAmount = $item->getRowTotal()
            - $item->getDiscountAmount()
            + $item->getTaxAmount()
            + $item->getDiscountTaxCompensationAmount()
            + $gst;
            
        return $totalAmount;
    }
     /**
      * Get item price in display currency or order currency depending on item type
      *
      * @return float
      */
    public function getItemDisplayPriceExclTax()
    {
      //  $item = $this->getItem();
        $gst = ($itemQty > 0) ? $item->getGst() : 0;
        if ($item instanceof QuoteItem) {
            return $item->getCalculationPrice();
        } else {
            return $item->getPrice();
        }
    }
}
