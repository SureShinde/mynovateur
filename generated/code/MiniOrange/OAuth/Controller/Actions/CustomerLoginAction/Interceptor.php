<?php
namespace MiniOrange\OAuth\Controller\Actions\CustomerLoginAction;

/**
 * Interceptor class for @see \MiniOrange\OAuth\Controller\Actions\CustomerLoginAction
 */
class Interceptor extends \MiniOrange\OAuth\Controller\Actions\CustomerLoginAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Customer\Model\Session $t8, \Magento\Framework\App\ResponseFactory $Ub)
    {
        $this->___init();
        parent::__construct($Dp, $GQ, $t8, $Ub);
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
    public function setUser($user)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setUser');
        return $pluginInfo ? $this->___callPlugins('setUser', func_get_args(), $pluginInfo) : parent::setUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function setRelayState($pQ)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setRelayState');
        return $pluginInfo ? $this->___callPlugins('setRelayState', func_get_args(), $pluginInfo) : parent::setRelayState($pQ);
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
