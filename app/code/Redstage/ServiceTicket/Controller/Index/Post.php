<?php

/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */

namespace Redstage\ServiceTicket\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Redstage\ServiceTicket\Model\ServiceTicketFactory;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Redstage\ServiceTicket\Helper\Data;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class Post extends \Magento\Framework\App\Action\Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ServiceTicketFactory
     */
    protected $serviceTicketFactory;

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

    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    /**
     * Services constructor.
     * @param PageFactory $resultPageFactory
     * @param ServiceTicketFactory $serviceTicketFactory
     * @param Curl $curl
     * @param Json $json
     * @param Data $dataHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ServiceTicketFactory $serviceTicketFactory,
        Curl $curl,
        Json $json,
        Data $dataHelper,
        JsonFactory $resultJsonFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        array $data = []
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->serviceTicketFactory = $serviceTicketFactory;
        $this->curl = $curl;
        $this->json = $json;
        $this->dataHelper = $dataHelper;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }


    /**
     * Post action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        try { 
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

            if ($data) {
                $model = $this->serviceTicketFactory->create();
                $model->setData($data)->save();
                $message = $isSuccessMessage;
            }
        } catch (\Exception $e) {
            $message = $isErrorMessage;
        }
        
        return $resultJson->setData([
            'html' => $message,
            'success' => $success
        ]);
    }

}
