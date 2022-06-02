<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\OAuthConstants;
use Magento\Framework\App\Action\HttpPostActionInterface;
class AdminLoginAction extends BaseAction implements HttpPostActionInterface
{
    private $relayState;
    private $user;
    private $adminSession;
    private $cookieManager;
    private $adminConfig;
    private $cookieMetadataFactory;
    private $adminSessionManager;
    private $urlInterface;
    private $userFactory;
    protected $_resultPage;
    private $request;
    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Backend\Model\Auth\Session $te, \Magento\Framework\Stdlib\CookieManagerInterface $I8, \Magento\Backend\Model\Session\AdminConfig $Uf, \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $Sl, \Magento\Security\Model\AdminSessionsManager $Dm, \Magento\Backend\Model\UrlInterface $Np, \Magento\User\Model\UserFactory $pm, \Magento\Framework\App\RequestInterface $ge)
    {
        $this->adminSession = $te;
        $this->cookieManager = $I8;
        $this->adminConfig = $Uf;
        $this->cookieMetadataFactory = $Sl;
        $this->adminSessionManager = $Dm;
        $this->urlInterface = $Np;
        $this->userFactory = $pm;
        $this->request = $ge;
        parent::__construct($Dp, $GQ);
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\101\144\x6d\151\156\x4c\157\147\x69\x6e\101\143\x74\151\x6f\x6e\x3a\x20\145\x78\145\x63\165\164\x65");
        $Ru = $this->request->getParams();
        $user = $this->userFactory->create()->load($Ru["\165\163\145\x72\151\x64"]);
        $this->adminSession->setUser($user);
        $this->adminSession->processLogin();
        if (!$this->adminSession->isLoggedIn()) {
            goto lE;
        }
        $RX = $this->adminSession->getSessionId();
        if (!$RX) {
            goto OU;
        }
        $rS = str_replace("\141\165\164\157\154\x6f\x67\151\x6e\56\x70\150\160", "\151\156\x64\x65\x78\x2e\x70\x68\x70", $this->adminConfig->getCookiePath());
        $RC = $this->cookieMetadataFactory->createPublicCookieMetadata()->setDuration(3600)->setPath($rS)->setDomain($this->adminConfig->getCookieDomain())->setSecure($this->adminConfig->getCookieSecure())->setHttpOnly($this->adminConfig->getCookieHttpOnly());
        $this->cookieManager->setPublicCookie($this->adminSession->getName(), $RX, $RC);
        $this->adminSessionManager->processLogin();
        OU:
        lE:
        $Xw = $this->urlInterface->getStartupPageUrl();
        $kg = $this->urlInterface->getUrl($Xw);
        $kg = str_replace("\x61\165\x74\x6f\x6c\x6f\x67\151\x6e\56\160\x68\x70", "\151\x6e\144\145\170\56\160\150\x70", $kg);
        return $this->resultRedirectFactory->create()->setUrl($kg);
    }
}
