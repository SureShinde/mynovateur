<?php

/**
 * Redstage Contact module use for create contact form in magento side
 *
 * @category: PHP
 * @package: Redstage/Contact
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Contact
 */

namespace Redstage\Contact\Model\ResourceModel;

class Contact extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
    \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return void
     */
    protected function _construct() {
        $this->_init('redstage_contact', 'entity_id');
    }

}
