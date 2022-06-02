<?php
/**
 * Redstage Logger module to log all incoming and outgoing request and responses to and from Magento
 *
 * @category: PHP
 * @package: Redstage/Logger
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Logger
 */
namespace Redstage\Logger\Model\ResourceModel\Logger;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Redstage\Logger\Model\ResourceModel\Logger
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Redstage\Logger\Model\Logger', 'Redstage\Logger\Model\ResourceModel\Logger');
    }
}
