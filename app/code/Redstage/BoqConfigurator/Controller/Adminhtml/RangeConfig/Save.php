<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\RangeConfig;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Redstage\BoqConfigurator\Model\RangeConfigFactory;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var RangeConfigFactory
     */
    protected $rangeConfigFactory;
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param RangeConfigFactory|null $rangeConfigFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        RangeConfigFactory $rangeConfigFactory
    ) {
        $this->dataPersistor = $dataPersistor; 
        $this->rangeConfigFactory = $rangeConfigFactory;       
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
                $items = $this->rangeConfigFactory->create()->getCollection()->addFieldToFilter('range', $data['range'])->getData();
                if(count($items) == 1){
                    $this->messageManager->addError(__('This Range config  already exists.'));
                    return $resultRedirect->setPath('*/rangeconfig/');
                }
            }
            
            /** @var \Redstage\BoqConfigurator\Model\RangeConfig $model */
            $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\RangeConfig')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Range Config no longer exists.'));
                return $resultRedirect->setPath('*/rangeconfig/');
            }

                
            $data['range'] = $data['range'];
            $data['color'] = implode(",",$data['color']);
            $data['finished'] = implode(",",$data['finished']);
            
            $model->setData($data);  
            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('You saved the Room Product Range Configuration .'));
                $this->dataPersistor->clear('RangeConfig');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/rangeconfig/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/rangeconfig/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the Room Range.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('RangeConfig', $data);
            return $resultRedirect->setPath('*/rangeconfig/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/rangeconfig/');
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::rangeconfig_update') || $this->_authorization->isAllowed('Redstage_BoqConfigurator::rangeconfig_create');
    }
}
