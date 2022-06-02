<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqGrouproomqty;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_BoqConfigurator::boqgrouproomqty_delete';

    /**
     * 
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        // check if we know what should be deleted
        $BoqConfiguratorId = (int)$this->getRequest()->getParam('link_id');
        
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($BoqConfiguratorId && (int) $BoqConfiguratorId > 0) {
            try {
                $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqGrouproomlink');
                $model->load($BoqConfiguratorId);
                $model->delete();
                $this->messageManager->addSuccess(__('The Group Room Qty has been deleted successfully.'));
                return $resultRedirect->setPath('*/boqgrouproomqty/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/boqgrouproomqty/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Product group Qty doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/boqgrouproomqty/index');
    }
}
