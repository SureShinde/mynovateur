<?php

/**
 * Redstage Dump Services Ticket module use to view service ticket log
 *
 * @category: PHP
 * @package: Redstage/DumpServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_DumpServiceTicket
 */

namespace Redstage\DumpServiceTicket\Model;

class DumpServiceTicket extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {

    const CACHE_TAG = 'redstage_dump_serviceticket';

    protected function _construct() {
        $this->_init('Redstage\DumpServiceTicket\Model\ResourceModel\DumpServiceTicket');
    }
    
    /**
     *
     * @return array
     */
    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    /**
     *
     * @return array
     */
    public function getDefaultValues() {
        $values = [];

        return $values;
    }

}
