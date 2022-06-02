<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel\RangeConfig;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Redstage\BoqConfigurator\Model\RangeConfig', 'Redstage\BoqConfigurator\Model\ResourceModel\RangeConfig');
    }
}
