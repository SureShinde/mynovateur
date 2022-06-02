<?php

namespace MiniOrange\SP\Controller\Actions;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use MiniOrange\SP\Helper\Exception\MissingAttributesException;
use MiniOrange\SP\Helper\SPMessages;
use MiniOrange\SP\Helper\SPConstants;
use Magento\Framework\App\Http;
use Magento\Framework\App\Http\Interceptor;

/**
 * This action class processes the user attributes coming in
 * the SAML response to either log the customer or admin in
 * to their respective dashboard or create a customer or admin
 * based on the default role set by the admin and log them in
 * automatically.
 *
 * @todo refactor and optimize this class code
 */
class ProcessUserAction extends BaseAction
{
    protected $messageManager;
    private $attrs;
    private $relayState;
    public $sessionIndex;
    private $emailAttribute;
    private $usernameAttribute;
    private $firstNameKey;
    private $lastNameKey;
    private $countryNameKey;
    private $defaultRole;
    private $defaultGroup;
    private $checkIfMatchBy;
    private $groupNameKey;
    private $userGroupModel;
    private $adminRoleModel;
    private $adminUserModel;
    private $firstName;
    private $lastName;
    private $countryName;
    private $groupName;
    private $storeManager;
    private $customerRepository;
    private $customerLoginAction;
    private $responseFactory;
    private $customerFactory;
    private $customerModel;
    private $userFactory;
    private $randomUtility;
    private $index;
    private $adminConfig;
    private $dontAllowUnlistedUserRole;
    private $dontCreateUserIfRoleNotMapped;
    private $_state;
    private $_configLoader;

    public function __construct(\Magento\Framework\Message\ManagerInterface $messageManager,
                                \Magento\Backend\App\Action\Context $context,
                                \MiniOrange\SP\Helper\SPUtility $spUtility,
                                \MiniOrange\SP\Controller\Adminhtml\Attrsettings\Index $index,
                                \Magento\Customer\Model\ResourceModel\Group\Collection $userGroupModel,
                                \Magento\Authorization\Model\ResourceModel\Role\Collection $adminRoleModel,
                                \Magento\User\Model\User $adminUserModel,
                                \Magento\Customer\Model\Customer $customerModel,
                                \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
                                \Magento\Store\Model\StoreManagerInterface $storeManager,
                                \Magento\Framework\App\ResponseFactory $responseFactory,
                                \MiniOrange\SP\Controller\Actions\CustomerLoginAction $customerLoginAction,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\User\Model\UserFactory $userFactory,
                                \Magento\Framework\Math\Random $randomUtility,
				\Magento\Framework\App\State $_state,
				\Magento\Framework\ObjectManager\ConfigLoaderInterface $_configLoader,
				\Magento\Backend\Helper\Data $HelperBackend)
    {
        //You can use dependency injection to get any class this observer may need.
        $this->messageManager = $messageManager;
        $this->index = $index;
        $this->emailAttribute = $spUtility->getStoreConfig(SPConstants::MAP_EMAIL);
        $this->emailAttribute = $spUtility->isBlank($this->emailAttribute) ? SPConstants::DEFAULT_MAP_EMAIL : $this->emailAttribute;
        $this->usernameAttribute = $spUtility->getStoreConfig(SPConstants::MAP_USERNAME);
        $this->usernameAttribute = $spUtility->isBlank($this->usernameAttribute) ? SPConstants::DEFAULT_MAP_USERN : $this->usernameAttribute;
        $this->firstNameKey = $spUtility->getStoreConfig(SPConstants::MAP_FIRSTNAME);
        $this->firstNameKey = $spUtility->isBlank($this->firstNameKey) ? SPConstants::DEFAULT_MAP_FN : $this->firstNameKey;
        $this->lastNameKey = $spUtility->getStoreConfig(SPConstants::MAP_LASTNAME);
        $this->lastNameKey = $spUtility->isBlank($this->lastNameKey) ? SPConstants::MAP_LASTNAME : $this->lastNameKey;
        $this->countryNameKey = $spUtility->getStoreConfig(SPConstants::MAP_COUNTRY);
        $this->countryNameKey  = $spUtility->isBlank($this->countryNameKey ) ? SPConstants::DEFAULT_MAP_CN : $this->countryNameKey;
        $this->groupNameKey = $spUtility->getStoreConfig(SPConstants::MAP_GROUP);

        $this->firstName = $spUtility->getStoreConfig(SPConstants::MAP_FIRSTNAME);
        $this->firstName = $spUtility->isBlank($this->firstName) ? SPConstants::DEFAULT_MAP_FN : $this->firstName;
        $this->lastName = $spUtility->getStoreConfig(SPConstants::MAP_LASTNAME);
        $this->countryName = $spUtility->getStoreConfig(SPConstants::MAP_COUNTRY);
        $this->defaultRole = $spUtility->getStoreConfig(SPConstants::MAP_DEFAULT_ROLE);
        $this->checkIfMatchBy = $spUtility->getStoreConfig(SPConstants::MAP_MAP_BY);
        $this->groupName = $spUtility->getStoreConfig(SPConstants::MAP_GROUP);
        $this->dontAllowUnlistedUserRole = $spUtility->getStoreConfig(SPConstants::UNLISTED_ROLE);
        $this->dontCreateUserIfRoleNotMapped = $spUtility->getStoreConfig(SPConstants::CREATEIFNOTMAP);

        $this->customerModel = $customerModel;
        $this->userGroupModel = $userGroupModel;
        $this->adminRoleModel = $adminRoleModel;
        $this->adminUserModel = $adminUserModel;
        $this->customerRepository=$customerRepository;
        $this->storeManager = $storeManager;
        $this->responseFactory = $responseFactory;
        $this->customerLoginAction = $customerLoginAction;
        $this->customerFactory = $customerFactory;
        $this->userFactory = $userFactory;
        $this->randomUtility = $randomUtility;
	$this->_state = $_state;
	$this->HelperBackend = $HelperBackend;
	$this->_configLoader = $_configLoader;

        parent::__construct($context,$spUtility);
    }


