<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqProductgroup;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_BoqConfigurator::boqproductgroup_delete';

    /**
     * Delete BoqProductgroup
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
                $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqProductgroup');
                $model->load($BoqConfiguratorId);
                $model->delete();
                $this->messageManager->addSuccess(__('The Product group has been deleted successfully.'));
                return $resultRedirect->setPath('*/boqproductgroup/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/boqproductgroup/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Product group doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/boqproductgroup/index');
    }
}
