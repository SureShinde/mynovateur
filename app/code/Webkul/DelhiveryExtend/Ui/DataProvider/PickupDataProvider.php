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
namespace Webkul\DelhiveryExtend\Ui\DataProvider;

use Webkul\DelhiveryExtend\Model\PickupFactory;
use Webkul\Marketplace\Helper\Data as HelperData;

/**
 * Class PickupDataProvider
 */
class PickupDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Delhivery Pickup collection
     *
     * @var \Webkul\DelhiveryExtend\Model\PickupFactory
     */
    protected $collection;

    /**
     * @var HelperData
     */
    public $helperData;

    /**
     * Construct
     *
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param PickupFactory $pickupFactory
     * @param HelperData $helperData
     * @param array $meta = []
     * @param array $data = []
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        PickupFactory $pickupFactory,
        HelperData $helperData,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $sellerId = $helperData->getCustomerId();
        $connection = $pickupFactory->create()->getCollection()->getConnection();
        $collectionData = $pickupFactory->create()->getCollection()
                                ->addFieldToFilter('main_table.seller_id', $sellerId);
        $mpOrderShipment = $connection->getTableName('marketplace_orders_shipments');
        $sql = $mpOrderShipment.' as mos';
        $cond = 'main_table.delhivery_pickup_id = mos.pickup_id';
        $fields = ['entity_id' => 'main_table.entity_id'];
        $collectionData->getSelect()->joinLeft($sql, $cond, $fields);
        $collectionData->addFilterToMap('entity_id', 'main_table.entity_id');

        $mageSalesOrder = $connection->getTableName('sales_order');

        $sql = $mageSalesOrder.' as mso';
        $cond = 'mos.order_id = mso.entity_id';
        $fields = ['increment_id' => new \Zend_Db_Expr('group_concat(`mso`.increment_id)')];
        $collectionData->getSelect()->joinLeft($sql, $cond, $fields);
        $collectionData->addFilterToMap('increment_id', new \Zend_Db_Expr('group_concat(`mso`.increment_id)'));
        $collectionData->getSelect()->group('main_table.delhivery_pickup_id');

        $this->collection = $collectionData;
    }
}
