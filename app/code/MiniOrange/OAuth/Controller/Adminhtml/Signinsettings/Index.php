<?php


namespace MiniOrange\OAuth\Controller\Adminhtml\Signinsettings;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\OAuth\SAML2Utilities;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
use Magento\Framework\App\Action\HttpPostActionInterface;
class Index extends BaseAdminAction implements HttpPostActionInterface, HttpGetActionInterface
{
    public function execute()
    {
        try {
            $Ru = $this->getRequest()->getParams();
            if (!$this->isFormOptionBeingSaved($Ru)) {
                goto NA;
            }
            $this->processValuesAndSaveData($Ru);
            $this->oauthUtility->flushCache();
            $this->messageManager->addSuccessMessage(OAuthMessages::SETTINGS_SAVED);
            $this->oauthUtility->reinitConfig();
            NA:
        } catch (\Exception $P0) {
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
        $bC = $this->resultPageFactory->create();
        $bC->setActiveMenu(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_BASE);
        $bC->addBreadcrumb(__("\x53\151\x67\x6e\x20\111\x6e\x20\x53\145\164\164\151\x6e\147\x73"), __("\123\x69\x67\156\x20\111\156\x20\123\x65\x74\x74\151\x6e\x67\x73"));
        $bC->getConfig()->getTitle()->prepend(__(OAuthConstants::MODULE_TITLE));
        return $bC;
    }
    private function processValuesAndSaveData($Ru)
    {
        $L9 = isset($Ru["\x6d\157\x5f\x6f\x61\165\164\x68\x5f\163\x68\x6f\x77\x5f\143\x75\163\164\157\155\x65\162\137\154\x69\156\x6b"]) ? 1 : 0;
        $qu = isset($Ru["\155\x6f\137\157\141\165\x74\150\137\163\150\157\x77\137\x61\144\x6d\x69\x6e\137\154\151\x6e\x6b"]) ? 1 : 0;
        $rZ = isset($Ru["\155\x6f\x5f\x73\x61\155\x6c\137\145\x6e\x61\x62\x6c\145\137\x6c\157\147\151\156\x5f\162\145\144\151\162\145\143\x74"]) ? 1 : 0;
        $pG = isset($Ru["\x6d\157\137\x64\x6f\137\156\157\x74\x5f\141\x75\x74\x6f\137\x63\x72\x65\141\x74\145\x5f\165\x73\145\162\163"]) ? 1 : 0;
        $Uq = isset($Ru["\155\157\x5f\163\141\x6d\154\137\142\x79\160\x61\163\x73\x5f\x72\145\144\x69\162\145\143\164"]) ? 1 : 0;
        $Uq = !$rZ ? 0 : 1;
        $IC = isset($Ru["\155\x6f\137\x6f\141\165\x74\150\x5f\x65\156\141\x62\154\x65\137\x61\x6c\154\137\160\x61\147\145\x5f\x6c\157\x67\x69\x6e\x5f\162\145\144\x69\162\x65\x63\164"]) ? 1 : 0;
        $this->oauthUtility->log_debug("\x49\x6e\x64\145\x78" . $Ru["\x6d\x6f\x5f\157\x61\165\164\x68\137\x6c\x6f\147\x6f\165\164\137\162\145\x64\x69\x72\145\x63\164\x5f\165\162\154"]);
        $f0 = $Ru["\155\x6f\137\x6f\141\x75\164\x68\x5f\154\157\x67\157\x75\x74\x5f\x72\145\144\151\162\145\x63\164\x5f\x75\162\x6c"];
        $this->oauthUtility->setStoreConfig(OAuthConstants::AUTO_REDIRECT, $rZ);
        $this->oauthUtility->setStoreConfig(OAuthConstants::SHOW_CUSTOMER_LINK, $L9);
        $this->oauthUtility->setStoreConfig(OAuthConstants::SHOW_ADMIN_LINK, $qu);
        $this->oauthUtility->setStoreConfig(OAuthConstants::DO_NOT_AUTO_CREATE_USERS, $pG);
        $this->oauthUtility->setStoreConfig(OAuthConstants::LOGOUT_AUTO_REDIRECT_URL, $f0);
        $this->oauthUtility->setStoreConfig(OAuthConstants::ALL_PAGE_AUTO_REDIRECT, $IC);
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_SIGNIN);
    }
}
