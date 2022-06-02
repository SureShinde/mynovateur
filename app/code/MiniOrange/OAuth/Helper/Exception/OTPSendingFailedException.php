<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class OTPSendingFailedException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\x45\x52\122\117\x52\x5f\123\105\116\x44\x49\x4e\107\x5f\x4f\x54\120");
        $XG = 115;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\135\72\x20{$this->message}\12";
    }
}