    /**
     * Execute function to execute the classes function.
     *
     * @throws MissingAttributesException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Exception
     */
    public function execute()
    {
        $this->spUtility->log_debug(" inside class ProcessUserAction : execute: ");
        // throw an exception if attributes are empty
        if(empty($this->attrs)) throw new MissingAttributesException;
        // get and set all the necessary attributes

        $user_email = isset($this->attrs[$this->emailAttribute]) ? $this->attrs[$this->emailAttribute][0] : null;
        $this->spUtility->log_debug(" user_email is " ,$user_email);
        $firstName =  isset($this->attrs[$this->firstNameKey]) ? $this->attrs[$this->firstNameKey][0] : null;
        $lastName =   isset($this->attrs[$this->lastNameKey]) ? $this->attrs[$this->lastNameKey][0]: null;
        $userName =   isset($this->attrs[$this->usernameAttribute]) ? $this->attrs[$this->usernameAttribute][0]: null;
        $groupName =  isset($this->attrs[$this->groupNameKey]) ? $this->attrs[$this->groupNameKey]: null;
        $countryName = isset($this->attrs[$this->countryNameKey]) ? $this->attrs[$this->countryNameKey][0] : null;
        $groups =  isset($this->attrs[$this->groupNameKey]) ? $this->attrs[$this->groupNameKey]: null;
        $this->spUtility->log_debug(" country is " ,$countryName);
        $params = $this->getRequest()->getParams();



        if($this->spUtility->isBlank($this->defaultRole)) $this->defaultRole = SPConstants::DEFAULT_ROLE;
        if($this->spUtility->isBlank($this->checkIfMatchBy)) $this->checkIfMatchBy = SPConstants::DEFAULT_MAP_BY;

        $firstGroup = "";
        $this->defaultRole = null;
        if(is_array($groups))
        {
            $firstGroup = $groups[0];
        }
        else
        {
            $firstGroup = $this->spUtility->isBlank(json_decode($groups)) ? $groups : json_decode($groups)[0];
        }
           // echo $firstGroup;exit;
        $this->spUtility->log_debug("FirstGroup from IdP (if Multiple): ".json_encode($firstGroup));

        // process the user
        $this->processUserAction($user_email, $firstName, $lastName, $userName, $groupName,
            $this->defaultRole, $this->checkIfMatchBy, $this->attrs['NameID'][0],$params);
    }


