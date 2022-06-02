<?php

/**
 *  Module Last Price Paid
 *
 * @category  Redstage
 * @package   Redstage_LastPricePaid
 * @author    Mohit Tyagi <mtyagi@redstage.com>
 * @copyright 2008 - 2019 Redstage
 */

namespace Redstage\Services\Model\ResourceModel\Services;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('Redstage\Services\Model\Services', 'Redstage\Services\Model\ResourceModel\Services');
    }

}
