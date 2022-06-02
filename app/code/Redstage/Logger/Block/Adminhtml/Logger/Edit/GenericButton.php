<?php
/**
 * Redstage Logger module to log all incoming and outgoing request and responses to and from Magento
 *
 * @category: PHP
 * @package: Redstage/Logger
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Logger
 */

namespace Redstage\Logger\Block\Adminhtml\Logger\Edit;

use Magento\Backend\Block\Widget\Context;

/**
 * Class GenericButton
 * @package Redstage\Logger\Block\Adminhtml\Logger\Edit
 */
class GenericButton
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Generic Button constructor.
     *
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
