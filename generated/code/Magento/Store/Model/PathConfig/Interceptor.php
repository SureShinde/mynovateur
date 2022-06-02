<?php
namespace Magento\Store\Model\PathConfig;

/**
 * Interceptor class for @see \Magento\Store\Model\PathConfig
 */
class Interceptor extends \Magento\Store\Model\PathConfig implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Url\SecurityInfoInterface $urlSecurityInfo, \Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->___init();
        parent::__construct($scopeConfig, $urlSecurityInfo, $storeManager);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentSecureUrl(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurrentSecureUrl');
        return $pluginInfo ? $this->___callPlugins('getCurrentSecureUrl', func_get_args(), $pluginInfo) : parent::getCurrentSecureUrl($request);
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeSecure($path)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'shouldBeSecure');
        return $pluginInfo ? $this->___callPlugins('shouldBeSecure', func_get_args(), $pluginInfo) : parent::shouldBeSecure($path);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultPath()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultPath');
        return $pluginInfo ? $this->___callPlugins('getDefaultPath', func_get_args(), $pluginInfo) : parent::getDefaultPath();
    }
}
