<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Model\ResourceModel\Managepincode;

use \Webkul\DelhiveryShipping\Model\ResourceModel\AbstractCollection;

/**
 * Webkul DelhiveryShipping ResourceModel Managepincode collection
 */
class Collection extends \Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode\Collection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Webkul\DelhiveryShipping\Model\Managepincode::class,
            Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode::class
        );
        $this->_map['fields']['seller_id'] = 'spm.seller_id';
        $this->_map['fields']['seller_name'] = 'cgf.seller_name';
    }
}
