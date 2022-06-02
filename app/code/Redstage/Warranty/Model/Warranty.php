<?php

/**
 * Redstage Warranty module use for create warranty form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Warranty
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Warranty
 */

namespace Redstage\Warranty\Model;

class Warranty extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {

    const CACHE_TAG = 'redstage_warranty';

    protected function _construct() {
        $this->_init('Redstage\Warranty\Model\ResourceModel\Warranty');
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
