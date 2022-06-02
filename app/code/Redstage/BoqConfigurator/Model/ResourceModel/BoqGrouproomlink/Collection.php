<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel\BoqGrouproomlink;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'link_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Redstage\BoqConfigurator\Model\BoqGrouproomlink', 'Redstage\BoqConfigurator\Model\ResourceModel\BoqGrouproomlink');
    }
}