    /**
     * This function processes the user values to either create
     * a new user on the site and log him/her in or log an existing
     * user to the site. Mapping is done based on $checkIfMatchBy
     * variable. Either email or username.
     *
     * @param $user_email
     * @param $firstName
     * @param $lastName
     * @param $userName
     * @param $groupName
     * @param $defaultRole
     * @param $checkIfMatchBy
     * @param $nameId
     * @throws LocalizedException
     * @throws \Exception
     */
    private function processUserAction($user_email, $firstName, $lastName, $userName,
                                       $groupName, $defaultRole, $checkIfMatchBy, $nameId,$params)
    {

        $admin = false;
        $this->spUtility->log_debug(" inside processUserAction() ");
        $admin = $this->spUtility->checkIfFlowStartedFromBackend($this->relayState);
        $this->spUtility->log_debug("processUserAction(): isAdmin: ".json_encode($admin));
        $user = null;

        if($admin){
            $defaultRole = $this->spUtility->getStoreConfig(SPConstants::MAP_DEFAULT_ROLE);
            $this->spUtility->log_debug("processUserAction() :  defaultRole from settings: ".json_encode($defaultRole));
            $defaultRole = $this->spUtility->isBlank($defaultRole)? SPConstants::DEFAULT_ROLE : $defaultRole;

            $user = $this->getAdminUserFromAttributes($user_email);
            $autoCreateUser = $this->spUtility->getAutoCreateAdmin();

            if(!$this->spUtility->isBlank($user)) {
                $this->spUtility->log_debug("processUserAction(): Admin User Found: Updating Attributes ".$admin);
                $user = $this->updateUserAttributes($firstName, $lastName, $groupName, $defaultRole, $nameId, $user, $admin);
            }else if($this->spUtility->isBlank($user) && $autoCreateUser && !$this->spUtility->isBlank($defaultRole)) {
                $this->spUtility->log_debug("processUserAction(): AdminUser Not Found: Creating One");
                $user = $this->createNewUser($user_email, $firstName, $lastName, $userName, $groupName, $defaultRole, $nameId, $user, $admin);
            }else{
                $url = $this->spUtility->getAdminUrl('admin/index');
                $this->spUtility->log_debug("This backend user does not exists and cannot be auto-created. Please also check if default role is set. Redirecting to". $url);
                $this->spUtility->messageManager->addError("This backend user does not exists and cannot be auto-created. Please contact your administrator.");
                $this->responseFactory->create()->setRedirect($url)->sendResponse();
            }
        }
        else{
//----------If the flow is not for Admin SSO i.e; when it for customer SSO:
            $defaultGroup = $this->spUtility->getStoreConfig(SPConstants::MAP_DEFAULT_GROUP);
            $autoCreateUser = $this->spUtility->getAutoCreateCustomer();
            $user = $this->getCustomerFromAttributes($user_email);
            if($user){
                $this->spUtility->log_debug(" processUserAction() : User Found: Updating Attributes ");
                $user = $this->updateUserAttributes($firstName, $lastName, $groupName, $defaultGroup, $nameId, $user, $admin);
            }else if(!$user && $autoCreateUser) {
                $this->spUtility->log_debug(" processUserAction(): Customer Not Found, Creating One: ");
                $user = $this->createNewUser($user_email, $firstName, $lastName, $userName, $groupName, $defaultGroup, $nameId, $user, $admin);
            }else{
                $this->spUtility->messageManager->addError("This Customer does not exists and cannot be auto-created.Please contact your Administrator.");
                $this->responseFactory->create()->setRedirect($this->storeManager->getStore()->getBaseUrl())->sendResponse();
            }
        }

        $this->spUtility->log_debug("ProcessUserAction() : before redirecting users: relayState :".$this->relayState);
        // log the user in to it's respective dashboard
        //echo $admin;exit;
        if($admin) {
            //flow stops here
            $this->redirectToBackendAndLogin($user->getId(), $this->sessionIndex, $this->relayState);
        } else {
            $user = $this->customerModel->load($user->getId());
            $this->spUtility->log_debug("ProcessUserAction() : redirecting customer :");
            $this->customerLoginAction->setUser($user)->setCustomerId($user->getId())->setRelayState($this->relayState)->execute();
        }
    }


