<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\Exception\OTPSendingFailedException;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
class ResendOTPAction extends BaseAdminAction
{
    private $REQUEST;
    public function execute()
    {
        $Nl = $this->oauthUtility->getStoreConfig(OAuthConstants::OTP_TYPE);
        $Pg = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_EMAIL);
        $ZW = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_PHONE);
        $this->startVerificationProcess($ZW, $Pg, $Nl);
    }
    private function startVerificationProcess($ZW, $Pg, $Nl)
    {
        $ga = Curl::mo_send_otp_token($Nl, $Pg, $ZW);
        $ga = json_decode($ga, true);
        if (strcasecmp($ga["\x73\164\x61\x74\165\163"], "\123\x55\x43\x43\105\x53\123") == 0) {
            goto Fy;
        }
        $this->handleOTPSendFailed();
        goto zD;
        Fy:
        $this->handleOTPSentSuccess($ga, $ZW, $Pg, $Nl);
        zD:
    }
    private function handleOTPSentSuccess($ga, $ZW, $Pg, $Nl)
    {
        $this->oauthUtility->setStoreConfig(OAuthConstants::TXT_ID, $ga["\164\x78\111\x64"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::OTP_TYPE, $Nl);
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_EMAIL);
        $tI = $Nl == OAuthConstants::OTP_TYPE_PHONE ? OAuthMessages::parse("\120\110\117\116\x45\x5f\x4f\x54\120\137\123\105\116\124", array("\160\x68\x6f\156\x65" => $ZW)) : OAuthMessages::parse("\105\115\x41\x49\x4c\137\x4f\x54\120\137\123\105\x4e\124", array("\x65\x6d\141\x69\154" => $Pg));
        $this->messageManager->addSuccessMessage($tI);
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
