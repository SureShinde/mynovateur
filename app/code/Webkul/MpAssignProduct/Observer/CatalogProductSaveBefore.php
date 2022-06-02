<?php
namespace Webkul\MpAssignProduct\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class CatalogProductSaveBefore implements ObserverInterface
{
    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        try {
            $quantityAndStockStatus = ['use_config_manage_stock'=>0, 'manage_stock'=>0];
            $observer->getProduct()->setData('stock_data', $quantityAndStockStatus);
        } catch (\Exception $e) {
        }
        return $this;

    }
}