<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoomrange;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_BoqConfigurator::boqroomrange_delete';

    /**
     * Delete boqroomrange
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        // check if we know what should be deleted
        $BoqRoomrangeId = (int)$this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($BoqRoomrangeId && (int) $BoqRoomrangeId > 0) {
            try {
                $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype');
                $model->load($BoqRoomrangeId);
                $model->delete();
                $this->messageManager->addSuccess(__('The Room Range has been deleted successfully.'));
                return $resultRedirect->setPath('*/boqroomrange/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/boqroomrange/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Room Range doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/boqroomrange/index');
    }
}
