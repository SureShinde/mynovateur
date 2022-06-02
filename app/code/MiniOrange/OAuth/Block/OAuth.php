<?php


namespace MiniOrange\OAuth\Block;

use Magento\Framework\View\Element\Template;
use MiniOrange\OAuth\Helper\OAuthConstants;
use Magento\Store\Model\ScopeInterface;

class OAuth extends Template
{
    public $oauthUtility;
    private $adminRoleModel;
    private $userGroupModel;

    const CALLBACK_URL = 'ouath/ouath_settings/ouath_client_callbackurl';
    const CLIENT_ID = 'ouath/ouath_settings/ouath_client_id';
    const CLIENT_SECRET = 'ouath/ouath_settings/ouath_client_secret';
    const SCOPE = 'ouath/ouath_settings/ouath_client_scope';
    const AUTHORIZE_URL = 'ouath/ouath_settings/ouath_client_authorizeendpoint';
    const ACCESSTOKEN_URL = 'ouath/ouath_settings/ouath_client_accesstokenendpoint';
    const GETUSERINFO_URL = 'ouath/ouath_settings/ouath_client_getuserinfoendpoint';
    //const CALLBACK_URL = 'ouath/ouath_settings/ouath_client_jwksurl';


    public function __construct(\Magento\Framework\View\Element\Template\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Authorization\Model\ResourceModel\Role\Collection $LR, \Magento\Customer\Model\ResourceModel\Group\Collection $HQ, array $b2 = array(),
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->oauthUtility = $GQ;
        $this->adminRoleModel = $LR;
        $this->userGroupModel = $HQ;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($Dp, $b2);
    }
    public function getHelloWorldTxt()
    {
        return "\x48\x65\154\x6c\157\x20\x77\157\x72\x6c\x64\41";
    }
    public function getCustomerEmail()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_EMAIL);
    }
    public function isHeader()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::SEND_HEADER);
    }
    public function isBody()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::SEND_BODY);
    }
    public function getCustomerKey()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_KEY);
    }
    public function isVerified()
    {
        return $this->oauthUtility->mclv();
    }
    public function getApiKey()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::API_KEY);
    }
    public function isAutoRedirectEnabled()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::AUTO_REDIRECT);
    }
    public function isAllPageAutoRedirectEnabled()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::ALL_PAGE_AUTO_REDIRECT);
    }
    public function isLogoutAutoRedirectEnabled()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::LOGOUT_AUTO_REDIRECT);
    }
    public function getLogoutAutoRedirectUrl()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::LOGOUT_AUTO_REDIRECT_URL);
    }
    public function isByBackDoorEnabled()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::BACKDOOR);
    }
    public function getToken()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::TOKEN);
    }
    public function getRolesMapped()
    {
        $BT = $this->oauthUtility->getStoreConfig(OAuthConstants::ROLES_MAPPED);
        return !$this->oauthUtility->isBlank($BT) ? unserialize($BT) : array();
    }
    public function getGroupsMapped()
    {
        $BT = $this->oauthUtility->getStoreConfig(OAuthConstants::GROUPS_MAPPED);
        return !$this->oauthUtility->isBlank($BT) ? $BT : array();
    }
    public function isOAuthConfigured()
    {
        return $this->oauthUtility->isOAuthConfigured();
    }
    public function getAppName()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::APP_NAME);
    }
    public function getClientID()
    {
        //return $this->oauthUtility->getStoreConfig(OAuthConstants::CLIENT_ID);
        if($this->scopeConfig->getValue(self::CLIENT_ID,ScopeInterface::SCOPE_STORE)){
          return $this->scopeConfig->getValue(self::CLIENT_ID,ScopeInterface::SCOPE_STORE);
        }else{
          return $this->oauthUtility->getStoreConfig(OAuthConstants::CLIENT_ID);
        }
    }
    public function getClientSecret()
    {
        //return $this->oauthUtility->getStoreConfig(OAuthConstants::CLIENT_SECRET);
        if($this->scopeConfig->getValue(self::CLIENT_SECRET,ScopeInterface::SCOPE_STORE)){
          return $this->scopeConfig->getValue(self::CLIENT_SECRET,ScopeInterface::SCOPE_STORE);
        }else{
          return $this->oauthUtility->getStoreConfig(OAuthConstants::CLIENT_SECRET);
        }
    }
    public function getScope()
    {
        //return $this->oauthUtility->getStoreConfig(OAuthConstants::SCOPE);
        //return $this->scopeConfig->getValue(self::SCOPE,ScopeInterface::SCOPE_STORE); // For Store
        if($this->scopeConfig->getValue(self::SCOPE,ScopeInterface::SCOPE_STORE)){
          return $this->scopeConfig->getValue(self::SCOPE,ScopeInterface::SCOPE_STORE);
        }else{
          return $this->oauthUtility->getStoreConfig(OAuthConstants::SCOPE);
        }
    }
    public function getAuthorizeURL()
    {
        //return $this->oauthUtility->getStoreConfig(OAuthConstants::AUTHORIZE_URL);
        if($this->scopeConfig->getValue(self::AUTHORIZE_URL,ScopeInterface::SCOPE_STORE)){
          return $this->scopeConfig->getValue(self::AUTHORIZE_URL,ScopeInterface::SCOPE_STORE);
        }else{
          return $this->oauthUtility->getStoreConfig(OAuthConstants::AUTHORIZE_URL);
        }
        //return $this->scopeConfig->getValue(self::AUTHORIZE_URL,ScopeInterface::SCOPE_STORE); // For Store
    }
    public function getAccessTokenURL()
    {
        //return $this->oauthUtility->getStoreConfig(OAuthConstants::ACCESSTOKEN_URL);
        //return $this->scopeConfig->getValue(self::ACCESSTOKEN_URL,ScopeInterface::SCOPE_STORE); // For Store
        if($this->scopeConfig->getValue(self::ACCESSTOKEN_URL,ScopeInterface::SCOPE_STORE)){
            return $this->scopeConfig->getValue(self::ACCESSTOKEN_URL,ScopeInterface::SCOPE_STORE);
        }else{
          return $this->oauthUtility->getStoreConfig(OAuthConstants::ACCESSTOKEN_URL);
        }
    }
    public function getUserInfoURL()
    {
        //return $this->oauthUtility->getStoreConfig(OAuthConstants::GETUSERINFO_URL);
        //return $this->scopeConfig->getValue(self::GETUSERINFO_URL,ScopeInterface::SCOPE_STORE); // For Store
        if($this->scopeConfig->getValue(self::GETUSERINFO_URL,ScopeInterface::SCOPE_STORE)){
          return $this->scopeConfig->getValue(self::GETUSERINFO_URL,ScopeInterface::SCOPE_STORE);
        }else{
          return $this->oauthUtility->getStoreConfig(OAuthConstants::GETUSERINFO_URL);
        }
    }
    public function getLogoutURL()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::OAUTH_LOGOUT_URL);
    }
    public function getAdminCssURL()
    {
        return $this->oauthUtility->getAdminCssUrl("\x61\144\x6d\151\x6e\x53\145\x74\164\151\156\x67\x73\56\x63\163\x73");
    }
    public function getAdminJSURL()
    {
        return $this->oauthUtility->getAdminJSUrl("\141\x64\155\x69\x6e\123\x65\164\x74\x69\156\x67\163\x2e\x6a\x73");
    }
    public function getIntlTelInputJs()
    {
        return $this->oauthUtility->getAdminJSUrl("\151\x6e\164\x6c\x54\x65\x6c\111\x6e\160\x75\164\56\x6d\151\156\56\152\x73");
    }
    public function getTestUrl()
    {
        return $this->getSPInitiatedUrl(OAuthConstants::TEST_RELAYSTATE);
    }
    public function getBaseUrl()
    {
        return $this->oauthUtility->getBaseUrl();
    }
    public function getCallBackUrl()
    {
        //return $this->oauthUtility->getBaseUrl() . OAuthConstants::CALLBACK_URL;
        if($this->scopeConfig->getValue(self::CALLBACK_URL,ScopeInterface::SCOPE_STORE)){
          return $this->scopeConfig->getValue(self::CALLBACK_URL,ScopeInterface::SCOPE_STORE); // For Store
        }else{
          return $this->oauthUtility->getBaseUrl() . OAuthConstants::CALLBACK_URL;
        }
    }
    public function getExtensionPageUrl($gm)
    {
        return $this->oauthUtility->getAdminUrl("\155\157\157\141\165\164\150\57" . $gm . "\x2f\151\156\144\x65\170");
    }
    public function getCurrentActiveTab()
    {
        $gm = $this->getUrl("\52\57\x2a\x2f\x2a", ["\x5f\x63\x75\162\162\x65\x6e\164" => true, "\137\x75\x73\145\137\x72\x65\167\162\151\x74\x65" => false]);
        $kb = strpos($gm, "\x2f\155\157\157\x61\x75\164\x68") + 9;
        $yP = strpos($gm, "\x2f\151\156\x64\145\x78");
        $iL = substr($gm, $kb, $yP - $kb);
        return $iL;
    }
    public function showAdminLink()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::SHOW_ADMIN_LINK);
    }
    public function showCustomerLink()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::SHOW_CUSTOMER_LINK);
    }
    public function doNotAutoCreateUsers()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::DO_NOT_AUTO_CREATE_USERS);
    }
    public function getSPInitiatedUrl($pQ = null)
    {
        return $this->oauthUtility->getSPInitiatedUrl($pQ);
    }
    public function getAccountMatcher()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::MAP_MAP_BY);
    }
    public function getDisallowUnlistedUserRole()
    {
        $dJ = $this->oauthUtility->getStoreConfig(OAuthConstants::UNLISTED_ROLE);
        return !$this->oauthUtility->isBlank($dJ) ? $dJ : '';
    }
    public function getDisallowUserCreationIfRoleNotMapped()
    {
        $eX = $this->oauthUtility->getStoreConfig(OAuthConstants::CREATEIFNOTMAP);
        return !$this->oauthUtility->isBlank($eX) ? $eX : '';
    }
    public function getUserNameMapping()
    {
        $TY = $this->oauthUtility->getStoreConfig(OAuthConstants::MAP_USERNAME);
        return !$this->oauthUtility->isBlank($TY) ? $TY : '';
    }
    public function getGroupMapping()
    {
        $Zn = $this->oauthUtility->getStoreConfig(OAuthConstants::MAP_GROUP);
        return !$this->oauthUtility->isBlank($Zn) ? $Zn : '';
    }
    public function getUserEmailMapping()
    {
        $gQ = $this->oauthUtility->getStoreConfig(OAuthConstants::MAP_EMAIL);
        return !$this->oauthUtility->isBlank($gQ) ? $gQ : '';
    }
    public function getFirstNameMapping()
    {
        $v9 = $this->oauthUtility->getStoreConfig(OAuthConstants::MAP_FIRSTNAME);
        return !$this->oauthUtility->isBlank($v9) ? $v9 : '';
    }
    public function getLastNameMapping()
    {
        $xp = $this->oauthUtility->getStoreConfig(OAuthConstants::MAP_LASTNAME);
        return !$this->oauthUtility->isBlank($xp) ? $xp : '';
    }
    public function getAllRoles()
    {
        return $this->adminRoleModel->toOptionArray();
    }
    public function getX509Cert()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::X509CERT);
    }
    public function getAllGroups()
    {
        return $this->userGroupModel->toOptionArray();
    }
    public function getDefaultRole()
    {
        $uK = $this->oauthUtility->getStoreConfig(OAuthConstants::MAP_DEFAULT_ROLE);
        return !$this->oauthUtility->isBlank($uK) ? $uK : OAuthConstants::DEFAULT_ROLE;
    }
    public function getRegistrationStatus()
    {
        return $this->oauthUtility->getStoreConfig(OAuthConstants::REG_STATUS);
    }
    public function getCurrentAdminUser()
    {
        return $this->oauthUtility->getCurrentAdminUser();
    }
    public function getSSOButtonText()
    {
        $Bm = $this->oauthUtility->getStoreConfig(OAuthConstants::BUTTON_TEXT);
        $U_ = $this->oauthUtility->getStoreConfig(OAuthConstants::APP_NAME);
        return !$this->oauthUtility->isBlank($Bm) ? $Bm : "\x4c\157\x67\x69\x6e\x20\x77\x69\164\150\x20" . $U_;
    }
    public function getMiniOrangeUrl()
    {
        return $this->oauthUtility->getMiniOrangeUrl();
    }
    public function getAdminLogoutUrl()
    {
        return $this->oauthUtility->getLogoutUrl();
    }
    public function getIsTestConfigurationClicked()
    {
        return $this->oauthUtility->getIsTestConfigurationClicked();
    }
    public function isEnabled()
    {
        return $this->oauthUtility->micr() && $this->oauthUtility->mclv();
    }
    public function getCurrentUrl()
    {
        return $this->_storeManager->getStore()->getCurrentUrl();
    }
}
