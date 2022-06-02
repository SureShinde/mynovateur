<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Redstage\CustomerSync\Observer\Customer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Redstage\CustomerSync\Helper\Data;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResourceConnection;

/**
 * Class OrderPlaceBefore
 * @package Redstage\CustomerSync\Observer\Customer
 */
class OrderPlaceBefore implements ObserverInterface
{
    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var CollectionFactory
     */
    protected $_orderFactory;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var CustomerCollectionFactory
     */
    protected $customerCollectionFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;
    

    /**
     * OrderPlaceBefore constructor.
     *
     * @param OrderFactory $orderFactory
     * @param Data $helperData
     * @param CollectionFactory $collectionFactory
     * @param CustomerFactory $customerFactory
     * @param Customer $customer
     */
    public function __construct(
        OrderFactory $orderFactory,
        Data $helperData,
        CollectionFactory $collectionFactory,
        CustomerFactory $customerFactory,
        LoggerInterface $logger,
        CustomerCollectionFactory $customerCollectionFactory,
        ResourceConnection $resourceConnection
    )
    {
        $this->orderFactory = $orderFactory;
        $this->helperData = $helperData;
        $this->_orderFactory = $collectionFactory;
        $this->customerFactory = $customerFactory;
        $this->logger = $logger;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        //$dataObject = $observer->getEvent()->getDataObject();
        $orderData=$observer->getEvent()->getOrder();
        $this->logger->info(print_r($orderData->getCustomerId(),true)); 
        // $customerId = $this->helperData->getLoginCustomerId(); 
        $customerId = $orderData->getCustomerId(); 
        $this->logger->info("customer id = ".$customerId);   
        $customerOrder = $this->_orderFactory->create()
            ->addFieldToFilter('customer_id', $customerId);
        
        if ($customerId && (!$customerOrder->getSize()))
        {     
            $connection = $this->resourceConnection->getConnection();
            $tableName = $this->resourceConnection->getTableName('customer_entity');

            $updateCutomer = $connection->update(
                $connection->getTableName('customer_entity'),
                ['customer_status'=>'purchase'],
                $where = '`entity_id` = '.$customerId
            );

           
            $this->logger->info(print_r($updateCutomer,true));
            
        }


    }
}
