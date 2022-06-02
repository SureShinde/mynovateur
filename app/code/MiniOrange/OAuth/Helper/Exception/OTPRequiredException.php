<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class OTPRequiredException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\x52\x45\121\125\x49\122\105\104\137\117\124\120");
        $XG = 113;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\x5b{$this->code}\x5d\x3a\x20{$this->message}\12";
    }
}
