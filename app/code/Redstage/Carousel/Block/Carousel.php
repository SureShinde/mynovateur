<?php
namespace Redstage\Carousel\Block;
use Redstage\Carousel\Model\SlideFactory;
class Carousel extends \Magento\Framework\View\Element\Template 
{ 
    /**
     * @var SlideCollectionFactory
     */
    protected $_slideFactory;

    protected  $_storeManager;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context, 
         SlideFactory $slideFactory,
         \Magento\Store\Model\StoreManagerInterface $storeManager,
         array $data = []
    ) {
        $this->_slideFactory = $slideFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
       
    }

    protected function _prepareLayout()
    {
        if ($this->_scopeConfig->getValue('carousel/general/responsive',\Magento\Store\Model\ScopeInterface::SCOPE_STORE)) { 
                $this->pageConfig->addPageAsset('Redstage_Carousel::css/carousel/orbit.responsive.css');
        } else {   
                $this->pageConfig->addPageAsset('Redstage_Carousel::css/carousel/orbit.css');
        }
        
        return parent::_prepareLayout();
    }

    public function getSlides()
    {
        return $this->_slides;
    }

    public function setSlides($slides)
    {
        $this->_slides = $slides;
    }

    public function getTimerSpeed()
    {
        return $this->_scopeConfig->getValue('carousel/general/duration',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    public function getNavigationArrows()
    {   
        $arrows = $this->_scopeConfig->getValue('carousel/general/arrow_navigation',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $arrows ? 'false' : 'false';
    }

    public function getBullets()
    {
        $bullets = $this->_scopeConfig->getValue('carousel/general/dots_navigation',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $bullets ? 'true' : 'false';
    }

    public function getMaxWidth()
    {
        $max_width = $this->_scopeConfig->getValue('carousel/general/max_width',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($max_width) {
            $max_width = str_replace('px', '', $max_width);
            return (int)$max_width;
        }
        return false;
    }

    public function getBulletsContainerClass()
    {
        $position = $this->_scopeConfig->getValue('carousel/general/dots_position',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        switch ($position) {
            case 'bottom-left':
                return 'orbit-bullets left';
            case 'bottom-right':
                return 'orbit-bullets right';
            default:
                return 'orbit-bullets';
        }
    }

    public function getDotsColor()
    {
        $dots_color = $this->_scopeConfig->getValue('carousel/general/dots_color',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $dots_color;
    }

    protected function _beforeToHtml()
    {
        $slideData = $this->_slideFactory->create()->getCollection();
        $slideData->addFieldToFilter('active', '1');
        $slideData->addFieldToFilter('store_id', $this->_storeManager->getStore()->getId());
        $slideData->setOrder('sort_order', 'ASC');
        $this->setSlides($slideData);
        return parent::_beforeToHtml();
    }
    
    public function getMediaUrl(){
       return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
} 