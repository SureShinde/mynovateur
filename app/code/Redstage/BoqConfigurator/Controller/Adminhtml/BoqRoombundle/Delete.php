<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoombundle;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_BoqConfigurator::boqroombundle_delete';

    /**
     * Delete boqroombundle
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        // check if we know what should be deleted
        $boqroombundleId = (int)$this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($boqroombundleId && (int) $boqroombundleId > 0) {
            try {
                $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoombundle');
                $model->load($boqroombundleId);
                $model->delete();
                $this->messageManager->addSuccess(__('The Room Bundle has been deleted successfully.'));
                return $resultRedirect->setPath('*/boqroombundle/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/boqroombundle/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Room Range doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/boqroombundle/index');
    }
}
