<?php

/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Services
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Services
 */

namespace Redstage\Services\Model;

class Services extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {

    const CACHE_TAG = 'redstage_service';

    protected function _construct() {
        $this->_init('Redstage\Services\Model\ResourceModel\Services');
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
