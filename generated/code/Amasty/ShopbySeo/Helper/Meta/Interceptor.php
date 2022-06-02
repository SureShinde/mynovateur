<?php
namespace Amasty\ShopbySeo\Helper\Meta;

/**
 * Interceptor class for @see \Amasty\ShopbySeo\Helper\Meta
 */
class Interceptor extends \Amasty\ShopbySeo\Helper\Meta implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Amasty\Shopby\Helper\Data $dataHelper, \Amasty\ShopbySeo\Helper\Data $seoHelper, \Magento\Framework\Registry $registry, \Magento\Framework\App\Request\Http $request, \Amasty\ShopbyBase\Model\Integration\IntegrationFactory $integrationFactory)
    {
        $this->___init();
        parent::__construct($context, $dataHelper, $seoHelper, $registry, $request, $integrationFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function setPageTags(\Magento\Framework\View\Page\Config $pageConfig)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setPageTags');
        return $pluginInfo ? $this->___callPlugins('setPageTags', func_get_args(), $pluginInfo) : parent::setPageTags($pageConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexTagValue()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexTagValue');
        return $pluginInfo ? $this->___callPlugins('getIndexTagValue', func_get_args(), $pluginInfo) : parent::getIndexTagValue();
    }

    /**
     * {@inheritdoc}
     */
    public function getFollowTagValue()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFollowTagValue');
        return $pluginInfo ? $this->___callPlugins('getFollowTagValue', func_get_args(), $pluginInfo) : parent::getFollowTagValue();
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexTagByData($indexTag, \Magento\Framework\DataObject $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexTagByData');
        return $pluginInfo ? $this->___callPlugins('getIndexTagByData', func_get_args(), $pluginInfo) : parent::getIndexTagByData($indexTag, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getFollowTagByData($followTag, \Magento\Framework\DataObject $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFollowTagByData');
        return $pluginInfo ? $this->___callPlugins('getFollowTagByData', func_get_args(), $pluginInfo) : parent::getFollowTagByData($followTag, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTagByData($tagKey, $tagValue, $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTagByData');
        return $pluginInfo ? $this->___callPlugins('getTagByData', func_get_args(), $pluginInfo) : parent::getTagByData($tagKey, $tagValue, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function isFollowingAllowed()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isFollowingAllowed');
        return $pluginInfo ? $this->___callPlugins('isFollowingAllowed', func_get_args(), $pluginInfo) : parent::isFollowingAllowed();
    }

    /**
     * {@inheritdoc}
     */
    public function isModifyRobotsEnable()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isModifyRobotsEnable');
        return $pluginInfo ? $this->___callPlugins('isModifyRobotsEnable', func_get_args(), $pluginInfo) : parent::isModifyRobotsEnable();
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isModuleOutputEnabled');
        return $pluginInfo ? $this->___callPlugins('isModuleOutputEnabled', func_get_args(), $pluginInfo) : parent::isModuleOutputEnabled($moduleName);
    }
}
