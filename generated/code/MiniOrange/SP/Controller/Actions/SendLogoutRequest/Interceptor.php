<?php
namespace MiniOrange\SP\Controller\Actions\SendLogoutRequest;

/**
 * Interceptor class for @see \MiniOrange\SP\Controller\Actions\SendLogoutRequest
 */
class Interceptor extends \MiniOrange\SP\Controller\Actions\SendLogoutRequest implements \Magento\Framework\Interception\InterceptorInterface
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
    public function setIsAdmin($isAdmin)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setIsAdmin');
        return $pluginInfo ? $this->___callPlugins('setIsAdmin', func_get_args(), $pluginInfo) : parent::setIsAdmin($isAdmin);
    }

    /**
     * {@inheritdoc}
     */
    public function setuserId($userId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setuserId');
        return $pluginInfo ? $this->___callPlugins('setuserId', func_get_args(), $pluginInfo) : parent::setuserId($userId);
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
