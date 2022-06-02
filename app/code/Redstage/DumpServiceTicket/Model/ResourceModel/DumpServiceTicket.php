<?php

/**
 * Redstage Dump Services Ticket module use to view service ticket log
 *
 * @category: PHP
 * @package: Redstage/DumpServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_DumpServiceTicket
 */

namespace Redstage\DumpServiceTicket\Model\ResourceModel;

class DumpServiceTicket extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

    /**
     * @var \Magento\Eav\Model\Entity\Attribute
     */
    public $_attributeValue;

    public function __construct(
    \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct() {
        $this->_init('redstage_dump_serviceticket', 'entity_id');
    }

}
