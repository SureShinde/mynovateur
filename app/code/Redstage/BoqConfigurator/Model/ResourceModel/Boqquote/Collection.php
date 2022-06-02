<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel\Boqquote;

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
        $this->_init('Redstage\BoqConfigurator\Model\Boqquote', 'Redstage\BoqConfigurator\Model\ResourceModel\Boqquote');
    }
}
