<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomInvoice
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\CustomInvoice\Plugin\Order;

/*
 * Webkul Marketplace Order View Block
 */

class View extends \Webkul\Marketplace\Block\Order\View
{

    public function afterGetLinks(\Webkul\Marketplace\Block\Order\View $subject, $result)
    {
        $order = $subject->getOrder();
        $orderId = $order->getId();
        if (isset($result['invoice'])) {
            unset($result['invoice']);
        }
        $result['custom_invoice'] = [
            'name' => 'custom_invoice',
            'label' => __('Invoice'),
            'url' => $subject->_urlBuilder->getUrl(
                'custominvoice/invoice/view',
                [
                    'id' => $orderId,
                    '_secure' => $subject->getRequest()->isSecure()
                ]
            )
        ];
        return $result;
    }
}
