<?php
namespace Redstage\BoqConfigurator\Block;

class Configurator extends \Magento\Framework\View\Element\Template
{
    /**
    * @var \Magento\Customer\Model\Session $customer
    */
    protected $customer;

    /**
    * @var \Redstage\BoqConfigurator\Helper\Data $helperData
    */
    protected $helperData;

    /**
    * @var \Magento\Theme\Block\Html\Header\Logo $logo
    */
    protected $_logo;

    /**
    * @var \Magento\Eav\Model\Config $_eavConfig
    */
    protected $_eavConfig;

     /**
     * @param Context $context
     * @param BoqquoteFactory $boqquoteFactory
     * @param BoqProductgroupFactory $productgroupFactory
     * @param BoqRoomtypeFactory $boqRoomTypeFactory
     * @param BoqGrouproomlinkFactory $boqGrouproomlinkFactory
     * @param BoqRoombundleFactory $boqRoombundleFactory
     * @param \Redstage\BoqConfigurator\Helper\Data $helperData
     * @param \Magento\Customer\Model\Session $customer
     * @param \Magento\Store\Model\StoreManager $storeManager
     * @param \Magento\Eav\Model\Config $eavConfig
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Redstage\BoqConfigurator\Model\BoqquoteFactory $boqquoteFactory,
        \Redstage\BoqConfigurator\Model\BoqProductgroupFactory $boqProductgroupFactory,
        \Redstage\BoqConfigurator\Model\BoqRoomtypeFactory $boqRoomTypeFactory,
        \Redstage\BoqConfigurator\Model\BoqGrouproomlinkFactory $boqGrouproomlinkFactory,
        \Redstage\BoqConfigurator\Model\BoqRoombundleFactory $boqRoombundleFactory,
        \Redstage\BoqConfigurator\Helper\Data $helperData,
        \Magento\Customer\Model\Session $customer,
        \Magento\Store\Model\StoreManager $storeManager,
        \Magento\Backend\Block\Template\Context $context2,
        \Magento\Theme\Block\Html\Header\Logo $logo,
        \Magento\Eav\Model\Config $eavConfig
    )
    {
        
        parent::__construct($context);
        $this->boqquoteFactory = $boqquoteFactory;
        $this->productgroupFactory = $boqProductgroupFactory;
        $this->boqRoomTypeFactory = $boqRoomTypeFactory;
        $this->boqGrouproomlinkFactory = $boqGrouproomlinkFactory;
        $this->boqRoombundleFactory = $boqRoombundleFactory;
        $this->customer = $customer;
        $this->storeManager = $storeManager;
        $this->helperData = $helperData;
        $this->_logo = $logo;
        $this->_eavConfig = $eavConfig;
    }

    /**
     * Get Boqquote collection
     *
     * @return \Redstage\BoqConfigurator\Model\ResourceModel\Boqquote\Collection
     */
    public function getQuote()
    {
        $customerId = $this->getCustomerId();
        $boqquote = $this->boqquoteFactory->create();
        $collection = $boqquote->getCollection()->addFieldToFilter('customer_id', $customerId);
        return $collection->getData();
    }

    /**
     * Get BoqProductgroup collection
     *
     * @return \Redstage\BoqConfigurator\Model\ResourceModel\BoqProductgroup\Collection
     */
    public function getProductGroup()
    {
        $productGroup = $this->productgroupFactory->create();
        $collection = $productGroup->getCollection();
        return $collection->getData();
    }

    /**
     * Get BoqRoomtype collection
     *
     * @return \Redstage\BoqConfigurator\Model\ResourceModel\BoqRoomtype\Collection
     */
    public function getRoomType()
    {
        $roomType = $this->boqRoomTypeFactory->create();
        $collection = $roomType->getCollection()->addFieldToFilter('is_active', 1)->getData();
        return $collection;
    }

    /**
     * Get BoqGrouproomlink collection
     *
     * @return \Redstage\BoqConfigurator\Model\ResourceModel\BoqGrouproomlink\Collection
     */
    public function getGroupRoomLink()
    {
        $groupRoomLink = $this->boqGrouproomlinkFactory->create();
        $collection = $groupRoomLink->getCollection();
        return $collection->getData();
    }

