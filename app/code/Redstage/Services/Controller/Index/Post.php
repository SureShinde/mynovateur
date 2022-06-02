<?php

/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Services
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Services
 */

namespace Redstage\Services\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Redstage\Services\Model\ServicesFactory;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Redstage\Services\Helper\Data;
use Magento\Framework\Controller\Result\JsonFactory;

class Post extends \Magento\Framework\App\Action\Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ServicesFactory
     */
    protected $servicesFactory;

    /**
    * @var Curl
    */
    protected $curl;

    /**
    * @var Json
    */
    protected $json;

    /**
    * @var Data
    */
    protected $dataHelper;

    /**
    * @var Json
    */
    protected $resultJsonFactory;

    /**
     * Services constructor.
     * @param PageFactory $resultPageFactory
     * @param WarrantyFactory $warrantyFactory
     * @param Curl $curl
     * @param Json $json
     * @param Data $dataHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ServicesFactory $servicesFactory,
        Curl $curl,
        Json $json,
        Data $dataHelper,
        JsonFactory $resultJsonFactory,
        array $data = []
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->servicesFactory = $servicesFactory;
        $this->curl = $curl;
        $this->json = $json;
        $this->dataHelper = $dataHelper;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }


    /**
     * Post action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        try {
            $apiUrl = $this->dataHelper->getApiUrl();
            $data = (array)$this->getRequest()->getPost();
            $isSuccessMessage = $this->dataHelper->isSuccessMessage();
            $isErrorMessage = $this->dataHelper->isErrorMessage();           
            $resultJson = $this->resultJsonFactory->create();
            $error = false;
            $apiData = array();
            $i=0;
            $success = 1;
            $apiData['mode'] = 'formdata';
            foreach($data as $key => $value){
                if($key!='form_key' && $key!='hideit'){
                  $apiData['formdata'][$i]['key'] = $key;
                  $apiData['formdata'][$i]['value'] = $value;
                  $apiData['formdata'][$i]['type'] = 'text';
                  $i++;
                    if (!\Zend_Validate::is(trim($data[$key]), 'EmailAddress') && $data[$key]=='email') {
                        $error = true;
                    }else if (!\Zend_Validate::is(trim($data[$key]), 'NotEmpty')) {
                        $error = true;
                    }
                }
                if (\Zend_Validate::is(trim($data['hideit']), 'NotEmpty')) {
                    $error = true;
                }
            }

            if ($error || empty($data)) {
                return $resultJson->setData([
                    'html' => $isErrorMessage,
                    'success' => 0
                ]);
            }

            $apiData = $this->json->serialize($apiData);

            $result = $this->makeACurlRequest($apiUrl, $apiData);
            $jsonDecode = $this->json->unserialize($result);
            if(isset($jsonDecode['status']) && $jsonDecode['status']!=''){
              $data['response_status'] = $jsonDecode['status'];
            }
            if(isset($jsonDecode['detail']) && $jsonDecode['detail']!=''){
              $data['response_detail'] = $jsonDecode['detail'];
              $success = 0;
            }
            if ($data) {
                $model = $this->servicesFactory->create();
                $model->setData($data)->save();
                $message = $isSuccessMessage;
                  if($success == 0){
                    $message = $jsonDecode['detail'];
                  }
            }
        } catch (\Exception $e) {
            $message = $isErrorMessage;
        }
        
        return $resultJson->setData([
            'html' => $message,
            'success' => $success
        ]);
    }


    /*
     * POST CURL API
     */

    public function makeACurlRequest($apiUrl, $apiData) {
      $URL = $apiUrl;
      $jsonData = $apiData;
     
      //set curl options
      $this->curl->setOption(CURLOPT_HEADER, 0);
      $this->curl->setOption(CURLOPT_TIMEOUT, 60);
      $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
      //set curl header
      $this->curl->addHeader("Content-Type", "application/json");
      //post request with url and data
      $this->curl->post($URL, $jsonData);
      //read response
      $response = $this->curl->getBody();
      return $response;
    }

}
