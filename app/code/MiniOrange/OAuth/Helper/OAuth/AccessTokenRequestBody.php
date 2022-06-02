<?php


namespace MiniOrange\OAuth\Helper\OAuth;

use MiniOrange\OAuth\Helper\OAuth\SAML2Utilities;
use MiniOrange\OAuth\Helper\OAuthConstants;
class AccessTokenRequestBody
{
    private $clientID;
    private $clientSecret;
    private $grantType;
    private $redirectURL;
    private $code;
    public function __construct($OU, $D4, $XG)
    {
        $this->grantType = $OU;
        $this->redirectURL = $D4;
        $this->code = $XG;
    }
    private function generateRequest()
    {
        $To = ["\162\x65\144\151\x72\x65\x63\x74\137\165\162\151" => $this->redirectURL, "\147\x72\141\x6e\164\x5f\164\x79\160\145" => OAuthConstants::GRANT_TYPE, "\143\x6f\x64\x65" => $this->code];
        return $To;
    }
    public function build()
    {
        $To = $this->generateRequest();
        return $To;
    }
}