    /**
     * This function updates the user attributes based on the value
     * in the SAML Response. This function decides if the user is
     * a customer or an admin and update it's attribute accordingly
     *
     * @param $firstName
     * @param $lastName
     * @param $groupName
     * @param $defaultRole
     * @param $nameId
     * @param \Magento\Customer\Api\Data\CustomerInterface $user
     * @param $admin
     * @return \Magento\Customer\Api\Data\CustomerInterface|void
     * @throws \Exception
     */
    private function updateUserAttributes($firstName, $lastName, $groupName,
                                          $defaultRole, $nameId, $user, $admin)
    {
        $userId = $user->getId();

        if($admin){
            $adminUser = $this->spUtility->getAdminUserById($userId);
            $this->spUtility->log_debug("updateUserAttributes(): admin: ". $nameId);
            // update the attributes
            if(!$this->spUtility->isBlank($firstName))
                $adminUser->setFirstname($firstName);
            if(!$this->spUtility->isBlank($lastName))
                $adminUser->setLastname($lastName);

            $session_details = array("NameID"=> $nameId, "SessionIndex"=>$this->sessionIndex);
            $this->spUtility->saveConfig('extra', $session_details, $userId, $admin);
            $rolesMapped = $this->spUtility->getStoreConfig(SPConstants::ROLES_MAPPED);

            if(!$this->spUtility->isBlank($rolesMapped)){
                $setRole = $this->processRoles($defaultRole, $admin, $rolesMapped, $groupName);

            }

        // update the attributes
       if(!$this->spUtility->isBlank($firstName))
            $this->spUtility->saveConfig(SPConstants::DB_FIRSTNAME,$firstName,$userId,$admin);
        if(!$this->spUtility->isBlank($lastName))
            $this->spUtility->saveConfig(SPConstants::DB_LASTNAME,$lastName,$userId,$admin);

            

	$session_details = array("NameID"=> $nameId,"SessionIndex"=>$this->sessionIndex);

	$this->spUtility->saveConfig('extra',$session_details,$userId,$admin);

            $this->spUtility->log_debug(" exiting updateUserAttributes: adminUser Email",$adminUser->getEmail());
            $adminUser->save();

        }else{

            $customer = $this->spUtility->getCustomer($userId);
            // update the customer attributes
            $this->spUtility->log_debug("updateUserAttributes(): customer: ". $nameId);
            if(!$this->spUtility->isBlank($firstName))
                $customer->setFirstname($firstName);

            if(!$this->spUtility->isBlank($lastName))
                $customer->setLastname($lastName);

            $session_details = array("NameID"=> $nameId, "SessionIndex"=>$this->sessionIndex);
            $this->spUtility->saveConfig('extra', $session_details, $userId, $admin);

            $groupMapped = $this->spUtility->getStoreConfig(SPConstants::GROUPS_MAPPED);
            $setRole = $this->processRoles($defaultRole, $admin, $groupMapped, $groupName);

            if(!$this->spUtility->isBlank($setRole)){
                $customer->setGroupId($setRole);
            }

            $this->spUtility->customerRepository->save($customer);
            $this->spUtility->log_debug(" exiting updateUserAttributes: customer");
        }

        if(!empty($setRole) && !empty($this->dontAllowUnlistedUserRole) && $this->dontAllowUnlistedUserRole == 'checked')
            return;
        return $user;
    }


/* Update Custom Attributes */
     private function updateCustomerAttributes($user,$admin){

       $this->spUtility->log_debug(" In updateCustomAttribute function");

       $userId = $user->getId();
       $this->spUtility->log_debug("user id",$userId);

       $admin = is_a($user,'\Magento\User\Model\User') ? TRUE : FALSE;


       $attrsKeys = array_Keys((array)$this->attrs);
       $this->spUtility->log_debug("attributes keys ",$attrsKeys);

       $mapped = json_decode($this->spUtility->getStoreConfig(SPConstants::CUSTOM_MAPPED));
       $mappedValues = array_values((array)$mapped);

       $results = array_intersect($attrsKeys, $mappedValues);
       $table = $this->spUtility->getStoreConfig(SPConstants::MAP_TABLE);

       $this->spUtility->log_debug(" Update user's custom attributes");
       try{
          foreach ($results as $result){
          $column = array_search($result, (array)$mapped);
          $this->spUtility->log_debug("column name ",$column);
          $attrValue = $this->attrs[$result][0];
          $this->spUtility->log_debug("value of match array ",$attrValue);
          $this->spUtility->updateColumnInTable($table,$column,$attrValue,SPConstants::COLUMN_ENTITY,1);
          }
      }
       catch(\Exception $e){
                  $this->messageManager->addErrorMessage(SPMessages::COLUMN_NOT_FOUND);
              }

           return $user;
}


