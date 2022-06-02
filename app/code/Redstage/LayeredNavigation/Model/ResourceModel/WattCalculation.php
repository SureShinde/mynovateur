<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
* @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\Model\ResourceModel;

class WattCalculation extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

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
        $this->_init('redstage_layerednavigation_selection', 'entity_id');
    }

}
