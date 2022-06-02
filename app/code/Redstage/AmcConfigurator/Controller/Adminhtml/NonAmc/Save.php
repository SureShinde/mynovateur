<?php
namespace Redstage\AmcConfigurator\Controller\Adminhtml\NonAmc;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Redstage\AmcConfigurator\Model\NonamcList;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var NonamcList
     */
    protected $nonamcList;
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param NonamcList $nonamcList
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        NonamcList $nonamcList
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->nonamcList = $nonamcList;
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

            /** @var \Redstage\AmcConfigurator\Model\NonamcList $model */
            $model = $this->nonamcList->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Amc Configurator no longer exists.'));
                return $resultRedirect->setPath('*/nonamc/');
            }


            $model->setData($data);

            try {
                $model->save();

                $this->messageManager->addSuccess(__('You saved the AmcList.'));
                $this->dataPersistor->clear('NonamcList');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/amclist/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/amclist/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
               $this->messageManager->addException($e, __('Something went wrong while saving the AmcList.'));
               // $this->messageManager->addException($e->getMessage());
            }

            $this->dataPersistor->set('AmcList', $data);
            return $resultRedirect->setPath('*/amclist/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/amclist/');
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_AmcConfigurator::amcadmin_update') || $this->_authorization->isAllowed('Redstage_AmcConfigurator::amcadmin_create');
    }
}
