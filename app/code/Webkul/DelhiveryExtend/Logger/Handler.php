<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryExtend\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    public $loggerType = Logger::INFO;

    /**
     * File name
     * @var string
     */
    public $fileName = '/var/log/delhiveryextend.log';
}
