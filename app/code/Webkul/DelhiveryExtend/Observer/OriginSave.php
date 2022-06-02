<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Marketplace
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryExtend\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Webkul DelhiveryExtend OriginSave Observer.
 */
class OriginSave implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private $messageManager;

    /**
     * @var \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory
     */
    protected $delhiveryWarehouse;

    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory $delhiveryWarehouse
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Webkul\DelhiveryExtend\Logger\Logger $logger,
        \Webkul\DelhiveryExtend\Helper\Data $helper,
        \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory $delhiveryWarehouse
    ) {
        $this->messageManager = $messageManager;
        $this->countryFactory = $countryFactory;
        $this->customerSession = $customerSession;
        $this->logger = $logger;
        $this->helper = $helper;
        $this->delhiveryWarehouse = $delhiveryWarehouse;
    }

    /**
     * Admin customer save after event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $origin = $observer->getOrigin();
            $street = $origin->getStreet();
            $originData = $origin->getData();
            $warehouse = $this->delhiveryWarehouse->create()->getCollection()
                                ->addFieldToFilter('seller_id', ['eq' => $originData['seller_id']])
                                ->setPageSize(1)->setCurPage(1)->getFirstItem();
            if ($warehouse->getEntityId()) {
                $path = $this->helper->getWarehouseEditUrl();
                $warehouseData = [
                    "phone" => $originData['telephone'],
                    "name" => $originData['company'],
                    "pin" => $originData['postal_code'],
                    "address" => implode(" ",$street),
                    "registered_name" => $warehouse->getName()
                ];
                $warehouseData = $this->helper->createWarehouse(
                    $path,
                    $warehouseData
                );
            } else {
                $path = $this->helper->getWarehouseCreateUrl();
                $warehouse = $this->delhiveryWarehouse->create();
                $countryName = $this->countryFactory->create()
                                    ->loadByCode($originData['country_id'])
                                    ->getName();
                $warehouseData = [
                    "phone" => $originData['telephone'],
                    "city" => $originData['city'],
                    "name" => $originData['company'],
                    "pin" => $originData['postal_code'],
                    "address" => implode(" ",$street),
                    "country" => $countryName,
                    "email" => $this->customerSession->getCustomer()->getEmail(),
                    "registered_name" => $originData['company'],
                    "return_address" => implode(" ",$street),
                    "return_pin" => $originData['postal_code'],
                    "return_city" => $originData['city'],
                    "return_state" => $originData['region'],
                    "return_country" => $countryName
                ];
                $warehouseData = $this->helper->createWarehouse(
                    $path,
                    $warehouseData
                );
            }

            if ($warehouse->getEntityId() && $warehouseData['success']) {
                $warehouse->setName($warehouseData['data']['name']);
                $warehouse->save();
                $this->messageManager->addSuccess(__('Warehouse updated successfully.'));
            } elseif ($warehouseData['success']) {
                $warehouseRecord = [
                    'name' => $warehouseData['data']['name'],
                    'seller_id' => $originData['seller_id']
                ];
                $warehouse->setData($warehouseRecord);
                $warehouse->save();
            } elseif(isset($warehouseData['error']) || isset($warehouseData['message'])) {
                $this->logger->addError('OriginSave '.json_encode($warehouseData));
                $errorMsg = $warehouseData['error'][0] ?? $warehouseData['message'];
                $this->messageManager->addError($errorMsg);
                throw new \Exception($errorMsg);
            }
        } catch (\Exception $e) {
            $this->logger->addError('OriginSave '.$e->getMessage());
            throw new \Exception($e->getMessage());
        }
        return $this;
    }
}
