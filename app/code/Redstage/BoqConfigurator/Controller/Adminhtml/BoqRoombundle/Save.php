<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoombundle;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Redstage\BoqConfigurator\Model\BoqRoombundleFactory;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var boqRoombundleFactory
     */
    protected $boqRoombundleFactory;
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param BoqRoombundleFactoryactory|null $boqRoombundleFactory
     */
    public function __construct(
        Context $context,
        BoqRoombundleFactory $boqRoombundleFactory,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->boqRoombundleFactory = $boqRoombundleFactory;        
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
            $id = $this->getRequest()->getParam('id');
            
            if (empty($data['id'])) {
                $datas['id'] = null;
            }
            
            /** @var \Redstage\BoqConfigurator\Model\BoqRoombundle $model */
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoombundle')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Room Bundle no longer exists.'));
                return $resultRedirect->setPath('*/boqroombundle/');
            }       
        
            $i = 0;
            $len = count($data);
            if (empty($data['id'])) {
                $items = $this->boqRoombundleFactory->create()->getCollection()->addFieldToFilter('name', $data[0])->getData();
                if(count($items) == 1){
                    $this->messageManager->addError(__('This Room Bundle already exists.'));
                    return $resultRedirect->setPath('*/boqroombundle/');
                }
                $datas['id'] = null;
            
            foreach ($data as $key=>$val) {
                if ($i == 0) {
                    $datas['name'] = $val;
                }
                if($i >0 && $i < $len-1) {                    
                    
                    $ranges[$key] =$val;                                           
                     
                }              
                
                $i++;
            }
        
            
            $datas['room_type_config']=json_encode($ranges);
            
           // $datas['room_type_config'] = implode(",",$range);
        
                 
            $model->setData($datas);
        }
        else{
            $editdata['id'] = $model->getId();
            unset($data['id']);
            unset($data['room_type_config']);
            unset($data['created_at']);
            unset($data['updated_at']);
            unset($data['name']);
            unset($data['form_key']);
                foreach ($data as $key=>$val) {
                    if ($i == 0) {
                    $editdata['name'] = $val;
                }
                    if($i >0 && $i < $len-1) {                    
                            
                        $ranges[$key] =$val;                                           
                    }              
                    $i++;
                }
                
                    
            $editdata['room_type_config']=json_encode($ranges);
            $model->setData($editdata);
        }
            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved the Room Bundle.'));
                $this->dataPersistor->clear('BoqRoombundle');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/boqroombundle/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/boqroombundle/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the Room Bundle.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('BoqRoombundle', $data);
            return $resultRedirect->setPath('*/boqroombundle/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/boqroombundle/');
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroombundle_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqroombundle_create');
    }
}
