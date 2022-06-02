<?php
namespace MiniOrange\SP\Controller\Actions\CustomerLoginAction;

/**
 * Interceptor class for @see \MiniOrange\SP\Controller\Actions\CustomerLoginAction
 */
class Interceptor extends \MiniOrange\SP\Controller\Actions\CustomerLoginAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \MiniOrange\SP\Helper\SPUtility $spUtility, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\App\ResponseFactory $responseFactory)
    {
        $this->___init();
        parent::__construct($context, $spUtility, $customerSession, $responseFactory);
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
    public function setCustomerId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCustomerId');
        return $pluginInfo ? $this->___callPlugins('setCustomerId', func_get_args(), $pluginInfo) : parent::setCustomerId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setRelayState($relayState)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setRelayState');
        return $pluginInfo ? $this->___callPlugins('setRelayState', func_get_args(), $pluginInfo) : parent::setRelayState($relayState);
    }

    /**
     * {@inheritdoc}
     */
    public function setAxCompanyId($accountId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAxCompanyId');
        return $pluginInfo ? $this->___callPlugins('setAxCompanyId', func_get_args(), $pluginInfo) : parent::setAxCompanyId($accountId);
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
