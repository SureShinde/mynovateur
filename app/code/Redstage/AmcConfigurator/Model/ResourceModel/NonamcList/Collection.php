<?php
namespace Redstage\AmcConfigurator\Model\ResourceModel\NonamcList;

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
        $this->_init('Redstage\AmcConfigurator\Model\NonamcList', 'Redstage\AmcConfigurator\Model\ResourceModel\NonamcList');
    }
}
