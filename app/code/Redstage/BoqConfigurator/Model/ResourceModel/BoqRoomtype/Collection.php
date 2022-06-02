<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel\BoqRoomtype;

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
        $this->_init('Redstage\BoqConfigurator\Model\BoqRoomtype', 'Redstage\BoqConfigurator\Model\ResourceModel\BoqRoomtype');
    }
}
