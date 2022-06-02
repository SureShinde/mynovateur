<?php
namespace Redstage\BoqConfigurator\Model;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;

class BoqRoombundle extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Room Bundle cache tag
     */
    const CACHE_TAG = 'boq_room_bundle';

    /**#@+
     * Room Bundle's statuses
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
        $this->_init('Redstage\BoqConfigurator\Model\ResourceModel\BoqRoombundle');
    }

    /**
     * Prepare Room Bundle's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
