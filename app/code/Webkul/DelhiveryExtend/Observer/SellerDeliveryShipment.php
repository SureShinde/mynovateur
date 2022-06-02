<?php
/**
 * Webkul Software.
 *
 * @category  Webkul_DelhiveryExtend
 *
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Observer;

use Magento\Framework\Event\ObserverInterface;

class SellerDeliveryShipment implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\DataObject $frameworkDataobject
     * @param \Webkul\DelhiveryShipping\Model\Carrier $mpDelhiveryCarrier
     * @param \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\DataObject $frameworkDataobject,
        \Webkul\DelhiveryShipping\Model\Carrier $mpDelhiveryCarrier,
        \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger
    ) {
        $this->messageManager = $messageManager;
        $this->customerSession = $customerSession;
        $this->frameworkDataobject = $frameworkDataobject;
        $this->mpDelhiveryCarrier = $mpDelhiveryCarrier;
        $this->delhiVeryLogger = $delhiVeryLogger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = new \Magento\Framework\DataObject([]);//$this->frameworkDataobject->get();
        $orderId = $observer->getOrderId();
        $request->setOrderId($orderId);
        $request->setSellerShipment(true);
        $request->setSellerId($this->customerSession->getCustomerId());
        $this->mpDelhiveryCarrier->_doShipmentRequest($request);
    }
}
