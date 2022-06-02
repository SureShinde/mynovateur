<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class PasswordStrengthException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\x49\116\126\x41\114\111\104\x5f\x50\101\123\x53\137\123\x54\122\105\x4e\107\124\110");
        $XG = 110;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\133{$this->code}\x5d\72\40{$this->message}\12";
    }
}
