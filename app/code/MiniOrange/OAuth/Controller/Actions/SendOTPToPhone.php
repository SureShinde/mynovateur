<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\Exception\OTPSendingFailedException;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
class SendOTPToPhone extends BaseAdminAction
{
    private $REQUEST;
    public function execute()
    {
        $this->checkIfRequiredFieldsEmpty(array("\x70\x68\157\x6e\145" => $this->REQUEST));
        $ZW = $this->REQUEST["\x70\x68\x6f\x6e\145"];
        $this->startVerificationProcess('', $ZW);
    }
    private function startVerificationProcess($ga, $ZW)
    {
        $ga = Curl::mo_send_otp_token(OAuthConstants::OTP_TYPE_PHONE, '', $ZW);
        $ga = json_decode($ga, true);
        if (strcasecmp($ga["\x73\x74\141\164\165\163"], "\x53\125\103\x43\x45\x53\x53") == 0) {
            goto zZ;
        }
        $this->handleOTPSendFailed();
        goto h9;
        zZ:
        $this->handleOTPSentSuccess($ga, $ZW);
        h9:
    }
    private function handleOTPSentSuccess($ga, $ZW)
    {
        $this->oauthUtility->setStoreConfig(OAuthConstants::TXT_ID, $ga["\x74\170\111\144"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_PHONE, $ZW);
        $this->oauthUtility->setStoreConfig(OAuthConstants::OTP_TYPE, OAuthConstants::OTP_TYPE_PHONE);
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_EMAIL);
        $this->messageManager->addSuccessMessage(OAuthMessages::parse("\x50\x48\x4f\x4e\105\x5f\117\124\120\137\x53\105\x4e\124", array("\160\150\157\x6e\x65" => $ZW)));
    }
    private function handleOTPSendFailed()
    {
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_EMAIL);
        throw new OTPSendingFailedException();
    }
    public function setRequestParam($ge)
    {
        $this->REQUEST = $ge;
        return $this;
    }
}
