<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryExtend\Block\Order\Shipment;

/*
 * Webkul Marketplace Order View Block
 */
use Magento\Sales\Model\Order;
use Magento\Customer\Model\Customer;
use Magento\Sales\Model\Order\Address;
use Magento\Sales\Model\Order\Address\Renderer as AddressRenderer;
use Magento\Downloadable\Model\Link;
use Magento\Downloadable\Model\Link\Purchased;
use Magento\Store\Model\ScopeInterface;
use Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Webkul\Marketplace\Model\OrdersFactory as MpOrderModel;
use Magento\Sales\Model\Order\Creditmemo;
use Magento\Sales\Model\Order\InvoiceFactory;
use Webkul\Marketplace\Model\SaleslistFactory;
use Magento\Catalog\Api\ProductRepositoryInterfaceFactory;
use Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory as OrderItemCollection;

class Lists extends \Webkul\Marketplace\Block\Order\Shipment\Lists
{
    /**
     * @var OrderItemCollection
     */
    protected $itemCollectionFactory;

    /**
     * @param Order                                             $order
     * @param Customer                                          $customer
     * @param \Magento\Framework\ObjectManagerInterface         $objectManager
     * @param \Magento\Customer\Model\Session                   $customerSession
     * @param \Magento\Framework\Registry                       $coreRegistry
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param AddressRenderer                                   $addressRenderer
     * @param \Magento\Downloadable\Model\Link\PurchasedFactory $purchasedFactory
     * @param CollectionFactory                                 $itemsFactory
     * @param MpOrderModel                                      $mpOrderModel
     * @param Creditmemo                                        $creditmemoModel
     * @param \Magento\Sales\Model\Order\Creditmemo\ItemFactory $creditmemoItem
     * @param InvoiceFactory                                    $invoiceModel
     * @param SaleslistFactory                                  $saleslistModel
     * @param \Webkul\Marketplace\Helper\Orders                 $ordersHelper
     * @param ProductRepositoryInterfaceFactory                 $productRepository
     * @param \Magento\Shipping\Model\Config                    $shippingConfig
     * @param \Magento\Shipping\Model\CarrierFactory            $carrierFactory
     * @param OrderItemCollection                               $itemCollectionFactory
     * @param array                                             $data
     */
    public function __construct(
        Order $order,
        Customer $customer,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Element\Template\Context $context,
        AddressRenderer $addressRenderer,
        \Magento\Downloadable\Model\Link\PurchasedFactory $purchasedFactory,
        \Magento\Sales\Block\Order\Item\Renderer\DefaultRenderer $defaultRenderer,
        CollectionFactory $itemsFactory,
        MpOrderModel $mpOrderModel = null,
        Creditmemo $creditmemoModel = null,
        \Magento\Sales\Model\Order\Creditmemo\ItemFactory $creditmemoItem = null,
        InvoiceFactory $invoiceModel = null,
        SaleslistFactory $saleslistModel = null,
        \Webkul\Marketplace\Helper\Orders $ordersHelper = null,
        ProductRepositoryInterfaceFactory $productRepository = null,
        \Magento\Shipping\Model\Config $shippingConfig = null,
        \Magento\Shipping\Model\CarrierFactory $carrierFactory = null,
        OrderItemCollection $itemCollectionFactory = null,
        \Webkul\DelhiveryExtend\Model\ShipmentFactory $shipmentFactory,
        array $data = []
    ) {
        $this->shipmentFactory = $shipmentFactory;
        parent::__construct(
            $order,
            $customer,
            $customerSession,
            $coreRegistry,
            $context,
            $addressRenderer,
            $purchasedFactory,
            $defaultRenderer,
            $itemsFactory,
            $mpOrderModel,
            $creditmemoModel,
            $creditmemoItem,
            $invoiceModel,
            $saleslistModel,
            $ordersHelper,
            $productRepository,
            $shippingConfig,
            $carrierFactory,
            $itemCollectionFactory,
            $data
        );
    }

    /**
     * Get ShippingStatus
     */
    public function getShippingStatus($trackingNumber)
    {
        $trackingInfo = $this->shipmentFactory->create()->getCollection()
                            ->addFieldToFilter('tracking_number', $trackingNumber)
                            ->setPageSize(1)->setCurPage(1)->getFirstItem();
        return $trackingInfo->getEntityId() ? $trackingInfo->getShipStatus() : __('In process');

    }
}
