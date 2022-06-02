<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class PasswordResetFailedException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\105\122\x52\x4f\122\137\x4f\x43\x43\125\122\122\x45\x44");
        $XG = 116;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\133{$this->code}\135\72\40{$this->message}\xa";
    }
}
