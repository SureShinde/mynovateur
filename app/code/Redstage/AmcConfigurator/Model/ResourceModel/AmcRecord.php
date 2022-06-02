<?php
namespace Redstage\AmcConfigurator\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;

class AmcRecord extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('redstage_amc_record', 'id');
    }
}
