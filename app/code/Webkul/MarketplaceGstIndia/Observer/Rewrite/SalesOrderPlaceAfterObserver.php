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

namespace Webkul\MarketplaceGstIndia\Observer\Rewrite;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManager;
use Magento\Quote\Model\QuoteRepository;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Webkul\Marketplace\Helper\Data as MarketplaceHelper;
use Magento\Sales\Model\Order\AddressFactory;
use Webkul\Marketplace\Model\SaleslistFactory;
use Magento\Directory\Model\CountryFactory;
use Webkul\Marketplace\Helper\Email as MpEmailHelper;
use Webkul\Marketplace\Helper\Orders as OrdersHelper;
use Webkul\Marketplace\Model\ProductFactory;
use Webkul\Marketplace\Model\OrdersFactory;
use Webkul\Marketplace\Model\OrderPendingMailsFactory;
use Webkul\Marketplace\Helper\Notification as NotificationHelper;
use Webkul\Marketplace\Model\SaleperpartnerFactory;

/**
 * Webkul Marketplace SalesOrderPlaceAfterObserver Observer Model.
 */
class SalesOrderPlaceAfterObserver extends \Webkul\Marketplace\Observer\SalesOrderPlaceAfterObserver
{

    /**
     * Order Place Operation method.
     *
     * @param \Magento\Sales\Model\Order $order
     * @param int                        $lastOrderId
     */
    public function orderPlacedOperations($order, $lastOrderId)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->get(\Psr\Log\LoggerInterface::class);
        $logger->debug('message test');
        $orderItemRepository = $objectManager->get(\Magento\Sales\Api\OrderItemRepositoryInterface::class);

        $this->productSalesCalculation($order);

        /*send placed order mail notification to seller*/

        $paymentCode = '';
        if ($order->getPayment()) {
            $paymentCode = $order->getPayment()->getMethod();
        }

        $shippingInfo = '';
        $shippingDes = '';

        $billingId = $order->getBillingAddress()->getId();

        $billaddress = $this->orderAddressFactory->create()->load($billingId);
        $billinginfo = $billaddress['firstname'].'<br/>'.
        $billaddress['street'].'<br/>'.
        $billaddress['city'].' '.
        $billaddress['region'].' '.
        $billaddress['postcode'].'<br/>'.
        $this->countryModel->create()->load($billaddress['country_id'])->getName().'<br/>T:'.
        $billaddress['telephone'];

        $order->setOrderApprovalStatus(1)->save();

        $payment = $order->getPayment()->getMethodInstance()->getTitle();

        if ($order->getShippingAddress()) {
            $shippingId = $order->getShippingAddress()->getId();
            $address = $this->orderAddressFactory->create()->load($shippingId);
            $shippingInfo = $address['firstname'].'<br/>'.
            $address['street'].'<br/>'.
            $address['city'].' '.
            $address['region'].' '.
            $address['postcode'].'<br/>'.
            $this->countryModel->create()->load($address['country_id'])->getName().'<br/>T:'.
            $address['telephone'];
            $shippingDes = $order->getShippingDescription();
        }

        $adminStoremail = $this->_marketplaceHelper->getAdminEmailId();
        $defaultTransEmailId = $this->_marketplaceHelper->getDefaultTransEmailId();
        $adminEmail = $adminStoremail ? $adminStoremail : $defaultTransEmailId;
        $adminUsername = $this->_marketplaceHelper->getAdminName();

