<?php
namespace MiniOrange\SP\Controller\Actions\AdminLoginAction;

/**
 * Interceptor class for @see \MiniOrange\SP\Controller\Actions\AdminLoginAction
 */
class Interceptor extends \MiniOrange\SP\Controller\Actions\AdminLoginAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \MiniOrange\SP\Helper\SPUtility $spUtility, \Magento\Backend\Model\Auth\Session $adminSession, \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager, \Magento\Backend\Model\Session\AdminConfig $adminConfig, \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory, \Magento\Security\Model\AdminSessionsManager $adminSessionManager, \Magento\Backend\Model\UrlInterface $urlInterface, \Magento\User\Model\UserFactory $userFactory, \Magento\Framework\App\RequestInterface $request)
    {
        $this->___init();
        parent::__construct($context, $spUtility, $adminSession, $cookieManager, $adminConfig, $cookieMetadataFactory, $adminSessionManager, $urlInterface, $userFactory, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }

    /**
     * {@inheritdoc}
     */
    public function getActionFlag()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getActionFlag');
        return $pluginInfo ? $this->___callPlugins('getActionFlag', func_get_args(), $pluginInfo) : parent::getActionFlag();
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
    public function getResponse()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getResponse');
        return $pluginInfo ? $this->___callPlugins('getResponse', func_get_args(), $pluginInfo) : parent::getResponse();
    }
}
