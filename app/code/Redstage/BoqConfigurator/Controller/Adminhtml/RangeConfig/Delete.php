<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\RangeConfig;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_BoqConfigurator::rangeconfig_delete';

    /**
     * Delete rangeconfig
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        // check if we know what should be deleted
        $rangeconfigId = (int)$this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($rangeconfigId && (int) $rangeconfigId > 0) {
            try {
                $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\RangeConfig');
                $model->load($rangeconfigId);
                $model->delete();
                $this->messageManager->addSuccess(__('The Room Range has been deleted successfully.'));
                return $resultRedirect->setPath('*/rangeconfig/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/rangeconfig/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Range doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/rangeconfig/index');
    }
}