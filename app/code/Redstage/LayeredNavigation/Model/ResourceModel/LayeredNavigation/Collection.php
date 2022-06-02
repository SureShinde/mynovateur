<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
* @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\Model\ResourceModel\LayeredNavigation;

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
        $this->_init('Redstage\LayeredNavigation\Model\LayeredNavigation', 'Redstage\LayeredNavigation\Model\ResourceModel\LayeredNavigation');
    }

}