    /**
     * Function redirects the user to the backend with appropriate parameters
     * in the URL which will be read in the backend portion of the code
     * and log the admin in. We can't directly log the admin in from anywhere
     * in the code as Magento doesn't allow it.
     *
     * @param $userId
     * @param $sessionIndex
     * @param $relayState
     */
    private function redirectToBackendAndLogin($userId,$sessionIndex,$relayState)
    {
	$areaCode = 'adminhtml';
    $username = $userId;

    $this->_request->setPathInfo('/admin');


	try{
	$this->_state->setAreaCode($areaCode);
	} catch (\Magento\Framework\Exception\LocalizedException $exception) {


      	 // do nothing
  	 }
	 $this->_objectManager->configure($this->_configLoader->load($areaCode));

	$user = $this->_objectManager->get('Magento\User\Model\User')->loadByUsername($username);

	$session = $this->_objectManager->get('Magento\Backend\Model\Auth\Session');

 $session->setUser($user);

    $session->processLogin();


    if ($session->isLoggedIn()) {
        $cookieManager = $this->_objectManager->get('Magento\Framework\Stdlib\CookieManagerInterface');
        $cookieValue = $session->getSessionId();
        if ($cookieValue) {

            $sessionConfig = $this->_objectManager->get('Magento\Backend\Model\Session\AdminConfig');
            $cookiePath = str_replace('autologin.php', 'index.php', $sessionConfig->getCookiePath());
            $cookieMetadata = $this->_objectManager->get('Magento\Framework\Stdlib\Cookie\CookieMetadataFactory')
                ->createPublicCookieMetadata()
                ->setDuration(3600)
                ->setPath($cookiePath)
                ->setDomain($sessionConfig->getCookieDomain())
                ->setSecure($sessionConfig->getCookieSecure())
                ->setHttpOnly($sessionConfig->getCookieHttpOnly());
           $cookieManager->setPublicCookie($sessionConfig->getName(), $cookieValue, $cookieMetadata);
		if (class_exists('Magento\Security\Model\AdminSessionsManager')) {
			$adminSessionManager = $this->_objectManager->get('Magento\Security\Model\AdminSessionsManager');
			$adminSessionManager->processLogin();
		}

	}


	//$backendUrl = $this->_objectManager->get('Magento\Backend\Model\UrlInterface');
	$backendUrl = $this->HelperBackend->getHomePageUrl();
        //$url = str_replace('autologin.php', 'index.php', $url);
        header('Location:  '. $backendUrl);
        exit;
    }


/*
        // set the admin query parameters to be passed on to the backend for processing
        $adminParams = array('option'=>SPConstants::LOGIN_ADMIN_OPT,'userid'=>$userId,
            'relaystate'=>$relayState,'sessionindex'=>$sessionIndex);
        // redirect the user to the backend
        $this->responseFactory->create()
            ->setRedirect($this->spUtility->getAdminUrl('adminhtml',$adminParams))
            ->sendResponse();
        exit;  */


        $this->_objectManager->configure($this->_configLoader->load($areaCode));

        $user = $this->_objectManager->get('Magento\User\Model\User')->loadByUsername($username);
        $session = $this->_objectManager->get('Magento\Backend\Model\Auth\Session');
        $session->setUser($user);
        $session->processLogin();

        if ($session->isLoggedIn()) {
            $this->spUtility->log_debug("redirectToBackendAndLogin: isLoggedIn: true");
            $cookieManager = $this->_objectManager->get('Magento\Framework\Stdlib\CookieManagerInterface');
            $cookieValue = $session->getSessionId();
                if ($cookieValue) {
                    $this->spUtility->log_debug("redirectToBackendAndLogin: cookieValue: true");
                    $sessionConfig = $this->_objectManager->get('Magento\Backend\Model\Session\AdminConfig');
                    $cookiePath = str_replace('autologin.php', 'index.php', $sessionConfig->getCookiePath());
                    $cookieMetadata = $this->_objectManager->get('Magento\Framework\Stdlib\Cookie\CookieMetadataFactory')
                        ->createPublicCookieMetadata()
                        ->setDuration(3600)
                        ->setPath($cookiePath)
                        ->setDomain($sessionConfig->getCookieDomain())
                        ->setSecure($sessionConfig->getCookieSecure())
                        ->setHttpOnly($sessionConfig->getCookieHttpOnly());
                    $cookieManager->setPublicCookie($sessionConfig->getName(), $cookieValue, $cookieMetadata);

                    if (class_exists('Magento\Security\Model\AdminSessionsManager')) {
                        $this->spUtility->log_debug("redirectToBackendAndLogin: class exist AdminSessionsManager: true");
                        $adminSessionManager = $this->_objectManager->get('Magento\Security\Model\AdminSessionsManager');
                        $adminSessionManager->processLogin();
                    }
                }

            $url = $this->spUtility->getAdminUrl('admin/dashboard/index');
            $this->spUtility->log_debug("redirectToBackendAndLogin: finalUrl: ".$url);
            $this->spUtility->messageManager->addSuccess("You are logged in successfully.");
            $this->responseFactory->create()->setRedirect($url)->sendResponse();
        }
    }

