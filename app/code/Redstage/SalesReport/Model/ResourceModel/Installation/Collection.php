<?php
/**
 * Redstage SalesReport module purpose admin user can view sales report.
 *
 * @category: PHP
 * @package: Redstage/SalesReport
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Anjulata Gupta <agupta@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_SalesReport
 */

namespace Redstage\SalesReport\Model\ResourceModel\Installation;

use Magento\Sales\Model\ResourceModel\Order\Shipment\Item\CollectionFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Sales\Model\Order\ShipmentFactory;
use Magento\Store\Api\StoreRepositoryInterface; 
use Psr\Log\LoggerInterface;  


class Collection extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @var CollectionFactory
     */
    protected $_shipmentFactory;

    /**
     * @var ProductFactory
     */
    protected $_productFactory;    

    /**
     * @var CustomerFactory
     */
    protected $_customerFactory; 
    
    /**
     * @var ShipmentFactory
     */
    protected $_shipment; 
    
    /**
     * @var StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
    * @param CollectionFactory $shipmentFactory
    * @param ProductFactory $productFactory
    * @param CustomerFactory $customerFactory
    * @param StoreRepositoryInterface $storeRepository
    * @param LoggerInterface $logger
    */
    public function __construct(
    CollectionFactory $shipmentFactory,
    ProductFactory $productFactory,
    CustomerFactory $customerFactory,
    ShipmentFactory $shipment,
    StoreRepositoryInterface $storeRepository,
    LoggerInterface $logger
    ) {
        $this->_shipmentFactory = $shipmentFactory;
        $this->_productFactory = $productFactory; 
        $this->_customerFactory = $customerFactory; 
        $this->_shipment = $shipment; 
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
                '*'
            ]);
            /*$collection->addFieldToSelect([
                'market_place_product_id' => 'entity_id',
                'item_code' => 'sku',
                'billing_Quantity' => 'qty'
            ]);*/

            $collection->getSelect()
            ->join(array('ss'=> 'sales_shipment'),
                'ss.entity_id = main_table.parent_id', 
                array('ss.entity_id as delivery_ref_doc','ss.shipment_status as return_period_status','ss.created_at as date_of_dispatch','ss.customer_id as customer_id','ss.order_id as order_id')
            );
            $collection->getSelect()
            ->join(array('ssg'=> 'sales_shipment_grid'),
                'ss.order_id = ssg.order_id', 
                array('ssg.payment_method as name_of_logistics')
            );


            $collection->getSelect()
            ->join(array('sfo'=> 'sales_order'),
                'sfo.entity_id = ss.order_id', 
                array('sfo.created_at as order_date','sfo.entity_id as order_entity_id','sfo.increment_id as sfoincrement','sfo.customer_group_id as sfogroupid')
            );

            $collection->getSelect()
            ->join(array('cdata'=> 'customer_entity'),
                'cdata.entity_id = ss.customer_id',
                array('cdata.entity_id as cdataentity_id','CONCAT(cdata.firstname, " ", cdata.lastname) as full_name')
            );

            $collection->getSelect()
            ->join(array('soa'=> 'sales_order_address'),
                'soa.parent_id = ss.order_id and soa.address_type = "billing"', 
                array('CONCAT(soa.street, " ",soa.region, " ",soa.postcode) as partner_state_billing','soa.city as city')
            );

            $collection->getSelect()
            ->join(array('sin'=> 'sales_invoice'),
                'sin.order_id = ss.order_id', 
                array('sin.entity_id as sin_entity_id','sin.increment_id as increment_id','sin.grand_total as total_invoice_value','sin.base_grand_total as basic_value','sin.shipping_amount as packaging_forwording_charges')
            );

            $collection->getSelect()
            ->join(array('sinitem'=> 'sales_invoice_item'),
                'sinitem.parent_id = sin.entity_id and sinitem.product_id = main_table.product_id and sinitem.sku = main_table.sku', 
                array('sinitem.entity_id as sinitem_entity_id','sinitem.sgst as taxes_sgst','sinitem.cgst as taxes_cgst','sinitem.igst as taxes_igst','sinitem.utgst as taxes_utgst','sinitem.gst as taxes_gst')
            );
            //$collection->getSelect()->where("ss.store_id = ".$storeId);
            //$collection->getSelect()->where("sfo.status = complete");
            /*echo "<pre>";
            print_r($collection->getData());exit;*/

            return $collection;                
                
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }

}