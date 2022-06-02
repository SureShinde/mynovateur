<?php
namespace Amasty\Shopby\Model\Layer\FilterList;

/**
 * Interceptor class for @see \Amasty\Shopby\Model\Layer\FilterList
 */
class Interceptor extends \Amasty\Shopby\Model\Layer\FilterList implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Catalog\Model\Layer\FilterableAttributeListInterface $filterableAttributes, \Amasty\Base\Model\MagentoVersion $magentoVersion, \Amasty\Shopby\Helper\FilterSetting $filterSettingHelper, \Magento\Framework\App\Request\Http $request, \Magento\Framework\Registry $registry, \Amasty\ShopbyBase\Model\ResourceModel\FilterSetting\CollectionExtendedFactory $collectionExtendedFactory, \Amasty\Shopby\Model\Request $shopbyRequest, \Amasty\Shopby\Helper\Config $config, \Magento\Framework\View\LayoutInterface $layout, array $filters = [], $place = 'sidebar')
    {
        $this->___init();
        parent::__construct($objectManager, $filterableAttributes, $magentoVersion, $filterSettingHelper, $request, $registry, $collectionExtendedFactory, $shopbyRequest, $config, $layout, $filters, $place);
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters(\Magento\Catalog\Model\Layer $layer)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFilters');
        return $pluginInfo ? $this->___callPlugins('getFilters', func_get_args(), $pluginInfo) : parent::getFilters($layer);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllFilters(\Magento\Catalog\Model\Layer $layer)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAllFilters');
        return $pluginInfo ? $this->___callPlugins('getAllFilters', func_get_args(), $pluginInfo) : parent::getAllFilters($layer);
    }

    /**
     * {@inheritdoc}
     */
    public function sortingByPosition(\Magento\Catalog\Model\Layer\Filter\FilterInterface $first, \Magento\Catalog\Model\Layer\Filter\FilterInterface $second) : int
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'sortingByPosition');
        return $pluginInfo ? $this->___callPlugins('sortingByPosition', func_get_args(), $pluginInfo) : parent::sortingByPosition($first, $second);
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterPosition(\Magento\Catalog\Model\Layer\Filter\FilterInterface $filter) : int
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFilterPosition');
        return $pluginInfo ? $this->___callPlugins('getFilterPosition', func_get_args(), $pluginInfo) : parent::getFilterPosition($filter);
    }
}
