<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class OTPValidationFailedException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\111\x4e\x56\101\114\111\x44\x5f\x4f\x54\120");
        $XG = 114;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\x5b{$this->code}\135\x3a\40{$this->message}\12";
    }
}
