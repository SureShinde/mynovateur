<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class RegistrationRequiredFieldsException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\x52\105\121\125\x49\122\x45\104\x5f\x52\105\x47\x49\123\124\122\x41\x54\x49\x4f\116\x5f\x46\x49\x45\x4c\104\123");
        $XG = 111;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\x5d\x3a\40{$this->message}\xa";
    }
}
