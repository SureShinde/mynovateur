<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
 * @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */
 
namespace Redstage\LayeredNavigation\Block;

use Magento\Framework\View\Element\Template;

class Navigation extends Template
{

    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    public function getLayeredCustom()
    {
      return 'Hello World';
    }
}