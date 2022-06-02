<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqConfigurator;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    /** @var JsonFactory  */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $BoqConfiguratorId) {
                    /** @var \Redstage\BoqConfigurator\Model\BoqConfigurator $model */
                    $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqConfigurator');
                    $model->load($BoqConfiguratorId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$BoqConfiguratorId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithContactId(
                            $model,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add BoqConfigurator name to error message
     *
     * @param \Redstage\BoqConfigurator\Model\BoqConfigurator $BoqConfigurator
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithContactId(\Redstage\BoqConfigurator\Model\BoqConfigurator $BoqConfigurator, $errorText)
    {
        return '[BoqConfigurator ID: ' . $BoqConfigurator->getId() . '] ' . $errorText;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqconfigurator_create') ||
        $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqconfigurator_update');
    }
}
