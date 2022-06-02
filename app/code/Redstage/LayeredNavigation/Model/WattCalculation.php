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

class WattCalculation extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {

    const CACHE_TAG = 'redstage_layerednavigation_selection';

    protected function _construct() {
        $this->_init('Redstage\LayeredNavigation\Model\ResourceModel\WattCalculation');
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
