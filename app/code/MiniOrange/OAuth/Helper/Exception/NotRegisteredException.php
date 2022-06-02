<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class NotRegisteredException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\x4e\x4f\124\137\x52\105\x47\x5f\x45\x52\x52\117\122");
        $XG = 102;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\133{$this->code}\135\72\x20{$this->message}\12";
    }
}
