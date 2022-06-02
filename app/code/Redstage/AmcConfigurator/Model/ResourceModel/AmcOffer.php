<?php
namespace Redstage\AmcConfigurator\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;

class AmcOffer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('amc_material_offer_price', 'id');
    }
}
