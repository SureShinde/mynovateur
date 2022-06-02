<?php
namespace Redstage\LayeredNavigation\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * Class Data
 * @package Redstage\ServiceTicket\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Config paths
     */
    const LAYERED_CONFIG = 'redstagelayered/redstagelayered_config/redstagelayered_config_enabled';
    const APPLICATION  = 'redstagelayered/redstagelayered_config/redstagelayered_application';
    const APPLICATION_TYPE = 'redstagelayered/redstagelayered_config/redstagelayered_applicationtype';
    const CATEGORY_APPLY = 'redstagelayered/redstagelayered_config/redstagelayered_categoryapply';

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
    public function isModuleEnabled() {

        return $this->scopeConfig->getValue(
            self::LAYERED_CONFIG,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getValueFromApplication() {
        $data = $this->scopeConfig->getValue(self::APPLICATION,ScopeInterface::SCOPE_STORE);
        $decodedValue = $this->serializer->unserialize($data);
        if($decodedValue){
            return $decodedValue;
        }
        return false;
    }  

    public function getValueFromApplicationType() {
        $data = $this->scopeConfig->getValue(self::APPLICATION_TYPE,ScopeInterface::SCOPE_STORE);
        $decodedValue = $this->serializer->unserialize($data);
        if($decodedValue){
            return $decodedValue;
        }
        return false;
    }  

    public function getValueFromCategoryApply() {
        $data = $this->scopeConfig->getValue(self::CATEGORY_APPLY,ScopeInterface::SCOPE_STORE);
        $decodedValue = $this->serializer->unserialize($data);
        if($decodedValue){
            return $decodedValue;
        }
        return false;
    }  
}
