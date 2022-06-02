<?php
namespace Redstage\Carousel\Block\Adminhtml;

class Slide extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_slide';
        $this->_blockGroup = 'Redstage_Carousel';
        $this->_headerText = __('Redstage Carousel');
        $this->_addButtonLabel = __('Add New');
        parent::_construct();
    }
}

