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
namespace Webkul\DelhiveryExtend\Block\Product;

//use Magento\Framework\App\Http\Context;
use Magento\Customer\Model\Context;

class Products extends \Webkul\MpAssignProduct\Block\Product\Products
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Catalog\Model\Product\Media\Config $mediaConfig
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Webkul\Marketplace\Helper\Data $mpHelper
     * @param \Webkul\MpAssignProduct\Helper\Data $helper
     * @param \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory
     * @param \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory
     * @param \Webkul\Marketplace\Model\ResourceModel\Seller\CollectionFactory $sellerlistCollectionFactory
     * @param array $data = []
     */
    public function __construct(
        \Magento\CatalogRule\Model\ResourceModel\Rule $ruleResource,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\Product\Media\Config $mediaConfig,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Webkul\Marketplace\Helper\Data $mpHelper,
        \Webkul\MpAssignProduct\Helper\Data $helper,
        \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory,
        \Webkul\Marketplace\Model\ResourceModel\Seller\CollectionFactory $sellerlistCollectionFactory,
        \Webkul\MarketplaceBaseShipping\Model\ShippingSettingRepository $shippingSettingRepository,
        \Webkul\DelhiveryShipping\Model\Carrier $delhiveryCarrier,
        \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger,
        array $data = []
    ) {
        $this->httpContext = $httpContext;
        $this->ruleResource = $ruleResource;
        $this->cookieManager = $cookieManager;
        $this->scopeConfig = $scopeConfig;
        $this->connection = $resourceConnection->getConnection();
        $this->storeManager = $storeManager;
        $this->shippingSetting = $shippingSettingRepository;
        $this->delhiveryCarrier = $delhiveryCarrier;
        $this->delhiVeryLogger = $delhiVeryLogger;
        $this->helper = $helper;
        parent::__construct(
            $context,
            $helper,
            $itemsFactory,
            $associatesFactory,
            $priceHelper,
            $mpHelper,
            $mediaConfig,
            $sellerlistCollectionFactory,
            $data
        );
    }

    /**
     * Is shipping cost enable on product pagegetDeliveryShipCost
     */
    public function isShippingCostEnableOnProPage()
    {
        $config = 'carriers/delhivery/cost_on_page';
        return $this->scopeConfig->getValue($config, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Is shipping cost enable on product pagegetDeliveryShipCost
     */
    public function getSellerAccConfig()
    {
        return $this->helper->getSellerAccConfig();
    }

    /**
     * Get Seller Origin postal code
     *
     * @param int $sellerId
     * @return string
     */
    public function getSellerOriginPostalCode($sellerId) {
        $address = $this->shippingSetting->getBySellerId($sellerId);
        return $address->getPostalCode();
    }

    /**
     * Get Customer Origin postal code
     *
     * @param int $sellerId
     * @return string
     */
    public function getCustomerOriginPostalCode() {
        return $this->cookieManager->getCookie('zip_data');
    }

    /**
     * Get DeliveryShippingCost
     *
     * @param int $sellerId
     * @return string
     */
    public function getDeliveryShipCost($sellerOrigin, $customerOrigin, $productId) {
        try {
            $this->delhiveryCarrier->getDeliveryShipingCost($sellerOrigin, $customerOrigin, $productId);
        } catch (\Exception $e) {
            $this->delhiVeryLogger->addError('DelhiveryExtend Products '.$e->getMessage());
        }
    }

    /**
     * Get AssignedProducts
     *
     */
    public function getAssignedProducts()
    {
        $customerZipCode = $this->getCustomerOriginPostalCode();
        $product = $this->getProduct();
        if ($product) {
            $productType = $product->getTypeId();
            $sellercollection = $this->_sellerlistCollectionFactory->create()
                                        ->addFieldToFilter('is_seller', ['eq' => 1]);
            $sellerIds = $sellercollection->getColumnValues('seller_id');
            if ($productType=='simple') {
                $collection = $this->itemsFactory->create()
                                    ->getCollection()
                                    ->addFieldToFilter('main_table.seller_id', ['in'=>$sellerIds])
                                    ->addFieldToFilter('main_table.product_id', ['eq'=>$product->getId()])
                                    ->addFieldToFilter('main_table.qty', ['gt'=>0]);
            } else {
                $parentIds = $this->associatesFactory->create()->getCollection()
                                    ->addFieldToFilter('main_table.parent_product_id', ['eq'=>$product->getId()])
                                    ->addFieldToFilter('main_table.qty', ['gt'=>0])
                                    ->getColumnValues('parent_id');
                $parentIds = !empty($parentIds) ? $parentIds : [0];
                $collection = $this->itemsFactory->create()->getCollection()
                                    ->addFieldToFilter('main_table.id', ['in'=>$parentIds])
                                    ->addFieldToFilter('main_table.seller_id', ['in'=>$sellerIds])
                                    ->addFieldToFilter('main_table.product_id', ['eq'=>$product->getId()]);
            }
            $sellerPostalRecord = $this->connection->getTableName('wk_delhivery_pincode_seller_map');
            $collection->getSelect()->join(
                        $sellerPostalRecord.' as dpsm',
                        'main_table.seller_id = dpsm.seller_id'
                    )->where(
                        'dpsm.pincode = '.$customerZipCode
                    );
            $collection->setOrder('main_table.price','ASC');
            return $collection;
        }
        return false;
    }

    /**
     * Get ScriptData
     * @return string
     */
    public function getScriptData()
    {
        $scriptData = [
            'sellerListUrl' => $this->getUrl('mpassignproduct/index/sellerlist')
        ];
        return json_encode($scriptData);
    }

    /**
     * Get Applied CatalogRules
     */
    public function getAppliedCatalogRules()
    {
        $isLogged = $this->httpContext->getValue(Context::CONTEXT_AUTH);
        $customerGroupId = $isLogged ? $this->httpContext->getValue(Context::CONTEXT_GROUP) : 0;
        $product = $this->getProduct();
        /* Get Current Website ID */
        $websiteId = $this->storeManager->getStore()->getWebsiteId();
        $rules = $this->ruleResource->getRulePrices(
            new \DateTime('now'),
            $websiteId,
            $customerGroupId,
            [$product->getEntityId()]
        );
        echo $discount = (($product->getPrice() - $rules[$product->getEntityId()])/$product->getPrice())*100 ;
        $product->getPrice().
        print_r($rules);
        die;
    }
}
