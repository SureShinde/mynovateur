<?php
/**
 * Redstage OrderInstallation module purpose admin user can export order data predifined CSV only shipment created order data.
 *
 * @category: PHP
 * @package: Redstage/OrderInstallation
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Mohit Tyagi <mtyagi@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_OrderInstallation
 */

namespace Redstage\OrderInstallation\Model\ResourceModel\Installation;

use Magento\Sales\Model\ResourceModel\Order\Shipment\Item\CollectionFactory;
use Magento\Store\Api\StoreRepositoryInterface; 
use Psr\Log\LoggerInterface;  


class Collection{

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Shipment\Item\CollectionFactory
    */
    protected $_shipmentFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeRepository;

    /**
     * @var LoggerInterface
     */
    public $logger;

    public function __construct(
    CollectionFactory $shipmentFactory,
    StoreRepositoryInterface $storeRepository,
    LoggerInterface $logger
    ) {
        $this->_shipmentFactory = $shipmentFactory;
        $this->storeRepository= $storeRepository;
        $this->logger = $logger;
    }

    public function ShipmentItemCollection(){
        try {
            $store = $this->storeRepository->get('default');
            $storeId = $store->getId(); // this is the store ID
            $collection = $this->_shipmentFactory->create()->addAttributeToSelect("*");
            // Get columns for grid
        $collection->addFieldToSelect([
            'product_sku' => 'sku',
            'product_name' => 'name',
            'product_desc' => 'product_id'
        ]);

        $collection->getSelect()
        ->join(array('ss'=> 'sales_shipment'),
            'ss.entity_id = main_table.parent_id', 
            array('ss.customer_id as shipment_customer_id','ss.created_at as shipment_created_at','ss.increment_id as shipment_increment_id')
        );


        $collection->getSelect()
        ->join(array('sfo'=> 'sales_order'),
            'sfo.entity_id = ss.order_id', 
            array('sfo.created_at as sfocreated','sfo.entity_id as order_entity_id','sfo.increment_id as sfoincrement','sfo.customer_group_id as sfogroupid')
        );

        $collection->getSelect()
        ->join(array('cdata'=> 'customer_entity'),
            'cdata.entity_id = ss.customer_id', 
            array('cdata.email as email','cdata.firstname as firstname')
        );

        $collection->getSelect()
        ->join(array('soa'=> 'sales_order_address'),
            'soa.parent_id = ss.order_id and soa.address_type = "shipping"', 
            array('soa.city as city','soa.postcode as postcode','soa.region as region','soa.street as street1','soa.street as street2','soa.street as street3','soa.customer_address_id as shipping_contactname','soa.customer_address_id as shipping_contactnumber')
        );

        $collection->getSelect()
        ->join(array('sin'=> 'sales_invoice'),
            'sin.order_id = ss.order_id', 
            array('sin.created_at as sincreated','sin.increment_id as sinincrement')
        );
        $collection->getSelect()->where("ss.store_id = ".$storeId);
        $collection->addFilterToMap(
            'product_sku',
            'main_table.sku'
        );
        $collection->addFilterToMap(
            'product_name',
            'main_table.name'
        );
        $collection->addFilterToMap(
            'product_desc',
            'main_table.product_id'
        );
        $collection->addFilterToMap(
            'order_entity_id',
            'sfo.entity_id'
        );
        $collection->addFilterToMap(
            'sfoincrement',
            'sfo.increment_id'
        );
        $collection->addFilterToMap(
            'sfocreated',
            'sfo.created_at'
        );
        $collection->addFilterToMap(
            'sfogroupid',
            'sfo.customer_group_id'
        );
        $collection->addFilterToMap(
            'shipment_increment_id',
            'ss.increment_id'
        );
        $collection->addFilterToMap(
            'shipment_created_at',
            'ss.created_at'
        );
        $collection->addFilterToMap(
            'shipping_contactname',
            'soa.customer_address_id'
        );
        $collection->addFilterToMap(
            'shipping_contactnumber',
            'soa.customer_address_id'
        );
        $collection->addFilterToMap(
            'email',
            'cdata.email'
        );
        $collection->addFilterToMap(
            'firstname',
            'cdata.firstname'
        );
        $collection->addFilterToMap(
            'city',
            'soa.city'
        );
        $collection->addFilterToMap(
            'postcode',
            'soa.postcode'
        );
        $collection->addFilterToMap(
            'region',
            'soa.region'
        );
        $collection->addFilterToMap(
            'street1',
            'soa.street'
        );
        $collection->addFilterToMap(
            'street2',
            'soa.street'
        );
        $collection->addFilterToMap(
            'street3',
            'soa.street'
        );
        $collection->addFilterToMap(
            'sinincrement',
            'sin.increment_id'
        );
        $collection->addFilterToMap(
            'sincreated',
            'sin.created_at'
        );
        $collection->addFilterToMap(
            'contactname',
            'caevn.value'
        );
        $collection->addFilterToMap(
            'contactnumber',
            'caevn.value'
        );

        $collection->setOrder('ss.created_at');
            return $collection;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }

}