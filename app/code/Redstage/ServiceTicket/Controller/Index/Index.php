<?php 

/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */

namespace Redstage\ServiceTicket\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Redstage\ServiceTicket\Helper\Data;
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
     * ServiceTicket constructor.
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
        if ($this->dataHelper->isModuleEnabled() && $this->dataHelper->isCustoemrId()) {
            $resultPage = $this->_pageFactory->create();
            $resultPage->getConfig()->getTitle()->set(__("Service Ticket"));
            return $resultPage;
        }else{
            $resultRedirect = $this->resultRedirectFactory->create();
            $url = $this->_redirect->getRefererUrl();

            $resultRedirect->setUrl($url);
            return $resultRedirect;
        }
    }
}