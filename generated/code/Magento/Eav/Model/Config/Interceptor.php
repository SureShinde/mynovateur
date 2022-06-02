<?php
namespace Magento\Eav\Model\Config;

/**
 * Interceptor class for @see \Magento\Eav\Model\Config
 */
class Interceptor extends \Magento\Eav\Model\Config implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\CacheInterface $cache, \Magento\Eav\Model\Entity\TypeFactory $entityTypeFactory, \Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory $entityTypeCollectionFactory, \Magento\Framework\App\Cache\StateInterface $cacheState, \Magento\Framework\Validator\UniversalFactory $universalFactory, ?\Magento\Framework\Serialize\SerializerInterface $serializer = null, ?\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig = null, $attributesForPreload = [])
    {
        $this->___init();
        parent::__construct($cache, $entityTypeFactory, $entityTypeCollectionFactory, $cacheState, $universalFactory, $serializer, $scopeConfig, $attributesForPreload);
    }

    /**
     * {@inheritdoc}
     */
    public function getCache()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCache');
        return $pluginInfo ? $this->___callPlugins('getCache', func_get_args(), $pluginInfo) : parent::getCache();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'clear');
        return $pluginInfo ? $this->___callPlugins('clear', func_get_args(), $pluginInfo) : parent::clear();
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isCacheEnabled');
        return $pluginInfo ? $this->___callPlugins('isCacheEnabled', func_get_args(), $pluginInfo) : parent::isCacheEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityType($code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityType');
        return $pluginInfo ? $this->___callPlugins('getEntityType', func_get_args(), $pluginInfo) : parent::getEntityType($code);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributes');
        return $pluginInfo ? $this->___callPlugins('getAttributes', func_get_args(), $pluginInfo) : parent::getAttributes($entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute($entityType, $code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttribute');
        return $pluginInfo ? $this->___callPlugins('getAttribute', func_get_args(), $pluginInfo) : parent::getAttribute($entityType, $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityAttributeCodes($entityType, $object = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityAttributeCodes');
        return $pluginInfo ? $this->___callPlugins('getEntityAttributeCodes', func_get_args(), $pluginInfo) : parent::getEntityAttributeCodes($entityType, $object);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityAttributes($entityType, $object = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityAttributes');
        return $pluginInfo ? $this->___callPlugins('getEntityAttributes', func_get_args(), $pluginInfo) : parent::getEntityAttributes($entityType, $object);
    }

    /**
     * {@inheritdoc}
     */
    public function importAttributesData($entityType, array $attributes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'importAttributesData');
        return $pluginInfo ? $this->___callPlugins('importAttributesData', func_get_args(), $pluginInfo) : parent::importAttributesData($entityType, $attributes);
    }
}
