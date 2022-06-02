<?php
namespace Redstage\Carousel\Model\ResourceModel;
class Slide extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('redstage_carousel_slide','slide_id');
    }
}