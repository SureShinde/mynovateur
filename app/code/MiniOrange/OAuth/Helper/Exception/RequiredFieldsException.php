<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class RequiredFieldsException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\122\105\x51\125\111\x52\105\104\x5f\x46\x49\x45\x4c\104\123");
        $XG = 104;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\133{$this->code}\x5d\72\40{$this->message}\xa";
    }
}
