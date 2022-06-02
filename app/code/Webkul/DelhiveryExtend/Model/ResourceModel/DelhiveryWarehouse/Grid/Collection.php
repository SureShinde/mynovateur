<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Model\ResourceModel\DelhiveryWarehouse\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Search\AggregationInterface;
use Webkul\DelhiveryExtend\Model\ResourceModel\DelhiveryWarehouse\Collection as DelhiveryWarehouseCollection;

class Collection extends DelhiveryWarehouseCollection implements SearchResultInterface
{
    /**
     * @var AggregationInterface
     */
    protected $_aggregations;

    /**
     * @param \Magento\Eav\Model\ResourceModel\Entity\AttributeFactory $attributeFactory
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entity
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $event
     * @param \Magento\Store\Model\StoreManagerInterface $store
     * @param [type] $mainTable
     * @param [type] $eventPrefix
     * @param [type] $eventObject
     * @param [type] $resourceModel
     * @param [type] $model
     * @param \Magento\Framework\DB\Adapter\AdapterInterface $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource
     */
    public function __construct(
        \Magento\Eav\Model\ResourceModel\Entity\AttributeFactory $attributeFactory,
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entity,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $event,
        \Magento\Store\Model\StoreManagerInterface $store,
        $mainTable,
        $eventPrefix,
        $eventObject,
        $resourceModel,
        $model = \Magento\Framework\View\Element\UiComponent\DataProvider\Document::class,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {

        parent::__construct($entity, $logger, $fetchStrategy, $event, $connection, $resource);
        $this->attributeFactory = $attributeFactory;
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->_aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     *
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->_aggregations = $aggregations;
    }

    /**
     * Retrieve all ids for collection
     * Backward compatibility with EAV collection.
     *
     * @param int $limitCount
     * @param int $offset
     *
     * @return array
     */
    public function getAllIds($limitCount = null, $offset = null)
    {
        return $this->getConnection()->fetchCol($this->_getAllIdsSelect($limitCount, $offset), $this->_bindParams);
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return $this
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items = null)
    {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     *
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /*protected function _initSelect()
    {
        $this->addFilterToMap("product_qty", "csi.qty");
        parent::_initSelect();
    }*/

    /**
     * Join store relation table if there is store filter.
     */
    protected function _renderFiltersBefore()
    {
        $customerGridFlat = $this->getTable('customer_grid_flat');

        $sql = $customerGridFlat.' as cgf';
        $cond = 'main_table.seller_id = cgf.entity_id';
        $fields = ['seller_name' => 'cgf.name', 'name' => 'main_table.name'];
        $this->getSelect()->join($sql, $cond, $fields);
        $this->addFilterToMap('seller_name', 'cgf.name');
        $this->addFilterToMap('name', 'main_table.name');

        /*$sql = $catalogProductEntityVarchar.' as cpev';
        $cond = 'main_table.product_id = cpev.row_id';
        $fields = ['product_name' => 'value'];
        $this->getSelect()
            ->join($sql, $cond, $fields)
            ->where('cpev.store_id = 0 AND cpev.attribute_id = '.$productAttributeId);
        $this->addFilterToMap('product_name', 'cpev.value');*/

        /*$this->getSelect()->joinLeft(
                $catalogProductEntityDecimal.' as cped',
                'main_table.product_id = cped.row_id and cped.store_id = 0 AND cped.attribute_id = '.$proPriceAttId,
                ["product_price" => "COALESCE(cped.value, 0)"]
            );
        $this->addFilterToMap('product_price', 'COALESCE(cped.value, 0)');*/
        //$this->getSelect()->group('id');
        parent::_renderFiltersBefore();
    }
}
