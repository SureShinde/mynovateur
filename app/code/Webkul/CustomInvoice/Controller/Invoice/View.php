<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomInvoice
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\CustomInvoice\Controller\Invoice;

/**
 * Webkul Marketplace Order View Controller.
 */
class View extends \Webkul\Marketplace\Controller\Order
{
    /**
     * Seller Order View page.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $helper = $this->helper;
        $isPartner = $helper->isSeller();
        if ($isPartner == 1) {
            if ($order = $this->_initOrder()) {
                /*update notification flag*/
                $this->_updateNotification();
                /** @var \Magento\Framework\View\Result\Page $resultPage */
                $resultPage = $this->_resultPageFactory->create();
                if ($helper->getIsSeparatePanel()) {
                    $resultPage->addHandle('custominvoice_layout2_invoice_view');
                }
                $resultPage->getConfig()->getTitle()->set(
                    __('Order #%1', $order->getRealOrderId())
                );

                return $resultPage;
            } else {
                return $this->resultRedirectFactory->create()->setPath(
                    '*/*/history',
                    ['_secure' => $this->getRequest()->isSecure()]
                );
            }
        } else {
            return $this->resultRedirectFactory->create()->setPath(
                'marketplace/account/becomeseller',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        }
    }
}
