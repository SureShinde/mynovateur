<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel\BoqConfigurator;

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
        $this->_init('Redstage\BoqConfigurator\Model\BoqConfigurator', 'Redstage\BoqConfigurator\Model\ResourceModel\BoqConfigurator');
    }
}
