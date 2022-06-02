<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel\BoqProductgroup;

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
        $this->_init('Redstage\BoqConfigurator\Model\BoqProductgroup', 'Redstage\BoqConfigurator\Model\ResourceModel\BoqProductgroup');
    }
}
