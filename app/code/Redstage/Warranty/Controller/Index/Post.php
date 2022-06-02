<?php

/**
 * Redstage Warranty module use for create warranty form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Warranty
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Warranty
 */

namespace Redstage\Warranty\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Redstage\Warranty\Model\WarrantyFactory;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Redstage\Warranty\Helper\Data;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filesystem; 
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class Post extends \Magento\Framework\App\Action\Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;

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
    * @var Filesystem
    */
    protected $_filesystem;

    /**
     * File Uploader factory.
     *
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $_fileUploaderFactory;

    /**
     * @var string
     */
    const FILE_DIR = 'warranty/uplaods';

    /**
     * Warranty constructor.
     * @param PageFactory $resultPageFactory
     * @param WarrantyFactory $warrantyFactory
     * @param Curl $curl
     * @param Json $json
     * @param Data $dataHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        WarrantyFactory $warrantyFactory,
        Curl $curl,
        Json $json,
        Data $dataHelper,
        JsonFactory $resultJsonFactory,
        Filesystem $fileSystem,
        UploaderFactory $fileUploaderFactory,
        ManagerInterface $messageManager,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->warrantyFactory = $warrantyFactory;
        $this->curl = $curl;
        $this->json = $json;
        $this->dataHelper = $dataHelper;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_filesystem = $fileSystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->messageManager = $messageManager;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }


    /**
     * @return void
     */
    public function execute() {
        try {
            $apiUrl = $this->dataHelper->getApiUrl();
            $data = (array)$this->getRequest()->getPost();
            $PostModel = $this->warrantyFactory->create();
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

            $imgResult = ['file' => '', 'size' => ''];
            if ($_FILES['upload_image']['name']) {
                try {
                    //$pathresult = ['file' => '', 'size' => ''];
                    // init uploader model.                    
                    $uploader = $this->_fileUploaderFactory->create(
                            ['fileId' => 'upload_image']
                        );
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    // get media directory
                    $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
                    
                    // save the image to media directory
                    $imgResult = array_intersect_key($uploader->save($mediaDirectory->getAbsolutePath(self::FILE_DIR)),$imgResult);
                } catch (Exception $e) {
                    \Zend_Debug::dump($e->getMessage());
                }
                $imgResult['url'] = $this->getMediaUrl($imgResult['file']);
                $data['image'] = $imgResult['url'];
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
                $PostModel->setData($data)->save();
                $message = $isSuccessMessage;
                if($success == 0){
                    $message = $jsonDecode['detail'];
                }
            }
            $this->_redirect('warranty/index');
            $this->messageManager->addSuccessMessage(__("$message"));
        } catch (\Exception $e) {
            $message = $isErrorMessage;
            $success = 0;
            $this->_redirect('warranty/index');
            $this->messageManager->addErrorMessage($e, __("$message"));
        }
        
        
        
        /*return $resultJson->setData([
            'html' => $message,
            'success' => $success
        ]);*/
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

    /**
     * Get file url
     *
     * @param string $file
     * @return string
     */
    public function getMediaUrl($file)
    {
        $file = ltrim(str_replace('\\', '/', $file), '/');
        return $this->_storeManager
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . self::FILE_DIR . '/' . $file;
    }

}
