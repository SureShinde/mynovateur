<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class AccountAlreadyExistsException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\101\103\103\x4f\125\116\124\137\x45\130\111\123\124\x53");
        $XG = 108;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\135\72\x20{$this->message}\xa";
    }
}
