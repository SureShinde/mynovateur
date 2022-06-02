<?php
namespace Redstage\Carousel\Controller\Adminhtml\Slide;

class Delete extends \Redstage\Carousel\Controller\Adminhtml\Slide
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('slide_id');
        if ($id) {
            $name = "";
            try {
               
                $slide = $this->_slideFactory->create();
                $slide->load($id);
                $name = $slide->getName();
                $slide->delete();
                $this->messageManager->addSuccess(__('Slide deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_redstage_carousel_slide_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('redstage_carousel/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_redstage_carousel_slide_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('redstage_carousel/*/edit', ['slide_id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Could not delete slide.'));
        // go to grid
        $resultRedirect->setPath('redstage_carousel/*/');
        return $resultRedirect;
    }
}
