<?php
namespace Amasty\MegaMenuLite\Model\Menu\TreeResolver;

/**
 * Interceptor class for @see \Amasty\MegaMenuLite\Model\Menu\TreeResolver
 */
class Interceptor extends \Amasty\MegaMenuLite\Model\Menu\TreeResolver implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Tree\NodeFactory $nodeFactory, \Magento\Framework\Data\TreeFactory $treeFactory, \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory, \Magento\Catalog\Helper\Category $categoryHelper, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\DataObjectFactory $dataObjectFactory, \Amasty\MegaMenuLite\Model\ResourceModel\Menu\Item\Position\CollectionFactory $positionCollectionFactory, \Magento\Framework\UrlInterface $urlBuilder, \Magento\Catalog\Model\Layer\Resolver $layerResolver, \Amasty\MegaMenuLite\Model\Provider\FieldsByStore $fieldsByStore, \Amasty\MegaMenuLite\Model\Menu\GetItemsCollection $getItemsCollection, \Amasty\MegaMenuLite\Model\OptionSource\UrlKey $urlKey, \Magento\Framework\EntityManager\MetadataPool $metadataPool)
    {
        $this->___init();
        parent::__construct($nodeFactory, $treeFactory, $categoryCollectionFactory, $categoryHelper, $storeManager, $dataObjectFactory, $positionCollectionFactory, $urlBuilder, $layerResolver, $fieldsByStore, $getItemsCollection, $urlKey, $metadataPool);
    }

    /**
     * {@inheritdoc}
     */
    public function get(int $storeId) : \Magento\Framework\Data\Tree\Node
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'get');
        return $pluginInfo ? $this->___callPlugins('get', func_get_args(), $pluginInfo) : parent::get($storeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getBeforeAdditionalLinks()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBeforeAdditionalLinks');
        return $pluginInfo ? $this->___callPlugins('getBeforeAdditionalLinks', func_get_args(), $pluginInfo) : parent::getBeforeAdditionalLinks();
    }

    /**
     * {@inheritdoc}
     */
    public function getAdditionalLinks()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAdditionalLinks');
        return $pluginInfo ? $this->___callPlugins('getAdditionalLinks', func_get_args(), $pluginInfo) : parent::getAdditionalLinks();
    }

    /**
     * {@inheritdoc}
     */
    public function getSortedItems(int $storeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSortedItems');
        return $pluginInfo ? $this->___callPlugins('getSortedItems', func_get_args(), $pluginInfo) : parent::getSortedItems($storeId);
    }
}
