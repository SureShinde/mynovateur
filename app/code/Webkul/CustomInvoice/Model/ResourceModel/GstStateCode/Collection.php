<?php
/**
 * Webkul Software.
 *
 * @category Webkul
 * @package Webkul_CustomInvoice
 * @author Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license https://store.webkul.com/license.html
 */


namespace Webkul\CustomInvoice\Model\ResourceModel\GstStateCode;

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
            \Webkul\CustomInvoice\Model\GstStateCode::class,
            \Webkul\CustomInvoice\Model\ResourceModel\GstStateCode::class
        );
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
        $this->_map['fields']['state_code'] = 'main_table.state_code';
        $this->_map['fields']['state_name'] = 'crt.default_name';
        $this->_map['fields']['region_code'] = 'crt.code';
        $this->_map['fields']['country_code'] = 'main_table.country_code';
    }


}
