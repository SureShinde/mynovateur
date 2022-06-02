<?php
/**
 * Created By : Anjulata Gupta
 */
namespace Redstage\Catalog\ViewModel;
// use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Context;
use Magento\Framework\App\Request\Http;

class CategoryStaticBlock extends \Magento\Framework\View\Element\Template  implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    
    private $request;

    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Catalog\Helper\Category $categoryHelper
     * @param Http $request
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Block\Product\ListProduct $listProduct,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Http $request,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_coreRegistry = $registry;
        $this->_listProduct = $listProduct;
        $this->storeManager = $storeManager;
        $this->request = $context->getRequest();
        
    }

    /**
     * Produce and return block's html output
     *
     * This method should not be overridden. You can override _toHtml() method in descendants if needed.
     *
     * @return string
     */
    public function toHtml()
    {
        if($this->getBlockId() && $this->getCurrentCategory()->getData($this->getBlockId()))
        {
            return parent::toHtml();
        }
        return '';
    }

    public function getBlockId()
    {
        $page = $this->getRequest()->getParam('p',false);
        if(!$page || $page == 1){
            return 'landing_page_second';
        }
        else if($page == 3)
        {
            return 'landing_page_third';
        }
        return false;
    }


    /**
     * Retrieve current category model object
     *
     * @return \Magento\Catalog\Model\Category
     */
    public function getCurrentCategory()
    {
        if (!$this->hasData('current_category')) {
            $this->setData('current_category', $this->_coreRegistry->registry('current_category'));
        }
        return $this->getData('current_category');
    }

    /**
     * @return mixed
     */
    public function getCatagoryCmsBlockHtml($blockId)
    {        
        if($this->request->getModuleName() != 'catalogsearch'){
            return $this->getLayout()->createBlock(
                    \Magento\Cms\Block\Block::class
            )->setBlockId(
                $this->getCurrentCategory()->getData($blockId)
            )->toHtml();
        }

    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return ['CMS_VIEW_PRODUCT'.$this->getBlockId()];
    }

    public function getCategoryThumbnail()
    {
        $category = $this->getCurrentCategory();

        if (!empty($category)) {
            $thumbnail = $category->getThumbnail();
            $link = $category->getUrlLinkThumbnail();

            if (!empty($thumbnail) && !empty($link)) {
                $mediaUrl = $this->storeManager
                         ->getStore()
                         ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

                $dataImage['src'] =  $mediaUrl . 'catalog/category/' . $thumbnail;
                $dataImage['link'] =  $link;

                return $dataImage;
            }
        }
        return false;
    }
    
}