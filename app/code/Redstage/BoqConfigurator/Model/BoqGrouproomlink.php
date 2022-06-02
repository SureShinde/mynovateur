<?php
namespace Redstage\BoqConfigurator\Model;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;

class BoqGrouproomlink extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Product Group Qty cache tag
     */
    const CACHE_TAG = 'boq_product_group_room_qty_link';

    /**#@+
     * Product Group Qty statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Redstage\BoqConfigurator\Model\ResourceModel\BoqGrouproomlink');
    }

    
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
