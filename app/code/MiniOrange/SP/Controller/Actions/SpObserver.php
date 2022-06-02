<?php

namespace MiniOrange\SP\Controller\Actions;

use Magento\Framework\App\Action\Action;

use MiniOrange\SP\Helper\Exception\SAMLResponseException;
use MiniOrange\SP\Helper\Exception\InvalidSignatureInResponseException;
use MiniOrange\SP\Helper\SPMessages;
use Magento\Framework\Event\Observer;
use MiniOrange\SP\Helper\Saml2\SAML2Utilities;
use MiniOrange\SP\Controller\Actions\ReadResponseAction;
use MiniOrange\SP\Helper\SPConstants;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;


/**
 * This is our main Observer class. Observer class are used as a callback
 * function for all of our events and hooks. This particular observer
 * class is being used to check if a SAML request or response was made
 * to the website. If so then read and process it. Every Observer class
 * needs to implement ObserverInterface.
 */
class SpObserver extends Action implements CsrfAwareActionInterface
{
    private $requestParams = array (
        'SAMLRequest',
        'SAMLResponse',
        'option'
    );

    private $controllerActionPair = array (
        'account' => array('login','create'),
        'auth' => array('login'),
    );

    protected $messageManager;
    protected $logger;
    protected $readResponseAction;
    protected $spUtility;
    protected $adminLoginAction;
    protected $testAction;
	protected $storeManager;
    protected $currentControllerName;
    protected $currentActionName;
    protected $readLogoutRequestAction;
    protected $requestInterface;
    protected $request;
    protected $formkey;
    protected $_pageFactory;
    protected $acsUrl;
    protected $repostSAMLResponseRequest;
    protected $repostSAMLResponsePostData;
    protected $responseFactory;
    protected $baseRelayState;

