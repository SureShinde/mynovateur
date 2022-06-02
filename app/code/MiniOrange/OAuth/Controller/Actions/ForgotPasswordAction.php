<?php


namespace MiniOrange\OAuth\Controller\Actions;

use Magento\Framework\App\Action\HttpPostActionInterface;
use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\Exception\AccountAlreadyExistsException;
use MiniOrange\OAuth\Helper\Exception\NotRegisteredException;
class ForgotPasswordAction extends BaseAdminAction implements HttpPostActionInterface
{
    private $REQUEST;
    public function execute()
    {
        $this->oauthUtility->log_debug("\x46\157\x72\x67\157\x74\120\141\163\x73\167\157\162\144\x41\x63\x74\x69\157\156\x3a\40\145\170\145\x63\165\164\x65");
        $this->checkIfRequiredFieldsEmpty(["\145\155\141\x69\x6c" => $this->REQUEST]);
        $Pg = $this->REQUEST["\145\155\x61\151\x6c"];
        $ZD = $this->oauthUtility->getStoreConfig(OAuthConstants::CUSTOMER_KEY);
        $dr = $this->oauthUtility->getStoreConfig(OAuthConstants::API_KEY);
        $uF = json_decode(Curl::forgot_password($Pg, $ZD, $dr), true);
        if (strcasecmp($uF["\163\x74\141\164\165\x73"], "\x53\125\103\103\105\x53\123") == 0) {
            goto zN;
        }
        $this->messageManager->addErrorMessage(OAuthMessages::PASS_RESET_ERROR);
        goto Oq;
        zN:
        $this->messageManager->addSuccessMessage(OAuthMessages::PASS_RESET);
        Oq:
        $this->oauthUtility->flushCache("\x46\x6f\162\147\157\x74\120\x61\x73\x73\x77\157\162\144\x41\143\164\x69\x6f\x6e\40\72\x20");
    }
    public function setRequestParam($ge)
    {
        $this->REQUEST = $ge;
        return $this;
    }
}
