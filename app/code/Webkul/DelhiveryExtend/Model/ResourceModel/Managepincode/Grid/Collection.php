<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Model\ResourceModel\Managepincode\Grid;

use Magento\Framework\Api\Search\SearchResultInterface as ApiSearchResultInterface;
use Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode\Collection as ManagepincodeCollection;
use Magento\Framework\Search\AggregationInterface as SearchAggregationInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb as ResourceModelAbstractDb;

/**
 * Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode\Grid\Collection Class
 * Collection for displaying grid of Manage AWB.
 */
class Collection extends \Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode\Grid\Collection
{
    /**
     * Join store relation table if there is store filter
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        $sellerPinMap = $this->getTable('wk_delhivery_pincode_seller_map');
        $sql = $sellerPinMap.' as spm';
        $cond = 'main_table.pin = spm.pincode';
        $fields = ['seller_id' => 'spm.seller_id'];
        $this->getSelect()->joinLeft($sql, $cond, $fields);
        $this->addFilterToMap('seller_id', 'spm.seller_id');

        $customerGridFlat = $this->getTable('customer_grid_flat');

        $sql = $customerGridFlat.' as cgf';
        $cond = 'spm.seller_id = cgf.entity_id';
        $fields = ['seller_name' => 'cgf.name'];
        $this->getSelect()->joinLeft($sql, $cond, $fields);
        $this->addFilterToMap('seller_name', 'cgf.name');
        parent::_renderFiltersBefore();
    }
}
