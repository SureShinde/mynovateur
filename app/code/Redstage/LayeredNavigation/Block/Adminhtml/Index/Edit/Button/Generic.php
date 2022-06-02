<?php
/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */
  
namespace Redstage\LayeredNavigation\Block\Adminhtml\Index\Edit\Button;
use Magento\Backend\Block\Widget\Context;
/**
 * Class Generic
 */
class Generic
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }
    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}