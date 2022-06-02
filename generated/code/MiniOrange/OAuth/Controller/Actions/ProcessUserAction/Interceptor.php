<?php
namespace MiniOrange\OAuth\Controller\Actions\ProcessUserAction;

/**
 * Interceptor class for @see \MiniOrange\OAuth\Controller\Actions\ProcessUserAction
 */
class Interceptor extends \MiniOrange\OAuth\Controller\Actions\ProcessUserAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Customer\Model\ResourceModel\Group\Collection $HQ, \Magento\Authorization\Model\ResourceModel\Role\Collection $LR, \Magento\User\Model\User $P4, \Magento\Customer\Model\Customer $kD, \Magento\Store\Model\StoreManagerInterface $W6, \Magento\Framework\App\ResponseFactory $Ub, \MiniOrange\OAuth\Controller\Actions\CustomerLoginAction $yZ, \Magento\Customer\Model\CustomerFactory $fi, \Magento\User\Model\UserFactory $pm, \Magento\Framework\Math\Random $R2, \Magento\Customer\Model\AddressFactory $f6)
    {
        $this->___init();
        parent::__construct($Dp, $GQ, $HQ, $LR, $P4, $kD, $W6, $Ub, $yZ, $fi, $pm, $R2, $f6);
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
    public function setFlattenedAttrs($ct)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFlattenedAttrs');
        return $pluginInfo ? $this->___callPlugins('setFlattenedAttrs', func_get_args(), $pluginInfo) : parent::setFlattenedAttrs($ct);
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
