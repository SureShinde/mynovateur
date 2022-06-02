<?php


namespace MiniOrange\OAuth\Observer;

use Magento\Framework\Event\ObserverInterface;
use MiniOrange\OAuth\Helper\Exception\SAMLResponseException;
use MiniOrange\OAuth\Helper\Exception\InvalidSignatureInResponseException;
use MiniOrange\OAuth\Helper\OAuthMessages;
use Magento\Framework\Event\Observer;
use MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse;
use MiniOrange\OAuth\Helper\OAuthConstants;
class RedirectToIDPObserver implements ObserverInterface
{
    private $requestParams = array("\x6f\160\x74\151\x6f\156");
    private $controllerActionPair = array("\x61\143\x63\157\165\x6e\164" => array("\154\x6f\x67\151\x6e", "\x63\162\x65\x61\x74\x65"), "\x61\x75\x74\x68" => array("\154\x6f\x67\151\156"));
    private $messageManager;
    private $logger;
    private $readAuthorizationResponse;
    private $oauthUtility;
    private $adminLoginAction;
    private $testAction;
    private $currentControllerName;
    private $currentActionName;
    private $requestInterface;
    private $request;
    public function __construct(\Magento\Framework\Message\ManagerInterface $mc, \Psr\Log\LoggerInterface $Za, \MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse $ll, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \MiniOrange\OAuth\Controller\Actions\AdminLoginAction $Pj, \Magento\Framework\App\Request\Http $OI, \Magento\Framework\App\RequestInterface $ge, \MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction $jF)
    {
        $this->messageManager = $mc;
        $this->logger = $Za;
        $this->readAuthorizationResponse = $ll;
        $this->{$GQ} = ${$GQ};
        $this->adminLoginAction = $Pj;
        $this->currentControllerName = $OI->getControllerName();
        $this->currentActionName = $OI->getActionName();
        $this->request = $ge;
        $this->testAction = $jF;
    }
    public function execute(Observer $Or)
    {
        $a1 = array_keys($this->request->getParams());
        $lR = array_intersect($a1, $this->requestParams);
        try {
            if (!$this->checkIfUserShouldBeRedirected()) {
                goto gwc;
            }
            $Or->getControllerAction()->getResponse()->setRedirect($this->oauthUtility->getSPInitiatedUrl());
            gwc:
        } catch (\Exception $P0) {
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
    }
    private function checkIfUserShouldBeRedirected()
    {
        if (!($this->oauthUtility->getStoreConfig(OAuthConstants::AUTO_REDIRECT) != "\61" || $this->oauthUtility->isUserLoggedIn())) {
            goto nTN;
        }
        return FALSE;
        nTN:
        if (!($this->oauthUtility->getStoreConfig(OAuthConstants::BACKDOOR) == "\61" && array_key_exists(OAuthConstants::OAuth_SSO_FALSE, $this->request->getParams()))) {
            goto v0E;
        }
        return FALSE;
        v0E:
        $Lg = array_key_exists($this->currentControllerName, $this->controllerActionPair) ? $this->controllerActionPair[$this->currentControllerName] : NULL;
        return !is_null($Lg) && is_array($Lg) ? in_array($this->currentActionName, $Lg) : FALSE;
    }
}
