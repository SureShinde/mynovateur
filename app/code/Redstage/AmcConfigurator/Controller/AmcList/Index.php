<?php

namespace Redstage\AmcConfigurator\Controller\AmcList;

use Magento\Customer\Model\Session;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(

        Context $context,
        Session $customerSession,
        UrlInterface $urlInterface,
        PageFactory $pageFactory
    ) {

        $this->customerSession = $customerSession;
        $this->urlInterface = $urlInterface;
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }

    public function execute()

    {
        //Redirect to login page if customer is not logged in
        /*if (!$this->customerSession->isLoggedIn()) {
            $this->customerSession->setAfterAuthUrl($this->urlInterface->getCurrentUrl());
            $this->customerSession->authenticate();
        }*/
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('MY AMC');
        return $resultPage;
    }
}
