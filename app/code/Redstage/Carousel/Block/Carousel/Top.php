<?php
namespace Redstage\Carousel\Block\Carousel;

class Top extends \Redstage\Carousel\Block\Carousel 
{ 
    protected function _construct()
    {
        $this->setTemplate('Redstage_Carousel::carousel/carousel.phtml');
    }

    protected function _toHtml()
    {
        if ($this->_scopeConfig->getValue('carousel/general/after_topnav',\Magento\Store\Model\ScopeInterface::SCOPE_STORE)) {
            return parent::_toHtml();
        }
        return '';
    }
}