    /**
     * Get BoqRoombundle collection
     *
     * @return \Redstage\BoqConfigurator\Model\ResourceModel\BoqRoombundle\Collection
     */
    public function getRoomBundle()
    {
        $roomBundle = $this->boqRoombundleFactory->create();
        $collection = $roomBundle->getCollection();
        return $collection->getData();
    }

    /**
     * Get room type range
     * @return string
     */
    public function getAjaxUrl()
    {    
        return $this->getUrl('boqconfigurator/product/control');
    }

    /**
     * Get products
     * @return string
     */
    public function getProductGroupAjaxUrl()
    {    
        return $this->getUrl('boqconfigurator/product/productgroup');
    }

    /**
     * Get recommended products
     * @return string
     */
    public function getRecommendedProductAjaxUrl()
    {    
        return $this->getUrl('boqconfigurator/product/recommendedproduct');
    }

    /**
     * Get plates and frames products
     * @return string
     */
    public function getPlatesAndFramesProductUrl()
    {    
        return $this->getUrl('boqconfigurator/product/PlatesAndFramesProducts');
    }

    /**
     * Get options of color attribute 
     * @return string
     */
    public function getColorAjaxUrl()
    {    
        return $this->getUrl('boqconfigurator/product/color');
    }

    /**
     * Get options of finish attribute 
     * @return string
     */
    public function getFinishedAjaxUrl()
    {    
        return $this->getUrl('boqconfigurator/product/finished');
    }

    /**
     * Add generated quote to cart 
     * @return string
     */
    public function getAddToCartAjaxUrl()
    {    
        return $this->getUrl('boqconfigurator/product/addtocart');
    }

    /**
     * Go to customer login page
     * @return string
     */
    public function getCustomerLoginUrl()
    {    
        return $this->getUrl("customer/account/login");
    }

    /**
     * Go to my account page
     * @return string
     */
    public function getMyAccountUrl()
    {    
        return $this->getUrl("customer/account");
    }

    /**
     * Get save quote for logged in customer
     * @return string
     */
    public function getSaveQuoteAjaxUrl()
    {    
        return $this->getUrl("boqconfigurator/product/savequote");
    }

    
    public function getConfig($config_path)
    {
        return $this->storeManager->getStore()->getConfig($config_path);
    }

    /**
     * Get product default placeholder image
     * @return string
     */
    public function getPlaceholderImageUrl()
    {
        $path ="catalog/placeholder/small_image_placeholder/";         
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA );
        return $mediaUrl.'catalog/product/placeholder/'.$this->getConfig($path);
    }

    /**
     * Get logged in customer id
     * @return int
     */
    public function getCustomerId(){
        return $this->helperData->getLoginCustomerId();
    }

    /**
     * Get store locator url
     * @return string
     */
    public function getStoreLocatorUrl(){
        $urlKey =  $this->helperData->getStoreLocator('url');
        return $this->getUrl($urlKey);
    }

    /**
     * Get logo image URL
     *
     * @return string
     */
    public function getLogoSrc()
    {    
        return $this->_logo->getLogoSrc();
    }


    public function getProductPreferabelSpaceAttrOptions(){
        $attributeCode = "product_preferable_space";
        $attribute = $this->_eavConfig->getAttribute('catalog_product', $attributeCode);
        $options = $attribute->getSource()->getAllOptions();
        //print_r($options);
        $result = [];
        foreach ($options as $option) { //print_r($option);
            if ($option['value'] > 0) {
                $result[$option['value']] = $option['label'];
            }
        }
        
        return $result;
    }

    /**
     * generated pdf 
     * @return string
     */
    public function getPdfAjaxUrl()
    {    
        return $this->getUrl('boqconfigurator/boq/pdf');
    }

    /**
     * Go to get price symbol 
     * @return string
     */
    public function getTotalPriceUrl()
    {    
        return $this->getUrl('boqconfigurator/product/pricesymbol');
    }

    /**
     * Go to boq page 
     * @return string
     */
    public function getboqUrl()
    {    
        return $this->getUrl('boqconfigurator/boq/index');
    }
   
}

