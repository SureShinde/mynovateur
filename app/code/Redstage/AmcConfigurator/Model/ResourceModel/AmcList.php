<?php
namespace Redstage\AmcConfigurator\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;

class AmcList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('amc_customer_data', 'id');
    }
}
