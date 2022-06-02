<?php 

/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Services
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Services
 */

namespace Redstage\Services\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Redstage\Services\Helper\Data;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
    * @var Data
    */
    protected $dataHelper;

    /**
    * @var RedirectFactory
    */
    protected $resultRedirectFactory;
    
    
    /**
     * Services constructor.
     * @param Context $context
     * @param PageFactory $_pageFactory
     * @param Data $dataHelper
     * @param RedirectFactory $resultRedirectFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $dataHelper,
        RedirectFactory $resultRedirectFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->dataHelper = $dataHelper;
        $this->resultRedirectFactory = $resultRedirectFactory;
        return parent::__construct($context);
    }
    

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if ($this->dataHelper->isModuleEnabled()) {
            $resultPage = $this->_pageFactory->create();
            $resultPage->getConfig()->getTitle()->set(__("Service Call"));
            return $resultPage;
        }else{
            $resultRedirect = $this->resultRedirectFactory->create();
            $url = $this->_redirect->getRefererUrl();

            $resultRedirect->setUrl($url);
            return $resultRedirect;
        }
    }
}