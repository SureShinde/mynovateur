<?php
namespace Amasty\ShopbySeo\Helper\Url;

/**
 * Interceptor class for @see \Amasty\ShopbySeo\Helper\Url
 */
class Interceptor extends \Amasty\ShopbySeo\Helper\Url implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Amasty\ShopbySeo\Helper\Data $helper, \Magento\Framework\Registry $coreRegistry, \Magento\Store\Model\StoreManagerInterface $storeManager, \Amasty\ShopbySeo\Helper\UrlParser $urlParser, \Amasty\ShopbySeo\Helper\Config $config, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Amasty\ShopbySeo\Model\SeoOptions $seoOptions)
    {
        $this->___init();
        parent::__construct($context, $helper, $coreRegistry, $storeManager, $urlParser, $config, $dataPersistor, $seoOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRequest');
        return $pluginInfo ? $this->___callPlugins('getRequest', func_get_args(), $pluginInfo) : parent::getRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function seofyUrl($url)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'seofyUrl');
        return $pluginInfo ? $this->___callPlugins('seofyUrl', func_get_args(), $pluginInfo) : parent::seofyUrl($url);
    }

    /**
     * {@inheritdoc}
     */
    public function modifySeoIdentifier($identifier)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'modifySeoIdentifier');
        return $pluginInfo ? $this->___callPlugins('modifySeoIdentifier', func_get_args(), $pluginInfo) : parent::modifySeoIdentifier($identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function modifySeoIdentifierByAlias($identifier, $aliases = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'modifySeoIdentifierByAlias');
        return $pluginInfo ? $this->___callPlugins('modifySeoIdentifierByAlias', func_get_args(), $pluginInfo) : parent::modifySeoIdentifierByAlias($identifier, $aliases);
    }

    /**
     * {@inheritdoc}
     */
    public function hasCategoryFilterParam()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasCategoryFilterParam');
        return $pluginInfo ? $this->___callPlugins('hasCategoryFilterParam', func_get_args(), $pluginInfo) : parent::hasCategoryFilterParam();
    }

    /**
     * {@inheritdoc}
     */
    public function parseQuery($query)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'parseQuery');
        return $pluginInfo ? $this->___callPlugins('parseQuery', func_get_args(), $pluginInfo) : parent::parseQuery($query);
    }

    /**
     * {@inheritdoc}
     */
    public function removeCategorySuffix($url)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'removeCategorySuffix');
        return $pluginInfo ? $this->___callPlugins('removeCategorySuffix', func_get_args(), $pluginInfo) : parent::removeCategorySuffix($url);
    }

    /**
     * {@inheritdoc}
     */
    public function isSeoUrlEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isSeoUrlEnabled');
        return $pluginInfo ? $this->___callPlugins('isSeoUrlEnabled', func_get_args(), $pluginInfo) : parent::isSeoUrlEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getAddSuffixSettingValue()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAddSuffixSettingValue');
        return $pluginInfo ? $this->___callPlugins('getAddSuffixSettingValue', func_get_args(), $pluginInfo) : parent::getAddSuffixSettingValue();
    }

    /**
     * {@inheritdoc}
     */
    public function isAddSuffixToShopby()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isAddSuffixToShopby');
        return $pluginInfo ? $this->___callPlugins('isAddSuffixToShopby', func_get_args(), $pluginInfo) : parent::isAddSuffixToShopby();
    }

    /**
     * {@inheritdoc}
     */
    public function getSeoSuffix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSeoSuffix');
        return $pluginInfo ? $this->___callPlugins('getSeoSuffix', func_get_args(), $pluginInfo) : parent::getSeoSuffix();
    }

    /**
     * {@inheritdoc}
     */
    public function getParam($paramName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getParam');
        return $pluginInfo ? $this->___callPlugins('getParam', func_get_args(), $pluginInfo) : parent::getParam($paramName);
    }

    /**
     * {@inheritdoc}
     */
    public function getParams()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getParams');
        return $pluginInfo ? $this->___callPlugins('getParams', func_get_args(), $pluginInfo) : parent::getParams();
    }

    /**
     * {@inheritdoc}
     */
    public function hasParams()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasParams');
        return $pluginInfo ? $this->___callPlugins('hasParams', func_get_args(), $pluginInfo) : parent::hasParams();
    }

    /**
     * {@inheritdoc}
     */
    public function setParam($paramName, $paramValue = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setParam');
        return $pluginInfo ? $this->___callPlugins('setParam', func_get_args(), $pluginInfo) : parent::setParam($paramName, $paramValue);
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
