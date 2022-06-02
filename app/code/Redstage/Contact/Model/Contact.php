<?php

/**
 * Redstage Contact module use for create contact form in magento side
 *
 * @category: PHP
 * @package: Redstage/Contact
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Contact
 */

namespace Redstage\Contact\Model;

class Contact extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {

    const CACHE_TAG = 'redstage_contact';

    protected function _construct() {
        $this->_init('Redstage\Contact\Model\ResourceModel\Contact');
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
