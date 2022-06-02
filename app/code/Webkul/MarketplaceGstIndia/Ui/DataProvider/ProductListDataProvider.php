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
namespace Webkul\MarketplaceGstIndia\Ui\DataProvider;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollection;
use Webkul\Marketplace\Helper\Data as HelperData;

/**
 * Class DataProvider
 */
class ProductListDataProvider extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{
    /**
     * Product collection
     *
     * @var \Webkul\Marketplace\Model\ResourceModel\Product\Collection
     */
    protected $collection;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
    
    /**
     * @param string                                                    $name
     * @param string                                                    $primaryFieldName
     * @param string                                                    $requestFieldName
     * @param CollectionFactory                                         $productCollection
     * @param HelperData                                                $helperData
     * @param \Magento\Framework\Registry                               $registry
     * @param \Magento\Catalog\Model\ProductFactory                     $productFactory
     * @param \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]  $addFieldStrategies
     * @param \Magento\Ui\DataProvider\AddFilterToCollectionInterface[] $addFilterStrategies
     * @param array                                                     $meta
     * @param array                                                     $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollection,
        HelperData $helperData,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\ProductFactory  $productFactory,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $productCollection,
            $addFieldStrategies,
            $addFilterStrategies,
            $meta,
            $data
        );
        
        if (!$registry->registry('mp_flat_catalog_flag')) {
            $registry->register('mp_flat_catalog_flag', 1);
        }
        
        /** @var Collection $collection */
        $collectionData = $productFactory->create()->getCollection();
        
        $collectionData = $productCollection->create();
        $collectionData->addAttributeToSelect('gst_percent');
        $collectionData->addAttributeToSelect('gst_min_price');
        $collectionData->addAttributeToSelect('gst_percent_max');
        $collectionData->addAttributeToSelect('hsn_code');

        $this->collection = $collectionData;
        $this->addFieldStrategies = $addFieldStrategies;
        $this->addFilterStrategies = $addFilterStrategies;
    }
}
