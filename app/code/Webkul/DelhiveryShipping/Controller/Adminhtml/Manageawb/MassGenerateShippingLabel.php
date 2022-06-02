<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryShipping\Controller\Adminhtml\Manageawb;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\View\Result\PageFactory;

class MassGenerateShippingLabel extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $_resultPage;

    /**
     * @var Webkul\DelhiveryShipping\Helper\Data
     */
    protected $_delhiveryHelper;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * @var \Webkul\DelhiveryShipping\Model\Manageawb
     */
    protected $_delhiveryModelAwb;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
        \Webkul\DelhiveryShipping\Model\ResourceModel\Manageawb\CollectionFactory $collectionFactory,
        Context $context
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->filter = $filter;
        $this->_delhiveryHelper = $delhiveryHelper;
        $this->_date = $date;
        $this->_delhiveryModelAwb = $delhiveryModelAwb;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Download Pincode Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        try {
            $result = "";
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $trackingNum = '';
            foreach ($collection as $awbData) {
                if ($awbData->getStatus()=="Assigned" || $awbData->getStatus()=="InTransit") {
                    continue;
                }
                $trackingNum .= $awbData->getAwb().',';
            }

            if ($trackingNum != '') {
                $result = $this->_delhiveryHelper->executeShippingLabelCurl($trackingNum);
            }
            $result = json_decode($result);
            if (isset($result->packages)) {
                $pdf = $this->_objectManager->create(
                    'Webkul\DelhiveryShipping\Model\ShippingLabel'
                )->getPdfData($result);
            } else {
                $this->messageManager->addError(
                    __("Please Submit Manifest and AWD Status , Before generatting shipping label")
                );
            }
        } catch (\Exception $e) {
            $this->messageManager->addError(
                __($e->getMessage())
            );
        }
        return $this->resultRedirectFactory->create()->setPath(
            '*/*/index'
        );
    }
}
