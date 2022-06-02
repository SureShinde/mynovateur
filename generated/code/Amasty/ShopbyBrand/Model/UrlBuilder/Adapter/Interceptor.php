<?php
namespace Amasty\ShopbyBrand\Model\UrlBuilder\Adapter;

/**
 * Interceptor class for @see \Amasty\ShopbyBrand\Model\UrlBuilder\Adapter
 */
class Interceptor extends \Amasty\ShopbyBrand\Model\UrlBuilder\Adapter implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlFactory $urlBuilderFactory, \Amasty\ShopbyBrand\Helper\Data $brandHelper, \Magento\Framework\App\RequestInterface $request, \Amasty\ShopbyBrand\Model\ConfigProvider $configProvider)
    {
        $this->___init();
        parent::__construct($urlBuilderFactory, $brandHelper, $request, $configProvider);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl($routePath = null, $routeParams = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrl');
        return $pluginInfo ? $this->___callPlugins('getUrl', func_get_args(), $pluginInfo) : parent::getUrl($routePath, $routeParams);
    }

    /**
     * {@inheritdoc}
     */
    public function getSuffix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSuffix');
        return $pluginInfo ? $this->___callPlugins('getSuffix', func_get_args(), $pluginInfo) : parent::getSuffix();
    }
}
