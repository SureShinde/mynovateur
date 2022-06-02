<?php
/**
 * Redstage Services Ticket sync module use for update service ticket status in bulk and base on magento side created ticket from SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicketsync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicketsync
 */

namespace Redstage\ServiceTicketsync\Cron;
use Redstage\ServiceTicket\Model\ServiceTicketFactory;
use Redstage\Logger\Model\ResourceModel\Logger\CollectionFactory as LoggerFactory;
use Psr\Log\LoggerInterface;
use Magento\Framework\Serialize\Serializer\Json;

class CreateServiceTickets {

    /**
     * @var ServiceTicketFactory
     */
    protected $serviceTicketFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var LoggerFactory
     */
    protected $loggerFactory;

    /**
     * 
     * @param ServiceTicketFactory $serviceTicketFactory
     * @param LoggerInterface $logger
     * @param LoggerFactory $loggerFactory
     */
    public function __construct(
    ServiceTicketFactory $serviceTicketFactory,
    LoggerInterface $logger,
    Json $json,
    LoggerFactory $loggerFactory
    ) {
        $this->serviceTicketFactory = $serviceTicketFactory;
        $this->logger = $logger;
        $this->json = $json;
        $this->loggerFactory = $loggerFactory;
    }

    /**
     * Method is used to disable the products if the product is expired
     */
    public function execute() {
        $loggerCollection = $this->loggerFactory->create()->addFieldToFilter('status', 'pending')->addFieldToFilter('request_type', 'create_ticket');
        $jsonDecodeResponseData = [];
        //$this->logger->info(print_r($loggerCollection->getData(),true));
        $loggerData = $loggerCollection->getData();
        $data = $loggerCollection->getFirstItem();
        //$this->logger->info(print_r($data->getData(),true)); 
          if(is_array($loggerData)){
            foreach ($loggerData as $logdata) {
                //$this->logger->info(print_r($logdata,true));                
                $jsonDecodeResponseData = $this->json->unserialize($logdata['response_data']);    
                if(is_array($jsonDecodeResponseData)){
                    $index = 0;
                    foreach ($jsonDecodeResponseData as $response) {
                        if(isset($response['success']) && $response['success'] && isset($response['recordId']) && $response['recordId']){
                            try {
                                if(isset($response['external_Id'])){
                                    //Ticket id as external_Id should be geeting in response data from api, It is not there in response
                                    $model = $this->serviceTicketFactory->create()->load($response['external_Id']);
                                    //$this->logger->info(print_r($model->getData(),true));
                                    if($model->getId()){ 
                                        $model->setStatus("1");
                                        $model->save(); 

                                        $data->setStatus('success')->save();
                                    }    
                                }
                            } catch (Exception $e) {
                                
                            }
                        }
                        $index++;
                    }
                }
                
                
            } 
        }
        $this->logger->info("out");
    }    

}
