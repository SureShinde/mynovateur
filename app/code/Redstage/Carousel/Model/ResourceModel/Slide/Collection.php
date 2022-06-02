<?php
namespace Redstage\Carousel\Model\ResourceModel\Slide;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Redstage\Carousel\Model\Slide','Redstage\Carousel\Model\ResourceModel\Slide');
    }
}


