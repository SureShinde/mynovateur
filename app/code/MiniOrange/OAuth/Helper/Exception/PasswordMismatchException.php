<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class PasswordMismatchException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\120\101\123\x53\137\115\x49\123\115\x41\x54\103\x48");
        $XG = 122;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\x5b{$this->code}\x5d\x3a\40{$this->message}\12";
    }
}
