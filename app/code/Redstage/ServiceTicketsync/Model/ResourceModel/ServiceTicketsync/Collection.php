<?php
/**
 * Redstage Services Ticket sync module use for update service ticket status in bulk and base on magento side created ticket from SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicketsync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicketsync
 */

namespace Redstage\ServiceTicketsync\Model\ResourceModel\ServiceTicketsync;

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
        $this->_init('Redstage\ServiceTicketsync\Model\ServiceTicketsync', 'Redstage\ServiceTicketsync\Model\ResourceModel\ServiceTicketsync');
    }

}
