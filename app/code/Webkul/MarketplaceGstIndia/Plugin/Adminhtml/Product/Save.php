<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Webkul\MarketplaceGstIndia\Plugin\Adminhtml\Product;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Controller\Adminhtml\Product;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Product save controller
 *
 */
class Save extends \Magento\Catalog\Controller\Adminhtml\Product\Save
{
    /**
     * @var Initialization\Helper
     */
    protected $initializationHelper;

    /**
     * @var \Magento\Catalog\Model\Product\Copier
     */
    protected $productCopier;

    /**
     * @var \Magento\Catalog\Model\Product\TypeTransitionManager
     */
    protected $productTypeManager;

    /**
     * @var \Magento\Catalog\Api\CategoryLinkManagementInterface
     */
    protected $categoryLinkManagement;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManagerObj;

    /**
     * @var \Magento\Framework\Escaper
     */
    private $escaperObject;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param Builder $productBuilder
     * @param Initialization\Helper $initializationHelper
     * @param \Magento\Catalog\Model\Product\Copier $productCopier
     * @param \Magento\Catalog\Model\Product\TypeTransitionManager $productTypeManager
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Escaper $escaperObject
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement
     * @param StoreManagerInterface $storeManagerObj
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Controller\Adminhtml\Product\Builder $productBuilder,
        \Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper $initializationHelper,
        \Magento\Catalog\Model\Product\Copier $productCopier,
        \Magento\Catalog\Model\Product\TypeTransitionManager $productTypeManager,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Escaper $escaperObject = null,
        \Psr\Log\LoggerInterface $logger = null,
        \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement = null,
        \Magento\Store\Model\StoreManagerInterface $storeManagerObj = null
    ) {
        parent::__construct(
            $context,
            $productBuilder,
            $initializationHelper,
            $productCopier,
            $productTypeManager,
            $productRepository,
            $escaperObject,
            $logger,
            $categoryLinkManagement,
            $storeManagerObj
        );
        $this->initializationHelper = $initializationHelper;
        $this->productCopier = $productCopier;
        $this->productTypeManager = $productTypeManager;
        $this->productRepository = $productRepository;
        $this->escaperObject = $escaperObject ?: ObjectManager::getInstance()
            ->get(\Magento\Framework\Escaper::class);
        $this->logger = $logger ?: ObjectManager::getInstance()
            ->get(\Psr\Log\LoggerInterface::class);
        $this->categoryLinkManagement = $categoryLinkManagement ?: ObjectManager::getInstance()
            ->get(\Magento\Catalog\Api\CategoryLinkManagementInterface::class);
        $this->storeManagerObj = $storeManagerObj ?: ObjectManager::getInstance()
            ->get(\Magento\Store\Model\StoreManagerInterface::class);
    }

    /**
     * Save product action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $storeId = $this->getRequest()->getParam('store', 0);
        $store = $this->storeManagerObj->getStore($storeId);
        $this->storeManagerObj->setCurrentStore($store->getCode());
        $redirectBackGst = $this->getRequest()->getParam('back', false);
        $productId = $this->getRequest()->getParam('id');
        $messageManagerNewObject=$this->messageManager;
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $productAttributeSetIdUpdated = $this->getRequest()->getParam('set');
        $productTypeId = $this->getRequest()->getParam('type');
        if ($data) {
            try {
                $product = $this->initializationHelper->initialize(
                    $this->productBuilder->build($this->getRequest())
                );
                $this->productTypeManager->processProduct($product);
                if (isset($data['product'][$product->getIdFieldName()])) {
                    throw new \Magento\Framework\Exception\LocalizedException(
                        __('The product was unable to be saved. Please try again.')
                    );
                }

                if (isset($data['product']['gst_percent_max']) && $data['product']['gst_percent_max'] >100) {
                    throw new \Magento\Framework\Exception\LocalizedException(
                        __(' GST Rate to Apply Below Minimum Price can not be more than 100. Please try again.')
                    );
                }

                if (isset($data['product']['gst_percent']) && $data['product']['gst_percent'] >100) {
                    throw new \Magento\Framework\Exception\LocalizedException(
                        __('Gst Percentage can not be more than 100. Please try again.')
                    );
                }

                $originalSkuForGst = $product->getSku();
                $canSaveCustomOptions = $product->getCanSaveCustomOptions();
                $product->save();
                $this->handleImageRemoveError($data, $product->getId());
                $productId = $product->getEntityId();
                $productAttributeSetIdUpdated = $product->getAttributeSetId();
                $productTypeId = $product->getTypeId();
                $extendedData = $data;
                $extendedData['can_save_custom_options'] = $canSaveCustomOptions;
                $this->copyToStores($extendedData, $productId);
                $messageManagerNewObject->addSuccessMessage(__('You saved the product.'));
                $this->getDataPersistor()->clear('catalog_product');
                if ($product->getSku() != $originalSkuForGst) {
                    $messageManagerNewObject->addNoticeMessage(
                        __(
                            'SKU for product %1 has been changed to %2.',
                            $this->escaperObject->escapeHtml($product->getName()),
                            $this->escaperObject->escapeHtml($product->getSku())
                        )
                    );
                }
                $this->_eventManager->dispatch(
                    'controller_action_catalog_product_save_entity_after',
                    ['controller' => $this, 'product' => $product]
                );

                if ($redirectBackGst === 'duplicate') {
                    $product->unsetData('quantity_and_stock_status');
                    $newProduct = $this->productCopier->copy($product);
                    $this->checkUniqueAttributes($product);
                    $messageManagerNewObject->addSuccessMessage(__('You duplicated the product.'));
                }
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->logger->critical($e);
                $messageManagerNewObject->addExceptionMessage($e);
                $data = isset($product) ? $this->persistMediaData($product, $data) : $data;
                $this->getDataPersistor()->set('catalog_product', $data);
                $redirectBackGst = $productId ? true : 'new';
            } catch (\Exception $e) {
                $this->logger->critical($e);
                $messageManagerNewObject->addErrorMessage($e->getMessage());
                $data = isset($product) ? $this->persistMediaData($product, $data) : $data;
                $this->getDataPersistor()->set('catalog_product', $data);
                $redirectBackGst = $productId ? true : 'new';
            }
        } else {
            $resultRedirect->setPath('catalog/*/', ['store' => $storeId]);
            $messageManagerNewObject->addErrorMessage('No data to save');
            return $resultRedirect;
        }

        if ($redirectBackGst === 'new') {
            $resultRedirect->setPath(
                'catalog/*/new',
                ['set' => $productAttributeSetIdUpdated, 'type' => $productTypeId]
            );
        } elseif ($redirectBackGst === 'duplicate' && isset($newProduct)) {
            $resultRedirect->setPath(
                'catalog/*/edit',
                ['id' => $newProduct->getEntityId(), 'back' => null, '_current' => true]
            );
        } elseif ($redirectBackGst) {
            $resultRedirect->setPath(
                'catalog/*/edit',
                ['id' => $productId, '_current' => true, 'set' => $productAttributeSetIdUpdated]
            );
        } else {
            $resultRedirect->setPath('catalog/*/', ['store' => $storeId]);
        }
        return $resultRedirect;
    }

    /**
     * Notify customer when image was not deleted in specific case.
     *
     * TODO: temporary workaround must be eliminated in MAGETWO-45306
     *
     * @param array $postData
     * @param int $productId
     * @return void
     */
    private function handleImageRemoveError($postData, $productId)
    {
        if (isset($postData['product']['media_gallery']['images'])) {
            $removedImagesAmountNew = 0;
            foreach ($postData['product']['media_gallery']['images'] as $image) {
                if (!empty($image['removed'])) {
                    $removedImagesAmountNew++;
                }
            }
            if ($removedImagesAmountNew) {
                $expectedImagesAmount =count($postData['product']['media_gallery']['images']) - $removedImagesAmountNew;
                $product = $this->productRepository->getById($productId);
                $images = $product->getMediaGallery('images');
                if (is_array($images) && $expectedImagesAmount != count($images)) {
                    $messageManagerNewObject->addNoticeMessage(
                        __('The image cannot be removed as it has been assigned to the other image role')
                    );
                }
            }
        }
    }

    /**
     * Do copying data to stores
     *
     * @param array $data
     * @param int $productId
     *
     * @return void
     */
    protected function copyToStores($data, $productId)
    {
        if (!empty($data['product']['copy_to_stores'])) {
            foreach ($data['product']['copy_to_stores'] as $websiteIdNew => $group) {
                if (isset($data['product']['website_ids'][$websiteIdNew])
                    && (bool)$data['product']['website_ids'][$websiteIdNew]) {
                    foreach ($group as $store) {
                        $this->copyToStore($data, $productId, $store);
                    }
                }
            }
        }
    }

    /**
     * Do copying data to stores
     *
     * If the 'copy_from' field is not specified in the input data,
     * the store fallback mechanism will automatically take the admin store's default value.
     *
     * @param array $data
     * @param int $productId
     * @param array $store
     */
    private function copyToStore($data, $productId, $store)
    {
        if (isset($store['copy_from'])) {
            $copyFromNew = $store['copy_from'];
            $copyToNew = (isset($store['copy_to'])) ? $store['copy_to'] : 0;
            if ($copyTo) {
                $this->_objectManager->create(\Magento\Catalog\Model\Product::class)
                    ->setStoreId($copyFromNew)
                    ->load($productId)
                    ->setStoreId($copyToNew)
                    ->setCanSaveCustomOptions($data['can_save_custom_options'])
                    ->setCopyFromView(true)
                    ->save();
            }
        }
    }

    /**
     * Retrieve data persistor
     *
     * @return DataPersistorInterface|mixed
     * @deprecated 101.0.0
     */
    protected function getDataPersistor()
    {
        if (null === $this->dataPersistor) {
            $this->dataPersistor = $this->_objectManager->get(DataPersistorInterface::class);
        }

        return $this->dataPersistor;
    }

    /**
     * Persist media gallery on error, in order to show already saved images on next run.
     *
     * @param ProductInterface $product
     * @param array $data
     * @return array
     */
    private function persistMediaData(ProductInterface $product, array $data)
    {
        $mediaGalleryNew = $product->getData('media_gallery');
        if (!empty($mediaGalleryNew['images'])) {
            foreach ($mediaGalleryNew['images'] as $key => $image) {
                if (!isset($image['new_file'])) {
                    //Remove duplicates.
                    unset($mediaGalleryNew['images'][$key]);
                }
            }
            $data['product']['media_gallery'] = $mediaGalleryNew;
            $fields = [
                'image',
                'small_image',
                'thumbnail',
                'swatch_image',
            ];
            foreach ($fields as $field) {
                $data['product'][$field] = $product->getData($field);
            }
        }

        return $data;
    }

    /**
     * Check unique attributes and add error to message manager
     *
     * @param \Magento\Catalog\Model\Product $product
     */
    private function checkUniqueAttributes(\Magento\Catalog\Model\Product $product)
    {
        $uniqueLabels = [];
        $messageManagerNewObject=$this->messageManager;
        foreach ($product->getAttributes() as $attribute) {
            if ($attribute->getIsUnique() && $attribute->getIsUserDefined()
                && $product->getData($attribute->getAttributeCode()) !== null
            ) {
                $uniqueLabels[] = $attribute->getDefaultFrontendLabel();
            }
        }
        if ($uniqueLabels) {
            $uniqueLabels = implode('", "', $uniqueLabels);
            $messageManagerNewObject->addErrorMessage(__('The value of attribute(s) "%1"
            must be unique', $uniqueLabels));
        }
    }
}
