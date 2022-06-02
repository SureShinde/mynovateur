<?php


namespace MiniOrange\OAuth\Helper;

class MoCurl extends \Magento\Framework\HTTP\Adapter\Curl
{
    protected $_header;
    protected $_body;
    public function __construct()
    {
        $rI = \Magento\Framework\App\ObjectManager::getInstance();
        $xu = $rI->get("\115\141\x67\145\156\x74\x6f\134\106\162\141\155\x65\167\x6f\162\x6b\x5c\101\x70\x70\134\x50\162\157\x64\165\x63\x74\115\x65\164\141\144\141\164\141\111\x6e\164\x65\x72\146\141\143\x65");
        $Ux = $xu->getVersion();
        if (!($Ux < 2.2)) {
            goto TV;
        }
        parent::__construct();
        TV:
        $this->_config["\166\x65\162\151\146\x79\160\145\x65\x72"] = false;
        $this->_config["\166\145\x72\151\146\x79\150\157\163\x74"] = false;
        $this->_config["\x68\145\x61\x64\145\162"] = false;
    }
}
