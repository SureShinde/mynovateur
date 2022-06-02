<?php
/**
 * Redstage customer sync module use to sync customer in bulk 
 *
 * @category: PHP
 * @package: Redstage/CustomerSync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_CustomerSync
 */

namespace Redstage\CustomerSync\Cron;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResourceConnection;

class CustomerInactive 
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * Customer log
     *
     * @var \Magento\Customer\Model\Log
     */
    protected $customerLog;


    /**
     * @param LoggerInterface $logger
     * @param CollectionFactory $collectionFactory
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        LoggerInterface $logger,
        CollectionFactory $collectionFactory,
        ResourceConnection $resourceConnection
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Method is used to disable the products if the product is expired
     */
    public function execute() {
        $customers = $this->collectionFactory->create()->load();
        $customers->getSelect()
            ->reset(\Zend_Db_Select::COLUMNS)
            ->columns(['entity_id'])
            ->columns(['customer_status'])
            ->where("customer_status IN('browsing','purchase')");
        /*$customersData = $customers->getData();
        $this->logger->info(print_r($customersData,true));*/
        
        foreach ($customers as $customerData) {

            //$this->logger->info(print_r($customerData->getData(),true)); 
            $customerId = $customerData->getEntityId();   
            // $this->logger->info($customerId);
            
            $visitorConnection = $this->resourceConnection->getConnection();
            $tableName = $this->resourceConnection->getTableName('customer_visitor');

            $sql = "SELECT last_visit_at FROM ".$tableName." WHERE customer_id=$customerId ORDER BY visitor_id Desc LIMIT 1 "; 
            $VisitorData = $this->resourceConnection->getConnection()->fetchAll($sql); 
            // $this->logger->info(print_r($VisitorData,true));
            
            if($VisitorData){
                $currentDate = date('Y');                
                $lastLoginDate = date('Y',strtotime($VisitorData[0]['last_visit_at']));
                $yearsDiff = abs($currentDate - $lastLoginDate);
                if ($customerData->getEntityId() && ($yearsDiff >= 5))
                {
                    $connection = $this->resourceConnection->getConnection();
                    $tableName = $this->resourceConnection->getTableName('customer_entity');

                    $updateCutomer = $connection->update(
                        $connection->getTableName('customer_entity'),
                        ['customer_status'=>'inactive'],
                        $where = '`entity_id` = '.$customerId
                    );
                }
            }
        } 
        
    }

     

}