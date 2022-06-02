<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomInvoice
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\CustomInvoice\Model\ResourceModel\GstStateCode\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Search\AggregationInterface;
use Webkul\CustomInvoice\Model\ResourceModel\GstStateCode\Collection as GstStateCodeCollection;

class Collection extends GstStateCodeCollection implements SearchResultInterface
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
        $countryRegion = $this->getTable('directory_country_region');

        $sql = $countryRegion.' as crt';
        $cond = 'main_table.state_code = crt.region_id';
        $fields = [
            'entity_id' => 'main_table.entity_id',
            'state_code' => 'main_table.state_code',
            'state_name' => 'crt.default_name',
            'region_code' => 'crt.code',
            'country_code' => 'main_table.country_code'
        ];
        $this->getSelect()->join($sql, $cond, $fields);
        $this->addFilterToMap('entity_id', 'main_table.entity_id');
        $this->addFilterToMap('state_code', 'main_table.state_code');
        $this->addFilterToMap('state_name', 'crt.default_name');
        $this->addFilterToMap('region_code', 'crt.code');
        $this->addFilterToMap('country_code', 'main_table.country_code');
        parent::_renderFiltersBefore();
    }
}
