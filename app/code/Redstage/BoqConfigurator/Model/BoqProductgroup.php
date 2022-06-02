<?php
namespace Redstage\BoqConfigurator\Model;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;

class BoqProductgroup extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Contact cache tag
     */
    const CACHE_TAG = 'boq_product_group';

    /**#@+
     * Contact's statuses
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
        $this->_init('Redstage\BoqConfigurator\Model\ResourceModel\BoqProductgroup');
    }

    /**
     * Prepare Contact's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
