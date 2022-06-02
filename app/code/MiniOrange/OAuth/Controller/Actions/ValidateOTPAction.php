<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\Exception\AccountAlreadyExistsException;
use MiniOrange\OAuth\Helper\Exception\OTPValidationFailedException;
use MiniOrange\OAuth\Helper\Exception\RequiredFieldsException;
use MiniOrange\OAuth\Helper\Exception\OTPRequiredException;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
class ValidateOTPAction extends BaseAdminAction
{
    private $REQUEST;
    public function execute()
    {
        $this->oauthUtility->log_debug("\126\x61\x6c\151\144\141\164\x65\117\124\120\101\143\164\x69\157\156\x20\72\40\x65\x78\145\143\x75\164\145");
        $this->checkIfRequiredFieldsEmpty(array("\x73\165\142\155\x69\164" => $this->REQUEST));
        $OT = $this->REQUEST["\163\x75\x62\155\151\x74"];
        $oM = $this->oauthUtility->getStoreConfig(OAuthConstants::TXT_ID);
        $Vz = $this->REQUEST["\x6f\x74\160\x5f\164\x6f\153\x65\156"];
        if ($OT == "\x42\x61\x63\153") {
            goto Km;
        }
        $this->validateOTP($oM, $Vz);
        goto Qx;
        Km:
        $this->goBackToRegistrationPage();
        Qx:
    }
    private function goBackToRegistrationPage()
    {
        $this->oauthUtility->log_debug("\126\141\x6c\x69\144\x61\x74\x65\117\124\x50\101\x63\x74\151\x6f\x6e\x20\72\x20\x67\157\102\x61\143\153\124\157\x52\x65\147\x69\x73\x74\162\x61\x74\151\x6f\x6e\x50\141\x67\x65");
        $this->oauthUtility->setStoreConfig(OAuthConstants::OTP_TYPE, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_EMAIL, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_PHONE, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::TXT_ID, '');
    }
    private function validateOTP($vn, $it)
    {
        $this->oauthUtility->log_debug("\126\141\154\x69\144\x61\x74\145\117\124\120\101\x63\x74\151\157\x6e\x20\x3a\x20\166\141\x6c\151\x64\x61\164\x65\x4f\124\120");
        if (!(!array_key_exists("\157\164\160\137\164\x6f\x6b\x65\156", $this->REQUEST) || $this->REQUEST["\x6f\164\160\137\164\x6f\153\x65\x6e"] == '')) {
            goto ex;
        }
        throw new OTPRequiredException();
        ex:
        $ga = Curl::validate_otp_token($vn, $it);
        $ga = json_decode($ga, true);
        if (strcasecmp($ga["\163\x74\x61\164\x75\x73"], "\123\125\103\103\105\123\123") == 0) {
            goto gT;
        }
        $this->handleOTPValidationFailed();
        goto p1;
        gT:
        $this->handleOTPValidationSuccess($ga);
        p1:
    }
    private function handleOTPValidationSuccess($ga)
    {
        $Ya = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_NAME);
        $FI = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_FNAME);
        $KO = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_LNAME);
        $Pg = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_EMAIL);
        $ZW = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_PHONE);
        $ga = Curl::create_customer($Pg, $Ya, '', $ZW, $FI, $KO);
        $ga = json_decode($ga, true);
        if (strcasecmp($ga["\163\x74\x61\164\165\x73"], "\123\125\x43\x43\x45\x53\123") == 0) {
            goto I6;
        }
        if (!(strcasecmp($ga["\x73\x74\141\164\165\x73"], "\x43\x55\123\124\x4f\115\x45\122\x5f\x55\x53\x45\122\x4e\101\115\105\137\101\x4c\x52\x45\101\x44\x59\137\105\130\111\123\x54\x53") == 0)) {
            goto B5;
        }
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_LOGIN);
        throw new AccountAlreadyExistsException();
        B5:
        goto xG;
        I6:
        $this->configureUserInMagento($ga);
        xG:
    }
    private function configureUserInMagento($ga)
    {
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_KEY, $ga["\151\x64"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::API_KEY, $ga["\x61\160\151\113\x65\x79"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::TOKEN, $ga["\x74\157\x6b\145\x6e"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::OTP_TYPE, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::TXT_ID, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_COMPLETE_LOGIN);
        $this->messageManager->addSuccessMessage(OAuthMessages::REG_SUCCESS);
    }
    private function handleOTPValidationFailed()
    {
        $this->oauthUtility->log_debug("\x56\141\x6c\x69\144\141\x74\x65\117\x54\x50\x41\143\164\151\157\x6e\40\72\x20\x68\141\x6e\144\x6c\x65\117\124\x50\126\145\162\151\151\143\141\x74\x69\157\x6e\x46\x61\151\x6c\145\x64");
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_EMAIL);
        throw new OTPValidationFailedException();
    }
    public function setRequestParam($ge)
    {
        $this->REQUEST = $ge;
        return $this;
    }
}
