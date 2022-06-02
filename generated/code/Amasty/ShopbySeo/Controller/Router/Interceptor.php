<?php
namespace Amasty\ShopbySeo\Controller\Router;

/**
 * Interceptor class for @see \Amasty\ShopbySeo\Controller\Router
 */
class Interceptor extends \Amasty\ShopbySeo\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Amasty\ShopbySeo\Helper\UrlParser $urlParser, \Amasty\ShopbySeo\Helper\Url $urlHelper, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Amasty\ShopbySeo\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($urlParser, $urlHelper, $scopeConfig, $helper);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }

    /**
     * {@inheritdoc}
     */
    public function modifyRequest(\Magento\Framework\App\RequestInterface $request, $identifier, $params = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'modifyRequest');
        return $pluginInfo ? $this->___callPlugins('modifyRequest', func_get_args(), $pluginInfo) : parent::modifyRequest($request, $identifier, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function skipRequest(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'skipRequest');
        return $pluginInfo ? $this->___callPlugins('skipRequest', func_get_args(), $pluginInfo) : parent::skipRequest($request);
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
    public function initRequestMetaData(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'initRequestMetaData');
        return $pluginInfo ? $this->___callPlugins('initRequestMetaData', func_get_args(), $pluginInfo) : parent::initRequestMetaData($request);
    }
}
