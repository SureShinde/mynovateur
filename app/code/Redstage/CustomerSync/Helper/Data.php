<?php 
namespace Redstage\CustomerSync\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Authorization\Model\UserContextInterface;


class Data extends AbstractHelper
{
    const XML_PATH_FIELD = 'salesforce/salesforce_config/';
    const XML_PATH_FIELD_CUSTOMER_SYNC = 'salesforce/salesforce_config_customersync/';
    const CONFIG_MODULE_IS_ENABLED = 'salesforce/salesforce_config/salesforce_config_enabled';
    const CONFIG_CUSTOMER_SYNC_IS_ENABLED = 'salesforce/salesforce_config_customersync/customersync_config_enabled';

   /**
     * @var Magento\Authorization\Model\UserContextInterface
     */
   protected $userContext;

   /**
     * Data constructor.
     * @param Context $context
     * @param UserContextInterface $userContext
     */
   public function __construct(
      Context $context,
      UserContextInterface $userContext
   )
   {
      $this->userContext = $userContext;
      parent::__construct($context);
   }

   public function getConfigValue($field, $storeId = null)
   {
      return $this->scopeConfig->getValue(
           $field, ScopeInterface::SCOPE_STORE, $storeId
      );
   }
   public function getFieldConfig($code, $storeId = null)
   {
      return $this->getConfigValue(self::XML_PATH_FIELD.$code, $storeId);
   }


   public function getDefaultConfig($path)
   {
      return $this->scopeConfig->getValue($path, \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
   }

   public function isModuleEnabled()
   {
      return (bool) $this->getDefaultConfig(self::CONFIG_MODULE_IS_ENABLED);
   }

   public function getSyncFieldConfig($code, $storeId = null)
   {
      return $this->getConfigValue(self::XML_PATH_FIELD_CUSTOMER_SYNC.$code, $storeId);
   }

   public function isCustomerSyncEnabled()
   {
      return (bool) $this->getDefaultConfig(self::CONFIG_CUSTOMER_SYNC_IS_ENABLED);
   }

   /**
     * Get logged in customer id
     * @return int
     */
   public function getLoginCustomerId()
   {
      $customerId = $this->userContext->getUserId();
      return $customerId;
   }
}