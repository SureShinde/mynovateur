<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class IncorrectUserInfoDataException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\x49\116\x56\x41\114\x49\x44\x5f\x55\x53\x45\x52\137\111\116\x46\117");
        $XG = 119;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\133{$this->code}\135\72\40{$this->message}\xa";
    }
}
