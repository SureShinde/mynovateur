<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqProductgroup;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Redstage\BoqConfigurator\Model\BoqProductgroup;
use Redstage\BoqConfigurator\Model\BoqProductgroupFactory;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var BoqProductgroupFactory
     */
    protected $boqProductgroupFactory;
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor     
     * @param BoqProductgroupFactory|null $boqProductgroupFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,    
        BoqProductgroupFactory $boqProductgroupFactory
    ) {
        
        $this->dataPersistor = $dataPersistor;
        $this->boqProductgroupFactory = $boqProductgroupFactory;
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
       $items = $this->boqProductgroupFactory->create()->getCollection()->addFieldToFilter('name', $data['name'])->getData();
        
        
        if(count($items) == 1){
                 $this->messageManager->addError(__('This Product Group Already exists.'));
                 return $resultRedirect->setPath('*/boqproductgroup/');
        }
        else{
        if ($data) {
            $id = $this->getRequest()->getParam('id');

            if (empty($data['id'])) {
                $data['id'] = null;
            }
            
            /** @var \Redstage\BoqConfigurator\Model\BoqProductgroup $model */
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqProductgroup')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Product Group no longer exists.'));
                return $resultRedirect->setPath('*/boqproductgroup/');
            }    
             
            
            $model->setData($data);

            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved the Product group.'));
                $this->dataPersistor->clear('boqproductgroup');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/boqproductgroup/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/boqproductgroup/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the Productgroup.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('BoqProductgroup', $data);
            return $resultRedirect->setPath('*/boqproductgroup/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
    }
        return $resultRedirect->setPath('*/boqproductgroup/');
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqproductgroup_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqproductgroup_create');
    }
}
