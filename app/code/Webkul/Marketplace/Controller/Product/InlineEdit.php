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

namespace Webkul\Marketplace\Controller\Product;

class InlineEdit extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * Initialization
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->productRepository = $productRepository;
        $this->_stockRegistry = $stockRegistry;
    }

    /**
     * Save grid inline changes
     *
     * @return $this
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $postItems = $this->getRequest()->getParam('items', []);
        if (count($postItems)) {
            
            // die('test');
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach ($postItems as $item) {
                    // echo"<pre>";print_r($item);die;
                    try {
                        if ($item['entity_id']) {
                            $product = $this->productRepository->getById($item['entity_id']);
                            $stockItem = $this->_stockRegistry->getStockItem($item['entity_id']);
                            $stockItem->setData('qty', $item['qty']);
                            $product->setStatus($item['status']);
                            $product->setPrice($item['price']);
                            $product->setVisibility($item['visibility']);
                            $product->save();
                        }
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
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
