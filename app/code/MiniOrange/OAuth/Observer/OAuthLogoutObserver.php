<?php


namespace MiniOrange\OAuth\Observer;

use Magento\Framework\Event\ObserverInterface;
use MiniOrange\OAuth\Helper\OAuthMessages;
use Magento\Framework\Event\Observer;
use MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse;
use MiniOrange\OAuth\Helper\OAuthConstants;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Response\RedirectInterface;
class OAuthLogoutObserver implements ObserverInterface
{
    private $requestParams = array("\x6f\x70\164\151\157\x6e");
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
    protected $_redirect;
    protected $_response;
    public function __construct(\Magento\Framework\Message\ManagerInterface $mc, \Psr\Log\LoggerInterface $Za, \MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse $ll, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \MiniOrange\OAuth\Controller\Actions\AdminLoginAction $Pj, \Magento\Framework\App\Request\Http $OI, \Magento\Framework\App\RequestInterface $ge, \MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction $jF, RedirectInterface $Sh, ResponseInterface $zV)
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
        $this->_redirect = $Sh;
        $this->_response = $zV;
    }
    public function execute(Observer $Or)
    {
        $jN = $this->oauthUtility->getStoreConfig(OAuthConstants::LOGOUT_AUTO_REDIRECT_URL);
        $this->oauthUtility->log_debug("\x6c\157\147\x6f\x75\x74\x5f\x72\145\144\x69\162\145\143\x74\x20\165\x72\x6c\40\55\40" . $jN);
        if (!empty($jN)) {
            goto VDe;
        }
        $this->oauthUtility->log_debug("\x69\156\x73\151\144\145\x20\x65\154\163\145\72\x20\x6c\x6f\x67\x6f\x75\164\x5f\x72\145\144\x69\x72\x65\x63\x74\x20\151\163\40\145\155\x70\x74\x79\56\40");
        goto Wby;
        VDe:
        $this->oauthUtility->log_debug("\x69\156\163\151\144\x65\x20\x69\x66\72\40\154\x6f\147\157\165\x74\137\162\x65\144\151\162\145\143\164\40\156\x6f\164\x20\x65\155\160\164\171\55\x20" . $jN);
        $this->_response->setRedirect($jN)->sendResponse();
        exit;
        Wby:
    }
}
