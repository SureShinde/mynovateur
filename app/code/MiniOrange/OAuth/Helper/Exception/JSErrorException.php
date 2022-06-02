<?php


namespace MiniOrange\OAuth\Helper\Exception;

class JSErrorException extends \Exception
{
    public function __construct($tI)
    {
        $tI = $tI;
        $XG = 103;
        parent::__construct($tI, $XG, null);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\x5b{$this->code}\x5d\x3a\40{$this->message}\xa";
    }
}
