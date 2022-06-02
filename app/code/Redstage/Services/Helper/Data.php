<?php
/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Services
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Services
 */
namespace Redstage\Services\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * Class Data
 * @package Redstage\Services\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Config paths
     */
    const API_URL  = 'services/services_config/services_api_url';
    const SERVICES_CONFIG = 'services/services_config/services_config_enabled';
    const SUCCESS_MESSAGE  = 'services/services_config/services_success_message';
    const ERROR_MESSAGE = 'services/services_config/services_error_message';

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
        SerializerInterface $serializer
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->serializer = $serializer;
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->scopeConfig->getValue(
            self::API_URL,
            ScopeInterface::SCOPE_STORE
        );
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
        $data = $this->scopeConfig->getValue('services/services_config/service_calltype',ScopeInterface::SCOPE_STORE);
        $decodedValue = $this->serializer->unserialize($data);
        if($decodedValue){
            return $decodedValue;
        }
        return false;
    }  
}
