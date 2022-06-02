<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\OAuth\AuthorizationRequest;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\Data;
class SendAuthorizationRequest extends BaseAction
{
    public function execute()
    {
        $this->oauthUtility->log_debug("\123\145\x6e\144\101\165\164\150\x6f\x72\x69\x7a\x61\x74\151\x6f\156\122\x65\161\x75\145\x73\x74\x3a\40\x65\x78\x65\143\x75\x74\x65");
        $Ru = $this->getRequest()->getParams();
        $pQ = array_key_exists("\x72\145\x6c\x61\171\x53\x74\141\164\145", $Ru) ? $Ru["\x72\145\x6c\141\x79\123\164\141\164\x65"] : "\57";
        if (!($pQ == OAuthConstants::TEST_RELAYSTATE)) {
            goto Tq;
        }
        $this->oauthUtility->setStoreConfig(OAuthConstants::IS_TEST, true);
        $this->oauthUtility->flushCache();
        Tq:
        if ($this->oauthUtility->isOAuthConfigured()) {
            goto DY;
        }
        return;
        DY:
        $AP = $this->oauthUtility->getStoreConfig(OAuthConstants::CLIENT_ID);
        $Sr = $this->oauthUtility->getStoreConfig(OAuthConstants::SCOPE);
        $Mf = $this->oauthUtility->getStoreConfig(OAuthConstants::AUTHORIZE_URL);
        $C9 = OAuthConstants::CODE;
        $XO = $this->oauthUtility->getBaseUrl();
        $D4 = $XO . "\x6d\x6f\x6f\x61\x75\x74\x68\57\141\x63\164\151\x6f\x6e\x73\57\x52\145\141\144\101\165\x74\x68\x6f\162\151\172\141\164\151\157\x6e\x52\145\x73\x70\x6f\156\x73\145";
        $this->oauthUtility->log_debug("\123\x65\x6e\x64\101\165\164\x68\157\x72\151\172\x61\x74\151\x6f\156\x52\145\161\165\145\163\x74\72\40\x73\143\x6f\x70\x65\x3a", $Sr);
        $this->oauthUtility->log_debug("\x53\x65\156\144\x41\165\164\x68\157\x72\x69\172\141\164\151\157\x6e\122\145\161\165\x65\163\x74\x3a\40\x61\165\x74\150\157\x72\151\172\x65\125\122\114\72", $Mf);
        $this->oauthUtility->log_debug("\x53\145\156\144\x41\165\164\x68\157\x72\x69\172\141\x74\x69\157\156\x52\145\x71\x75\x65\x73\164\x3a\40\162\x65\x73\x70\x6f\156\163\145\x54\x79\x70\x65\72", $C9);
        $this->oauthUtility->log_debug("\123\x65\x6e\x64\101\x75\164\150\157\x72\x69\172\141\164\x69\157\156\x52\145\161\165\x65\x73\x74\x3a\x20\143\x75\162\x72\145\x6e\164\x42\x61\163\145\125\162\x6c\x3a", $XO);
        $this->oauthUtility->log_debug("\123\145\x6e\x64\101\x75\x74\150\157\x72\151\172\x61\164\151\x6f\156\x52\145\161\x75\145\x73\164\x3a\x20\x72\x65\x64\x69\162\145\x63\x74\125\x52\x4c\72", $D4);
        $Yr = new AuthorizationRequest($AP, $Sr, $Mf, $C9, $D4, $pQ);
        $qC = $Yr->build();
        return $this->sendHTTPRedirectRequest($qC, $Mf);
    }
}
