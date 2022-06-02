<?php
namespace MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction;

/**
 * Interceptor class for @see \MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction
 */
class Interceptor extends \MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ)
    {
        $this->___init();
        parent::__construct($Dp, $GQ);
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
    public function setAttrs($HX)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAttrs');
        return $pluginInfo ? $this->___callPlugins('setAttrs', func_get_args(), $pluginInfo) : parent::setAttrs($HX);
    }

    /**
     * {@inheritdoc}
     */
    public function setOAuthException($cZ)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setOAuthException');
        return $pluginInfo ? $this->___callPlugins('setOAuthException', func_get_args(), $pluginInfo) : parent::setOAuthException($cZ);
    }

    /**
     * {@inheritdoc}
     */
    public function setUserEmail($p6)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setUserEmail');
        return $pluginInfo ? $this->___callPlugins('setUserEmail', func_get_args(), $pluginInfo) : parent::setUserEmail($p6);
    }

    /**
     * {@inheritdoc}
     */
    public function setHasExceptionOccurred($YK)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setHasExceptionOccurred');
        return $pluginInfo ? $this->___callPlugins('setHasExceptionOccurred', func_get_args(), $pluginInfo) : parent::setHasExceptionOccurred($YK);
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
