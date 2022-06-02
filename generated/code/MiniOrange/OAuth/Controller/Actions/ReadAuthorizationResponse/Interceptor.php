<?php
namespace MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse;

/**
 * Interceptor class for @see \MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse
 */
class Interceptor extends \MiniOrange\OAuth\Controller\Actions\ReadAuthorizationResponse implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \MiniOrange\OAuth\Controller\Actions\ProcessResponseAction $sE)
    {
        $this->___init();
        parent::__construct($Dp, $GQ, $sE);
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
    public function setRequestParam($ge)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setRequestParam');
        return $pluginInfo ? $this->___callPlugins('setRequestParam', func_get_args(), $pluginInfo) : parent::setRequestParam($ge);
    }

    /**
     * {@inheritdoc}
     */
    public function setPostParam($post)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setPostParam');
        return $pluginInfo ? $this->___callPlugins('setPostParam', func_get_args(), $pluginInfo) : parent::setPostParam($post);
    }

    /**
     * {@inheritdoc}
     */
    public function verifySign($GW, $Cz)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'verifySign');
        return $pluginInfo ? $this->___callPlugins('verifySign', func_get_args(), $pluginInfo) : parent::verifySign($GW, $Cz);
    }

    /**
     * {@inheritdoc}
     */
    public function get_base64_from_url($aB)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'get_base64_from_url');
        return $pluginInfo ? $this->___callPlugins('get_base64_from_url', func_get_args(), $pluginInfo) : parent::get_base64_from_url($aB);
    }

    /**
     * {@inheritdoc}
     */
    public function decodeJWT($ZB)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'decodeJWT');
        return $pluginInfo ? $this->___callPlugins('decodeJWT', func_get_args(), $pluginInfo) : parent::decodeJWT($ZB);
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
