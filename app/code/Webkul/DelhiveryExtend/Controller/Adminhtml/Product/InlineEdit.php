<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Webkul\MpAssignProduct\Model\ItemsFactory;
use Webkul\MpAssignProduct\Helper\Data as MpAssignHelper;

class InlineEdit extends Action
{
    protected $jsonFactory;
    protected $model;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        ItemsFactory $model,
        MpAssignHelper $mpAssignHelper
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->model = $model;
        $this->mpAssignHelper = $mpAssignHelper;
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (empty($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    $modelData = $this->model->create()->load($entityId);
                    $productId = $modelData->getProductId();
                    $productType = $this->mpAssignHelper->checkProductType($productId);
                    if ($productType == 'simple') {
                        try {
                            $modelData->setData(array_merge($modelData->getData(), $postItems[$entityId]));
                            $modelData->save();
                        } catch (\Exception $e) {
                            $messages[] = "[Error:]  {$e->getMessage()}";
                            $error = true;
                        }
                    } else {
                        $messages[] = __('Configurable product type is not updatable.');
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
