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
use Magento\Customer\Model\CustomerFactory;
use Redstage\Logger\Model\ResourceModel\Logger\CollectionFactory as LoggerFactory;
use Psr\Log\LoggerInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\ResourceConnection;

class CustomerSync 
{

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var LoggerFactory
     */
    protected $loggerFactory;

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    


    /**
     * 
     * @param Redstage\CustomerSync\Model\ResourceModel\DumpCustomerSync\CollectionFactory $collectionFactory
     * @param Magento\Customer\Model\CustomerFactory $customerFactory
     */
    public function __construct(
    CustomerFactory $customerFactory,
    LoggerInterface $logger,
    LoggerFactory $loggerFactory,
    Json $json,
    ResourceConnection $resourceConnection
    ) {
        $this->customerFactory = $customerFactory;
        $this->logger = $logger;
        $this->loggerFactory = $loggerFactory;
        $this->json = $json;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Method is used to disable the products if the product is expired
     */
    public function execute() {
        $loggerCollection = $this->loggerFactory->create()->addFieldToFilter('status', 'pending')->addFieldToFilter('request_type', 'customer_sync');
        $jsonDecodeResponseData = [];
        $loggerData = $loggerCollection->getData();
        $data = $loggerCollection->getFirstItem();
        
        if(is_array($loggerData)){
            foreach ($loggerData as $logdata) {
                $jsonDecodeResponseData = $this->json->unserialize($logdata['response_data']);
                //$this->logger->info(print_r($jsonDecodeResponseData,true));
                if(is_array($jsonDecodeResponseData)){
                    $index = 0;
                    foreach ($jsonDecodeResponseData as $response) {
                        $this->logger->info(print_r($response,true));
                        if(isset($response['success']) && $response['success'] && isset($response['record_Id']) && $response['record_Id']){
                            try {

                                    $connection = $this->resourceConnection->getConnection();
                                    $updateCutomer = $connection->update(
                                        $connection->getTableName('customer_entity'),
                                        ['customer_sf_id'=> $response['record_Id'],'send_to_sf'=>'1'],
                                        $where = '`entity_id` = '.$response['external_Id']
                                    );
                                    $data->setStatus('success')->save();
                                 
                            } catch (Exception $e) {
                                
                            }
                        }
                        $index++;
                    }
                }
            } 
        }
    }

}