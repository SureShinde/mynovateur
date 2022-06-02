<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
 * @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
class Delete extends Action
{
    /**
     * @var \Redstage\LayeredNavigation\Model\LayeredNavigation
     */
    protected $modelLayerednavigation;
    /**
     * @param Context                  $context
     * @param \Redstage\LayeredNavigation\Model\LayeredNavigation $layerednavigationFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Redstage\LayeredNavigation\Model\LayeredNavigation $layerednavigationFactory
    ) {
        parent::__construct($context);
        $this->modelLayerednavigation = $layerednavigationFactory;
    }
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MD_UiExample::index_delete');
    }
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->modelLayerednavigation;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}