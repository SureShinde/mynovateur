<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class InvalidPhoneException extends \Exception
{
    public function __construct($ZW)
    {
        $tI = OAuthMessages::parse("\105\122\x52\117\122\x5f\120\x48\117\116\x45\x5f\x46\x4f\122\x4d\101\x54", ["\160\150\x6f\156\145" => $ZW]);
        $XG = 112;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\x5b{$this->code}\x5d\72\x20{$this->message}\xa";
    }
}
