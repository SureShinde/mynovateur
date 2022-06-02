<?php
namespace Magento\Cms\Helper\Page;

/**
 * Interceptor class for @see \Magento\Cms\Helper\Page
 */
class Interceptor extends \Magento\Cms\Helper\Page implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Cms\Model\Page $page, \Magento\Framework\View\DesignInterface $design, \Magento\Cms\Model\PageFactory $pageFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Framework\Escaper $escaper, \Magento\Framework\View\Result\PageFactory $resultPageFactory, ?\Magento\Cms\Model\Page\CustomLayoutManagerInterface $customLayoutManager = null, ?\Magento\Cms\Model\Page\CustomLayoutRepositoryInterface $customLayoutRepo = null, ?\Magento\Cms\Model\Page\IdentityMap $identityMap = null)
    {
        $this->___init();
        parent::__construct($context, $messageManager, $page, $design, $pageFactory, $storeManager, $localeDate, $escaper, $resultPageFactory, $customLayoutManager, $customLayoutRepo, $identityMap);
    }

    /**
     * {@inheritdoc}
     */
    public function prepareResultPage(\Magento\Framework\App\ActionInterface $action, $pageId = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepareResultPage');
        return $pluginInfo ? $this->___callPlugins('prepareResultPage', func_get_args(), $pluginInfo) : parent::prepareResultPage($action, $pageId);
    }

    /**
     * {@inheritdoc}
     */
    public function getPageUrl($pageId = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPageUrl');
        return $pluginInfo ? $this->___callPlugins('getPageUrl', func_get_args(), $pluginInfo) : parent::getPageUrl($pageId);
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isModuleOutputEnabled');
        return $pluginInfo ? $this->___callPlugins('isModuleOutputEnabled', func_get_args(), $pluginInfo) : parent::isModuleOutputEnabled($moduleName);
    }
}
