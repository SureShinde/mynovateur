<?php
namespace MiniOrange\OAuth\Controller\Actions\AdminLoginAction;

/**
 * Interceptor class for @see \MiniOrange\OAuth\Controller\Actions\AdminLoginAction
 */
class Interceptor extends \MiniOrange\OAuth\Controller\Actions\AdminLoginAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Backend\Model\Auth\Session $te, \Magento\Framework\Stdlib\CookieManagerInterface $I8, \Magento\Backend\Model\Session\AdminConfig $Uf, \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $Sl, \Magento\Security\Model\AdminSessionsManager $Dm, \Magento\Backend\Model\UrlInterface $Np, \Magento\User\Model\UserFactory $pm, \Magento\Framework\App\RequestInterface $ge)
    {
        $this->___init();
        parent::__construct($Dp, $GQ, $te, $I8, $Uf, $Sl, $Dm, $Np, $pm, $ge);
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
