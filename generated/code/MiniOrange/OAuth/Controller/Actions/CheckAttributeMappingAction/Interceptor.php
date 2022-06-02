<?php
namespace MiniOrange\OAuth\Controller\Actions\CheckAttributeMappingAction;

/**
 * Interceptor class for @see \MiniOrange\OAuth\Controller\Actions\CheckAttributeMappingAction
 */
class Interceptor extends \MiniOrange\OAuth\Controller\Actions\CheckAttributeMappingAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction $jF, \MiniOrange\OAuth\Controller\Actions\ProcessUserAction $B0, \Magento\Store\Model\StoreManagerInterface $W6)
    {
        $this->___init();
        parent::__construct($Dp, $GQ, $jF, $B0, $W6);
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
    public function setUserInfoResponse($D7)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setUserInfoResponse');
        return $pluginInfo ? $this->___callPlugins('setUserInfoResponse', func_get_args(), $pluginInfo) : parent::setUserInfoResponse($D7);
    }

    /**
     * {@inheritdoc}
     */
    public function setFlattenedUserInfoResponse($G1)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFlattenedUserInfoResponse');
        return $pluginInfo ? $this->___callPlugins('setFlattenedUserInfoResponse', func_get_args(), $pluginInfo) : parent::setFlattenedUserInfoResponse($G1);
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
