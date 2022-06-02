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
use Redstage\ServiceTicket\Model\ResourceModel\ServiceTicket\CollectionFactory;
use Redstage\Logger\Model\LoggerFactory;
use Redstage\ServiceTicketsync\Helper\Data;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Store\Model\StoreManagerInterface;

class Createtickets extends \Magento\Framework\Model\AbstractModel implements \Redstage\ServiceTicketsync\Api\CreateTicketInterface
{

    /**
     * @var Curl
     */
    protected $curlClient;

    /**
     * @var LoggerFactory
     */
    protected $loggerFactory;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var CollectionFactory
     */
    protected $_serviceTicketFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * 
     * @param RequestInterface $request
     * @param Json $json
     * @param LoggerFactory $loggerFactory
     * @param Data $helperData
     * @param Curl $curlClient
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        RequestInterface $request,
        Json $json,
        LoggerFactory $loggerFactory,
        Data $helperData,
        Curl $curlClient,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->request = $request;
        $this->json = $json;
        $this->loggerFactory = $loggerFactory;
        $this->helperData = $helperData;
        $this->curlClient = $curlClient;
        $this->_serviceTicketFactory = $collectionFactory;
        $this->storeManager = $storeManager;
    }

    
    public function skAuthTocken()
    {
        try {
            if($this->helperData->getFieldConfig('salesforce_config_enabled')){
                $targetUrl = $this->helperData->getFieldConfig('salesforce_auth_api_url')."?username=".$this->helperData->getFieldConfig('salesforce_username')."&password=".$this->helperData->getFieldConfig('salesforce_password')."&grant_type=".$this->helperData->getFieldConfig('salesforce_grand_type')."&client_id=".$this->helperData->getFieldConfig('salesforce_client_id')."&client_secret=".$this->helperData->getFieldConfig('salesforce_client_secret');
                
                if (isset($targetUrl)) { 
                    // send data on target Url using post method
                    $this->curlClient->post($targetUrl, '');

                    $response = json_decode($this->curlClient->getBody(), true);
                    if ($response['access_token']) {
                        return $response['access_token'];
                    } 
                }
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return false;
    }

    public function sendServiceTicketsToSF(){
        try {
            if($this->helperData->getTicketConfig('create_ticket_config_enabled')){
                $targetUrl = $this->helperData->getTicketConfig('create_ticket_api_url');
                $credential = $this->skAuthTocken();
                if (isset($targetUrl) && isset($credential)) {
                    // prepare headers based on token
                    $headers = [
                        "Content-Type" => "application/json",
                        "Authorization" => "Bearer $credential"
                    ];
                    $data = $this->getTicketsToSend();
                    //print_r($data);
                    // set header details
                    $this->curlClient->setHeaders($headers);
                    $this->curlClient->setOption(CURLOPT_SSL_VERIFYHOST,false);
                    $this->curlClient->setOption(CURLOPT_SSL_VERIFYPEER,false);

                    // send data on target Url using post method
                    $this->curlClient->post($targetUrl, $data);

                    $sfResponse = $this->curlClient->getBody();

                    if ($sfResponse) {
                        try{
                            $loggerData = array();
                            $loggerData['request_data'] = $data;
                            $loggerData['request_type'] = 'create_ticket';
                            $loggerData['response_data'] = $sfResponse;
                            $loggerData['status'] = 'pending';
                            $modelLogger = $this->loggerFactory->create();
                            $modelLogger->setData($loggerData)->save(); 
                            $status = 'pending';
                        }
                        catch (\Exception $e) {
                            $status = 'failed';
                            $responseData = $e->getMessage();
                            
                        }
                        if($status == 'failed'){
                            $modelLogger = $this->loggerFactory->create()->load($modelLogger->getId());
                            $modelLogger->setStatus($status)->setResponseData($responseData)->save();
                        }                        
                        echo $sfResponse;    
                        
                    }
                }
            }
        }catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }
    }

    public function getTicketsToSend(){
        $collection = $this->_serviceTicketFactory->create();
        $collection->getSelect()
                  ->reset(\Zend_Db_Select::COLUMNS)
                  //->columns(['entity_id'])
                  //->columns(['customer_id'])
                  ->columns(['product_serial_number'])
                  ->columns(['order_number'])
                  ->columns(['customer_address'])
                  ->columns(['name'])
                  ->columns(['pincode'])
                  ->columns(['mobile'])
                  ->columns(['email'])
                  ->columns(['description'])
                  ->columns(['request_type'])
                  ->columns(['DATE_FORMAT("invoice_number", "%Y-%m-%d") as InvoiceNumber'])                  
                  ->columns(['date_of_invoice as InvoiceDate']);
                  
        if($this->getCurrentStoreId() == 1){
            $collection->getSelect()->columns(['eCom_ref as eCom_ref']); 
            $collection->getSelect()->where("status = '0' and store_id = 1");
        }
        if($this->getCurrentStoreId() == 2){
            $collection->getSelect()->where("status = '0' and store_id = 2");
        }

        $collection->setPageSize(100)->load(); 
        $tickets = [];
        $index = 0;
        foreach ($collection->getData() as $ticket) { 
            $tickets[$index] = $ticket;
            $tickets[$index]['InvoiceDate'] = date("Y-m-d", strtotime($ticket['InvoiceDate']));
            $index++;
        }
        return json_encode(["request" => $tickets]);
    }

    /**
     * Returned store id
     *
     * @return int
     */
    public function getCurrentStoreId()
    {
        // give the current store id
        return $this->storeManager->getStore()->getStoreId();
    }
}
