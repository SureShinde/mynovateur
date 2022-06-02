<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqGrouproomqty;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;        
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
            $id = $this->getRequest()->getParam('link_id');

            if (empty($data['link_id'])) {
                $data['link_id'] = null;
            }

            
            
            /** @var \Redstage\BoqConfigurator\Model\BoqGrouproomlink $model */
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqGrouproomlink')->load($id);
            if (!$model->getLinkId() && $id) {
                $this->messageManager->addError(__('This Product group Qty no longer exists.'));
                return $resultRedirect->setPath('*/boqgrouproomqty/');
            }
            $data['product_group_id'] = $data[0];
            $data['room_type_id'] = $data[1];
            
            $datas['range']['room_type_id'] = $data[1];
            $datas['range']['bundle_type_id'] = $data[2];
            $datas['range']['qty'] = $data[3];
            
            $data['product_group_config'] = json_encode($datas['range']);
            
            $model->setData($data);     
            

            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved the Product Group Qty.'));
                $this->dataPersistor->clear('BoqGrouproomlink');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/boqgrouproomqty/edit', ['link_id' => $model->getLinkId()]);
                }
                return $resultRedirect->setPath('*/boqgrouproomqty/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the Product group qty.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('BoqGrouproomlink', $data);
            return $resultRedirect->setPath('*/boqgrouproomqty/edit', ['link_id' => $this->getRequest()->getParam('link_id')]);
        }
        return $resultRedirect->setPath('*/boqgrouproomqty/');
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqgrouproomqty_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqgrouproomqty_create');
    }
}
