<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoomtype;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_BoqConfigurator::boqroomtype_delete';

    /**
     * Delete BoqRoomtype
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        // check if we know what should be deleted
        $BoqConfiguratorId = (int)$this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($BoqConfiguratorId && (int) $BoqConfiguratorId > 0) {
            try {
                $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype');
                $model->load($BoqConfiguratorId);
                $model->delete();
                $this->messageManager->addSuccess(__('The Room type has been deleted successfully.'));
                return $resultRedirect->setPath('*/boqroomtype/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/Boqroomtype/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Room type doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/boqroomtype/index');
    }
}
