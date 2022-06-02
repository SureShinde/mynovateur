<?php

/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */

namespace Redstage\ServiceTicket\Model\ResourceModel;

class ServiceTicket extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

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
        $this->_init('redstage_serviceticket', 'entity_id');
    }

}
