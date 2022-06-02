<?php
/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */
namespace Redstage\ServiceTicket\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Http\Context as CustomerContext;

/**
 * Class Data
 * @package Redstage\ServiceTicket\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Config paths
     */
    const SERVICES_CONFIG = 'serviceticket/serviceticket_config/serviceticket_config_enabled';
    const SUCCESS_MESSAGE  = 'serviceticket/serviceticket_config/serviceticket_success_message';
    const ERROR_MESSAGE = 'serviceticket/serviceticket_config/serviceticket_error_message';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    
     /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
    * @var \Magento\Customer\Model\Session
    */
    protected $customerSession;

    /**
    * @var \Magento\Framework\App\Http\Context
    */
    protected $httpContext;

    /**
     * Data constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        SerializerInterface $serializer,
        Session $customerSession,
        CustomerContext $httpContext
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->serializer = $serializer;
        $this->customerSession = $customerSession;
        $this->httpContext = $httpContext;
    }

    /**
     * @return mixed
     */
    public function isModuleEnabled() {

        return $this->scopeConfig->getValue(
            self::SERVICES_CONFIG,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function isCustoemrId() {

        return $this->customerSession->getCustomerId();
    }

    /**
     * @return array
     */
    public function getCustoemrData() {

        return $this->customerSession;
    }

    /**
     * @return mixed
     */
    public function isSuccessMessage() {

        return $this->scopeConfig->getValue(
            self::SUCCESS_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function isErrorMessage() {

        return $this->scopeConfig->getValue(
            self::ERROR_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getValueFromMultipleFields() {
        $data = $this->scopeConfig->getValue('serviceticket/serviceticket_config/serviceticket_calltype',ScopeInterface::SCOPE_STORE);
        $decodedValue = $this->serializer->unserialize($data);
        if($decodedValue){
            return $decodedValue;
        }
        return false;
    }  

    public function getLink()
    {
        if($this->isModuleEnabled()){
            $link = "serviceticket/listing";
            return $link;
        }else{
            return null;
        }
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
