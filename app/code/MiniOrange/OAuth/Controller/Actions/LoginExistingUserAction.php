<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\Exception\AccountAlreadyExistsException;
use MiniOrange\OAuth\Helper\Exception\NotRegisteredException;
class LoginExistingUserAction extends BaseAdminAction
{
    private $REQUEST;
    public function execute()
    {
        $this->oauthUtility->log_debug("\114\157\x67\x69\x6e\x45\170\151\x73\x74\x69\156\x67\125\163\145\162\101\x63\x74\x69\157\156\72\x20\145\170\145\143\165\164\145");
        $this->checkIfRequiredFieldsEmpty(["\145\155\141\151\154" => $this->REQUEST, "\x70\141\163\x73\167\157\x72\144" => $this->REQUEST, "\163\x75\142\155\x69\164" => $this->REQUEST]);
        $Pg = $this->REQUEST["\145\155\141\151\154"];
        $OQ = $this->REQUEST["\160\x61\x73\x73\x77\x6f\162\144"];
        $OT = $this->REQUEST["\163\x75\142\x6d\151\164"];
        $this->getCurrentCustomer($Pg, $OQ);
    }
    private function getCurrentCustomer($Pg, $OQ)
    {
        $this->oauthUtility->log_debug("\x4c\157\147\151\156\x45\170\151\163\x74\x69\156\147\125\163\145\x72\x41\x63\164\151\157\156\x3a\x20\x67\145\x74\x43\165\162\162\x65\x6e\x74\x43\165\x73\164\157\155\x65\162");
        $uF = Curl::get_customer_key($Pg, $OQ);
        $ZD = json_decode($uF, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            goto W9;
        }
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_VERIFY_LOGIN);
        throw new AccountAlreadyExistsException();
        goto kc;
        W9:
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_EMAIL, $Pg);
        $this->oauthUtility->setStoreConfig(OAuthConstants::CUSTOMER_KEY, $ZD["\x69\144"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::API_KEY, $ZD["\x61\160\151\113\145\171"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::TOKEN, $ZD["\x74\157\x6b\145\x6e"]);
        $this->oauthUtility->setStoreConfig(OAuthConstants::TXT_ID, '');
        $this->oauthUtility->setStoreConfig(OAuthConstants::REG_STATUS, OAuthConstants::STATUS_COMPLETE_LOGIN);
        $this->messageManager->addSuccessMessage(OAuthMessages::REG_SUCCESS);
        $this->oauthUtility->reinitconfig();
        kc:
    }
    public function setRequestParam($ge)
    {
        $this->REQUEST = $ge;
        return $this;
    }
}
