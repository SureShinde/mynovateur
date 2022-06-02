<?php
namespace MiniOrange\SP\Controller\Adminhtml\Attrsettings\Index;

/**
 * Interceptor class for @see \MiniOrange\SP\Controller\Adminhtml\Attrsettings\Index
 */
class Interceptor extends \MiniOrange\SP\Controller\Adminhtml\Attrsettings\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MiniOrange\SP\Helper\SPUtility $spUtility, \Magento\Framework\Message\ManagerInterface $messageManager, \Psr\Log\LoggerInterface $logger, \Magento\Authorization\Model\ResourceModel\Role\Collection $adminRoleModel, \Magento\Customer\Model\ResourceModel\Attribute\Collection $attributeModel, \Magento\Customer\Model\ResourceModel\Group\Collection $userGroupModel)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $spUtility, $messageManager, $logger, $adminRoleModel, $attributeModel, $userGroupModel);
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
    public function getParams()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getParams');
        return $pluginInfo ? $this->___callPlugins('getParams', func_get_args(), $pluginInfo) : parent::getParams();
    }

    /**
     * {@inheritdoc}
     */
    public function checkIfSupportQueryFieldsEmpty($array)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'checkIfSupportQueryFieldsEmpty');
        return $pluginInfo ? $this->___callPlugins('checkIfSupportQueryFieldsEmpty', func_get_args(), $pluginInfo) : parent::checkIfSupportQueryFieldsEmpty($array);
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
    public function _processUrlKeys()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, '_processUrlKeys');
        return $pluginInfo ? $this->___callPlugins('_processUrlKeys', func_get_args(), $pluginInfo) : parent::_processUrlKeys();
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl($route = '', $params = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrl');
        return $pluginInfo ? $this->___callPlugins('getUrl', func_get_args(), $pluginInfo) : parent::getUrl($route, $params);
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
