<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;

class Save extends Action
{
    /**
     * @var \Magento\Framework\File\Csv
     */
    protected $csv;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product
     */
    protected $productResource;

    /**
     * @param Context $context
     * @param \Magento\Framework\File\Csv $csv
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Catalog\Model\ResourceModel\Product $productResource
     */
    public function __construct(
        Context $context,
        \Magento\Framework\File\Csv $csv,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\ResourceModel\Product $productResource
    ) {
        $this->csv = $csv;
        $this->productRepository = $productRepository;
        $this->productResource = $productResource;
        parent::__construct($context);
    }

    /**
     * Save/Update Region Rule
     *
     * @return ResultFactory
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $file = $this->getRequest()->getFiles('csv_file');
        try {
            if (!empty($file)) {
                if ($file['type']!="text/csv") {
                    throw new NotFoundException(__('Only Csv type file extension is allowed'));
                }
                $csvData = $this->csv->getData($file['tmp_name']);
                if (count($csvData) <= 1) {
                    throw new NotFoundException(__('Found Empty File'));
                }
                foreach ($csvData as $row => $data) {
                    if ($row > 0) {
                        $product = $this->productRepository->getById($data[0]);
                        if (empty($product)) {
                            continue;
                        }
                        $product->setGstPercent((float)$data[1]);
                        $this->productResource->saveAttribute($product, 'gst_percent');
                        $product->setGstMinPrice($data[2]);
                        $this->productResource->saveAttribute($product, 'gst_min_price');
                        if (strpos($data[4], '</script>') === false && strpos($data[4], '<script>') === false) {
                            $product->setGstPercentMax($data[3]);
                            $this->productResource->saveAttribute($product, 'gst_percent_max');
                        }
                        if (strpos($data[4], '</script>') === false && strpos($data[4], '<script>') === false) {
                            $product->setHsnCode($data[4]);
                            $this->productResource->saveAttribute($product, 'hsn_code');
                        }
                    }
                }
                $this->messageManager->addSuccess(__('Products Updated Successfully'));
            } else {
                throw new NotFoundException(__('Found Empty File'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
