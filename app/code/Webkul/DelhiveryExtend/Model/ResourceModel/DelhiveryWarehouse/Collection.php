<?php
/**
 * Webkul Software.
 *
 * @category Webkul
 * @package Webkul_DelhiveryExtend
 * @author Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license https://store.webkul.com/license.html
 */


namespace Webkul\DelhiveryExtend\Model\ResourceModel\DelhiveryWarehouse;

/**
 * Collection Class
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'entity_id';

    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            \Webkul\DelhiveryExtend\Model\DelhiveryWarehouse::class,
            \Webkul\DelhiveryExtend\Model\ResourceModel\DelhiveryWarehouse::class
        );
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
        $this->_map['fields']['seller_name'] = 'cgf.name';
        $this->_map['fields']['name'] = 'main_table.name';
    }
}
