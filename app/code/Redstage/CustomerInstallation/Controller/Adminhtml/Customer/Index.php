<?php

/**
 * Redstage CustomerInstallation module purpose admin user can export customer data predifined CSV.
 *
 * @category: PHP
 * @package: Redstage/CustomerInstallation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_CustomerInstallation
 */

namespace Redstage\CustomerInstallation\Controller\Adminhtml\Customer;

class Index extends \Magento\Backend\App\Action
{
        protected $resultPageFactory;
 
    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
 
    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Export'));
        $resultPage->addContent(
            $resultPage->getLayout()->createBlock('Redstage\CustomerInstallation\Block\Adminhtml\Customer\Listing')
        );
        return $resultPage;
    }
}
