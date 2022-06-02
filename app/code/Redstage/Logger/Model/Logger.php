<?php
/**
 * Redstage Logger module to log all incoming and outgoing request and responses to and from Magento
 *
 * @category: PHP
 * @package: Redstage/Logger
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Logger
 */
namespace Redstage\Logger\Model;

use Redstage\Logger\Model\ResourceModel\Logger as ResourceData;

/**
 * Class Logger
 * @package Redstage\Logger\Model
 */
class Logger extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceData::class);
    }
}
