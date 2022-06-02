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
namespace Webkul\MpAssignProduct\Block\Product;

class Products extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var Magento\Framework\App\Request\Http
     */
    protected $_request;

    /**
     * @var \Webkul\MpAssignProduct\Helper\Data
     */
    protected $_assignHelper;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    protected $priceHelper;

    /**
     * @var \Webkul\Marketplace\Helper\Data
     */
    protected $mpHelper;

    /**
     * @var \Magento\Catalog\Model\Product\Media\Config
     */
    protected $mediaConfig;

    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Webkul\MpAssignProduct\Helper\Data $helper
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param \Webkul\Marketplace\Helper\Data $mpHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Webkul\MpAssignProduct\Helper\Data $helper,
        \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        \Webkul\Marketplace\Helper\Data $mpHelper,
        \Magento\Catalog\Model\Product\Media\Config $mediaConfig,
        \Webkul\Marketplace\Model\ResourceModel\Seller\CollectionFactory $sellerlistCollectionFactory,
        array $data = []
    ) {
        $this->_coreRegistry = $context->getRegistry();
        $this->_request = $context->getRequest();
        $this->_assignHelper = $helper;
        $this->priceHelper = $priceHelper;
        $this->mpHelper = $mpHelper;
        $this->mediaConfig = $mediaConfig;
        $this->itemsFactory = $itemsFactory;
        $this->associatesFactory = $associatesFactory;
        $this->_imageHelper = $context->getImageHelper();
        $this->_sellerlistCollectionFactory = $sellerlistCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return bool|\Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getAssignedProducts()
    {
        $product = $this->getProduct();
        $productType = $product->getTypeId();
        $sellercollection = $this->_sellerlistCollectionFactory->create()
                                    ->addFieldToFilter('is_seller', ['eq' => 1]);
        $sellerIds = $sellercollection->getColumnValues('seller_id');
        if ($productType=='simple') {
            $collection = $this->itemsFactory->create()
                                ->getCollection()
                                ->addFieldToFilter('seller_id', ['in'=>$sellerIds])
                                ->addFieldToFilter('product_id', ['eq'=>$product->getId()])
                                ->addFieldToFilter('qty', ['gt'=>0]);
        } else {
            $parentIds = $this->associatesFactory->create()->getCollection()
                                ->addFieldToFilter('parent_product_id', ['eq'=>$product->getId()])
                                ->addFieldToFilter('qty', ['gt'=>0])
                                ->getColumnValues('parent_id');
            $collection = $this->itemsFactory->create()->getCollection()
                                ->addFieldToFilter('id', ['in'=>$parentIds])
                                ->addFieldToFilter('seller_id', ['in'=>$sellerIds])
                                ->addFieldToFilter('product_id', ['eq'=>$product->getId()]);
        }
        return $collection;
    }

    public function getFormattedPrice($price)
    {
        return $this->priceHelper->currency($price, true, false);
    }

    public function getSellerDetail($sellerId)
    {
        $sellerDetails = $this->_assignHelper->getSellerDetails($sellerId);
        return $sellerDetails;
    }
    /**
     * @return array $productsArray
     */
    public function getProductsArray()
    {
        $collection = $this->getAssignedProducts();
        $productsArray = [];
        $productsArray['headings'] = [
           0 => __('Seller'),
           1 => '',
           5 => __('Price'),
           6 => '',
        ];
        if (!$this->_assignHelper->showProfile()) {
            unset($productsArray['headings'][2]);
        }
        if (!empty($collection)) {
            foreach ($collection as $product) {
                $productsArray['data'][] = $this->getFormatedArray($product);
            }
        }

        return $productsArray;
    }

    /**
     * @param object $product
     * @return array $formatedArray
     */
    public function getFormatedArray($product)
    {
        $formatedArray = [];
        $productId = $this->getProduct()->getId();
        $sellerId = $product->getSellerId();
        $assignProductId = $product->getAssignProductId();
        $mainProduct = 0;
        if ($productId == $assignProductId) {
            $sellerId = $product->getOwnerId();
            $assignProductId = $product->getProductId();
            $mainProduct = 1;
        }
        $logo = "noimage.png";
        $shopTitle = __("Admin");
        $assignProduct = $this->_assignHelper->getProduct($assignProductId);
        $assignId = $product->getId();
        $productType = $assignProduct->getTypeId();
        $showProfile = $this->_assignHelper->showProfile();
        $price = $this->priceHelper->currency($assignProduct->getFinalPrice(), true, false);
        $sellerDetails = $this->_assignHelper->getSellerDetails($sellerId);
        $formatedArray['showProfile'] = $showProfile;
        $formatedArray['additionalColumnInfo'] = '';
        $formatedArray['assignId'] = $assignId;
        $formatedArray['assign_product_id'] = $assignProductId;
        $formatedArray['productType'] = $productType;
        $formatedArray['price'] = $price;
        $formatedArray['sellerId'] = $sellerId;
        $formatedArray['description'] = $assignProduct->getDescription();
        $formatedArray['mainproduct'] = $mainProduct;
        if ($sellerDetails) {
            $logo = $sellerDetails->getLogoPic() != '' ? $sellerDetails->getLogoPic():"noimage.png";
            $shopTitle = $sellerDetails->getShopTitle();
            if ($shopTitle == "") {
                $shopTitle = $sellerDetails->getShopUrl();
            }
            $product['shop_url'] = $sellerDetails->getShopUrl();
        }
        $formatedArray['shopTitle'] = $shopTitle;
        $logo = $this->_assignHelper->getBaseMediaUrl().'avatar/'.$logo;
        $formatedArray['logo'] = $logo;
        $shopName = $product['shop_url'];
        $shopUrl = $this->mpHelper->getRewriteUrl('marketplace/seller/profile/shop/'.$product['shop_url']);
        $formatedArray['shopUrl'] = $shopUrl;
        $formatedArray['shopName'] = $shopName."#customer-reviews";
        $baseImage =  $this->_imageHelper->init($assignProduct, 'product_base_image')
                        ->setImageFile($assignProduct->getImage())
                        ->getUrl();
        $formatedArray['baseImage'] = $baseImage;
        $condition = $product->getCondition();
        if (!$sellerId || $condition == 1) {
            $condition = __("New");
        } else {
            $condition = __("Used");
        }
        $formatedArray['condition'] = $condition;
        $sellerRating = $this->mpHelper->getFeedTotal($sellerId);
        $totalCount = $sellerRating['feedcount'];
        $percent = $sellerRating['totalfeed'];
        $rate = 0;
        $reviewLink = $this->mpHelper->getRewriteUrl('marketplace/seller/feedback/shop/'.$product['shop_url']);
        $collectionUrl = $this->getUrl("marketplace/seller/collection")."shop/".$product->getShopUrl();
        if ($showProfile) {
            if ($totalCount > 0) {
                $rate = $percent / 20;
                $rate = number_format($rate, 1);
            }
        }
        $formatedArray['percent'] = $percent;
        $formatedArray['rate'] = $rate;
        $formatedArray['reviewLink'] = $reviewLink;
        $formatedArray['collectionUrl'] = $collectionUrl;
        $stockItem = $assignProduct->getExtensionAttributes()->getStockItem();
        if ($stockItem->getQty() > 0 && $stockItem->getIsInStock()) {
            $availability = __("IN STOCK");
            $availabilityClass = " wk-in-stock";
            $displyAddToCart = true;
        } else {
            $availability = __("OUT OF STOCK");
            $availabilityClass = " wk-out-of-stock";
            $displyAddToCart = false;
        }
        $jsonResult = '';
        if ($product->getType() == "configurable") {
            $availability = "-";
            $availabilityClass = " wk-in-stock";
            $displyAddToCart = false;
            $associatedOptions = $this->_assignHelper->getAssociatedOptions($product->getProductId(), $productId);
            $jsonResult = $associatedOptions;
        }
        $mediaGalleryImages = $assignProduct->getMediaGalleryImages();
        $images = [];
        if (count($mediaGalleryImages) > 0) {
            foreach ($mediaGalleryImages as &$mediaGalleryImage) {
                $images[] = $this->mediaConfig->getMediaUrl($mediaGalleryImage['file']);
            }
        }
        $formatedArray['availability'] = $availability;
        $formatedArray['availabilityClass'] = $availabilityClass;
        $formatedArray['displyAddToCart'] = $displyAddToCart;
        $formatedArray['jsonResult'] = $jsonResult;
        $formatedArray['images'] = $images;
        return $formatedArray;
    }

    /**
     * [getProduct description]
     * @return $this
     */
    public function getProduct()
    {
        return $this->_coreRegistry->registry('product');
    }

    /**
     * [getDirection description]
     * @return direction
     */
    public function getDirection()
    {
        $dir = $this->_request->getParam("list_dir");
        if ($dir != "desc") {
            $dir = "asc";
        }
        return $dir;
    }

    /**
     * [getSortOrder description]
     * @return sort order type
     */
    public function getSortOrder()
    {
        $order = $this->_request->getParam("list_order");
        if ($order != "rating") {
            $order = "price";
        }
        return $order;
    }

    /**
     * [getDefaultUrl description]
     * @return string
     */
    public function getDefaultUrl()
    {
        $currentUrl = $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true]);
        list($url) = explode("?", $currentUrl);
        return $url;
    }
}
