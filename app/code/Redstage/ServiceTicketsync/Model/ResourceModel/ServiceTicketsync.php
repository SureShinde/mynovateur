<?php
/**
 * Redstage Services Ticket sync module use for update service ticket status in bulk and base on magento side created ticket from SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicketsync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicketsync
 */

namespace Redstage\ServiceTicketsync\Model\ResourceModel;

class ServiceTicketsync extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

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
