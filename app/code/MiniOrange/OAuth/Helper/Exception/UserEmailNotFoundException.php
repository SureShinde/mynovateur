<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class UserEmailNotFoundException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\105\x4d\101\111\114\137\x41\124\124\x52\x49\102\125\x54\105\137\x4e\117\124\137\122\x45\124\x55\x52\x4e\105\x44");
        $XG = 120;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\135\72\40{$this->message}\12";
    }
}
