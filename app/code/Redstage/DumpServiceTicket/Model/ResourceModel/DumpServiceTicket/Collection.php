<?php

/**
 * Redstage Dump Services Ticket module use to view service ticket log
 *
 * @category: PHP
 * @package: Redstage/DumpServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_DumpServiceTicket
 */

namespace Redstage\DumpServiceTicket\Model\ResourceModel\DumpServiceTicket;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('Redstage\DumpServiceTicket\Model\DumpServiceTicket', 'Redstage\DumpServiceTicket\Model\ResourceModel\DumpServiceTicket');
    }

}
