<?php
namespace Redstage\BoqConfigurator\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\ObjectManager;

class BoqProductgroup extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('boq_product_group', 'id');
    }
}
