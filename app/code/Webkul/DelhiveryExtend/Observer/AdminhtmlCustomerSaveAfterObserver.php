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
use Webkul\Marketplace\Model\ResourceModel\Seller\CollectionFactory;
use Webkul\Marketplace\Model\ResourceModel\Product\CollectionFactory as ProductCollection;
use Webkul\Marketplace\Model\Product as ProductStatus;

/**
 * Webkul DelhiveryExtend AdminhtmlCustomerSaveAfterObserver Observer.
 */
class AdminhtmlCustomerSaveAfterObserver implements ObserverInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private $messageManager;

    /**
     * @var \Magento\Framework\Json\DecoderInterface
     */
    protected $jsonDecoder;

    /**
     * @var \Webkul\DelhiveryExtend\Model\PinSellerMapFactory
     */
    protected $pinSellerMapFactory;

    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param CollectionFactory $collectionFactory
     * @param \Magento\Framework\Json\DecoderInterface $jsonDecoder
     * @param \Webkul\DelhiveryExtend\Model\PinSellerMapFactory $pinSellerMapFactory
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        CollectionFactory $collectionFactory,
        \Magento\Framework\Json\DecoderInterface $jsonDecoder,
        \Webkul\DelhiveryShipping\Model\ManagepincodeFactory $managePinCodeFactory,
        \Webkul\DelhiveryExtend\Model\PinSellerMapFactory $pinSellerMapFactory
    ) {
        $this->messageManager = $messageManager;
        $this->collectionFactory = $collectionFactory;
        $this->jsonDecoder = $jsonDecoder;
        $this->managePinCodeFactory = $managePinCodeFactory;
        $this->pinSellerMapFactory = $pinSellerMapFactory;
    }

    /**
     * Admin customer save after event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getCustomer();
        $customerid = $customer->getId();
        $postData = $observer->getRequest()->getPostValue();
        if ($this->isSeller($customerid)) {
            $postalCodes = isset($postData['sellerassignpostcodeid']) ? $postData['sellerassignpostcodeid'] : '';
            $sellerId = $customerid;
            if ($postalCodes != '' || $postalCodes != 0) {
                $this->assignPostalCode($sellerId, $postalCodes);
            }
        }
        return $this;
    }

    /**
     * Is Seller
     *
     * @param int $customerId
     * @return boolean
     */
    public function isSeller($customerid)
    {
        $sellerStatus = 0;
        $model = $this->collectionFactory->create()->addFieldToFilter('seller_id', $customerid)
                        ->addFieldToFilter('store_id', 0)->setPageSize(1)->setCurPage(1)->getFirstItem();
        return $model->getEntityId() ? $model->getIsSeller() : 0;
    }

    /**
     * Assign PostalCode
     *
     * @param int $sellerId
     * @param string $postalcodes
     * @return void
     */
    public function assignPostalCode($sellerId, $postalCodes)
    {
        $successMessage = '';
        $postalCodes = array_flip($this->jsonDecoder->decode($postalCodes));
        $postalCodes = $this->managePinCodeFactory->create()->getCollection()
                            ->addFieldToFilter('pincode_id', ['in' => $postalCodes])
                            ->getColumnValues('pin');
        // get all seller's products
        $sellerPostalCodes = $this->pinSellerMapFactory->create()->getCollection()
                                    ->addFieldToFilter('seller_id', $sellerId)
                                    ->getColumnValues('pincode');
        $additionalPostalCodes = array_diff(array_values($postalCodes), array_values($sellerPostalCodes));
        $unAssignPostalCodeIds = array_diff(array_values($sellerPostalCodes), array_values($postalCodes));
        foreach ($additionalPostalCodes as $postalCode) {
            $successMessage = __('Postal Code has been successfully assigned to seller.');
            $item = $this->pinSellerMapFactory->create();
            $item->setSellerId($sellerId)->setPincode($postalCode)->save();
        }

        // remove unassign products from seller
        $this->unAssignPostalCode($sellerId, $unAssignPostalCodeIds);

        if ($successMessage) {
            $this->messageManager->addSuccess($successMessage);
        }
    }

    /**
     * Un AssignPostalCode
     *
     * @param int $sellerId
     * @param string $postalcodes
     * @return void
     */
    public function unAssignPostalCode($sellerId, $postalCodes)
    {
        if (!empty($postalCodes)) {
            $collection = $this->pinSellerMapFactory->create()->getCollection()
                                ->addFieldToFilter('seller_id', $sellerId)
                                ->addFieldToFilter('pincode', ['in'=>$postalCodes]);
            foreach ($collection as $coll) {
                $coll->delete();
            }
        }
    }
}
