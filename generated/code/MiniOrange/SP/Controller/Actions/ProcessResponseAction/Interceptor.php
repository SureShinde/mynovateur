<?php
namespace MiniOrange\SP\Controller\Actions\ProcessResponseAction;

/**
 * Interceptor class for @see \MiniOrange\SP\Controller\Actions\ProcessResponseAction
 */
class Interceptor extends \MiniOrange\SP\Controller\Actions\ProcessResponseAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \MiniOrange\SP\Helper\SPUtility $spUtility, \MiniOrange\SP\Controller\Actions\CheckAttributeMappingAction $attrMappingAction)
    {
        $this->___init();
        parent::__construct($context, $spUtility, $attrMappingAction);
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
    public function setSamlResponse($samlResponse)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setSamlResponse');
        return $pluginInfo ? $this->___callPlugins('setSamlResponse', func_get_args(), $pluginInfo) : parent::setSamlResponse($samlResponse);
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
