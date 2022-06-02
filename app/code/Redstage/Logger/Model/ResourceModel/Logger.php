<?php
/**
 * Redstage Logger module to log all incoming and outgoing request and responses to and from Magento
 *
 * @category: PHP
 * @package: Redstage/Logger
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Logger
 */
namespace Redstage\Logger\Model\ResourceModel;

/**
 * Class Logger
 * @package Redstage\Logger\Model\ResourceModel
 */
class Logger extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('redstage_api_logs', 'id');
    }
}


