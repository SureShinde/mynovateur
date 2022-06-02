<?php

/**
 * Redstage Warranty module use for create warranty form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Warranty
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Warranty
 */

namespace Redstage\Warranty\Controller\Adminhtml\Listing;

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
        $resultPage->getConfig()->getTitle()->prepend(__('Warranty Logs'));
        return $resultPage;
    }
}
