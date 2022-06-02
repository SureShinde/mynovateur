<?php


namespace MiniOrange\OAuth\Helper\Exception;

use MiniOrange\OAuth\Helper\OAuthMessages;
class MissingAttributesException extends \Exception
{
    public function __construct()
    {
        $tI = OAuthMessages::parse("\115\111\123\123\x49\x4e\x47\137\101\x54\124\122\111\102\x55\x54\105\x53\x5f\105\130\103\x45\120\124\x49\x4f\116");
        $XG = 125;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\135\x3a\40{$this->message}\xa";
    }
}
