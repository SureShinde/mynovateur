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
namespace Webkul\MarketplaceGstIndia\Model\Marketplace\Controller;

class Invoice extends \Webkul\Marketplace\Controller\Order\Invoice
{
    /**
     * @inheritDoc
     */
    protected function _getItemQtys($order, $items)
    {
        $data = parent::_getItemQtys($order, $items);
        $gst = 0;

        foreach ($order->getAllItems() as $orderItem) {
            if (in_array($orderItem->getId(), $items)) {
                $gst += $orderItem->getGst();
            }
        }
        $data['subtotal'] += $gst;
        $data['baseSubtotal'] += $gst;

        return $data;
    }
}
