<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqRoomtype;

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
                foreach (array_keys($postItems) as $BoqRoomtypeId) {
                    /** @var \Redstage\BoqConfigurator\Model\BoqRoomtype $model */
                    $model = $this->_objectManager->create('Redstage\BoqConfigurator\Model\BoqRoomtype');
                    $model->load($BoqRoomtypeId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$BoqRoomtypeId]));
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
     * Add BoqRoomtype name to error message
     *
     * @param \Redstage\BoqConfigurator\Model\BoqRoomtype $BoqRoomtype
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithContactId(\Redstage\BoqConfigurator\Model\BoqRoomtype $BoqRoomtype, $errorText)
    {
        return '[BoqRoomtype ID: ' . $BoqRoomtype->getId() . '] ' . $errorText;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqRoomtype::boqroomtype_create') ||
        $this->_authorization->isAllowed('Redstage_BoqRoomtype::boqroomtype_update');
    }
}
