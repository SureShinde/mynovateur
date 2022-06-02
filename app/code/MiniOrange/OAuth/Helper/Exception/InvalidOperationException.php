<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class InvalidOperationException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\111\116\x56\101\114\111\104\x5f\117\x50");
        $XG = 105;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\133{$this->code}\x5d\72\x20{$this->message}\12";
    }
}
