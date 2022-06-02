<?php
namespace Redstage\AmcConfigurator\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;

class NonamcList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('non_amc_tracking', 'id');
    }
}
