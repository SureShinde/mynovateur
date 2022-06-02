<?php
/**
 * Redstage OrderInstallation module purpose admin user can export order data predifined CSV only shipment created order data.
 *
 * @category: PHP
 * @package: Redstage/OrderInstallation
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Mohit Tyagi <mtyagi@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_OrderInstallation
 */

namespace Redstage\OrderInstallation\Controller\Adminhtml\Orders;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    
    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_OrderInstallation::orderonstallation');
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Redstage_OrderInstallation::orderonstallation');
        $resultPage->getConfig()->getTitle()->prepend(__('Order Export'));
        $resultPage->addContent(
            $resultPage->getLayout()->createBlock('Redstage\OrderInstallation\Block\Adminhtml\Orders\Listing')
        );

        return $resultPage;
    }
}
