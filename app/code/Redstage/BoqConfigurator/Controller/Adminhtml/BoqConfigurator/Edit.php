<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqConfigurator;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqConfigurator');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This BoqConfigurator no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('BoqConfigurator', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Redstage_BoqConfigurator::all_boqconfigurator'
        )->addBreadcrumb(
            __('BOQ'), __('BOQ')
        )->addBreadcrumb(
            __('All BOQ Quotes'), __('All BOQ Quotes')
        )->addBreadcrumb(
            $id ? __('Edit BoqConfigurator') : __('New BOQ Quote'),
            $id ? __('Edit BoqConfigurator') : __('New BOQ Quote')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('All BOQ Quotes'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New BOQ Quote'));
        return $resultPage;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqconfigurator_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqconfigurator_create');
    }
}
