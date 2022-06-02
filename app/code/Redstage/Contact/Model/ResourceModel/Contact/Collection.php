<?php

/**
 * Redstage Contact module use for create contact form in magento side
 *
 * @category: PHP
 * @package: Redstage/Contact
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Contact
 */
namespace Redstage\Contact\Model\ResourceModel\Contact;

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
        $this->_init('Redstage\Contact\Model\Contact', 'Redstage\Contact\Model\ResourceModel\Contact');
    }

}
