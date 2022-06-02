<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqConfigurator;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_BoqConfigurator::boqconfigurator_delete';

    /**
     * Delete BoqConfigurator
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
                $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqConfigurator');
                $model->load($BoqConfiguratorId);
                $model->delete();
                $this->messageManager->addSuccess(__('The BoqConfigurator has been deleted successfully.'));
                return $resultRedirect->setPath('*/boqconfigurator/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/boqconfigurator/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('BoqConfigurator doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/boqconfigurator/index');
    }
}