    public function __construct(\Magento\Framework\Message\ManagerInterface $messageManager,
                                \Psr\Log\LoggerInterface $logger,
                                \Magento\Backend\App\Action\Context $context,
                                \MiniOrange\SP\Controller\Actions\ReadResponseAction $readResponseAction,
                                \MiniOrange\SP\Helper\SPUtility $spUtility,
                                \MiniOrange\SP\Controller\Actions\AdminLoginAction $adminLoginAction,
                                \Magento\Framework\App\Request\Http $httpRequest,
                                \MiniOrange\SP\Controller\Actions\ReadLogoutRequestAction $readLogoutRequestAction,
                                \Magento\Framework\App\RequestInterface $request,
								\Magento\Store\Model\StoreManagerInterface $storeManager,
                                \MiniOrange\SP\Controller\Actions\ShowTestResultsAction $testAction,
                                ResultFactory $resultFactory,
                                \Magento\Framework\View\Result\PageFactory $pageFactory,
                                \Magento\Framework\Data\Form\FormKey $formkey)
    {
        //You can use dependency injection to get any class this observer may need.
        $this->messageManager = $messageManager;
        $this->logger = $logger;
        $this->readResponseAction = $readResponseAction;
        $this->spUtility = $spUtility;
        $this->adminLoginAction = $adminLoginAction;
        $this->readLogoutRequestAction = $readLogoutRequestAction;
        $this->currentControllerName = $httpRequest->getControllerName();
        $this->currentActionName = $httpRequest->getActionName();
        $this->request = $request;
        $this->testAction = $testAction;
        $this->storeManager = $storeManager;
        $this->resultFactory = $resultFactory;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
        $this->formkey=$formkey;
        $this->getRequest()->setParam('form_key', $this->formkey->getFormKey());
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $this->responseFactory = $objectManager->get('\Magento\Framework\App\ResponseFactory');

    }

    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }

    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
    /**
     * This function is called as soon as the observer class is initialized.
     * Checks if the request parameter has any of the configured request
     * parameters and handles any exception that the system might throw.
     *
     * @param $observer
     */
    public function execute()
    {
        $requestParams = array (
            'SAMLRequest',
            'SAMLResponse',
            'option'
        );
        $this->spUtility->log_debug(" inside spObserver : execute: ");
        $keys 			= array_keys($this->request->getParams());
        $operation 		= array_intersect($keys, $this->requestParams);
        try{
            $params = $this->request->getParams(); // get params
            $postData = $this->request->getPost(); // get only post params
            $isTest = isset($params['RelayState']) && $params['RelayState']==SPConstants::TEST_RELAYSTATE;
            $this->baseRelayState = isset($params['RelayState']) ? $params['RelayState'] :'';
            $this->baseRelayState = parse_url($this->baseRelayState, PHP_URL_HOST);
            $this->spUtility->log_debug("execute: count-operation: ".count($operation));
            // request has values then it takes priority over others
            if(count($operation) > 0) {
                $this->_route_data(array_values($operation)[0], $params, $postData,$requestParams);
            }
           // $this->spUtility->log_debug("SPObserver: execute: stop flow before this. ".$this->baseRelayState);

        }catch (\Exception $e){
            if($isTest) { // show a failed validation screen
                $this->testAction->setSamlException($e)->setHasExceptionOccurred(TRUE)->execute();
                $this->spUtility->log_debug("execute: catch: Error in Test Connection");
            }
            $this->spUtility->log_debug("We could not sign you in. Please contact your Administrator.");
            $this->messageManager->addError("We could not sign you in. Please contact your Administrator.");
            $this->responseFactory->create()->setRedirect($this->baseRelayState)->sendResponse();
        }
    }


    /**
     * This function checks if user needs to be redirected to the
     * registered IDP with AUthnRequest. First check if admin has
     * enabled autoRedirect. Then check if user is landing on one of the
     * admin or customer login pages. If both of those are true
     * then return TRUE other return FALSE.
     */
    private function checkIfUserShouldBeRedirected()
    {
        // return false if auto redirect is not enabled
        if($this->spUtility->getStoreConfig(SPConstants::AUTO_REDIRECT)!="1"
            || $this->spUtility->isUserLoggedIn()) return FALSE;
        // check if backdoor is enabled and samlsso=false
        if($this->spUtility->getStoreConfig(SPConstants::BACKDOOR)=="1"
            && isset($this->request->getParams()[SPConstants::SAML_SSO_FALSE])) return FALSE;
        // now check if user is landing on one of the login pages
        $action = isset($this->controllerActionPair[$this->currentControllerName])
            ? $this->controllerActionPair[$this->currentControllerName] : NULL;
        return !is_null($action) && is_array($action) ? in_array($this->currentActionName,$action) : FALSE;
    }


    /**
     * Route the request data to appropriate functions for processing.
     * Check for any kind of Exception that may occur during processing
     * of form post data. Call the appropriate action.
     *
     * @param $op refers to operation to perform
     * @param $params
     * @param $postData
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException
     * @throws \Magento\Framework\Stdlib\Cookie\FailureToSendException
     */
    private function _route_data($op,$params,$postData,$requestParams)
    {
        $this->spUtility->log_debug(" _route_data: operation ".$op);
        switch ($op)
        {
            case $this->requestParams[0]:{
                $this->readLogoutRequestAction->setRequestParam($params)->setPostParam($postData)->execute();
            }
            break;

            case $this->requestParams[1]:{
//                if($params['RelayState']==SPConstants::TEST_RELAYSTATE){
                    $this->readResponseAction->setRequestParam($params)->setPostParam($postData)->execute();
//                }
//                $this->checkForMultipleStoreAndProceedAccordingly($params,$postData);
            }
            break;

            case $this->requestParams[2]: {
                if($params['option']==SPConstants::LOGIN_ADMIN_OPT)
                    $this->adminLoginAction->execute();
            }
            break;
        }
    }

    private function setParams($request){
        $this->repostSAMLResponseRequest = $request;
		return $this;
    }

    private function setPostData($post){
        $this->repostSAMLResponsePostData = $post;
		return $this;
    }

}
