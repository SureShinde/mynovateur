<?php
namespace Redstage\AmcConfigurator\Model;
use Magento\Store\Model\StoreManagerInterface;

class AmcRecord extends \Magento\Framework\Model\AbstractModel
{
    /**
     *  cache tag
     */
    const CACHE_TAG = 'redstage_amc_record';

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
        $this->_init('Redstage\AmcConfigurator\Model\ResourceModel\AmcRecord');
    }
}
