<?php


namespace MiniOrange\OAuth\Controller\Adminhtml\Attrsettings;

use Magento\Backend\App\Action\Context;
use Magento\Customer\Model\ResourceModel\Group\Collection;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\View\Result\PageFactory;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
use MiniOrange\OAuth\Helper\OAuthUtility;
use Psr\Log\LoggerInterface;
class Index extends BaseAdminAction implements HttpPostActionInterface, HttpGetActionInterface
{
    private $adminRoleModel;
    private $userGroupModel;
    public function __construct(Context $Dp, PageFactory $nc, OAuthUtility $GQ, ManagerInterface $mc, LoggerInterface $Za, \Magento\Authorization\Model\ResourceModel\Role\Collection $LR, Collection $HQ)
    {
        parent::__construct($Dp, $nc, $GQ, $mc, $Za);
        $this->adminRoleModel = $LR;
        $this->userGroupModel = $HQ;
    }
    public function execute()
    {
        try {
            $Ru = $this->getRequest()->getParams();
            if (!$this->isFormOptionBeingSaved($Ru)) {
                goto Tu;
            }
            $this->checkIfRequiredFieldsEmpty(["\x6f\141\x75\164\x68\x5f\141\x6d\137\165\163\145\x72\156\141\155\x65" => $Ru, "\x6f\x61\x75\x74\x68\137\141\155\137\141\143\143\x6f\x75\x6e\164\137\x6d\141\164\x63\x68\145\x72" => $Ru]);
            $this->processValuesAndSaveData($Ru);
            $this->oauthUtility->flushCache();
            $this->messageManager->addSuccessMessage(OAuthMessages::SETTINGS_SAVED);
            $this->oauthUtility->reinitConfig();
            Tu:
        } catch (\Exception $P0) {
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
        $bC = $this->resultPageFactory->create();
        $bC->setActiveMenu(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_BASE);
        $bC->addBreadcrumb(__("\x41\x54\124\x52\x20\123\145\x74\164\151\x6e\x67\163"), __("\x41\124\124\122\x20\x53\x65\x74\164\151\156\147\163"));
        $bC->getConfig()->getTitle()->prepend(__(OAuthConstants::MODULE_TITLE));
        return $bC;
    }
    private function processValuesAndSaveData($Ru)
    {
        $Os = trim($Ru["\x6f\141\x75\164\x68\x5f\x61\x6d\x5f\x64\145\x66\141\x75\x6c\164\137\162\x6f\x6c\x65"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_MAP_BY, $Ru["\157\141\x75\x74\x68\x5f\141\x6d\137\x61\x63\x63\157\165\x6e\164\137\155\141\164\143\150\145\162"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_USERNAME, $Ru["\x6f\x61\165\x74\x68\x5f\141\x6d\137\x75\x73\145\x72\x6e\x61\x6d\x65"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_EMAIL, $Ru["\157\x61\x75\164\x68\x5f\141\155\x5f\x65\x6d\141\151\x6c"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_FIRSTNAME, $Ru["\157\141\165\x74\150\137\141\x6d\x5f\146\x69\x72\x73\x74\137\x6e\141\x6d\145"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_LASTNAME, $Ru["\157\141\x75\x74\x68\137\x61\x6d\x5f\154\x61\163\164\x5f\156\141\x6d\x65"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_GROUP, $Ru["\x6f\141\x75\164\150\137\141\x6d\137\147\x72\157\x75\x70\137\156\x61\x6d\145"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_DEFAULT_ROLE, $Os);
        $Pv = isset($Ru["\157\141\x75\164\x68\x5f\x61\155\137\x64\157\x6e\164\137\x61\x6c\154\x6f\167\x5f\x75\156\154\151\163\x74\145\144\137\x75\163\145\162\x5f\x72\157\154\x65"]) ? "\x63\150\145\x63\x6b\145\144" : "\x75\x6e\x43\x68\145\143\x6b\145\144";
        $Jd = isset($Ru["\155\x6f\x5f\x6f\x61\x75\164\x68\137\x64\157\x6e\x74\x5f\x63\162\x65\x61\164\x65\x5f\165\163\x65\x72\x5f\151\x66\x5f\162\157\154\x65\x5f\x6e\157\x74\x5f\155\141\160\x70\x65\x64"]) ? "\143\x68\x65\143\x6b\x65\x64" : "\165\156\x63\150\145\x63\x6b\145\x64";
        $ap = $this->processAdminRoleMapping($Ru);
        $tT = $this->processCustomerRoleMapping($Ru);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_USERNAME, $Ru["\157\x61\165\164\150\x5f\141\155\x5f\x75\163\x65\162\156\141\x6d\145"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_EMAIL, $Ru["\157\141\165\x74\x68\137\x61\155\x5f\145\x6d\x61\x69\x6c"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::MAP_GROUP, $Ru["\x6f\141\165\164\x68\137\x61\x6d\137\147\162\x6f\x75\x70\137\156\141\x6d\x65"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::UNLISTED_ROLE, $Pv);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CREATEIFNOTMAP, $Jd);
        $this->oauthUtility->setStoreConfig(OAuthConstants::ROLES_MAPPED, serialize($ap));
        $this->oauthUtility->setStoreConfig(OAuthConstants::GROUPS_MAPPED, serialize($tT));
    }
    private function processAdminRoleMapping($Ru)
    {
        $ap = array();
        $OZ = $this->adminRoleModel->toOptionArray();
        foreach ($OZ as $Yb) {
            $Ve = "\x6f\x61\x75\x74\x68\x5f\141\x6d\x5f\141\x64\x6d\151\156\137\x61\164\x74\x72\x5f\166\x61\x6c\x75\x65\163\x5f" . $Yb["\x76\141\x6c\x75\145"];
            if (!array_key_exists($Ve, $Ru)) {
                goto l8;
            }
            $ap[$Yb["\x76\141\154\x75\145"]] = $Ru[$Ve];
            l8:
            Ju:
        }
        pi:
        return $ap;
    }
    private function processCustomerRoleMapping($Ru)
    {
        $tT = array();
        $sL = $this->userGroupModel->toOptionArray();
        foreach ($sL as $n7) {
            $Ve = "\x6f\141\165\x74\150\137\141\155\137\x67\x72\157\165\160\137\x61\x74\x74\x72\x5f\166\x61\x6c\x75\x65\x73\x5f" . $n7["\166\141\x6c\x75\145"];
            if (!array_key_exists($Ve, $Ru)) {
                goto XW;
            }
            $tT[$n7["\x76\x61\154\165\145"]] = $Ru[$Ve];
            XW:
            nj:
        }
        Vf:
        return $tT;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_ATTR);
    }
}
