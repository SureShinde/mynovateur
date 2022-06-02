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
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Webkul\Marketplace\Helper\Data as HelperData;

class UploadPostalData implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger,
        \Webkul\DelhiveryExtend\Model\PinSellerMapFactory $pinSellerMapFactory,
        \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Webkul\DelhiveryExtend\Helper\Data $helper,
        \Magento\Framework\File\Csv $csvReader,
        \Webkul\Marketplace\Model\ResourceModel\Seller\CollectionFactory $sellerCollection,
        Filesystem $filesystem,
        HelperData $helperData
    ) {
        $this->messageManager = $messageManager;
        $this->delhiVeryLogger = $delhiVeryLogger;
        $this->pinSellerMapFactory = $pinSellerMapFactory;
        $this->itemsFactory   = $itemsFactory;
        $this->associates = $associatesFactory;
        $this->_productRepository = $productRepository;
        $this->helper = $helper;
        $this->helperData = $helperData;
        $this->csvReader = $csvReader;
        $this->sellerCollection = $sellerCollection;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->filesystem = $filesystem ?: \Magento\Framework\App\ObjectManager::getInstance()
                                                                        ->create(Filesystem::class);
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->helper->checkToUpload()) {
            $config = 'mpassignproduct/postal_code/postal_code_file';
            $filepath = $this->helper->getPostalFileData($config);
            $directoryPath = $this->filesystem->getDirectoryRead(
                \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
            )->getAbsolutePath('upload/'.$filepath);
            $sellerNotAvl = [];
            $postalData = $this->csvReader->getData($directoryPath);
            array_shift($postalData); // removing heading from csv
            $mappedRecord = 0;
            $duplicateRecord = 0;
            foreach ($postalData as $data) {
                $sellerIds = array_map('trim', explode(',', $data[1]));
                $validSellers = $this->getValidSellerList($sellerIds);
                $invalidSeller = array_diff($sellerIds, $validSellers);
                if (!empty($validSellers)) {
                    foreach ($validSellers as $sellerId) {
                        $item = $this->pinSellerMapFactory->create();
                        try {
                            $item->setSellerId($sellerId);
                            $item->setPincode(trim($data[0]));
                            $item->save();
                            $mappedRecord++;
                        } catch (\Exception $e) {
                            $duplicateRecord++;
                        }
                    }
                }
                $sellerNotAvl = array_merge($sellerNotAvl, $invalidSeller);
            }
            if ($mappedRecord) {
                $this->messageManager->addSuccess(__('Total %1 Postal data mapped.', $mappedRecord));
            }
            if ($duplicateRecord) {
                $this->messageManager->addError(__('%1 postal data not mapped due to duplicity.', $duplicateRecord));
            }
            if (!empty($sellerNotAvl)) {
                $this->messageManager->addNotice(
                    __('Not exist seller id : %1.',
                    implode(', ', array_unique($sellerNotAvl)))
                );
            }
            $path = 'mpassignproduct/postal_code/enable_upload';
            $this->helper->setCheckToDefault($path);
        }

        if ($this->helper->checkToUploadMassProductAssign()) {
            $this->createMassProductAssign();
        }
        $this->helperData->clearCache();
    }

    /**
     * Create Mass ProductAssign
     */
    private function createMassProductAssign()
    {
        $config = 'mpassignproduct/seller_product_assign/seller_product_assign_file';
        $filepath = $this->helper->getPostalFileData($config);
        $directoryPath = $this->filesystem->getDirectoryRead(
            \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
        )->getAbsolutePath('upload/'.$filepath);
        $sellerNotAvl = [];
        $csvData = $this->csvReader->getData($directoryPath);
        array_shift($csvData); // removing heading from csv
        $savedProduct = 0;
        $unSavedProduct = 0;
        $notFoundProduct = 0;
        $sellerNotFound = [];
        $duplicateRecord = 0;
            foreach ($csvData as $data) {
                $productsku = $data[0];
                try {
                    $productInfo = $this->_productRepository->get($productsku);
                    $productId = $productInfo->getEntityId();
                    if ($productInfo->getEntityId()) {
                        $sellerIds = explode(",", $data[3]);
                        foreach ($sellerIds as $sellerId) {
                            $sellerInfo = $this->helperData->getSellerCollectionObj($sellerId);
                            if ($sellerInfo->getSize()) {
                                $productType = $productInfo->getTypeId();
                                $associatedProductParentId = $this->helper->getParentIdsByChild($productId);
                                if ($associatedProductParentId) {
                                    $collection = $this->checkForProductInAssignedItem($associatedProductParentId, $sellerId);
                                    $itemId = 0;
                                    $flag = false;
                                    if ($collection->getSize()) {
                                        foreach ($collection as $item) {
                                            $itemId = $item->getId();
                                        }
                                    } else {
                                        $item = $this->itemsFactory->create();
                                        $item->setProductId($associatedProductParentId);
                                        $item->setSellerId($sellerId);
                                        if ($item->save()) {
                                            $itemId = $item->getId();
                                            $flag = $this->addAssociatedProducts($itemId, $associatedProductParentId, $productId, $data);
                                            $flag ? $savedProduct++ : $unSavedProduct++;
                                        }
                                    }

                                    if ($itemId && !$flag) {
                                        $this->updateAssociatedProduct($itemId, $associatedProductParentId, $productId, $data) ? $savedProduct++ : $unSavedProduct++;
                                    }
                                }
                                else if ($productType == 'simple') {
                                    $collection = $this->checkForProductInAssignedItem($productId, $sellerId);
                                    if ($collection->getSize()) {
                                        foreach ($collection as $item) {
                                            $this->updateRecord($data, $item) ? $savedProduct++ : $unSavedProduct++;
                                        }
                                    } else {
                                        $this->createNewRecord($data, $productId, $sellerId) ? $savedProduct++ : $unSavedProduct++;
                                    }
                                }
                            }
                            else {
                                 array_push($sellerNotFound, $sellerId);
                            }
                        }
                    }
                } catch (\Exception $e) {
                    $e->getMessage() == 'Unique constraint violation found' ? $duplicateRecord ++ : $notFoundProduct++;
                }
            }
            if ($savedProduct) {
              $this->messageManager->addSuccess(__(' %1 Product(s) mapped.', $savedProduct));
            }
            if ($unSavedProduct) {
                $this->messageManager->addSuccess(__(' Unable to map %1 product(s).', $unSavedProduct));
            }
            if ($notFoundProduct) {
              $this->messageManager->addNotice(__(' %1 Product(s) not found.', $notFoundProduct));
            }

            if (!empty($sellerNotFound)) {
                $this->messageManager->addNotice(__(' Seller(s) not found with Id : %1', implode(', ', array_unique($sellerNotFound))));
            }

            if ($duplicateRecord) {
                $this->messageManager->addSuccess(__('%1 duplicate record(s) found.', $duplicateRecord));
            }

            $path = 'mpassignproduct/seller_product_assign/enable_product_assign_upload';
            $this->helper->setCheckToDefault($path);
    }

    /**
     * Create NewRecord
     *
     * @param array $data
     * @param int $productId
     * @param int $sellerId
     * @return boolean
     */
    private function createNewRecord($data, $productId, $sellerId)
    {
        $item = $this->itemsFactory->create();
        $item->setProductId($productId);
        $item->setSellerId($sellerId);
        $item->setQty($data[1]);
        $item->setPrice($data[2]);
        if ($item->save()) {
            return true;
        }
        return false;
    }

    /**
     * Update Record
     *
     * @param array $data
     * @param \Webkul\MpAssignProduct\Model\Items $item
     * @return boolean
     */
    private function updateRecord($data, $item)
    {
        $item->setQty($data[1]);
        $item->setPrice($data[2]);
        if ($item->save()) {
            return true;
        }
        return false;
    }

    /**
     * Update Associated Product
     *
     * @param int $itemId
     * @param int $parenProductId
     * @param int $productId
     * @param array $data
     * @return boolean
     */
    private function updateAssociatedProduct($itemId, $parenProductId, $productId, $data)
    {
        $collection =  $this->associates->create()->getCollection()
                                ->addFieldToFilter('parent_product_id', $parenProductId)
                                ->addFieldToFilter('product_id', $productId)
                                ->addFieldToFilter('parent_id', $itemId);
        if ($collection->getSize()) {
            foreach ($collection as $item) {
                $item->setQty($data[1]);
                $item->setPrice($data[2]);
                if ($item->save()) {
                    return true;
                }
            }
            return false;
        } else {
            return $this->addAssociatedProducts($itemId, $parenProductId, $productId, $data);
        }
    }

    /**
     * Add Associated Products
     *
     * @param int $itemId
     * @param int $parenProductId
     * @param int $productId
     * @param array $data
     * @return boolean
     */
    private function addAssociatedProducts($itemId, $parenProductId, $productId, $data)
    {
        $item = $this->associates->create();
        $item->setParentId($itemId);
        $item->setParentProductId($parenProductId);
        $item->setProductId($productId);
        $item->setQty($data[1]);
        $item->setPrice($data[2]);
        if ($item->save()) {
            return true;
        }
        return false;
    }

    /**
     * Check For ProductIn AssignedItem
     *
     * @param int $productId
     * @param int $sellerId
     * @return \Webkul\MpAssignProduct\Model\ItemsFactory
     */
    private function checkForProductInAssignedItem($productId, $sellerId)
    {
        return $this->itemsFactory->create()->getCollection()
                        ->addFieldToFilter('seller_id', $sellerId)
                        ->addFieldToFilter('product_id', $productId);
    }

    /**
     * Get ValidSellerList
     *
     * @param array $sellerIds
     * @return array
     */
    private function getValidSellerList($sellerIds)
    {
        /*$storeId = $this->helperData->getCurrentStoreId();
        $collection = $this->sellerCollection->create();
        $collection->addFieldToFilter('seller_id', ['in' => $sellerIds]);
        $collection->addFieldToFilter('store_id', $storeId);
        // If seller data doesn't exist for current store

        if (!$collection->getSize()) {
            $collection = $this->sellerCollection->create();
            $collection->addFieldToFilter('seller_id', ['in' => $sellerIds]);
            $collection->addFieldToFilter('store_id', 0);
        }*/
        $collection = $this->sellerCollection->create();
        $collection->addFieldToFilter('seller_id', ['in' => $sellerIds]);
        $collection->addFieldToFilter('store_id', 0);
        return $collection->getColumnValues('seller_id');
    }
}
