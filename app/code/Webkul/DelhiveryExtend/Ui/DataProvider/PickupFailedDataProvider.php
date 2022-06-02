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

use Webkul\DelhiveryExtend\Model\ShipmentFactory;
use Webkul\Marketplace\Helper\Data as HelperData;

/**
 * Class PickupDataProvider
 */
class PickupFailedDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
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
     * @param ShipmentFactory $shipmentFactory
     * @param HelperData $helperData
     * @param array $meta = []
     * @param array $data = []
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        ShipmentFactory $shipmentFactory,
        HelperData $helperData,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $sellerId = $helperData->getCustomerId();
        $connection = $shipmentFactory->create()->getCollection()->getConnection();
        $collectionData = $shipmentFactory->create()->getCollection()
                                ->addFieldToFilter('main_table.pickup_id', 0)
                                ->addFieldToFilter('main_table.seller_id', $sellerId);
        $mageSalesOrder = $connection->getTableName('sales_order');

        $sql = $mageSalesOrder.' as mso';
        $cond = 'main_table.order_id = mso.entity_id';
        $fields = ['increment_id' => 'mso.increment_id'];
        $collectionData->getSelect()->joinLeft($sql, $cond, $fields);
        $collectionData->addFilterToMap('increment_id', 'mso.increment_id');
        //$collectionData->getSelect()->group('main_table.delhivery_pickup_id');
        $this->collection = $collectionData;
    }
}
