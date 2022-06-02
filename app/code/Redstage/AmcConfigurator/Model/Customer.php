<?php
namespace Redstage\AmcConfigurator\Model;
use Magento\Store\Model\StoreManagerInterface;

class Customer extends \Magento\Framework\Model\AbstractModel
{


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
        $this->_init('Redstage\AmcConfigurator\Model\ResourceModel\Customer');
    }

    /**
     * Prepare nonamclist
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
