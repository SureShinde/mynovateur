<?php

namespace MiniOrange\SP\Controller\Adminhtml\Attrsettings;

use Magento\Backend\App\Action\Context;
use MiniOrange\SP\Helper\SPConstants;
use MiniOrange\SP\Helper\SPMessages;
use MiniOrange\SP\Controller\Actions\BaseAdminAction;

/**
 * This class handles the action for endpoint: mospsaml/attrsettings/Index
 * Extends the \Magento\Backend\App\Action for Admin Actions which
 * inturn extends the \Magento\Framework\App\Action\Action class necessary
 * for each Controller class
 */
class Index extends BaseAdminAction
{

    private $adminRoleModel;
    private $userGroupModel;
    private $attributeModel;
    protected $logger;
    private $samlResponse;
    private $params;
    private $adminUserModel;

    public function __construct(\Magento\Backend\App\Action\Context $context,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory,
                                \MiniOrange\SP\Helper\SPUtility $spUtility,
                                //\MiniOrange\SP\Helper\SAML2\SAML2Response $samlResponse,
                                //\Magento\User\Model\User $adminUserModel,
                                \Magento\Framework\Message\ManagerInterface $messageManager,
                                \Psr\Log\LoggerInterface $logger,
                                \Magento\Authorization\Model\ResourceModel\Role\Collection $adminRoleModel,
                                \Magento\Customer\Model\ResourceModel\Attribute\Collection $attributeModel,
                                \Magento\Customer\Model\ResourceModel\Group\Collection $userGroupModel)
    {
        //You can use dependency injection to get any class this observer may need.
        parent::__construct($context,$resultPageFactory,$spUtility,$messageManager,$logger);
        $this->adminRoleModel = $adminRoleModel;
        $this->userGroupModel = $userGroupModel;
        $this->attributeModel = $attributeModel;
        $this->spUtility = $spUtility;

       //  $this->samlResponse = $samlResponse;
        //$this->adminUserModel = $adminUserModel;
         $this->logger = $logger;
    }

    /**
     * The first function to be called when a Controller class is invoked.
     * Usually, has all our controller logic. Returns a view/page/template
     * to be shown to the users.
     *
     * This function gets and prepares all our SP config data from the
     * database. It's called when you visis the moasaml/attrsettings/Index
     * URL. It prepares all the values required on the SP setting
     * page in the backend and returns the block to be displayed.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        try{

            $params = $this->getRequest()->getParams(); //get params

            $this->checkIfValidPlugin(); //check if user has registered himself
            if($this->isFormOptionBeingSaved($params)) // check if form options are being saved
            {
                $this->checkIfRequiredFieldsEmpty(array('saml_am_username'=>$params,'saml_am_account_matcher'=>$params));
              $this->saveCustomAttribute($params);
              $this->processValuesAndSaveData($params);
                $this->spUtility->flushCache();
                $this->messageManager->addSuccessMessage(SPMessages::SETTINGS_SAVED);
                $this->spUtility->reinitConfig();
            }
        }catch(\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
			$this->logger->debug($e->getMessage());
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(SPConstants::MODULE_DIR.SPConstants::MODULE_BASE);
        $resultPage->addBreadcrumb(__('ATTR Settings'), __('ATTR Settings'));
        $resultPage->getConfig()->getTitle()->prepend(__(SPConstants::MODULE_TITLE));
        return $resultPage;
    }


    /**
     * Process Values being submitted and save data in the database.
     * @param $param
     */
    private function processValuesAndSaveData($params)
    {
       $this->spUtility->log_debug(" Paramenters are:",$params);
        $this->spUtility->setStoreConfig(SPConstants::MAP_FIRSTNAME, $params['saml_am_first_name']);
        $this->spUtility->setStoreConfig(SPConstants::MAP_LASTNAME, $params['saml_am_last_name']);
        $this->spUtility->setStoreConfig(SPConstants::MAP_MAP_BY, $params['saml_am_account_matcher']);
        $this->spUtility->setStoreConfig(SPConstants::MAP_GROUP, $params['saml_am_group_name']);

        /* ===================================================================================================
                            THE LINES OF CODE BELOW ARE PREMIUM PLUGIN SPECIFIC
           ===================================================================================================
        */

        $this->spUtility->setStoreConfig(SPConstants::MAP_USERNAME, $params['saml_am_username']);
        $this->spUtility->setStoreConfig(SPConstants::MAP_EMAIL, $params['saml_am_email']);

        $this->spUtility->log_debug(" save default attribute: ");
        $this->spUtility->setStoreConfig(SPConstants::MAP_COUNTRY ,$params['saml_am_country']);
        $this->spUtility->setStoreConfig(SPConstants::MAP_CITY ,$params['saml_am_city']);
        $this->spUtility->setStoreConfig(SPConstants::MAP_ADDRESS ,$params['saml_am_address']);
        $this->spUtility->setStoreConfig(SPConstants::MAP_PHONE ,$params['saml_am_phone']);

}


