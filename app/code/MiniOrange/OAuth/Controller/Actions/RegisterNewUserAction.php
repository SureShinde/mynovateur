<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\Exception\PasswordMismatchException;
use MiniOrange\OAuth\Helper\Exception\OTPSendingFailedException;
class RegisterNewUserAction extends BaseAdminAction
{
    private $REQUEST;
    private $loginExistingUserAction;
    public function __construct(\Magento\Backend\App\Action\Context $Dp, \Magento\Framework\View\Result\PageFactory $nc, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Framework\Message\ManagerInterface $mc, \Psr\Log\LoggerInterface $Za, \MiniOrange\OAuth\Controller\Actions\LoginExistingUserAction $Ny)
    {
        parent::__construct($Dp, $nc, $GQ, $mc, $Za);
        $this->loginExistingUserAction = $Ny;
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\122\x65\x67\x69\163\x74\145\x72\116\x65\167\x55\x73\145\x72\72\40\x65\170\x65\x63\x75\x74\x65");
        $this->checkIfRequiredFieldsEmpty(array("\145\x6d\141\x69\154" => $this->REQUEST, "\x70\x61\163\x73\x77\x6f\162\144" => $this->REQUEST, "\143\157\x6e\x66\151\162\x6d\x50\141\x73\x73\167\x6f\x72\144" => $this->REQUEST));
        $Pg = $this->REQUEST["\145\155\x61\151\154"];
        $OQ = $this->REQUEST["\160\x61\x73\163\167\157\162\144"];
        $NS = $this->REQUEST["\x63\157\156\x66\151\162\155\x50\x61\x73\163\167\157\162\144"];
        $Ya = $this->REQUEST["\x63\x6f\155\x70\x61\156\x79\116\x61\155\x65"];
        $FI = $this->REQUEST["\x66\x69\162\163\164\x4e\x61\155\x65"];
        $KO = $this->REQUEST["\x6c\141\163\x74\116\x61\x6d\x65"];
        if (!(strcasecmp($NS, $OQ) != 0)) {
            goto r3;
        }
        throw new PasswordMismatchException();
        r3:
        $ga = $this->checkIfUserExists($Pg);
        if (strcasecmp($ga["\x73\164\141\x74\x75\x73"], "\103\x55\x53\x54\117\115\x45\122\x5f\116\x4f\124\137\x46\x4f\x55\x4e\104") == 0) {
            goto kZ;
        }
        $this->loginExistingUserAction->setRequestParam($this->REQUEST)->execute();
        goto E5;
        kZ:
        $this->startVerificationProcess($ga, $Pg, $Ya, $FI, $KO);
        E5:
    }
    private function checkIfUserExists($Pg)
    {
        $this->oauthUtility->log_debug("\122\x65\147\151\163\164\x65\162\116\x65\x77\125\x73\145\162\101\x63\164\151\157\156\x3a\40\143\x68\x65\143\153\x49\146\x55\x73\x65\162\105\x78\x69\163\164\x73");
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_EMAIL, $Pg);
        $uF = Curl::check_customer($Pg);
        return json_decode($uF, true);
    }
    private function startVerificationProcess($ga, $Pg, $Ya, $FI, $KO)
    {
        $this->oauthUtility->log_debug("\x52\145\x67\151\x73\164\145\x72\116\145\167\125\163\145\x72\101\143\164\x69\x6f\156\72\x20\123\x74\x61\162\x74\126\145\x72\x69\146\151\143\141\x74\151\157\x6e\x50\x72\x6f\143\x65\x73\x73");
        $ga = Curl::mo_send_otp_token(OAuthConstants::OTP_TYPE_EMAIL, $Pg);
        $ga = json_decode($ga, true);
        if (strcasecmp($ga["\x73\164\x61\164\x75\163"], "\123\x55\103\x43\x45\123\x53") == 0) {
            goto WW;
        }
        $this->handleOTPSendFailed();
        goto XM;
        WW:
        $this->handleOTPSentSuccess($ga, $Pg, $Ya, $FI, $KO);
        XM:
    }
    private function handleOTPSentSuccess($ga, $Pg, $Ya, $FI, $KO)
    {
        $this->oauthUtility->setStoreConfig(OAuthConstants::TXT_ID, $ga["\164\170\x49\144"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_EMAIL, $Pg);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_NAME, $Ya);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_FNAME, $FI);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_LNAME, $KO);
        $this->oauthUtility->setStoreConfig(OAuthConstants::OTP_TYPE, OAuthConstants::OTP_TYPE_EMAIL);
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_EMAIL);
        $this->messageManager->addSuccessMessage(OAuthMessages::parse("\105\x4d\x41\x49\114\x5f\117\124\x50\137\x53\105\116\124", array("\145\x6d\x61\151\154" => $Pg)));
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
