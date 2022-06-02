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


namespace Webkul\DelhiveryExtend\Model\ResourceModel\PinSellerMap;

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
        $this->_init("Webkul\DelhiveryExtend\Model\PinSellerMap", "Webkul\DelhiveryExtend\Model\ResourceModel\PinSellerMap");
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }


}

