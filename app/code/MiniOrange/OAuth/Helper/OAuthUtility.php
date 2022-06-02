<?php


namespace MiniOrange\OAuth\Helper;

use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Cache\Frontend\Pool;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Url;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\User\Model\UserFactory;
use Psr\Log\LoggerInterface;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\Data;
use MiniOrange\OAuth\Helper\Exception\InvalidOperationException;
use MiniOrange\OAuth\Helper\OAuth\SAML2Utilities;
use MiniOrange\OAuth\Helper\OAuth\lib\AESEncryption;
class OAuthUtility extends Data
{
    protected $adminSession;
    protected $customerSession;
    protected $authSession;
    protected $cacheTypeList;
    protected $cacheFrontendPool;
    protected $fileSystem;
    protected $reinitableConfig;
    protected $logger;
    public function __construct(ScopeConfigInterface $id, UserFactory $HW, CustomerFactory $fi, UrlInterface $Np, WriterInterface $u3, Repository $Z0, \Magento\Backend\Helper\Data $UZ, Url $yN, \Magento\Backend\Model\Session $te, Session $t8, \Magento\Backend\Model\Auth\Session $TW, TypeListInterface $kl, Pool $R_, LoggerInterface $Za, File $Eu, \Magento\Framework\App\Config\ReinitableConfigInterface $LC)
    {
        $this->adminSession = $te;
        $this->customerSession = $t8;
        $this->authSession = $TW;
        $this->cacheTypeList = $kl;
        $this->cacheFrontendPool = $R_;
        $this->fileSystem = $Eu;
        $this->logger = $Za;
        $this->reinitableConfig = $LC;
        parent::__construct($id, $HW, $fi, $Np, $u3, $Z0, $UZ, $yN);
    }
    public function log_debug($Zv, $PM = null)
    {
        if (!(!is_object($Zv) && !is_array($Zv))) {
            goto yu;
        }
        $this->logger->info("\115\x4f\40\x4f\101\x75\164\150\x20\x45\x6e\x74\145\162\x70\162\151\x73\145\x20\120\x6c\141\x6e\72" . $Zv);
        yu:
        if (!(null !== $PM)) {
            goto gQ;
        }
        if (is_object($PM) || is_array($PM)) {
            goto E4;
        }
        $this->logger->info($PM);
        goto Zt;
        E4:
        $this->logger->info(print_r($PM, true));
        Zt:
        gQ:
    }
    public function ccl()
    {
        $ZD = $this->getStoreConfig(OAuthConstants::CUSTOMER_KEY);
        $dr = $this->getStoreConfig(OAuthConstants::API_KEY);
        $uF = Curl::ccl($ZD, $dr);
        return $uF;
    }
    public function vml($XG)
    {
        $ZD = $this->getStoreConfig(OAuthConstants::CUSTOMER_KEY);
        $dr = $this->getStoreConfig(OAuthConstants::API_KEY);
        $uF = Curl::vml($ZD, $dr, $XG, $this->getBaseUrl());
        return $uF;
    }
    public function getHiddenPhone($ZW)
    {
        $Ui = "\x78\170\170\170\170\170\170" . substr($ZW, strlen($ZW) - 3);
        return $Ui;
    }
    public function isBlank($Vw)
    {
        if (!(!isset($Vw) || empty($Vw))) {
            goto wa;
        }
        return true;
        wa:
        return false;
    }
    public function isCurlInstalled()
    {
        if (in_array("\143\x75\x72\x6c", get_loaded_extensions())) {
            goto EC;
        }
        return 0;
        goto Wj;
        EC:
        return 1;
        Wj:
    }
    public function validatePhoneNumber($ZW)
    {
        if (!preg_match(MoIDPConstants::PATTERN_PHONE, $ZW, $fR)) {
            goto QX;
        }
        return true;
        goto S8;
        QX:
        return false;
        S8:
    }
    public function getHiddenEmail($Pg)
    {
        if (!(!isset($Pg) || trim($Pg) === '')) {
            goto vC;
        }
        return '';
        vC:
        $mn = strlen($Pg);
        $nV = substr($Pg, 0, 1);
        $DA = strrpos($Pg, "\x40");
        $GI = substr($Pg, $DA - 1, $mn);
        $vB = 1;
        oC:
        if (!($vB < $DA)) {
            goto fk;
        }
        $nV = $nV . "\x78";
        uM:
        $vB++;
        goto oC;
        fk:
        $e7 = $nV . $GI;
        return $e7;
    }
    public function getAdminSession()
    {
        return $this->adminSession;
    }
    public function setAdminSessionData($mx, $Vw)
    {
        return $this->adminSession->setData($mx, $Vw);
    }
    public function getAdminSessionData($mx, $yG = false)
    {
        return $this->adminSession->getData($mx, $yG);
    }
    public function setSessionData($mx, $Vw)
    {
        return $this->customerSession->setData($mx, $Vw);
    }
    public function getSessionData($mx, $yG = false)
    {
        return $this->customerSession->getData($mx, $yG);
    }
    public function setSessionDataForCurrentUser($mx, $Vw)
    {
        if ($this->customerSession->isLoggedIn()) {
            goto Vr;
        }
        if ($this->authSession->isLoggedIn()) {
            goto te;
        }
        goto Y6;
        Vr:
        $this->setSessionData($mx, $Vw);
        goto Y6;
        te:
        $this->setAdminSessionData($mx, $Vw);
        Y6:
    }
    public function isOAuthConfigured()
    {
        $pi = $this->getStoreConfig(OAuthConstants::AUTHORIZE_URL);
        return $this->isBlank($pi) ? false : true;
    }
    public function micr()
    {
        $Pg = $this->getStoreConfig(OAuthConstants::CUSTOMER_EMAIL);
        $mx = $this->getStoreConfig(OAuthConstants::CUSTOMER_KEY);
        return !$this->isBlank($Pg) && !$this->isBlank($mx) ? true : false;
    }
    public function mclv()
    {
        $fI = $this->getStoreConfig(OAuthConstants::TOKEN);
        $RJ = AESEncryption::decrypt_data($this->getStoreConfig(OAuthConstants::SAMLSP_CKL), $fI);
        $ab = $this->getStoreConfig(OAuthConstants::SAMLSP_LK);
        return $RJ == "\164\x72\x75\145" && !$this->isBlank($ab) ? TRUE : FALSE;
    }
    public function mius()
    {
        $ZD = $this->getStoreConfig(OAuthConstants::CUSTOMER_KEY);
        $dr = $this->getStoreConfig(OAuthConstants::API_KEY);
        $fI = $this->getStoreConfig(OAuthConstants::TOKEN);
        $XG = AESEncryption::decrypt_data($this->getStoreConfig(OAuthConstants::SAMLSP_LK), $fI);
        $uF = Curl::mius($ZD, $dr, $XG);
        return $uF;
    }
    public function isUserLoggedIn()
    {
        return $this->customerSession->isLoggedIn() || $this->authSession->isLoggedIn();
    }
    public function getCurrentAdminUser()
    {
        return $this->authSession->getUser();
    }
    public function getCurrentUser()
    {
        return $this->customerSession->getCustomer();
    }
    public function getAdminLoginUrl()
    {
        return $this->getAdminUrl("\141\144\155\151\x6e\150\164\155\x6c\57\x61\165\164\150\x2f\x6c\x6f\147\151\156");
    }
    public function getAdminPageUrl()
    {
        return $this->getAdminBaseUrl();
    }
    public function getCustomerLoginUrl()
    {
        return $this->getUrl("\x63\165\163\x74\x6f\155\145\162\x2f\141\x63\x63\x6f\x75\156\164\x2f\154\x6f\147\x69\156");
    }
    public function getIsTestConfigurationClicked()
    {
        return $this->getStoreConfig(OAuthConstants::IS_TEST);
    }
    public function flushCache($Q0 = '')
    {
        $NR = ["\144\142\x5f\144\x64\x6c"];
        foreach ($NR as $n0) {
            $this->cacheTypeList->cleanType($n0);
            XP:
        }
        EU:
        foreach ($this->cacheFrontendPool as $Dj) {
            $Dj->getBackend()->clean();
            fH:
        }
        KD:
    }
    public function getFileContents($dL)
    {
        return $this->fileSystem->fileGetContents($dL);
    }
    public function putFileContents($dL, $b2)
    {
        $this->fileSystem->filePutContents($dL, $b2);
    }
    public function getLogoutUrl()
    {
        if (!$this->customerSession->isLoggedIn()) {
            goto eq;
        }
        return $this->getUrl("\x63\x75\x73\164\x6f\x6d\145\x72\57\141\143\143\157\x75\156\164\57\x6c\x6f\147\157\165\164");
        eq:
        if (!$this->authSession->isLoggedIn()) {
            goto tG;
        }
        return $this->getAdminUrl("\141\x64\155\151\x6e\x68\x74\x6d\154\57\141\165\164\150\57\x6c\157\147\x6f\165\x74");
        tG:
        return "\57";
    }
    public function getCallBackUrl()
    {
        return $this->getBaseUrl() . OAuthConstants::CALLBACK_URL;
    }
    public function removeSignInSettings()
    {
        $this->setStoreConfig(OAuthConstants::SHOW_CUSTOMER_LINK, 0);
        $this->setStoreConfig(OAuthConstants::SHOW_ADMIN_LINK, 0);
    }
    public function reinitConfig()
    {
        $this->reinitableConfig->reinit();
    }
    public function getCurrentUrl()
    {
        return $this->urlInterface->getCurrentUrl();
    }
}
