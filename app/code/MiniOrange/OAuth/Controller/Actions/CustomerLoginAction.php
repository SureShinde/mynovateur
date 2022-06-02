<?php


namespace MiniOrange\OAuth\Controller\Actions;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseFactory;
use MiniOrange\OAuth\Helper\OAuthUtility;
class CustomerLoginAction extends BaseAction implements HttpPostActionInterface
{
    private $user;
    private $customerSession;
    private $responseFactory;
    private $relayState;
    public function __construct(Context $Dp, OAuthUtility $GQ, Session $t8, ResponseFactory $Ub)
    {
        $this->customerSession = $t8;
        $this->responseFactory = $Ub;
        parent::__construct($Dp, $GQ);
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\x43\165\x73\x74\157\x6d\145\162\114\157\x67\x69\156\101\x63\164\151\157\156\x3a\40\145\170\x65\143\x75\x74\x65");
        if (isset($this->relayState)) {
            goto n9;
        }
        $this->relayState = $this->oauthUtility->getBaseUrl() . "\143\165\x73\x74\157\x6d\145\162\x2f\141\143\x63\x6f\165\x6e\x74";
        n9:
        $this->customerSession->setCustomerAsLoggedIn($this->user);
        return $this->getResponse()->setRedirect($this->oauthUtility->getUrl($this->relayState))->sendResponse();
    }
    public function setUser($user)
    {
        $this->oauthUtility->log_debug("\103\x75\x73\x74\157\x6d\x65\162\114\x6f\147\151\156\x41\x63\164\151\x6f\x6e\x3a\x20\163\x65\x74\125\163\145\162");
        $this->user = $user;
        return $this;
    }
    public function setRelayState($pQ)
    {
        $this->oauthUtility->log_debug("\103\165\x73\x74\157\155\145\162\x4c\x6f\147\x69\x6e\101\x63\164\151\157\156\x3a\x20\x73\145\164\x52\145\154\x61\171\x53\164\141\x74\145", $pQ);
        $this->relayState = $pQ;
        return $this;
    }
}
