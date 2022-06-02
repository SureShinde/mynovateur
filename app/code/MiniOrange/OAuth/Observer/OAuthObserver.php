<?php


namespace MiniOrange\OAuth\Observer;

use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use MiniOrange\OAuth\Controller\Actions\AdminLoginAction;
use MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction;
use MiniOrange\OAuth\Helper\OAuthMessages;
use Magento\Framework\Event\Observer;
use MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthUtility;
use Psr\Log\LoggerInterface;
class OAuthObserver implements ObserverInterface
{
    private $requestParams = array("\157\160\164\x69\x6f\156");
    private $controllerActionPair = array("\x61\143\x63\x6f\165\x6e\164" => array("\154\157\147\x69\156", "\x63\162\x65\x61\x74\x65"), "\x61\x75\x74\150" => array("\x6c\x6f\x67\151\x6e"));
    private $messageManager;
    private $logger;
    private $readAuthorizationResponse;
    private $oauthUtility;
    private $adminLoginAction;
    private $testAction;
    private $currentControllerName;
    private $currentActionName;
    private $request;
    public function __construct(ManagerInterface $mc, LoggerInterface $Za, ReadAuthorizationResponse $ll, OAuthUtility $GQ, AdminLoginAction $Pj, Http $OI, RequestInterface $ge, ShowTestResultsAction $jF)
    {
        $this->messageManager = $mc;
        $this->logger = $Za;
        $this->readAuthorizationResponse = $ll;
        $this->oauthUtility = $GQ;
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
            $Ru = $this->request->getParams();
            $Kz = $this->request->getPost();
            $jE = $this->oauthUtility->getStoreConfig(OAuthConstants::IS_TEST);
            if (!$this->checkIfUserShouldBeRedirected()) {
                goto frE;
            }
            $Or->getControllerAction()->getResponse()->setRedirect($this->oauthUtility->getSPInitiatedUrl($this->getReferral()));
            frE:
            if (!(count($lR) > 0)) {
                goto MmH;
            }
            $this->_route_data(array_values($lR)[0], $Or, $Ru, $Kz);
            MmH:
        } catch (\Exception $P0) {
            if (!$jE) {
                goto esm;
            }
            $this->testAction->setOAuthException($P0)->setHasExceptionOccurred(true)->execute();
            esm:
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
    }
    private function _route_data($ZL, $Or, $Ru, $Kz)
    {
        switch ($ZL) {
            case $this->requestParams[0]:
                if (!($Ru["\157\160\x74\151\157\156"] == OAuthConstants::LOGIN_ADMIN_OPT)) {
                    goto JXz;
                }
                $this->adminLoginAction->execute();
                JXz:
                goto VR0;
        }
        zaR:
        VR0:
    }
    private function checkIfUserShouldBeRedirected()
    {
        if (!($this->oauthUtility->getStoreConfig(OAuthConstants::AUTO_REDIRECT) != "\61" || $this->oauthUtility->isUserLoggedIn())) {
            goto R71;
        }
        return FALSE;
        R71:
        if (!($this->oauthUtility->getStoreConfig(OAuthConstants::BACKDOOR) == "\61" && array_key_exists(OAuthConstants::OAuth_SSO_FALSE, $this->request->getParams()))) {
            goto PL0;
        }
        return FALSE;
        PL0:
        $Lg = array_key_exists($this->currentControllerName, $this->controllerActionPair) ? $this->controllerActionPair[$this->currentControllerName] : NULL;
        return !is_null($Lg) && is_array($Lg) ? in_array($this->currentActionName, $Lg) : FALSE;
    }
}
