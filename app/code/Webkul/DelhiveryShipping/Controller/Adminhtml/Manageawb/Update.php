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
use Magento\Framework\View\Result\PageFactory;

class Update extends \Magento\Backend\App\Action
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
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
        Context $context
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_delhiveryHelper = $delhiveryHelper;
        $this->_date = $date;
        $this->_delhiveryModelAwb = $delhiveryModelAwb;
        parent::__construct($context);
    }

    /**
     * Update AWB Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        try {
            $gatewayUrl = $this->_delhiveryHelper->getGatewayUrl();
            $token = $this->_delhiveryHelper->getLicenseKey();
            if ($gatewayUrl =="" || $token =="") {
                throw new \Magento\Framework\Exception\LocalizedException(__('Please add valid License Key and Gateway URL in plugin configuration'));
            }
            $loadAwb = $this->_delhiveryModelAwb->getCollection()
            ->addFieldToFilter(
                "status",
                [
                    0=>'InTransit',
                    1=>'Manifested',
                    2=>'Dispatched',
                    4=>'Pending'
                ]
            );
            if (count($loadAwb)) { //No update to perform if count is zero
                $awbs = '';
                foreach ($loadAwb as $waybill) {
                    $awbs .= $waybill->getAwb().',';
                }
                $path = $gatewayUrl.'api/packages/json/?verbose=0&token='.$token.'&waybill='.$awbs;
                $retValue = $this->_delhiveryHelper->executeCurl($path, $token, 'GET', []);
                $statusupdates = json_decode($retValue);
                if (isset($statusupdates->Error)) {
                    throw new \Magento\Framework\Exception\LocalizedException(__($statusupdates->Error));
                }
                foreach ($statusupdates->ShipmentData as $item) {
                    $lmawb = $this->_delhiveryModelAwb->getCollection()
                                    ->addFieldToFilter("awb", $item->Shipment->AWB);
                    $newStatus = preg_replace('/\s+/', '', $item->Shipment->Status->Status);
                    if (count($lmawb)) {
                        foreach ($lmawb as $value) {
                            $value->setStatus($newStatus);
                            $value->save();
                        }
                    }
                }
            }
            $this->messageManager->addSuccess(__('%1 Waybill(s) Updated Successfully', count($loadAwb)));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