        $sellerOrder = $this->ordersFactory->create()
            ->getCollection()
            ->addFieldToFilter('order_id', $lastOrderId)
            ->addFieldToFilter('seller_id', ['neq' => 0]);
        foreach ($sellerOrder as $info) {
            $userdata = $this->_customerRepository->getById($info['seller_id']);
            $username = $userdata->getFirstname();
            $useremail = $userdata->getEmail();

            $senderInfo = [];
            $receiverInfo = [];

            $receiverInfo = [
                'name' => $username,
                'email' => $useremail,
            ];
            $senderInfo = [
                'name' => $adminUsername,
                'email' => $adminEmail,
            ];
            $totalprice = 0;
            $totalTaxAmount = 0;
            $codCharges = 0;
            $shippingCharges = 0;
            $orderinfo = '';
            $totalGstAmount = 0;

            $saleslistIds = [];
            $collection1 = $this->saleslistFactory->create()
                ->getCollection()
                ->addFieldToFilter('order_id', $lastOrderId)
                ->addFieldToFilter('seller_id', $info['seller_id'])
                ->addFieldToFilter('parent_item_id', ['null' => 'true'])
                ->addFieldToFilter('magerealorder_id', ['neq' => 0])
                ->addFieldToSelect('entity_id');

            $saleslistIds = $collection1->getData();

            $fetchsale = $this->saleslistFactory->create()
                ->getCollection()
                ->addFieldToFilter(
                    'entity_id',
                    ['in' => $saleslistIds]
                );
            $fetchsale->getSellerOrderCollection();
            foreach ($fetchsale as $res) {
                $product = $this->_productRepository->getById($res['mageproduct_id']);
                $itemDetails = $orderItemRepository->get($res->getOrderItemId());
                /* product name */
                $productName = $res->getMageproName();
                $result = [];
                $result = $this->getProductOptionData($res, $result);
                $productName = $this->getProductNameHtml($result, $productName);
                /* end */
                if ($res->getProductType() == 'configurable') {
                    $configurableSalesItem = $this->saleslistFactory->create()
                        ->getCollection()
                        ->addFieldToFilter('order_id', $lastOrderId)
                        ->addFieldToFilter('seller_id', $info['seller_id'])
                        ->addFieldToFilter('parent_item_id', $res->getOrderItemId());
                    $configurableItemArr = $configurableSalesItem->getOrderedProductId();
                    $configurableItemId = $res['mageproduct_id'];
                    if (!empty($configurableItemArr)) {
                        $configurableItemId = $configurableItemArr[0];
                    }
                    $product = $this->_productRepository->getById($configurableItemId);
                } else {
                    $product = $this->_productRepository->getById($res['mageproduct_id']);
                }

                $sku = $product->getSku();
                $orderinfo = $orderinfo."<tbody><tr>
                                <td class='item-info'>".$productName."</td>
                                <td class='item-info'>".$sku."</td>
                                <td class='item-qty'>".($res['magequantity'] * 1)."</td>
                                <td class='col subtotal'>
                                    <table>
                                        <tbody style='background:none;text-align:center'>
                                            <tr>
                                                <td>".round($itemDetails->getCgstPercent(),2)."</span></td>
                                                <td>".$order->formatPrice($itemDetails->getCgst())."</span></td>
                                            </tr>
                                    </table>
                                </td>
                                <td class='col subtotal'>
                                    <table>
                                        <tbody style='background:none;text-align:center'>
                                            <tr>
                                                <td>".round($itemDetails->getSgstPercent(),2)."</span></td>
                                                <td>".$order->formatPrice($itemDetails->getSgst())."</span></td>
                                            </tr>
                                    </table>
                                </td>
                                <td class='col subtotal'>
                                    <table>
                                        <tbody style='background:none;text-align:center'>
                                            <tr>
                                                <td>".round($itemDetails->getIgstPercent(),2)."</span></td>
                                                <td>".$order->formatPrice($itemDetails->getIgst())."</span></td>
                                            </tr>
                                    </table>
                                </td>
                                <td class='col subtotal'>
                                    <table>
                                        <tbody style='background:none;text-align:center'>
                                            <tr>
                                                <td>".round($itemDetails->getUgstPercent(),2)."</span></td>
                                                <td>".$order->formatPrice($itemDetails->getUgst())."</span></td>
                                            </tr>
                                    </table>
                                </td>
                                <td class='item-price'>".
                                    $order->formatPrice(
                                        $res['magepro_price'] * $res['magequantity']
                                    ).
                                '</td>
                             </tr></tbody>';
                $totalTaxAmount = $totalTaxAmount + $res['total_tax'];
                $totalGstAmount = $totalGstAmount + $itemDetails->getGst();
                $totalprice = $totalprice + ($res['magepro_price'] * $res['magequantity']);

                /*
                * Low Stock Notification mail to seller
                */
                if ($this->_marketplaceHelper->getlowStockNotification()) {
                    $stockState = $this->_objectManager->get('\Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku');
                    $salable = $stockState->execute($sku);
                    if (isset($salable[0]['qty'])) {
                        $stockItemQty = $salable[0]['qty'];
                    } elseif (!empty($product['quantity_and_stock_status']['qty'])) {
                        $stockItemQty = $product['quantity_and_stock_status']['qty'];
                    } else {
                        $stockItemQty = $product->getQty();
                    }
                    if ($stockItemQty <= $this->_marketplaceHelper->getlowStockQty()) {
                        $orderProductInfo = "<tbody><tr>
                                <td class='item-info'>".$productName."</td>
                                <td class='item-info'>".$sku."</td>
                                <td class='item-qty'>".($stockItemQty * 1).'</td>
                             </tr></tbody>';

                        $emailTemplateVariables = [];
                        $emailTemplateVariables['myvar1'] = $orderProductInfo;
                        $emailTemplateVariables['myvar2'] = $username;

                        $this->mpEmailHelper->sendLowStockNotificationMail(
                            $emailTemplateVariables,
                            $senderInfo,
                            $receiverInfo
                        );
                    }
                }
            }
            $shippingCharges = $info->getShippingCharges();
            $couponAmount = $info->getCouponAmount();
            $totalCod = 0;

            if ($paymentCode == 'mpcashondelivery') {
                $totalCod = $info->getCodCharges();
                $codRow = "<tr class='subtotal'>
                            <th colspan='7'>".__('Cash On Delivery Charges')."</th>
                            <td colspan='7'><span>".
                                $order->formatPrice($totalCod).
                            '</span></td>
                            </tr>';
            } else {
                $codRow = '';
            }

            $orderinfo = $orderinfo."<tfoot class='order-totals'>
                                <tr class='subtotal'>
                                    <th colspan='7'>".__('Shipping & Handling Charges')."</th>
                                    <td colspan='7'><span>".
                                    $order->formatPrice($shippingCharges)."</span></td>
                                </tr>
                                <tr class='subtotal'>
                                    <th colspan='7'>".__('Discount')."</th>
                                    <td colspan='7'><span> -".
                                        $order->formatPrice($couponAmount).
                                    "</span></td>
                                </tr>
                                <tr class='subtotal'>
                                    <th colspan='7'>".__('GST Amount')."</th>
                                    <td colspan='7'><span>".
                                    $order->formatPrice($totalGstAmount).'</span></td>
                                </tr>'.$codRow."
                                <tr class='subtotal'>
                                    <th colspan='7'>".__('Grandtotal')."</th>
                                    <td colspan='7'><span>".
                                    $order->formatPrice(
                                        $totalprice +
                                        $totalGstAmount +
                                        $shippingCharges +
                                        $totalCod -
                                        $couponAmount
                                    ).'</span></td>
                                </tr></tfoot>';

            $emailTemplateVariables = [];
            if ($shippingInfo != '') {
                $isNotVirtual = 1;
            } else {
                $isNotVirtual = 0;
            }
            $emailTempVariables['myvar1'] = $order->getRealOrderId();
            $emailTempVariables['myvar2'] = $order['created_at'];
            $emailTempVariables['myvar4'] = $billinginfo;
            $emailTempVariables['myvar5'] = $payment;
            $emailTempVariables['myvar6'] = $shippingInfo;
            $emailTempVariables['isNotVirtual'] = $isNotVirtual;
            $emailTempVariables['myvar9'] = $shippingDes;
            $emailTempVariables['myvar8'] = $orderinfo;
            $emailTempVariables['myvar3'] = $username;

            if ($this->_marketplaceHelper->getOrderApprovalRequired()) {
                $emailTempVariables['seller_id'] = $info['seller_id'];
                $emailTempVariables['order_id'] = $lastOrderId;
                $emailTempVariables['sender_name'] = $senderInfo['name'];
                $emailTempVariables['sender_email'] = $senderInfo['email'];
                $emailTempVariables['receiver_name'] = $receiverInfo['name'];
                $emailTempVariables['receiver_email'] = $receiverInfo['email'];

                $orderPendingMailsCollection = $this->orderPendingMailsFactory->create();
                $orderPendingMailsCollection->setData($emailTempVariables);
                $orderPendingMailsCollection->setCreatedAt($this->_date->gmtDate());
                $orderPendingMailsCollection->setUpdatedAt($this->_date->gmtDate());
                $orderPendingMailsCollection->save();
                $order->setOrderApprovalStatus(0)->save();
            } else {
                $this->mpEmailHelper->sendPlacedOrderEmail(
                    $emailTempVariables,
                    $senderInfo,
                    $receiverInfo
                );
            }
        }
    }
}
