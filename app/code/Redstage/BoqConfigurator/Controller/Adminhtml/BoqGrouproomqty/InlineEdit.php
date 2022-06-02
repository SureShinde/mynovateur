<?php
namespace Redstage\BoqConfigurator\Controller\Adminhtml\BoqGrouproomqty;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Redstage\BoqConfigurator\Model\BoqGrouproomlinkFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    /** @var JsonFactory  */
    protected $jsonFactory;

    /** @var boqGrouproomlink  */
    protected $boqGrouproomlink;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param BoqGrouproomlinkFactory $boqGrouproomlink
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        BoqGrouproomlinkFactory $boqGrouproomlink
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->boqGrouproomlink = $boqGrouproomlink;
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
                foreach (array_keys($postItems) as $boqGrouproomLinkId) {
                    /** @var \Redstage\BoqConfigurator\Model\BoqGrouproomlink $model */
                    $model = $this->boqGrouproomlink->create();
                    $model->load($boqGrouproomLinkId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$boqGrouproomLinkId]));
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
     * Add BoqGrouproomlink name to error message
     *
     * @param \Redstage\BoqConfigurator\Model\BoqGrouproomlink $BoqGrouproomlink
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithContactId(\Redstage\BoqConfigurator\Model\BoqGrouproomlink $BoqGrouproomlink, $errorText)
    {
        return '[BoqGrouproomlink ID: ' . $BoqGrouproomlink->getLinkId() . '] ' . $errorText;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqgrouproomqty_create') ||
        $this->_authorization->isAllowed('Redstage_BoqConfigurator::boqgrouproomqty_update');
    }
}
