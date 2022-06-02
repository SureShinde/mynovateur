<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class NoIdentityProviderConfiguredException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\x4e\117\x5f\x49\104\x50\x5f\x43\x4f\116\106\111\107");
        $XG = 101;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\x5d\72\x20{$this->message}\12";
    }
}
