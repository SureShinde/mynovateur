<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\OAuth\Lib\AESEncryption;
class LKAction extends BaseAdminAction
{
    private $REQUEST;
    public function removeAccount()
    {
        $this->oauthUtility->log_debug("\114\x4b\101\x63\164\x69\157\156\72\x20\162\x65\x6d\x6f\x76\x65\x41\143\x63\x6f\165\x6e\164");
        if (!$this->oauthUtility->micr()) {
            goto nZ;
        }
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_EMAIL, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_KEY, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::API_KEY, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::TOKEN, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_LOGIN);
        $this->oauthUtility->removeSignInSettings();
        $this->oauthUtility->reinitconfig();
        nZ:
        if (!$this->oauthUtility->mclv()) {
            goto xH;
        }
        $this->oauthUtility->mius();
        $this->oauthUtility->setStoreConfig(OAuthConstants::SAMLSP_LK, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::SAMLSP_CKL, '');
        xH:
        $this->oauthUtility->flushCache('');
    }
    public function setRequestParam($ge)
    {
        $this->REQUEST = $ge;
        return $this;
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\114\113\x41\x63\x74\x69\x6f\156\72\40\x65\170\x65\x63\x75\164\145");
        $this->checkIfRequiredFieldsEmpty(array("\154\x6b" => $this->REQUEST));
        $yW = $this->REQUEST["\154\153"];
        $ga = json_decode($this->oauthUtility->ccl(), true);
        switch ($ga["\163\164\141\164\x75\163"]) {
            case "\123\x55\x43\103\105\x53\x53":
                $this->_vlk_success($yW);
                goto ii;
            default:
                $this->_vlk_fail();
                goto ii;
        }
        dL:
        ii:
        $this->oauthUtility->reinitConfig();
    }
    public function _vlk_success($XG)
    {
        $this->oauthUtility->log_debug("\114\113\101\143\x74\151\157\156\72\40\137\x76\x6c\x6b\x5f\163\165\143\143\145\x73\x73");
        $uF = json_decode($this->oauthUtility->vml($XG), true);
        if (strcasecmp($uF["\163\164\141\164\165\x73"], "\x53\125\x43\x43\105\123\x53") == 0) {
            goto av;
        }
        if (strcasecmp($uF["\163\164\x61\164\x75\163"], "\x46\x41\x49\114\x45\104") == 0) {
            goto vn;
        }
        $this->messageManager->addErrorMessage(OAuthMessages::ERROR_OCCURRED);
        goto SK;
        vn:
        if (strcasecmp($uF["\155\x65\163\163\x61\x67\x65"], "\103\x6f\x64\x65\x20\150\141\x73\x20\105\x78\x70\151\162\x65\144") == 0) {
            goto DQ;
        }
        $this->messageManager->addErrorMessage(OAuthMessages::ENTERED_INVALID_KEY);
        goto OA;
        DQ:
        $this->messageManager->addErrorMessage(OAuthMessages::LICENSE_KEY_IN_USE);
        OA:
        SK:
        goto MN;
        av:
        $this->oauthUtility->reinitConfig();
        $mx = $this->oauthUtility->getStoreConfig(OAuthConstants::TOKEN);
        $this->oauthUtility->setStoreConfig(OAuthConstants::SAMLSP_LK, AESEncryption::encrypt_data($XG, $mx));
        $this->oauthUtility->setStoreConfig(OAuthConstants::SAMLSP_CKL, AESEncryption::encrypt_data("\x74\x72\165\x65", $mx));
        $this->messageManager->addSuccessMessage(OAuthMessages::LICENSE_VERIFIED);
        MN:
    }
    public function _vlk_fail()
    {
        $this->oauthUtility->log_debug("\x4c\x4b\x41\x63\x74\151\157\x6e\72\x20\x5f\166\154\153\x5f\x66\141\x69\x6c");
        $mx = $this->oauthUtility->getStoreConfig(OAuthConstants::TOKEN);
        $this->oauthUtility->setStoreConfig(OAuthConstants::SAMLSP_CKL, AESEncryption::encrypt_data("\x66\x61\x6c\x73\145", $mx));
        $this->messageManager->addErrorMessage(OAuthMessages::NOT_UPGRADED_YET);
    }
}
