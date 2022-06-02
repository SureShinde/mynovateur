<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqConfigurator;

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
            $id = $this->getRequest()->getParam('id');

            if (empty($data['id'])) {
                $data['id'] = null;
            }
            
            /** @var \Redstage\BoqConfigurator\Model\BoqConfigurator $model */
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqConfigurator')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This BoqConfigurator no longer exists.'));
                return $resultRedirect->setPath('*/boqconfigurator/');
            }
            
            
            $datas['name'] = $data['name'];
            $datas['range_config'] = implode(",",$data['range_config']);
            $model->setData($datas);

            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved the BoqConfigurator.'));
                $this->dataPersistor->clear('BoqConfigurator');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/boqconfigurator/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/boqconfigurator/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the BoqConfigurator.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('BoqConfigurator', $data);
            return $resultRedirect->setPath('*/boqconfigurator/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/boqconfigurator/');
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqconfigurator_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqconfigurator_create');
    }
}
