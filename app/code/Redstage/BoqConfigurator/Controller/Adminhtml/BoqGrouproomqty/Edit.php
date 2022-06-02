<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqGrouproomqty;

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
        $id = $this->getRequest()->getParam('link_id');
        $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqGrouproomlink');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getLinkId()) {
                $this->messageManager->addError(__('This Product group Qty no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/boqgrouproomqty/');
            }
        }

        $this->_coreRegistry->register('BoqGrouproomlink', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Redstage_BoqConfigurator::all_BoqGrouproomqty'
        )->addBreadcrumb(
            __('BOQ'), __('BOQ')
        )->addBreadcrumb(
            __('All Group Room Qty'), __('All Group Room Qty')
        )->addBreadcrumb(
            $id ? __('Edit BoqGrouproomqty') : __('New Group Room Qty'),
            $id ? __('Edit BoqGrouproomqty') : __('New Group Room Qty')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('All Group Room Qty'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Group Room Qty'));
        return $resultPage;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqgrouproomqty_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqgrouproomqty_create');
    }
}