    /**
     * Create a temporary email address based on the username
     * in the SAML response. Email Address is a required so we
     * need to generate a temp/fake email if no email comes from
     * the IDP in the SAML response.
     *
     * @param $userName
     * @return string
     */
    private function generateEmail($userName)
    {
        $siteurl = $this->spUtility->getBaseUrl();
        $siteurl = substr($siteurl,strpos($siteurl,'//'),strlen($siteurl)-1);
        return $userName .'@'.$siteurl;
    }

    /**
     * Process the role that needs to be assigned to the user.
     * Fetch all the roles / groups and check admin mapping to
     * select which role needs to be assigned to the user
     *
     * @param $defaultRole
     * @param $admin
     * @param $role_mapping
     * @param $groupName
     *
     * @todo : remove the n2 complexity here
     * @return array|string
     */
    private function processRoles($defaultRole, $admin, $role_mapping, $groupName)
    {
        $role_mapping = unserialize($role_mapping);
        $roleId = null;
        if(empty($groupName) || empty($role_mapping)){
            return null;
        }
        foreach($role_mapping as $role_value => $group_names)
        {
            $groups = explode(";", $group_names);       
                foreach ($groups as $group)
                {
                if($group == $groupName[0]){
                    $roleId = $role_value;
                    return $roleId;
                    }
                }
        }
        return null;
    }

    /**
     * Process the default role and figure out if it's for
     * an admin or user. Return the ID of the default Role.
     *
     * @param $admin
     * @param $defaultRole
     * @return string
     */
    private function processDefaultRole($admin, $defaultRole)
    {
        if($this->spUtility->isBlank($defaultRole)){
            $this->spUtility->log_debug("processDefaultRole(): defaultRole is Blank. Setting PreDefinedRoles");
            $defaultRole = $admin ? SPConstants::DEFAULT_ROLE : SPConstants::DEFAULT_GROUP;
        }

        $defaultRoleId = ($admin) ? $this->getRoleIdByName($defaultRole) : $this->getGroupIdByName($defaultRole);
        $this->spUtility->log_debug("processDefaultRole(): returning default Role/Grouo Id: ".$defaultRoleId." for role/group ".$defaultRole);
        return $defaultRoleId;
    }

    private function getRoleIdByName($roleName){
        $roles = $this->adminRoleModel->toOptionArray();
        foreach($roles as $role)
        {
            if($roleName == $role['label']) {
                $this->spUtility->log_debug("getRoleIdByName(): returning roleId: ".$role['value']." for role: ".$role['label']);
                return $role['value'];
             }
        }
        $this->spUtility->log_debug("getGroupIdByName(): Something went wrong. Default RoleId cannot be Found: ");
    }

    private function getGroupIdByName($groupName){
        $groups = $this->userGroupModel->toOptionArray();
        foreach($groups as $group)
        {
            if($groupName==$group['label']){
                $this->spUtility->log_debug("getGroupIdByName(): returning groupId: ".$group['value']." for role: ".$group['label']);
                return $group['value'];
            }
        }
        $this->spUtility->log_debug("getGroupIdByName(): Something went wrong. Default GroupId cannot be Found: ");
    }

