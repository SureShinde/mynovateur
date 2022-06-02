<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
* @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\Model;

class LayeredNavigation extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {

    const CACHE_TAG = 'redstage_layerednavigation';

    protected function _construct() {
        $this->_init('Redstage\LayeredNavigation\Model\ResourceModel\LayeredNavigation');
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
