<?php
namespace MiniOrange\SP\Controller\Actions\ProcessUserAction;

/**
 * Interceptor class for @see \MiniOrange\SP\Controller\Actions\ProcessUserAction
 */
class Interceptor extends \MiniOrange\SP\Controller\Actions\ProcessUserAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Backend\App\Action\Context $context, \MiniOrange\SP\Helper\SPUtility $spUtility, \MiniOrange\SP\Controller\Adminhtml\Attrsettings\Index $index, \Magento\Customer\Model\ResourceModel\Group\Collection $userGroupModel, \Magento\Authorization\Model\ResourceModel\Role\Collection $adminRoleModel, \Magento\User\Model\User $adminUserModel, \Magento\Customer\Model\Customer $customerModel, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\ResponseFactory $responseFactory, \MiniOrange\SP\Controller\Actions\CustomerLoginAction $customerLoginAction, \Magento\Customer\Model\CustomerFactory $customerFactory, \Magento\User\Model\UserFactory $userFactory, \Magento\Framework\Math\Random $randomUtility, \Magento\Framework\App\State $_state, \Magento\Framework\ObjectManager\ConfigLoaderInterface $_configLoader, \Magento\Backend\Helper\Data $HelperBackend)
    {
        $this->___init();
        parent::__construct($messageManager, $context, $spUtility, $index, $userGroupModel, $adminRoleModel, $adminUserModel, $customerModel, $customerRepository, $storeManager, $responseFactory, $customerLoginAction, $customerFactory, $userFactory, $randomUtility, $_state, $_configLoader, $HelperBackend);
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
    public function setRelayState($relayState)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setRelayState');
        return $pluginInfo ? $this->___callPlugins('setRelayState', func_get_args(), $pluginInfo) : parent::setRelayState($relayState);
    }

    /**
     * {@inheritdoc}
     */
    public function setSessionIndex($sessionIndex)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setSessionIndex');
        return $pluginInfo ? $this->___callPlugins('setSessionIndex', func_get_args(), $pluginInfo) : parent::setSessionIndex($sessionIndex);
    }

    /**
     * {@inheritdoc}
     */
    public function generatePassword($length = 16)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'generatePassword');
        return $pluginInfo ? $this->___callPlugins('generatePassword', func_get_args(), $pluginInfo) : parent::generatePassword($length);
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
