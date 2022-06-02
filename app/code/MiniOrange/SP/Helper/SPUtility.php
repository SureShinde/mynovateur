<?php

namespace MiniOrange\SP\Helper;

use MiniOrange\SP\Helper\SPConstants;
use MiniOrange\SP\Helper\Curl;
use MiniOrange\SP\Helper\Data;
use MiniOrange\SP\Helper\Exception\InvalidOperationException;
use MiniOrange\SP\Helper\Saml2\SAML2Utilities;
use MiniOrange\SP\Helper\Saml2\Lib\AESEncryption;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Controller\ResultFactory;
use Miniorange\SP\Helper\IdentityProviders;
use DOMDocument;

/**
 * This class contains some common Utility functions
 * which can be called from anywhere in the module. This is
 * mostly used in the action classes to get any utility
 * function or data from the database.
 */
class SPUtility extends Data
{
	protected $adminSession;
	protected $customerSession;
	protected $authSession;
	protected $cacheTypeList;
	protected $cacheFrontendPool;
	protected $logger;
	protected $resource;
	protected $adminFactory;
	protected $fileSystem;
	protected $reinitableConfig;
    public $storeManager;
    protected $websiteModel;
    protected $websiteRepository;
    public $customerRepository;
    public $resultFactory;
    public $messageManager;
    public $backendHelper;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Framework\UrlInterface $urlInterface,
                                \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
                                \Magento\Framework\View\Asset\Repository $assetRepo,
								\Magento\Backend\Helper\Data $helperBackend,
								\Magento\User\Model\UserFactory $adminFactory,
								\Magento\Framework\Message\ManagerInterface $messageManager,
								\Magento\Framework\Url $frontendUrl,
								 \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
								\Magento\Backend\Model\Session $adminSession,
								\Magento\Store\Model\Website $websiteModel,
								\Magento\Store\Model\StoreManagerInterface $storeManager,
								 \Psr\Log\LoggerInterface $logger,
								\Magento\Customer\Model\Session $customerSession,
								\Magento\Backend\Helper\Data $backendHelper,
                                \Magento\Store\Api\WebsiteRepositoryInterface $websiteRepository,
								\Magento\Backend\Model\Auth\Session $authSession,
								ResultFactory $resultFactory,
								\Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
								\Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
								\Magento\Framework\Filesystem\Driver\File $fileSystem,
								\Magento\Framework\App\ResourceConnection $resource,
								\Magento\Framework\App\Config\ReinitableConfigInterface $reinitableConfig)
    {
		$this->adminSession = $adminSession;
		$this->customerSession = $customerSession;
		$this->authSession = $authSession;
		$this->logger = $logger;
		$this->cacheTypeList = $cacheTypeList;
		$this->cacheFrontendPool = $cacheFrontendPool;
		$this->resource = $resource;
		$this->fileSystem = $fileSystem;
        $this->websiteRepository = $websiteRepository;
        $this->websiteModel = $websiteModel;
        $this->_storeManager=$storeManager;
        $this->resultFactory = $resultFactory;
        $this->customerRepository = $customerRepository;
        $this->reinitableConfig = $reinitableConfig;
        $this->messageManager = $messageManager;
		$this->adminFactory = $adminFactory;
        $this->backendHelper = $backendHelper;
	   	parent::__construct($scopeConfig,$adminFactory,$customerFactory,$urlInterface,
	   						$configWriter,$assetRepo,$helperBackend,$frontendUrl);
    }

	/**
	 * This function returns phone number as a obfuscated
	 * string which can be used to show as a message to the user.
	 *
	 * @param $phone references the phone number.
	 */
	public function getHiddenPhone($phone)
	{
		$hidden_phone = 'xxxxxxx' . substr($phone,strlen($phone) - 3);
		return $hidden_phone;
	}


	/**
	 * This function checks if a value is set or
	 * empty. Returns true if value is empty
	 *
	 * @return True or False
	 * @param $value references the variable passed.
	 */
	public function isBlank( $value )
	{
		if( ! isset( $value ) || empty( $value ) ) return TRUE;
		return FALSE;
	}


	/**
	 * This function checks if cURL has been installed
	 * or enabled on the site.
	 *
	 * @return True or False
	 */
	public function isCurlInstalled()
	{
		if  (in_array  ('curl', get_loaded_extensions())) {
			return 1;
		} else
			return 0;
	}


	/**
	 * This function checks if the phone number is in the correct format or not.
	 *
	 * @param $phone refers to the phone number entered
	 */
	public function validatePhoneNumber($phone)
	{
		if(!preg_match(MoIDPConstants::PATTERN_PHONE,$phone,$matches))
			return FALSE;
		else
			return TRUE;
	}


    /**
	 * This function is used to obfuscate and return
	 * the email in question.
	 *
	 * @param $email refers to the email id to be obfuscated
	 * @return obfuscated email id.
	 */
	public function getHiddenEmail($email)
	{
        if(!isset($email) || trim($email)==='')
			return "";

		$emailsize = strlen($email);
		$partialemail = substr($email,0,1);
		$temp = strrpos($email,"@");
		$endemail = substr($email,$temp-1,$emailsize);
		for($i=1;$i<$temp;$i++)
			$partialemail = $partialemail . 'x';

		$hiddenemail = $partialemail . $endemail;

        return $hiddenemail;
	}

	/**
	 * set Admin Session Data
	 *
	 * @param $key
	 * @param $value
	 */
	public function setAdminSessionData($key, $value)
	{
		return $this->adminSession->setData($key, $value);
	}


	/**
	 * get Admin Session data based of on the key
	 *
	 * @param $key
	 * @param $remove
	 */
	public function getAdminSessionData($key, $remove = false)
	{
		return $this->adminSession->getData($key, $remove);
	}


	/**
	 * set customer Session Data
	 *
	 * @param $key
	 * @param $value
	 */
	public function setSessionData($key, $value)
	{
		return $this->customerSession->setData($key, $value);
	}


	/**
	 * Get customer Session data based off on the key
	 *
	 * @param $key
	 * @param $remove
	 */
	public function getSessionData($key, $remove = false)
	{
		return $this->customerSession->getData($key, $remove);
	}


	/**
	 * Set Session data for logged in user based on if he/she
	 * is in the backend of frontend. Call this function only if
	 * you are not sure where the user is logged in at.
	 *
	 * @param $key
	 * @param $value
	 */
	public function setSessionDataForCurrentUser($key, $value)
	{
		if($this->customerSession->isLoggedIn())
			$this->setSessionData($key, $value);
		elseif($this->authSession->isLoggedIn())
			    $this->setAdminSessionData($key, $value);
	}


	/**
	 * Check if the admin has configured the plugin with
	 * the Identity Provier. Returns true or false
	 */
	public function isSPConfigured()
	{
		$loginUrl = $this->getStoreConfig(SPConstants::SAML_SSO_URL);
		return $this->isBlank($loginUrl) ? FALSE : TRUE;
	}


	/**
     * This function is used to check if customer has completed
     * the registration process. Returns TRUE or FALSE. Checks
     * for the email and customerkey in the database are set
     * or not.
     */
	public function micr()
	{
		$email = $this->getStoreConfig(SPConstants::SAMLSP_EMAIL);
        $key = $this->getStoreConfig(SPConstants::SAMLSP_KEY);
        return !$this->isBlank($email) && !$this->isBlank($key) ? TRUE : FALSE;
	}


	/**
	 * Check if there's an active session of the user
	 * for the frontend or the backend. Returns TRUE
	 * or FALSE
	 */
	public function isUserLoggedIn()
	{
		return $this->customerSession->isLoggedIn()
				|| $this->authSession->isLoggedIn();
	}

	/**
	 * Get the Current Admin User who is logged in
	 */
	public function getCurrentAdminUser()
	{
		return $this->authSession->getUser();
	}


	/**
	 * Get the Current Admin User who is logged in
	 */
	public function getCurrentUser()
	{
		return $this->customerSession->getCustomer();
	}

	/* Get customer object by id */
    public function getCustomer($id){
        return $this->customerRepository->getById($id);
    }


	/**
	 * Get the admin login url
	 */
	public function getAdminLoginUrl()
	{
		return $this->getAdminUrl('adminhtml/auth/login');
	}

	/**
	 * Get the customer login url
	 */
	public function getCustomerLoginUrl()
	{
		return $this->getUrl('customer/account/login');
	}

	/**
	 * Desanitize the cert
	 */
	public function desanitizeCert($cert)
	{
		return SAML2Utilities::desanitize_certificate($cert);
	}


	/**
	 * Sanitize the cert
	 */
	public function sanitizeCert($cert)
	{
		return SAML2Utilities::sanitize_certificate($cert);
	}


	/**
	 * Flush Magento Cache. This has been added to make
	 * sure the admin/user has a smooth experience and
	 * doesn't have to flush his cache over and over again
	 * to see his changes.
	 */
	public function flushCache()
	{
		$types = array('db_ddl'); // we just need to clear the database cache
		foreach ($types as $type) {
			$this->cacheTypeList->cleanType($type);
		}

		foreach ($this->cacheFrontendPool as $cacheFrontend) {
			$cacheFrontend->getBackend()->clean();
		}
	}


	/**
	 * Get data in the file specified by the path
	 */
	public function getFileContents($file)
	{
		return $this->fileSystem->fileGetContents($file);
	}


	/**
	 * Put data in the file specified by the path
	 */
	public function putFileContents($file,$data)
	{
		$this->fileSystem->filePutContents($file,$data);
	}


	/**
	 * Get the Current User's logout url
	 */
	public function getLogoutUrl()
	{
		if($this->customerSession->isLoggedIn()) return $this->getUrl('customer/account/logout');
		if($this->authSession->isLoggedIn()) return $this->getAdminUrl('adminhtml/auth/logout');
		return '/';
	}

	public function reinitConfig(){
        $this->reinitableConfig->reinit();
    }

	/*===========================================================================================
						THESE ARE PREMIUM PLUGIN SPECIFIC FUNCTIONS
	=============================================================================================*/

	/**
     * This function is used to check if customer has completed
     * the registration process. Returns TRUE or FALSE. Checks
     * for the email and customerkey in the database are set
     * or not. Then checks if license key has been verified.
     */
	public function mclv()
	{
		$token = $this->getStoreConfig(SPConstants::TOKEN);
		$isVerified = AESEncryption::decrypt_data($this->getStoreConfig(SPConstants::SAMLSP_CKL),$token);
		$licenseKey = $this->getStoreConfig(SPConstants::SAMLSP_LK);
		return $isVerified == "true" && !$this->isBlank($licenseKey) ? TRUE : FALSE;
	}

	/**
	 * This function is to add logs.
	 *
	 *
	 */

    public function addLogs($msg="", $obj=null)
    {
        if(is_object($msg)){
            $this->logger->debug("MO SAML Premium : ".print_r($obj,true));
        }else{
            $this->logger->debug("MO SAML Premium : ".$msg);
        }

        if($obj!=null){
            $this->logger->debug("MO SAML Premium : ".var_export($obj,true));

        }
    }
	/**
	 * This function is used to get the user license associated
	 * with IDP plugin from the server by calling the ccl cURL
	 * function.
	 *
	 * @return JSONEncoded response
	 */
	public function ccl()
	{
		$customerKey = $this->getStoreConfig(SPConstants::SAMLSP_KEY);
		$apiKey 	 = $this->getStoreConfig(SPConstants::API_KEY);
		$content 	 = Curl::ccl($customerKey, $apiKey);
		return $content;
	}

	/**
	 * This function is used to validate the license key entered by
	 * the user by calling the vml cURL function.
	 *
	 * @return JSONEncoded response
	 */
	public function vml($code)
	{
		$customerKey = $this->getStoreConfig(SPConstants::SAMLSP_KEY);
		$apiKey 	 = $this->getStoreConfig(SPConstants::API_KEY);
	        // $customerKey = "182589";
	        // $apiKey = "BjIZyuSDTE90MVWp4pRLr3dzrFs8h74T";
		$content 	 = Curl::vml($customerKey, $apiKey, $code, $this->getBaseUrl());
		return $content;
	}

	/**
	 * This function is updates the status of the licenseKey
	 * on the server by calling the mius cURL function.
	 *
	 * @return JSONEncoded response
	 */
	public function mius()
	{
		$customerKey = $this->getStoreConfig(SPConstants::SAMLSP_KEY);
		$apiKey 	 = $this->getStoreConfig(SPConstants::API_KEY);
		$token 		 = $this->getStoreConfig(SPConstants::TOKEN);
		$code		 = AESEncryption::decrypt_data($this->getStoreConfig(SPConstants::SAMLSP_LK),$token);
		$content	 = Curl::mius($customerKey, $apiKey, $code);
		return $content;
	}

	/*===========================================================================================
						THESE ARE PREMIUM PLUGIN SPECIFIC FUNCTIONS
	=============================================================================================*/


	/**
	 * Check if the admin has configured the plugin with
	 * SLO settings. Returns true or false
	 */
	public function isSLOConfigured()
	{
		$logoutUrl = $this->getStoreConfig(SPConstants::SAML_SLO_URL);
		return $this->isBlank($logoutUrl) ? FALSE : TRUE;
	}

		/**
    	*Common Log Method .. Accessible in all classes through
         **/
    	public function log_debug($msg, $obj=null){
            $this->logger->debug('MO_SAML_SP_Premium:' . $msg);
    	    if(null !== $obj) {
                if(is_object($obj) || is_array($obj)) {
                    $this->logger->info(print_r($obj,true));
                }else{
                    $this->logger->info($obj);
                }
            }
        }

		public function getAdminUserById($id){
			
			$user = $this->adminFactory->create()->load($id);
	//      $user->getStoredData();
			return $user;
		}

		/**
     * Is the option to auto create Admin while SSO enabled
     * by the admin.
     */
    public function getAutoCreateAdmin()
    {
        return $this->getStoreConfig(SPConstants::AUTO_CREATE_ADMIN);
    }

    /**
     * Is the option to auto create Customer while SSO
     * by the admin.
     */
    public function getAutoCreateCustomer()
    {
        return $this->getStoreConfig(SPConstants::AUTO_CREATE_CUSTOMER);
    }

	//check if flow started from Admin Url
    //It just checks if relayState contains admin base url
    public function checkIfFlowStartedFromBackend($relayState){
        $admin_base_url = $this->getAdminBaseUrl();
        $isAdminRS = strpos($relayState, $admin_base_url);
        $isAdminUrl = strpos($admin_base_url, $relayState);
        if($isAdminUrl !== false || $isAdminRS !== false){
            $this->log_debug("checkIfFlowStartedFromBackend: true");
            return true;
        }
        $this->log_debug("checkIfFlowStartedFromBackend: false");
        return false;
    }

	

 /**
     * Update a set of values of a row in any table
     **/
          public function updateColumnInTable($table, $colName, $colValue, $idKey, $idValue){
                $this->log_debug("updateColumnInTable");
                $this->resource->getConnection()->update(
                    $table,  [ $colName => $colValue],
                    [$idKey." = ?" => $idValue]
                );
            }

      /**
          * Insert a row in any table
          * @data array
          **/
          public function insertRowInTable($table,  $data){
                $this->resource->getConnection()->insertMultiple($table, $data);
            }


			//---------------Handle upload Metadata--------------

			public function handle_upload_metadata($file,$url) {
				if (isset($file) || isset($url)) {
					if (!empty($file['tmp_name'])) {
						$file = @file_get_contents($file['tmp_name']);
					} else {
						$url = filter_var($url, FILTER_SANITIZE_URL);
						$arrContextOptions = array(
							"ssl" => array(
								"verify_peer" => false,
								"verify_peer_name" => false,
							),
						);
						if (empty($url)) {
							return;
						} else {
							$file = file_get_contents($url, false, stream_context_create($arrContextOptions));
						}
					}
					$this->upload_metadata($file);
				} 
			}
		
			public function upload_metadata($file) {
				$document = new DOMDocument();
				$document->loadXML($file);
				restore_error_handler();
				$first_child = $document->firstChild;
				if (!empty($first_child)) {
					$metadata = new IDPMetadataReader($document);
					$identity_providers = $metadata->getIdentityProviders();
					if (empty($identity_providers)) {
						return;
					}
					foreach ($identity_providers as $key => $idp) {
						$saml_login_url = $idp->getLoginURL('HTTP-Redirect');
						$saml_issuer = $idp->getEntityID();
						$saml_x509_certificate = $idp->getSigningCertificate();
						$database_name = 'saml';
						$updatefieldsarray = array(
							'samlIssuer' => isset($saml_issuer) ? $saml_issuer : 0,
							'ssourl' => isset($saml_login_url) ? $saml_login_url : 0,
							'loginBindingType' => 'HttpRedirect',
							'certificate' => isset($saml_x509_certificate) ? $saml_x509_certificate[0] : 0,
						);
		
						$this->generic_update_query($database_name, $updatefieldsarray);
						break;
					}
					return;
				} else {
					
					return;
				}
			}
		
			public function generic_update_query($database_name, $updatefieldsarray){
				error_log("In BesamlController: generic_update_query()");
				$idp_obj = json_encode($updatefieldsarray);
				foreach ($updatefieldsarray as $key => $value)
				{
					$this->setStoreConfig($key, $value);
				 }
			}

}