    /**
     * Create a new user based on the SAML response and attributes. Log the user in
     * to it's appropriate dashboard. This class handles generating both admin and
     * customer users.
     *
     * @param $user_email
     * @param $firstName
     * @param $lastName
     * @param $userName
     * @param $groupName
     * @param $defaultRole
     * @param $user
     * @return \Magento\User\Model\User|null
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Exception
     */
    private function createNewUser($user_email, $firstName, $lastName, $userName, $groupName,
                                   $defaultRole, $nameId, $user, $admin)
    {
        $this->spUtility->log_debug("createNewUser(): email: ".$user_email);
        $this->spUtility->log_debug("createNewUser(): admin: ". json_encode($admin));

        $random_password = $this->generatePassword(16);// generate random string as a password
        $userName = !$this->spUtility->isBlank($userName)? $userName : $user_email;
        $email = !$this->spUtility->isBlank($user_email)? $user_email : $this->generateEmail($userName);

        if($this->spUtility->isBlank($firstName)){
            $firstName = explode('@',$email)[0] ;
            $this->spUtility->log_debug("createNewUser(): Changed firstName: ".$firstName);
        }

        if($admin){
            $role_mapping = $this->spUtility->getStoreConfig(SPConstants::ROLES_MAPPED);
            $this->spUtility->log_debug("createNewUser() : rolesMapped ". $role_mapping);
        }else{
            $role_mapping = $this->spUtility->getStoreConfig(SPConstants::GROUPS_MAPPED);
            $this->spUtility->log_debug("createNewUser() : groupsMapped ". $role_mapping);
        }
        // $role_mapping = is_array(unserialize($groupsMapped)) && $admin ? $groupsMapped : array();

        // $role_mapping = is_array($rolesMapped) && !$admin ? array_merge($role_mapping,$groupsMapped) : $role_mapping;

	if (strcasecmp( $this->dontCreateUserIfRoleNotMapped, 'checked') === 0 ) {
            if (!$this->isRoleMappingConfiguredForUser($role_mapping, $groupName)) return NULL;
            //if (!$this->isRoleMappingConfiguredForUser(unserialize($role_mapping), $groupName)) {
		echo 'We cannot log you in. Please contact your administrator'; exit;

	 }

        // process the roles
        $setRole = $this->processRoles($defaultRole,$admin,$role_mapping,$groupName);
        // create admin or customer user based on the role
	 $user = $admin ? $this->createAdminUser($userName,$firstName,$lastName,$email,$random_password,$setRole)
            : $this->createCustomer($userName,$firstName,$lastName,$email,$random_password,$setRole);
		$userId = $user->getId();

	 // update session index and nameID in the database for the user
        $session_details = array("NameID"=> $nameId,"SessionIndex"=>$this->sessionIndex);
		$this->spUtility->saveConfig('extra',$session_details,$userId,$admin);

	$data = $this->spUtility->getCustomerStoreConfig('extra',$userId);

	 return $user;
    }

    /**
     * Checks if the role coming in the response matches with
     * the mapping done in the plugin. This function is only
     * called if admin has enabled the option to not create
     * users if roles are not mapped.$_COOKIE
     * @param $role_mapping
     * @param $groupName
     * @return bool
     *
     * @todo : remove the n2 complexity here
     */
    private function isRoleMappingConfiguredForUser($role_mapping, $groupName)
    {
        if(empty($groupName) || empty($role_mapping)) return FALSE;
        foreach ($role_mapping as $role_value => $group_names)
        {
            $groups = explode(";", $group_names);
            foreach ($groups as $group)
            {
                if(in_array($group, $groupName))
			return TRUE;
            }
        }

    }

