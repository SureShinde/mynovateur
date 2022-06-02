<?php
namespace Redstage\CustomCreditmemo\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Reference extends AbstractDb
{
    /** @var string Main table name */
    const MAIN_TABLE = 'sales_creditmemo';

    const PAY_REFERENCE_ID = 'pay_reference_id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::PAY_REFERENCE_ID);
    }
}
?>