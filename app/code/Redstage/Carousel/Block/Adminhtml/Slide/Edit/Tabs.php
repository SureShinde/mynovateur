<?php
namespace Redstage\Carousel\Block\Adminhtml\Slide\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('slide_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Slide Information'));
    }
}
