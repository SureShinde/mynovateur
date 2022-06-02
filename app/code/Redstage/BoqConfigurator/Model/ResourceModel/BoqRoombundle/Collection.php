<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel\BoqRoombundle;

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
        $this->_init('Redstage\BoqConfigurator\Model\BoqRoombundle', 'Redstage\BoqConfigurator\Model\ResourceModel\BoqRoombundle');
    }
}
