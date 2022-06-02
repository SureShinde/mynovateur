<?php

/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */


namespace Redstage\ServiceTicket\Controller\Listing;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Redstage\ServiceTicket\Helper\Data;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\UrlInterface;

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
        RedirectFactory $resultRedirectFactory,
        UrlInterface $urlInterface
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->dataHelper = $dataHelper;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->urlInterface = $urlInterface;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {   
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        if ($this->dataHelper->isModuleEnabled() && $this->dataHelper->isCustoemrId()) {
            $resultPage = $this->_pageFactory->create();
            $resultPage->getConfig()->getTitle()->set(__('Service Ticket'));

            $block = $resultPage->getLayout()->getBlock('customer.account.link.back');
            if ($block) {
                $block->setRefererUrl($this->_redirect->getRefererUrl());
            }
            return $resultPage;
        }else{ 
            $url = $this->_redirect->getRefererUrl();

            // Or get any custom url
            //$url = $this->urlInterface->getUrl('my/custom/url');

            // Create login URL
            $login_url = $this->urlInterface
                              ->getUrl('customer/account/login', 
                                    array('referer' => base64_encode($url))
                                );

            // Redirect to login URL
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setUrl($login_url);
            return $resultRedirect;
        }
    }
}
