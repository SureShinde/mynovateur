<?php
namespace MiniOrange\SP\Controller\Actions\ShowTestResultsAction;

/**
 * Interceptor class for @see \MiniOrange\SP\Controller\Actions\ShowTestResultsAction
 */
class Interceptor extends \MiniOrange\SP\Controller\Actions\ShowTestResultsAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \MiniOrange\SP\Helper\SPUtility $spUtility)
    {
        $this->___init();
        parent::__construct($context, $spUtility);
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
    public function setAttrs($attrs)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAttrs');
        return $pluginInfo ? $this->___callPlugins('setAttrs', func_get_args(), $pluginInfo) : parent::setAttrs($attrs);
    }

    /**
     * {@inheritdoc}
     */
    public function setSamlException($exception)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setSamlException');
        return $pluginInfo ? $this->___callPlugins('setSamlException', func_get_args(), $pluginInfo) : parent::setSamlException($exception);
    }

    /**
     * {@inheritdoc}
     */
    public function setHasExceptionOccurred($hasExceptionOccurred)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setHasExceptionOccurred');
        return $pluginInfo ? $this->___callPlugins('setHasExceptionOccurred', func_get_args(), $pluginInfo) : parent::setHasExceptionOccurred($hasExceptionOccurred);
    }

    /**
     * {@inheritdoc}
     */
    public function setNameId($nameId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setNameId');
        return $pluginInfo ? $this->___callPlugins('setNameId', func_get_args(), $pluginInfo) : parent::setNameId($nameId);
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
