<?php
declare(strict_types=1);

namespace Redstage\CustomerSync\Model;
use Redstage\CustomerSync\Api\CustomersInterface as CustomerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Customer\Model\CustomerFactory;
use Redstage\Logger\Model\LoggerFactory;
use Magento\Customer\Api\Data\CustomersInterface;
use Redstage\CustomerSync\Helper\Data;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Psr\Log\LoggerInterface;
use Magento\Directory\Model\Country;
use Magento\Directory\Model\CountryFactory;
class Customers extends \Magento\Framework\Model\AbstractModel implements CustomerInterface 
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
    protected $_customerFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger; 

    /**
     * @var Country
     */
    public $countryFactory;

    /**
     * 
     * @param RequestInterface $request
     * @param Json $json
     * @param LoggerFactory $loggerFactory
     * @param Data $helperData
     * @param Curl $curlClient
     * @param CollectionFactory $collectionFactory
     * @param LoggerInterface $logger
     * @param CountryFactory $countryFactory
     */
    public function __construct(
        RequestInterface $request,
        Json $json,
        LoggerFactory $loggerFactory,
        Data $helperData,
        Curl $curlClient,
        CollectionFactory $collectionFactory,
        LoggerInterface $logger,
        CountryFactory $countryFactory
    ) {
        $this->request = $request;
        $this->json = $json;
        $this->loggerFactory = $loggerFactory;
        $this->helperData = $helperData;
        $this->curlClient = $curlClient;
        $this->_customerFactory = $collectionFactory;
        $this->logger = $logger;
        $this->countryFactory = $countryFactory;
    }
    

    public function skAuthTocken()
    {
        try {
            if($this->helperData->getFieldConfig('salesforce_config_enabled')){
                $targetUrl = $this->helperData->getFieldConfig('salesforce_auth_api_url')."?username=".$this->helperData->getFieldConfig('salesforce_username')."&password=".$this->helperData->getFieldConfig('salesforce_password')."&grant_type=".$this->helperData->getFieldConfig('salesforce_grand_type')."&client_id=".$this->helperData->getFieldConfig('salesforce_client_id')."&client_secret=".$this->helperData->getFieldConfig('salesforce_client_secret');
                
                // prepare headers based on token
                $headers = ["Content-Type" => "application/json"];

                
                if (isset($targetUrl)) { 
                    // send data on target Url using post method
                    $this->curlClient->post($targetUrl,'');

                    $response = json_decode($this->curlClient->getBody(), true);
                    //print_r($response);
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

    public function sendCustomersToSF(){
        //$this->logger->info('test2');
        try {
            if($this->helperData->getSyncFieldConfig('customersync_config_enabled')){
                $targetUrl = $this->helperData->getSyncFieldConfig('salesforce_customersync_api_url');"https://legrand-india--lightening.my.salesforce.com/services/apexrest/Accountsync/";
                $credential = $this->skAuthTocken();
                if (isset($targetUrl) && isset($credential)) {
                    // prepare headers based on token
                    $headers = [
                        "Content-Type" => "application/json",
                        "Authorization" => "Bearer $credential"
                    ];

                    $data = $this->getCustomersToSend();

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
                            $loggerData['request_type'] = 'customer_sync';
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

    /**
     * {@inheritdoc}
     */
    public function getCustomersToSend()
    {       
        $collection = $this->_customerFactory->create();
        $collection->getSelect()->where("send_to_sf IN('Pending','0') OR send_to_sf IS NULL");                
        $collection->setPageSize(100)->load(); 
        $addresses = [];
        $customerData = [];
        $index = 0;
        foreach ($collection as $customer) { 
            $customerData[$index]['etity_id'] = $customer->getEntityId();
            $customerData[$index]['firstname'] = $customer->getFirstname();
            $customerData[$index]['lastname'] = $customer->getLastname();
            // $customerData[$index]['middlename'] = $customer->getMiddlename();
            $customerData[$index]['email'] = $customer->getEmail(); 
            $customerData[$index]['mobile'] = '';
            $customerData[$index]['phone'] = '';
            $customerData[$index]['dob'] = $customer->getDob();
            $customerData[$index]['customer_status'] = ($customer->getCustomerStatus())?$customer->getCustomerStatus():'browsing';
            // $customerData[$index]['customer_status'] = "Active";
            

            $addresses = $customer->getAddresses();
            $personmailingaddress['street'] = '';
            $personmailingaddress['country'] = '';
            $personmailingaddress['state'] = '';
            $personmailingaddress['city'] = '';
            $personmailingaddress['zipcode'] = '';
           foreach ($addresses as $address) { 
                if ($address->getId() == $customer->getDefaultBilling() || $address->getId() == $customer->getDefaultShipping()) {
            
                $personmailingaddress['street'] = implode(" ",$address->getStreet());
                $personmailingaddress['country'] = $this->getCountryName($address->getCountryId());
                $personmailingaddress['state'] = $address->getRegion();
                $personmailingaddress['city'] = $address->getCity();
                $personmailingaddress['zipcode'] = $address->getPostcode();
                $customerData[$index]['mobile'] = $address->getTelephone();
                break;
            }
           }
           

           $customerData[$index]['personmailingaddress'] = $personmailingaddress;
           $index++;
        } 
        return json_encode(["request" => $customerData]);
    }

    /**
     * country full name
     *
     * @return string
     */
    public function getCountryName($countryId): string
    {
        $countryName = '';
        $country = $this->countryFactory->create()->loadByCode($countryId);
        if ($country) {
            $countryName = $country->getName();
        }
        return $countryName;
    }

}