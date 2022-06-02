<?php 
namespace Redstage\ServiceTicketsync\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
class Data extends AbstractHelper
{
  const XML_PATH_FIELD = 'salesforce/salesforce_config/';
  const XML_PATH_FIELD_TICKET = 'salesforce/salesforce_config_create_ticket/';
  const CONFIG_MODULE_IS_ENABLED = 'salesforce/salesforce_config/salesforce_config_enabled';
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

   public function getTicketConfig($code, $storeId = null)
   {
       return $this->getConfigValue(self::XML_PATH_FIELD_TICKET.$code, $storeId);
   }
}