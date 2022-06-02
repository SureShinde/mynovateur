<?php


namespace MiniOrange\OAuth\Controller\Adminhtml\OAuthsettings;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\OAuth\SAML2Utilities;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
class Index extends BaseAdminAction implements HttpPostActionInterface, HttpGetActionInterface
{
    public function execute()
    {
        try {
            $Ru = $this->getRequest()->getParams();
            if (!$this->isFormOptionBeingSaved($Ru)) {
                goto QD;
            }
            $this->checkIfRequiredFieldsEmpty(["\155\x6f\x5f\157\141\165\x74\x68\137\141\x70\160\137\x6e\x61\155\x65" => $Ru, "\155\x6f\137\157\141\165\164\x68\x5f\x63\154\151\145\156\164\x5f\x69\144" => $Ru, "\155\x6f\137\157\141\165\164\x68\x5f\143\154\x69\x65\x6e\x74\x5f\163\145\x63\x72\145\164" => $Ru, "\x6d\157\137\x6f\x61\x75\164\150\137\163\143\157\x70\145" => $Ru, "\155\x6f\x5f\x6f\x61\165\164\150\x5f\141\165\164\150\157\x72\x69\x7a\x65\x5f\x75\x72\x6c" => $Ru, "\155\157\137\157\141\165\x74\150\x5f\141\143\x63\145\163\163\164\x6f\153\x65\156\x5f\165\x72\154" => $Ru, "\x6d\157\x5f\157\141\165\x74\150\x5f\x67\145\164\165\x73\x65\162\151\156\x66\x6f\x5f\165\x72\x6c" => $Ru]);
            $this->processValuesAndSaveData($Ru);
            $this->oauthUtility->flushCache();
            $this->messageManager->addSuccessMessage(OAuthMessages::SETTINGS_SAVED);
            $this->oauthUtility->reinitConfig();
            QD:
        } catch (\Exception $P0) {
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
        $bC = $this->resultPageFactory->create();
        $bC->setActiveMenu(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_BASE);
        $bC->addBreadcrumb(__("\x4f\101\165\x74\x68\x20\123\x65\164\164\x69\x6e\x67\163"), __("\117\x41\x75\x74\150\40\x53\x65\x74\164\x69\156\x67\163"));
        $bC->getConfig()->getTitle()->prepend(__(OAuthConstants::MODULE_TITLE));
        return $bC;
    }
    private function processValuesAndSaveData($Ru)
    {
        $pz = trim($Ru["\155\x6f\x5f\157\x61\x75\164\150\x5f\x61\x70\160\137\156\x61\x6d\145"]);
        $Hf = trim($Ru["\x6d\x6f\137\157\x61\165\x74\150\x5f\143\154\x69\x65\x6e\x74\x5f\x69\144"]);
        $dS = trim($Ru["\x6d\x6f\137\157\141\165\164\x68\137\x63\154\151\145\x6e\164\x5f\163\145\x63\x72\145\x74"]);
        $SX = trim($Ru["\x6d\x6f\x5f\157\x61\x75\x74\x68\x5f\163\143\157\x70\x65"]);
        $fO = trim($Ru["\x6d\157\137\x6f\141\x75\x74\x68\137\141\165\x74\x68\157\x72\x69\x7a\x65\x5f\x75\162\154"]);
        $IN = trim($Ru["\x6d\x6f\x5f\157\x61\x75\164\150\137\141\x63\x63\145\163\163\x74\157\153\x65\156\137\x75\162\154"]);
        $nM = isset($Ru["\155\157\137\x6f\141\x75\164\x68\137\x67\145\x74\165\x73\x65\x72\151\x6e\x66\157\137\x75\162\154"]) ? trim($Ru["\x6d\157\x5f\x6f\x61\165\164\150\137\147\145\164\x75\x73\x65\162\x69\156\146\x6f\137\x75\x72\154"]) : '';
        $fq = isset($Ru["\x73\145\156\144\x5f\150\145\141\x64\145\162"]) ? 1 : 0;
        $qk = isset($Ru["\163\x65\156\144\137\142\x6f\x64\171"]) ? 1 : 0;
        $PX = isset($Ru["\155\x6f\137\x6f\141\165\164\150\x5f\154\x6f\147\157\x75\164\x5f\x75\x72\154"]) ? trim($Ru["\155\x6f\137\157\x61\165\x74\x68\x5f\x6c\x6f\x67\157\165\x74\137\165\x72\154"]) : '';
        $hi = trim($Ru["\155\x6f\137\157\x61\x75\164\x68\x5f\x6a\167\x6b\163\137\165\x72\154"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::APP_NAME, $pz);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CLIENT_ID, $Hf);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CLIENT_SECRET, $dS);
        $this->oauthUtility->setStoreConfig(OAuthConstants::SCOPE, $SX);
        $this->oauthUtility->setStoreConfig(OAuthConstants::AUTHORIZE_URL, $fO);
        $this->oauthUtility->setStoreConfig(OAuthConstants::ACCESSTOKEN_URL, $IN);
        $this->oauthUtility->setStoreConfig(OAuthConstants::GETUSERINFO_URL, $nM);
        $this->oauthUtility->setStoreConfig(OAuthConstants::OAUTH_LOGOUT_URL, $PX);
        $this->oauthUtility->setStoreConfig(OAuthConstants::SEND_HEADER, $fq);
        $this->oauthUtility->setStoreConfig(OAuthConstants::SEND_BODY, $qk);
        $this->oauthUtility->setStoreConfig(OAuthConstants::X509CERT, $hi);
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_OAUTHSETTINGS);
    }
}
