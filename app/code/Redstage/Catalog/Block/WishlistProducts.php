<?php
namespace Redstage\Catalog\Block;

class WishlistProducts extends \Magento\Framework\View\Element\Template
{

    protected $_wishlist;    
    protected $_customerSession;
    protected $helper;
    protected $image;
    protected $productRepository;
    protected $_storeManager;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Wishlist\Model\Wishlist $wishlist,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Wishlist\Helper\Data $helper,
    \Magento\Catalog\Helper\ImageFactory $image,
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    array $data = []
    ) {

    $this->_wishlist = $wishlist;
    $this->_customerSession = $customerSession;
    $this->helper = $helper;
    $this->image = $image;
    $this->productRepository = $productRepository;
    $this->_storeManager = $storeManager;
    parent::__construct($context, $data);
    }
 
/**
* @param int $customerId
*/
    public function getCustomerId()
    {
        $customerId = $this->_customerSession->getCustomer()->getId();
        return $customerId;
    }
    public function getWishlistByCustomerId($customerId)
    {
        $wishlist = $this->_wishlist->loadByCustomerId($customerId)->getItemCollection();
        return $wishlist;
    }
    public function getItemAddToCartParams($_item){
        return $this->helper->getAddToCartParams($_item);
    }
    public function getItemConfigureUrl($_item)
    {
        return $this->helper->getConfigureUrl($_item);
    }
    public function getItemRemoveParams($_item){
        return $this->helper->getRemoveParams($_item);
    }    
    public function getProductImageUrl($sku)
    {       
        $product = $this->productRepository->get($sku); //pass sku here        
        $thumbnail = $product->getData('thumbnail');
        return $url = $this->getMediaurl().'catalog/product'.$thumbnail;
    }
    public function getCurrentCurrencySymbol()
    {
        return $this->_storeManager->getStore()->getBaseCurrency()->getCurrencySymbol();
    } 
    public function getMediaurl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
