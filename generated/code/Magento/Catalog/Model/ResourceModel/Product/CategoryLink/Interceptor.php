<?php
namespace Magento\Catalog\Model\ResourceModel\Product\CategoryLink;

/**
 * Interceptor class for @see \Magento\Catalog\Model\ResourceModel\Product\CategoryLink
 */
class Interceptor extends \Magento\Catalog\Model\ResourceModel\Product\CategoryLink implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\EntityManager\MetadataPool $metadataPool, \Magento\Framework\App\ResourceConnection $resourceConnection)
    {
        $this->___init();
        parent::__construct($metadataPool, $resourceConnection);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryLinks(\Magento\Catalog\Api\Data\ProductInterface $product, array $categoryIds = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCategoryLinks');
        return $pluginInfo ? $this->___callPlugins('getCategoryLinks', func_get_args(), $pluginInfo) : parent::getCategoryLinks($product, $categoryIds);
    }

    /**
     * {@inheritdoc}
     */
    public function saveCategoryLinks(\Magento\Catalog\Api\Data\ProductInterface $product, array $categoryLinks = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveCategoryLinks');
        return $pluginInfo ? $this->___callPlugins('saveCategoryLinks', func_get_args(), $pluginInfo) : parent::saveCategoryLinks($product, $categoryLinks);
    }

    /**
     * {@inheritdoc}
     */
    public function updateCategoryLinks(\Magento\Catalog\Api\Data\ProductInterface $product, array $insertLinks, $insert = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'updateCategoryLinks');
        return $pluginInfo ? $this->___callPlugins('updateCategoryLinks', func_get_args(), $pluginInfo) : parent::updateCategoryLinks($product, $insertLinks, $insert);
    }
}
