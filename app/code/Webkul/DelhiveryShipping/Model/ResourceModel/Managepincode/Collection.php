<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode;

use \Webkul\DelhiveryShipping\Model\ResourceModel\AbstractCollection;

/**
 * Webkul DelhiveryShipping ResourceModel Managepincode collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'pincode_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Webkul\DelhiveryShipping\Model\Managepincode', 'Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode');
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }
}
