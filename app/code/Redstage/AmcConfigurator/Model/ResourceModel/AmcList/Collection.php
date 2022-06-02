<?php
namespace Redstage\AmcConfigurator\Model\ResourceModel\AmcList;

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
        $this->_init('Redstage\AmcConfigurator\Model\AmcList', 'Redstage\AmcConfigurator\Model\ResourceModel\AmcList');
    }
}
