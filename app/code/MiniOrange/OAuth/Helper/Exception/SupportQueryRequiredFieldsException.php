<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class SupportQueryRequiredFieldsException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\122\105\121\x55\x49\122\105\104\x5f\x51\125\105\122\x59\x5f\106\111\105\114\x44\123");
        $XG = 109;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\133{$this->code}\x5d\x3a\40{$this->message}\12";
    }
}
