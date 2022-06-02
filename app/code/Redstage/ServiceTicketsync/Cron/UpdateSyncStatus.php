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
use Redstage\ServiceTicketsync\Model\ResourceModel\ServiceTicketsync\CollectionFactory;
use Redstage\ServiceTicket\Model\ServiceTicketFactory;
use Redstage\Logger\Model\ResourceModel\Logger\CollectionFactory as LoggerFactory;
use Psr\Log\LoggerInterface;

class UpdateSyncStatus {

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ServiceTicketFactory
     */
    protected $serviceTicketFactory;
    protected $logger;
    protected $loggerFactory;
    /**
     * 
     * @param Redstage\ServiceTicketsync\Model\ResourceModel\ServiceTicketsync\CollectionFactory $collectionFactory
     * @param Redstage\ServiceTicket\Model\ServiceTicketFactory $serviceTicketFactory
     */
    public function __construct(
    CollectionFactory $collectionFactory,
    ServiceTicketFactory $serviceTicketFactory,
    LoggerInterface $logger,
    LoggerFactory $loggerFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->serviceTicketFactory = $serviceTicketFactory;
        $this->logger = $logger;
        $this->loggerFactory = $loggerFactory;
    }

    /**
     * Method is used to disable the products if the product is expired
     */
    public function execute() {
        $loggerCollection = $this->loggerFactory->create()->addFieldToFilter('status', 'pending')->addFieldToFilter('request_type', 'ticket_sync');

        //$this->logger->info(print_r($loggerCollection->getData(),true));
        //$this->logger->info('batch_id--'.$loggerCollection->getSize());die;
        if($loggerCollection->getSize()){
            $data = $loggerCollection->getFirstItem();
            //$this->logger->info('hello-'.$data->getId());die;
            $ticketCollection = $this->collectionFactory->create()->addFieldToFilter('flow_status', 'pending')->addFieldToFilter('batch_id', $data->getId());
            $ticketCollection->addFieldToSelect('*');
            //$this->logger->info(print_r($ticketCollection->getData(),true));
            foreach ($ticketCollection as $ticket) {
                    try {
                        $ticket->setFlowStatus('progress')->save(); 
                        $model = $this->serviceTicketFactory->create()->load($ticket->getMagentoServiceticketId());
                        if($model->getId()){
                            $model->setSfServiceticketStatus($ticket->getSfServiceticketStatus());
                            $model->setSfServiceticketNo($ticket->getSfServiceticketNo());
                            $model->setMessage($ticket->getMessage());
                            $model->save(); 
                            $ticket->setFlowStatus('complete')->save();
                        }else{
                            $ticket->setFlowStatus('invalid')->save();
                        }    
                    } catch (Exception $e) {
                        
                    }
            }
            $data->setStatus('success')->save();
        }    
    }

}
