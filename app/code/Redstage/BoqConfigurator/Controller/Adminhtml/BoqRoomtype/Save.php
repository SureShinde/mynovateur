<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoomtype;

use Magento\Backend\App\Action\Context;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Redstage\BoqConfigurator\Model\BoqRoomtype;
use Redstage\BoqConfigurator\Model\BoqRoomtypeFactory;

class Save extends \Magento\Backend\App\Action 
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var BoqRoomtypeFactory
     */
    protected $boqRoomtypeFactory;
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor     
     * @param BoqRoomtypeFactory|null $boqRoomtypeFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,    
        BoqRoomtypeFactory $boqRoomtypeFactory
    ) {
        
        $this->dataPersistor = $dataPersistor;
        $this->boqRoomtypeFactory = $boqRoomtypeFactory;
        parent::__construct($context);
              
    }
    
    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
      
        $items = $this->boqRoomtypeFactory->create()->getCollection()->addFieldToFilter('name', $data['name'])->getData();
        
        
        if(count($items) == 1){
                 $this->messageManager->addError(__('This Room Type Already exists.'));
                 return $resultRedirect->setPath('*/boqroomtype/');
        }
        else{
        if ($data) {
            $id = $this->getRequest()->getParam('id');

            if (empty($data['id'])) {
                $data['id'] = null;
            }
            
            /** @var \Redstage\BoqConfigurator\Model\BoqRoomtype $model */
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This room Type no longer exists.'));
                return $resultRedirect->setPath('*/boqroomrange/');
            }    
             
            
            $model->setData($data);

            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved the Room type.'));
                $this->dataPersistor->clear('BoqRoomtype');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/boqroomrange/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/boqroomrange/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the Room type.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('BoqRoomtype', $data);
            return $resultRedirect->setPath('*/boqroomrange/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
    }
        return $resultRedirect->setPath('*/boqroomrange/');
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroomtype_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroomtype_create');
    }
}