     /* ===================================================================================================
                            THE FUNCTION BELOW ARE PREMIUM PLUGIN SPECIFIC
        ===================================================================================================
    */

    /**
     * Read and process the Roles saved by the
     * admin.
     * @param $params
     * @return array
     */
    private function processAdminRoleMapping($params)
    {
        $admin_role_mapping = array();
        $roles = $this->adminRoleModel->toOptionArray();
        foreach ($roles as $role)
        {
            $attr = 'saml_am_admin_attr_values_' . $role['value'];
            if(isset($params[$attr]))
                $admin_role_mapping[$role['value']] = $params[$attr];
        }
        return $admin_role_mapping;
    }

     /**
         *save custom attributes in database
         */
    private function saveCustomAttribute($params){

     $this->spUtility->log_debug(" In saveCustomAtrribute function ");
     $this->spUtility->setStoreConfig(SPConstants::MAP_TABLE ,$params['saml_am_table']);
     $defaultAttributes = array("form_key","this_attribute","saml_am_first_name","saml_am_last_name","saml_am_account_matcher","saml_am_username","saml_am_email","saml_am_country","option","saml_am_company","saml_am_table","submit");

     $tempCustomAttrObject = json_encode($_POST,true);
     $tempCustomAttrObjectDecoded = json_decode($tempCustomAttrObject,true);
     $this->spUtility->log_debug("Default and Custom Attributes Array: ",$tempCustomAttrObjectDecoded);
     $tempCustom =$tempCustomAttrObjectDecoded;
     $this->spUtility->log_debug("let's unset default attr",$tempCustom);
               foreach($defaultAttributes as $value)
                   {
                       unset($tempCustom[$value]);
                   }
     $tempCustomAttrObjectEncoded = json_encode($tempCustom ,true);
     $this->spUtility->log_debug("save custom attributes");
     $this->spUtility->setStoreConfig(SPConstants::CUSTOM_MAPPED,$tempCustomAttrObjectEncoded);

}



    /**
     * Read and process the Groups saved by the
     * admin.
     * @param $params
     * @return array
     */
    private function processCustomerRoleMapping($params)
    {
        $customer_role_mapping = array();
        $groups = $this->userGroupModel->toOptionArray();
        foreach ($groups as $group)
        {
            $attr = 'saml_am_group_attr_values_' . $group['value'];
            if(isset($params[$attr]))
                $customer_role_mapping[$group['value']] = $params[$attr];
                $this->spUtility->log_debug(" Customer attributes:",$customer_role_mapping);

        }
        return $customer_role_mapping;
    }

    /**
      * Read and process the custom attributes saved by the
      * admin.
      * @param $params
      * @return array
      */

  public function getParams(){
            return $this->params ;
     }

    /**
     * Is the user allowed to view the Attribute Mapping settings.
     * This is based on the ACL set by the admin in the backend.
     * Works in conjugation with acl.xml
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(SPConstants::MODULE_DIR.SPConstants::MODULE_ATTR);
    }
}
