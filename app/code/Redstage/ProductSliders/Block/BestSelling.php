<?php

namespace Redstage\ProductSliders\Block;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;
use Magento\Wishlist\Model\ResourceModel\Item\CollectionFactory as WishlistCollectionFactory;


/**
 * Product Best Selling Block
 */
class BestSelling extends AbstractProduct
{

    /**
     * Product Collection
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected $_itemCollection;

    /**
     * Module Manager
     *
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * Reports Product Collection Factory
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productsFactory;

    /**
     * @var CategoryFactory
     */
    private $_categoryFactory;

    /**
    * @var \Redstage\ProductSliders\Helper\Data $helperData
    */
    protected $helperData;

    /**
    * @var \Magento\Customer\Model\Session $customer
    */
    protected $customer;

    /**
     * @var WishlistCollectionFactory
     */
    protected $_wishlistCollectionFactory;

    /**
     * Initialize Block
     *
     * @param Context $context
     * @param CollectionFactory $productsFactory
     * @param BestSellersCollectionFactory $bestSellelersFactory
     * @param CategoryFactory $categoryFactory
     * @param \Redstage\ProductSliders\Helper\Data $helperData
     * @param \Magento\Customer\Model\Session $customer
     * @param WishlistCollectionFactory $wishlistCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context           $context,
        CollectionFactory $productsFactory,
        BestSellersCollectionFactory $bestSellelersFactory,
        CategoryFactory   $categoryFactory,
        \Redstage\ProductSliders\Helper\Data $helperData,
        \Magento\Customer\Model\Session $customer,
        WishlistCollectionFactory $wishlistCollectionFactory,
        array             $data = []
    ) {
        $this->_productsFactory = $productsFactory;
        $this->_bestSellelersFactory = $bestSellelersFactory;
        $this->_categoryFactory = $categoryFactory;
        $this->helperData = $helperData;
        $this->customer = $customer;
        $this->_wishlistCollectionFactory = $wishlistCollectionFactory;
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * Retrieve Items Collection
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getBestSellingProduct(int $cat_id, string $custom_attribute_name, int $num_of_product)
    {
        $productIds = [];
        $bestSellers = $this->_bestSellelersFactory->create();
        $bestSellers->setPeriod('month');
        foreach ($bestSellers as $product) {
            $productIds[] = $product->getProductId();
        }
        $this->_itemCollection = $this->_productsFactory->create()
            ->addIdFilter($productIds)
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('status', 1)
            ->addAttributeToFilter('visibility', 4)
            ->addAttributeToSort('updated_at', 'desc');
        // ->addAttributeToFilter($custom_attribute_name, 1);
        $this->_itemCollection->addCategoriesFilter(['in' => [$cat_id]]);
        $this->_itemCollection->getSelect()->limit($num_of_product);

        foreach ($this->_itemCollection as $product) {
            $product->setDoNotUseCategoryId(true);
        }
        return $this->_itemCollection;
    }

    public function getCategoryName(int $cat_id)
    {
        $category = $this->_categoryFactory->create()->load($cat_id);
        $categoryName = $category->getName();
        return $categoryName;
    }

    public function getCategoryURL(int $cat_id)
    {
        $category = $this->_categoryFactory->create()->load($cat_id);
        $categoryUrl = $category->getUrl();
        return $categoryUrl;
    }

    /**
     * Get logged in customer id
     * @return int
     */
    public function getCustomerId(){
        return $this->helperData->getLoginCustomerId();
    }

    /**
     * @inheritdoc
     */
    public function getProductCollection()
    {
        $collection = [];
        $currentCustomer = $this->getCustomerId();
        if ($currentCustomer) {
            $wishlist = $this->_wishlistCollectionFactory->create()
                ->addCustomerIdFilter($currentCustomer);
            $productIds = null;
            foreach ($wishlist as $product) {
                $productIds[] = $product->getProductId();
            }
            $collection = $this->_productsFactory->create()->addIdFilter($productIds);
            $collection = $this->_addProductAttributesAndPrices($collection);
        }
        return $collection;
    }
}
