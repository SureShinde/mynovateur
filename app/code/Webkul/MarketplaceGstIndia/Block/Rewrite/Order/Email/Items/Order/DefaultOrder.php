<?php
namespace Webkul\MarketplaceGstIndia\Block\Rewrite\Order\Email\Items\Order;

use Magento\Sales\Block\Order\Email\Items\Order\DefaultOrder as OrderDefualt;

class DefaultOrder extends OrderDefualt
{
    public function setTemplate($template) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->get(\Psr\Log\LoggerInterface::class);
        $logger->debug('message template');
        return parent::setTemplate('Webkul_MarketplaceGstIndia::email/items/order/default.phtml');
    }
}