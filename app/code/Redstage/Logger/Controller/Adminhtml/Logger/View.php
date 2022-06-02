<?php
/**
 * Redstage Logger module to log all incoming and outgoing request and responses to and from Magento
 *
 * @category: PHP
 * @package: Redstage/Logger
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Logger
 */
namespace Redstage\Logger\Controller\Adminhtml\Logger;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Redstage\Logger\Model\LoggerFactory as LoggerFactory;
use Redstage\Logger\Model\ResourceModel\Logger as ResourceModel;

/**
 * Class View
 * @package Redstage\Logger\Controller\Adminhtml\Logger
 */
class View extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var LoggerFactory
     */
    protected $loggerFactory;
    /**
     * @var ResourceModel
     */
    protected $resource;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param LoggerFactory $loggerFactory
     * @param ResourceModel $resource
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        LoggerFactory $loggerFactory,
        ResourceModel $resource
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->loggerFactory = $loggerFactory;
        $this->resource = $resource;
        parent::__construct($context);
    }

    /**
     * View Logger
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $model = $this->loggerFactory->create();
        if ($id) {
            $this->resource->load($model, $id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Log no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('View Logs'));
        return $resultPage;
    }
}
