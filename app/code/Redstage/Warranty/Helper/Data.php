<?php
/**
 * Redstage Warranty module use for create warranty form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Warranty
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Warranty
 */
namespace Redstage\Warranty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\StoreManagerInterface;

/**
 * Class Data
 * @package Redstage\Warranty\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Config paths
     */
    const API_URL  = 'warranty/warranty_config/warranty_api_url';
    const WARRANTY_CONFIG = 'warranty/warranty_config/warranty_config_enabled';
    const SUCCESS_MESSAGE  = 'warranty/warranty_config/warranty_success_message';
    const ERROR_MESSAGE = 'warranty/warranty_config/warranty_error_message';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Data constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
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
            self::WARRANTY_CONFIG,
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
}