    /**
     * Create a new customer.
     *
     * @param $userName
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $random_password
     * @param $role_assigned
     * @return \Magento\Customer\Model\Customer
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function createCustomer($userName,$firstName,$lastName,$email,$random_password,$role_assigned)
    {
        $this->spUtility->log_debug("createCustomer(): email: ".$email);

        $role_assigned = $this->spUtility->isBlank($role_assigned) ? 1 : $role_assigned;
        $this->spUtility->log_debug("createCustomer(): role assigned: ".$role_assigned);

        $websiteId = $this->storeManager->getWebsite()->getWebsiteId();
        $storeId = $this->storeManager->getStore()->getStoreId();
//      $websiteId = $this->spUtility->getWebsiteIdFromUrl($this->relayState);
//      $storeId = $this->spUtility->getStoreIdFromUrl($this->relayState);

        $customer = $this->customerFactory->create()
            ->setWebsiteId($websiteId)
            ->setStoreId($storeId)
            ->setFirstname($firstName)
            ->setLastname($lastName)
            ->setEmail($email)
            ->setPassword($random_password)
            ->setGroupId($role_assigned)  // customer cannot have multiple groups
            ->save();

        $this->spUtility->log_debug("createCustomer(): Customer Created: ");

        $customer->sendNewAccountEmail(); // send welcome email to the customer

        return $customer;
    }

    /**
     * Create a New Admin User
     *
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $userName
     * @param $random_password
     * @param $role_assigned
     * @return \Magento\User\Model\User
     * @throws \Exception
     */
    private function createAdminUser($userName,$firstName,$lastName,$email,$random_password,$role_assigned)
    {
        $this->spUtility->log_debug("ProcessUserAction : createAdminUser(): ");

        $adminInfo = [
            'username'  => $userName,
            'firstname' => $firstName,
            'lastname'  => $lastName,
            'email'     => $email,
            'password'  => $random_password,
            'interface_locale' => 'en_US',
            'is_active' => 1
        ];

        $role_assigned = $this->spUtility->isBlank($role_assigned) ? 1 : $role_assigned;
        $user = $this->userFactory->create();
        $user->setData($adminInfo);
        $user->setRoleId($role_assigned);
        $user->save();
        return $user;

    }

    /**
     * Get the Admin User from the Attributes in the SAML response.
     * Return False if the admin doesn't exist. The admin is fetched
     * by email or username based on the admin settings (checkifmatchby)
     *
     * @param $checkIfMatchBy
     * @param $user_email
     * @param $userName
     * @return array|\Magento\User\Model\User
     * @throws \Magento\Framework\Exception\LocalizedException
     */
	private function getAdminUserFromAttributes($user_email)
    {
        $adminUser = false;
       $this->spUtility->log_debug(" get admin user from attribute");
        $connection = $this->adminUserModel->getResource()->getConnection();
        $select = $connection->select()->from($this->adminUserModel->getResource()->getMainTable())->where('email=:email');
        $binds = ['email' => $user_email];
        $adminUser = $connection->fetchRow($select, $binds);
        $adminUser = is_array($adminUser) ? $this->adminUserModel->loadByUsername($adminUser['username']) : $adminUser;
        $this->spUtility->log_debug("getAdminUserFromAttributes(): fetched adminUser: ");
        return $adminUser;
    }

    /**
     * Get the Customer User from the Attributes in the SAML response
     * Return false if the customer doesn't exist. The customer is fetched
     * by email only. There are no usernames to set for a Magento Customer.
     *
     * @param $user_email
     * @return bool|\Magento\Customer\Api\Data\CustomerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getCustomerFromAttributes($user_email)
    {
        try {
            $this->spUtility->log_debug("getCustomerFromAttributes(): customer: ".$user_email);
            $this->spUtility->log_debug("getCustomerFromAttributes(): WebsiteId: ".$this->storeManager->getStore()->getWebsiteId());
            $customer = $this->customerRepository->get($user_email, $this->storeManager->getStore()->getWebsiteId());
            return !is_null($customer) ? $customer : FALSE;
        } catch (NoSuchEntityException $e) {
            $this->spUtility->log_debug("getCustomerFromAttributes(): catch ");
            return FALSE;
        }
    }

    /** The setter function for the Attributes Parameter */
    public function setAttrs($attrs)
    {
        $this->attrs = $attrs;
        return $this;
    }


    /** The setter function for the RelayState Parameter */
    public function setRelayState($relayState)
    {
        $this->relayState = $relayState;
        return $this;
    }


    /** The setter function for the SessionIndex Parameter */
    public function setSessionIndex($sessionIndex)
    {
        $this->sessionIndex = $sessionIndex;
        return $this;
    }

    /**
     * Retrieve random password
     *
     * @param   int $length
     * @return  string
     */
    public function generatePassword($length = 16)
    {
        $chars = \Magento\Framework\Math\Random::CHARS_LOWERS
            . \Magento\Framework\Math\Random::CHARS_UPPERS
            . \Magento\Framework\Math\Random::CHARS_DIGITS
        ."#$%&*.;:()@!";

        $password = $this->randomUtility->getRandomString($length, $chars);
        return $password;
    }
}
