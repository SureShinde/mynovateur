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
namespace Webkul\DelhiveryShipping\Controller\Adminhtml\Managepincode;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Download extends \Magento\Backend\App\Action
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
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Webkul\DelhiveryShipping\Model\ManagepincodeFactory $pincodeFactory,
        Context $context
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_delhiveryHelper = $delhiveryHelper;
        $this->_date = $date;
        $this->_jsonHelper = $jsonHelper;
        $this->_pincodeFactory = $pincodeFactory;
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
            $pincodeUrl = $this->_delhiveryHelper->getPincodeUrl();
            $token = $this->_delhiveryHelper->getLicenseKey();
            if ($pincodeUrl && $token) {
                $path = $pincodeUrl.'json/?token='.$token.'&pre-paid=Y';
                $retValue = $this->_delhiveryHelper->executeCurl($path, $token, 'GET', [], 'raw');
                $codes = $this->_jsonHelper->jsonDecode($retValue);
                $pincodeModel = $this->_pincodeFactory->create()->getCollection();
                foreach ($pincodeModel as $pin) {
                    $pin->delete();
                }
                if (sizeof($codes)) {
                    foreach ($codes['delivery_codes'] as $item) {
                        $data = [];
                        $data['district'] = $item['postal_code']['district'];
                        $data['pin'] = $item['postal_code']['pin'];
                        $data['pre_paid'] = $item['postal_code']['pre_paid'];
                        $data['cash'] = $item['postal_code']['cash'];
                        $data['pickup'] = $item['postal_code']['pickup'];
                        $data['cod'] = $item['postal_code']['cod'];
                        $data['is_oda'] = $item['postal_code']['is_oda'];
                        $data['state_code'] = $item['postal_code']['state_code'];
                        $data['created_at'] = $this->_date->gmtDate();
                        $data['update_at'] = $this->_date->gmtDate();
                        $this->savePincode($data);
                    }
                }
                $this->messageManager->addSuccess(
                    __('Pincode download Successfully')
                );
            } else {
                $this->messageManager->addError(
                    __('Please add valid License Key and Gateway URL in plugin configuration')
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

    public function savePincode($data)
    {
        $pincodeModel = $this->_pincodeFactory->create();
        $pincodeModel->addData($data);
        $pincodeModel->save();
        return $pincodeModel->getId();
    }
}
