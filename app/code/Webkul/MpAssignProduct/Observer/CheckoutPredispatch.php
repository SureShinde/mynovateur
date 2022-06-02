<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 *
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MpAssignProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class CheckoutPredispatch implements ObserverInterface
{
    public function __construct(
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Webkul\MpAssignProduct\Helper\Data $helper,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
        $this->helper = $helper;
        $this->responseFactory = $responseFactory;
        $this->url = $url;
        $this->redirect = $redirect;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->helper->checkQuoteValidity()) {
            $this->messageManager->addError(__("The cart is invalid."));
            $url = $this->url->getUrl('checkout/cart');
            $this->responseFactory->create()->setRedirect($url)->sendResponse();
            die();
        }
    }
}