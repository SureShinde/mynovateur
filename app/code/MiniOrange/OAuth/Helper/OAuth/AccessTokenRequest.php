<?php


namespace MiniOrange\OAuth\Helper\OAuth;

use MiniOrange\OAuth\Helper\OAuth\SAML2Utilities;
use MiniOrange\OAuth\Helper\OAuthConstants;
class AccessTokenRequest
{
    private $clientID;
    private $clientSecret;
    private $grantType;
    private $redirectURL;
    private $code;
    public function __construct($AP, $GA, $OU, $D4, $XG)
    {
        $this->clientID = $AP;
        $this->clientSecret = $GA;
        $this->grantType = $OU;
        $this->redirectURL = $D4;
        $this->code = $XG;
    }
    private function generateRequest()
    {
        $To = ["\162\x65\144\151\x72\x65\143\x74\x5f\x75\x72\x69" => $this->redirectURL, "\147\162\x61\156\164\137\164\171\x70\145" => OAuthConstants::GRANT_TYPE, "\143\x6c\x69\x65\x6e\x74\x5f\x69\144" => $this->clientID, "\143\154\x69\x65\x6e\x74\137\163\x65\143\162\x65\x74" => $this->clientSecret, "\143\x6f\x64\x65" => $this->code];
        return $To;
    }
    public function build()
    {
        $To = $this->generateRequest();
        return $To;
    }
}
