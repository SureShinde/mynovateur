<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class InvalidIdentityProviderException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\111\x4e\x56\x41\x4c\111\104\x5f\x49\x44\x50");
        $XG = 119;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\135\72\x20{$this->message}\xa";
    }
}
