<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Redstage\BoqConfigurator\Controller\Boq;


/**
 * Boq quotes page controller.
 */
class Quote extends \Magento\Framework\App\Action\Action 
{
    public function __construct(
       \Magento\Framework\App\Action\Context $context
    )
    {
       return parent::__construct($context);
    }
    /**
     * Index action
     *
     */
    public function execute()
    {
      //echo "Module Created Successfully";
      $this->_view->loadLayout();
      $this->_view->renderLayout();
    }
}
