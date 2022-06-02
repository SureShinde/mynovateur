<?php
namespace Redstage\AmcConfigurator\Model;
use Magento\Store\Model\StoreManagerInterface;

class AmcList extends \Magento\Framework\Model\AbstractModel
{
    /**
     *  cache tag
     */
    const CACHE_TAG = 'amc_customer_data';

    /**#@+
     *  statuses
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
        $this->_init('Redstage\AmcConfigurator\Model\ResourceModel\AmcList');
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
