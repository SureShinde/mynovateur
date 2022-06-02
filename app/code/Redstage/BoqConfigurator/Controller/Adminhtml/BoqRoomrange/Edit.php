<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoomrange;

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
        $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Room Range no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/boqroomrange/');
            }
        }

        $this->_coreRegistry->register('BoqRoomtype', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Redstage_BoqConfigurator::all_boqroomrange'
        )->addBreadcrumb(
            __('BOQ'), __('BOQ')
        )->addBreadcrumb(
            __('All Room Range'), __('All Room Range')
        )->addBreadcrumb(
            $id ? __('Edit Room Range') : __('New Room Range'),
            $id ? __('Edit Room Range') : __('New Room Range')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('All Room Range'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Room Range'));
        return $resultPage;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroomrange_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroomrange_create');
    }
}
