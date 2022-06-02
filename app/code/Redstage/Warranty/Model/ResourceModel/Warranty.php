<?php

/**
 * Redstage Warranty module use for create warranty form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Warranty
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Warranty
 */

namespace Redstage\Warranty\Model\ResourceModel;

class Warranty extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

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
        $this->_init('redstage_warranty', 'entity_id');
    }

}
