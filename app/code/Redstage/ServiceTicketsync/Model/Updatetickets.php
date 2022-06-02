<?php
/**
 * Redstage Services Ticket sync module use for update service ticket status in bulk and base on magento side created ticket from SF
 *
 * @package: Redstage/ServiceTicketsync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicketsync
 */

namespace Redstage\ServiceTicketsync\Model;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Redstage\ServiceTicket\Model\ServiceTicketFactory;
use Redstage\ServiceTicketsync\Model\ServiceTicketsyncFactory;
use Redstage\Logger\Model\LoggerFactory;

class Updatetickets implements \Redstage\ServiceTicketsync\Api\UpdateStatusInterface
{

    /**
     * @var ServiceTicketFactory
     */
    protected $serviceTicketsyncFactory;

    /**
     * @var LoggerFactory
     */
    protected $loggerFactory;

    /**
     * @var ServiceTicketFactory
     */
    protected $serviceTicketFactory;

    /**
     * 
     * @param RequestInterface $request
     * @param Json $json
     * @param ServiceTicketFactory $serviceTicketFactory
     * @param ServiceTicketsyncFactory $serviceTicketsyncFactory
     * @param LoggerFactory $loggerFactory
     */
    public function __construct(
         RequestInterface $request,
         Json $json,
         ServiceTicketFactory $serviceTicketFactory,
         ServiceTicketsyncFactory $serviceTicketsyncFactory,
         LoggerFactory $loggerFactory
    ) {
        $this->request = $request;
        $this->json = $json;
        $this->serviceTicketFactory = $serviceTicketFactory;
        $this->serviceTicketsyncFactory = $serviceTicketsyncFactory;
        $this->loggerFactory = $loggerFactory;
    }

    /**
     * Updateticket function
     *
     * @api
     * @return string
     */
    public function Updateticket()
    {   
        $data = $this->request->getContent();
        $loggerData = array();
        $loggerData['request_data'] = $data;
        $loggerData['request_type'] = 'ticket_sync';
        $modelLogger = $this->loggerFactory->create();
        $modelLogger->setData($loggerData)->save();
        try {
            $jsonDecode = $this->json->unserialize($data);
            $tiketData = array();
            $index = 0;
            foreach($jsonDecode['tickets'] as $dataVal){
                try {
                    $tiketData['magento_serviceticket_id'] = $dataVal['magento_serviceticket_id'];
                    $tiketData['sf_serviceticket_no'] = $dataVal['ticket_id'];
                    $tiketData['sf_serviceticket_status'] = $dataVal['status'];
                    $tiketData['message'] = $dataVal['message'];
                    $tiketData['status'] = 'pending';
                    $tiketData['flow_status'] = 'pending';
                    $tiketData['batch_id'] = $modelLogger->getId();
                    $model = $this->serviceTicketsyncFactory->create();
                    $model->setData($tiketData)->save();

                    
                    $model->setFlowStatus('progress')->save(); 
                    $serviceTicketModel = $this->serviceTicketFactory->create()->load($model->getMagentoServiceticketId());
                    if($serviceTicketModel->getId()){
                        $serviceTicketModel->setSfServiceticketStatus($model->getSfServiceticketStatus());
                        $serviceTicketModel->setSfServiceticketNo($model->getSfServiceticketNo());
                        $serviceTicketModel->setMessage($model->getMessage());
                        $serviceTicketModel->save(); 
                        $model->setStatus('success')->save();
                        $model->setFlowStatus('complete')->save();

                        $status = 'success';
                        $responseReturn[$index] = [
                            "ticket_id" => $dataVal['ticket_id'],
                            "status" => 'success'
                        ];        
                    }else{
                        $model->setFlowStatus('invalid')->save();
                        $status = 'failed';
                        $responseReturn[$index] = [
                            "ticket_id" => $dataVal['ticket_id'],
                            "status" => 'failed',
                            "error_code" => "503",
                            "error_message" =>"Service ticket is not exist."
                        ];
                    } 
                } catch (\Exception $e) {
                    $status = 'failed';
                    $responseReturn[$index] = [
                        "ticket_id" => $dataVal['ticket_id'],
                        "status" => 'failed',
                        "error_code" => $e->getCode(),
                        "error_message" =>$e->getMessage()
                    ];
                }

                $index++;   
            }
            
        } catch (\Exception $e) {
            $status = 'failed';            
        }

        $response = json_encode(["tickets" => $responseReturn]);
        $modelLogger = $this->loggerFactory->create()->load($modelLogger->getId());
        $modelLogger->setStatus($status)->setResponseData($response)->save();
        echo $response;
        
    }
}
