<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MpAssignProduct
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MpAssignProduct\Controller\Adminhtml\Product;

use Webkul\MpAssignProduct\Controller\Adminhtml\Product as ProductController;
use Magento\Framework\Controller\ResultFactory;
use Webkul\MpAssignProduct\Model\Items;

class Save extends ProductController
{
    /**
     * @var \Magento\Backend\Model\Session
     */
    protected $_backendSession;

    /**
     * @var \Webkul\MpAssignProduct\Model\ItemsFactory
     */
    protected $_items;

    /**
     * @var \Webkul\MpAssignProduct\Helper\Data
     */
    protected $_assignHelper;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Catalog\Model\Product\Action
     */
    protected $productAction;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Webkul\MpAssignProduct\Model\ItemsFactory $items
     * @param \Webkul\MpAssignProduct\Helper\Data $mpAssignHelper
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Model\Product\Action $productAction
     * @param \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Webkul\MpAssignProduct\Model\ItemsFactory $items,
        \Webkul\MpAssignProduct\Helper\Data $mpAssignHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Product\Action $productAction,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory
    ) {
        $this->_backendSession = $context->getSession();
        $this->_items = $items;
        $this->_assignHelper = $mpAssignHelper;
        $this->storeManager = $storeManager;
        $this->productAction = $productAction;
        $this->associates = $associatesFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getParams();
            $assignId = $postData['id'];
            $requestedStatus = $postData['product_status'];
            $this->updateAssociatedProduct($postData, $assignId);

            $assignProduct = $this->_items->create();
            $assignProduct->load($assignId);
            $status = $assignProduct->getStatus();
            $type = $assignProduct->getType();
            if ($requestedStatus == 1) {
                //Approve Product
                if ($status == 0) {
                    $status = \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED;
                    $allStores = $this->storeManager->getStores();
                    $assignProductId = $assignProduct->getAssignProductId();
                    if ($assignProductId) {
                        foreach ($allStores as $store) {
                            $this->productAction->updateAttributes(
                                [$assignProductId],
                                ['status' => $status],
                                $store->getId()
                            );
                        }
                        $this->productAction->updateAttributes([$assignProductId], ['status' => $status], 0);
                    }
                    $assignProduct->setStatus(Items::STATUS_ENABLED)->save();
                    $this->_assignHelper->sendStatusMail($assignProduct);
                }
            } else {
                //Disapprove Product
                if ($status == 1) {
                    $status = \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_DISABLED;
                    $allStores = $this->storeManager->getStores();
                    $assignProductId = $assignProduct->getAssignProductId();
                    if ($assignProductId) {
                        foreach ($allStores as $store) {
                            $this->productAction->updateAttributes(
                                [$assignProductId],
                                ['status' => $status],
                                $store->getId()
                            );
                        }
                        $this->productAction->updateAttributes(
                            [$assignProductId],
                            ['status' => $status],
                            0
                        );
                    }
                    $assignProduct->setStatus(Items::STATUS_DISABLED)->save();
                    $this->_assignHelper->sendStatusMail($assignProduct, 1);
                }
            }
            $this->messageManager->addSuccess("Status updated successfully.");
            return $resultRedirect->setPath('*/*/edit', ['_current' => true, 'id' => $assignId]);
        }
        $this->messageManager->addError("Something went wrong.");
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Update Assigned Associated Products
     *
     * @param array $postData
     * @param int $parentId
     */
    private function updateAssociatedProduct($postData, $parentId)
    {
        $associateIds= [];
        foreach ($postData as $key => $value) {
            $pattern1 = "/associated_product_id/i";
            if (preg_match($pattern1, $key)) {
                array_push($associateIds, $value);
            }
        }

        foreach ($associateIds as $id) {
            $quantity = 0;
            $price = 0.00;
            $collection =  $this->associates->create()->getCollection()
                                ->addFieldToFilter('product_id', $id)
                                ->addFieldToFilter('parent_id', $parentId);

           foreach ($postData as $key => $value) {
                $pattern2 = "/wk_quantity{$id}/i";
                $pattern3 = "/wk_price{$id}/i";
                if (preg_match($pattern2, $key)) {
                    $quantity = $value;
                }
                if (preg_match($pattern3, $key)) {
                    $price = $value;
                }
            }
            if ($collection->getSize()) {
                foreach ($collection as $item) {
                    $item->setQty($quantity);
                    $item->setPrice($price);
                    $item->save();
                }
            }
        }
    }
}
