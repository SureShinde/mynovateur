<?php


namespace MiniOrange\OAuth\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use MiniOrange\OAuth\Helper\OAuthConstants;
class Data extends AbstractHelper
{
    protected $scopeConfig;
    protected $adminFactory;
    protected $customerFactory;
    protected $urlInterface;
    protected $configWriter;
    protected $assetRepo;
    protected $helperBackend;
    protected $frontendUrl;
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $id, \Magento\User\Model\UserFactory $HW, \Magento\Customer\Model\CustomerFactory $fi, \Magento\Framework\UrlInterface $Np, \Magento\Framework\App\Config\Storage\WriterInterface $u3, \Magento\Framework\View\Asset\Repository $Z0, \Magento\Backend\Helper\Data $UZ, \Magento\Framework\Url $yN)
    {
        $this->scopeConfig = $id;
        $this->adminFactory = $HW;
        $this->customerFactory = $fi;
        $this->urlInterface = $Np;
        $this->configWriter = $u3;
        $this->assetRepo = $Z0;
        $this->helperBackend = $UZ;
        $this->frontendUrl = $yN;
    }
    public function getMiniOrangeUrl()
    {
        return OAuthConstants::HOSTNAME;
    }
    public function getStoreConfig($Pt)
    {
        $l5 = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue("\155\x69\156\151\x6f\x72\x61\156\x67\145\x2f\x6f\x61\165\164\150\57" . $Pt, $l5);
    }
    public function setStoreConfig($Pt, $Vw)
    {
        $this->configWriter->save("\155\x69\156\x69\x6f\x72\x61\x6e\147\x65\x2f\157\141\165\x74\150\x2f" . $Pt, $Vw);
    }
    public function saveConfig($kg, $Vw, $B2, $rn)
    {
        $rn ? $this->saveAdminStoreConfig($kg, $Vw, $B2) : $this->saveCustomerStoreConfig($kg, $Vw, $B2);
    }
    public function getAdminStoreConfig($Pt, $B2)
    {
        return $this->adminFactory->create()->load($B2)->getData($Pt);
    }
    private function saveAdminStoreConfig($kg, $Vw, $B2)
    {
        $b2 = [$kg => $Vw];
        $JG = $this->adminFactory->create()->load($B2)->addData($b2);
        $JG->setId($B2)->save();
    }
    public function getCustomerStoreConfig($Pt, $B2)
    {
        return $this->customerFactory->create()->load($B2)->getData($Pt);
    }
    private function saveCustomerStoreConfig($kg, $Vw, $B2)
    {
        $b2 = [$kg => $Vw];
        $JG = $this->customerFactory->create()->load($B2)->addData($b2);
        $JG->setId($B2)->save();
    }
    public function getBaseUrl()
    {
        return $this->urlInterface->getBaseUrl();
    }
    public function getCurrentUrl()
    {
        return $this->urlInterface->getCurrentUrl();
    }
    public function getUrl($kg, $Ru = array())
    {
        return $this->urlInterface->getUrl($kg, ["\137\161\165\x65\162\171" => $Ru]);
    }
    public function getFrontendUrl($kg, $Ru = array())
    {
        return $this->frontendUrl->getUrl($kg, ["\137\161\x75\145\162\x79" => $Ru]);
    }
    public function getIssuerUrl()
    {
        return $this->getBaseUrl() . OAuthConstants::ISSUER_URL_PATH;
    }
    public function getImageUrl($I0)
    {
        return $this->assetRepo->getUrl(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_IMAGES . $I0);
    }
    public function getAdminCssUrl($hh)
    {
        return $this->assetRepo->getUrl(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_CSS . $hh, ["\141\162\145\141" => "\141\144\x6d\151\156\x68\x74\155\x6c"]);
    }
    public function getAdminJSUrl($IS)
    {
        return $this->assetRepo->getUrl(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_JS . $IS, ["\x61\162\145\141" => "\141\x64\x6d\151\156\x68\x74\x6d\x6c"]);
    }
    public function getMetadataUrl()
    {
        return $this->assetRepo->getUrl(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_METADATA, ["\141\x72\145\x61" => "\141\x64\x6d\x69\156\x68\x74\x6d\x6c"]);
    }
    public function getMetadataFilePath()
    {
        return $this->assetRepo->createAsset(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_METADATA, ["\x61\x72\x65\x61" => "\x61\144\x6d\151\x6e\x68\x74\x6d\x6c"])->getSourceFile();
    }
    public function getResourcePath($mx)
    {
        return $this->assetRepo->createAsset(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_CERTS . $mx, ["\141\162\145\x61" => "\141\x64\155\151\x6e\150\x74\155\x6c"])->getSourceFile();
    }
    public function getAdminBaseUrl()
    {
        return $this->helperBackend->getHomePageUrl();
    }
    public function getAdminUrl($kg, $Ru = array())
    {
        return $this->helperBackend->getUrl($kg, ["\x5f\161\165\145\162\171" => $Ru]);
    }
    public function getAdminSecureUrl($kg, $Ru = array())
    {
        return $this->helperBackend->getUrl($kg, ["\137\x73\x65\143\x75\162\x65" => true, "\x5f\x71\x75\145\162\171" => $Ru]);
    }
    public function isAllPageAutoRedirectEnabled()
    {
        return $this->getStoreConfig(OAuthConstants::ALL_PAGE_AUTO_REDIRECT);
    }
    public function getSPInitiatedUrl($pQ = null)
    {
        $pQ = is_null($pQ) ? $this->getCurrentUrl() : $pQ;
        return $this->getFrontendUrl(OAuthConstants::OAUTH_LOGIN_URL, ["\162\145\x6c\141\x79\123\x74\x61\x74\x65" => $pQ]);
    }
}
