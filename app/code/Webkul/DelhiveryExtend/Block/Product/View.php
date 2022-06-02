<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @author    Webkul DelhiveryExtend
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Block\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Category;

/**
 * Product View block
 */
class View extends \Magento\Catalog\Block\Product\View
{
    /**
     * @param Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface|\Magento\Framework\Pricing\PriceCurrencyInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param array $data
     * @codingStandardsIgnoreStart
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory,
        array $data = []
    ) {
        $this->cookieManager = $cookieManager;
        $this->itemsFactory =  $itemsFactory;
        $this->associatesFactory =  $associatesFactory;
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $data
        );
    }

    /**
     * Get MinPriceSellerOfProduct
     */
    public function getMinPriceSellerOfProduct()
    {
        $customerZipCode = $this->cookieManager->getCookie('zip_data');
        $product = $this->getProduct();
        $productType = $product->getTypeId();
        if ($productType=='simple') {
            $collection = $this->itemsFactory->create()->getCollection()
                                ->addFieldToFilter('main_table.product_id', ['eq'=>$product->getId()])
                                ->addFieldToFilter('main_table.qty', ['gt'=>0])
                                ->setOrder('main_table.price','ASC');
        } else {
            $parentIds = $this->associatesFactory->create()->getCollection()
                                ->addFieldToFilter('main_table.parent_product_id', ['eq'=>$product->getId()])
                                ->addFieldToFilter('main_table.qty', ['gt'=>0])
                                ->getColumnValues('parent_id');
            $parentIds = !empty($parentIds) ? array_unique($parentIds) : [0];
            $collection = $this->itemsFactory->create()->getCollection()
                                ->addFieldToFilter('main_table.id', ['in'=>$parentIds])
                                ->addFieldToFilter('main_table.product_id', ['eq'=>$product->getId()])
                                ->setOrder('main_table.price','ASC');
        }
        $connection = $collection->getConnection();
        $sellerTable = $connection->getTableName('marketplace_userdata');
        $collection->getSelect()->join(
            $sellerTable.' as st',
            'main_table.seller_id = st.seller_id AND st.is_seller = 1',
            [
                'price' => 'main_table.price',
                'seller_id' => 'dpsm.seller_id',
                'product_id' => 'main_table.product_id',
                'assigned_id' => 'main_table.id'
            ]
        );
        $collection->setOrder('main_table.id','ASC');
        $sellerPostalRecord = $connection->getTableName('wk_delhivery_pincode_seller_map');
        $collection->getSelect()->join(
            $sellerPostalRecord.' as dpsm',
            'main_table.seller_id = dpsm.seller_id'
        )->where(
            'dpsm.pincode = '.$customerZipCode
        );
        $productInfo = $collection->setPageSize(1)->setCurPage(1)->getFirstItem()->getData();
        return empty($productInfo) ? false : $productInfo;
    }
}
