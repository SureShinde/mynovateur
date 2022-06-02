<?php
namespace Amasty\Faq\Controller\Router;

/**
 * Interceptor class for @see \Amasty\Faq\Controller\Router
 */
class Interceptor extends \Amasty\Faq\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\UrlInterface $url, \Amasty\Faq\Model\ResourceModel\Category $category, \Amasty\Faq\Model\ResourceModel\Question $question, \Magento\Framework\App\ResponseInterface $response, \Magento\Framework\Message\ManagerInterface $messageManager, \Amasty\Faq\Model\ConfigProvider $configProvider, \Magento\Framework\App\Http\Context $httpContext, \Magento\Customer\Model\Session $customerSession, \Amasty\Faq\Model\Url $urlModel)
    {
        $this->___init();
        parent::__construct($actionFactory, $storeManager, $url, $category, $question, $response, $messageManager, $configProvider, $httpContext, $customerSession, $urlModel);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
