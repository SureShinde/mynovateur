<?php
namespace Redstage\Carousel\Model;

class Slide extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'redstage_carousel_slide';

    protected function _construct()
    {
        $this->_init('Redstage\Carousel\Model\ResourceModel\Slide');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
     public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}