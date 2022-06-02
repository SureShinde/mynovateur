<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoomrange;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Redstage\BoqConfigurator\Model\BoqRoomtypeFactory;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var boqRoomtypeFactory
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
        
        if ($data) {
          /* $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype');
             $id = $this->getRequest()->getParam('id');
           if (empty($data['id'])) {
                $datas['id'] = null;
            }
            
            /* @var \Redstage\BoqConfigurator\Model\BoqRoomtype $model 
            else{
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This BoqRoomrange no longer exists.'));
                return $resultRedirect->setPath('/boqroomrange/');
            }
            $datas['id'] = $model->getId();
            $datas['name'] = $model->getName();
        }          
             
            $datas['range_config'] = implode(",",$data['range_config']);       
            $model->setData($datas);  */   

            $items = $this->boqRoomtypeFactory->create()->getCollection()->addFieldToFilter('name', $data['name'])->getData();
        
        
        if(count($items) == 1){
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype');
            $datas['id'] = $items[0]['id'];
            $datas['name'] = $data['name'];
            $datas['is_active'] = $data['is_active'];
            $datas['range_config'] = implode(",",$data['range_config']);       
            $model->setData($datas);
        }     
            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved the Room Product Range Configuration .'));
                $this->dataPersistor->clear('BoqRoomtype');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/boqroomrange/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/boqroomrange/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the Room Range.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('BoqRoomtype', $data);
            return $resultRedirect->setPath('*/boqroomrange/edit', ['id' => $this->getRequest()->getParam('id')]);
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
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroomrange_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroomrange_create');
    }
}
