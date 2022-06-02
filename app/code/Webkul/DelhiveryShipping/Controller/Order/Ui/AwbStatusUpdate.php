<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryShipping\Controller\Order\Ui;

use Magento\Framework\App\Action\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Webkul\Marketplace\Helper\Data as HelperData;
use Magento\Customer\Model\Url as CustomerUrl;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * Webkul Marketplace Order Printinvoice controller.
 */
class AwbStatusUpdate extends Action implements \Magento\Framework\App\CsrfAwareActionInterface
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * @var CustomerUrl
     */
    private $customerUrl;


    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @param Context $context,
     * @param Filter $filter,
     * @param Session $customerSession,
     * @param CollectionFactory $orderCollectionFactory,
     * @param HelperData $helper,
     * @param CustomerUrl $customerUrl,
     * @param \Webkul\DelhiveryExtend\Model\ShipmentFactory $shipmentFactory,
     * @param \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
     * @param DateTime $date
     */
    public function __construct(
        Context $context,
        Filter $filter,
        Session $customerSession,
        CollectionFactory $orderCollectionFactory,
        HelperData $helper,
        CustomerUrl $customerUrl,
        \Webkul\DelhiveryExtend\Model\ShipmentFactory $shipmentFactory,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        DateTime $date
    ) {
        $this->filter = $filter;
        $this->_customerSession = $customerSession;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->helper = $helper;
        $this->customerUrl = $customerUrl;
        $this->shipmentFactory = $shipmentFactory;
        $this->delhiveryHelper = $delhiveryHelper;
        $this->date = $date;
        parent::__construct(
            $context
        );
    }

    /**
     * @inheritDoc
     */
    public function createCsrfValidationException(
        RequestInterface $request
    ): ?InvalidRequestException {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }

    /**
     * Check customer authentication.
     *
     * @param RequestInterface $request
     *
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        $loginUrl = $this->customerUrl->getLoginUrl();

        if (!$this->_customerSession->authenticate($loginUrl)) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }

        return parent::dispatch($request);
    }

    /**
     * Mass delete seller products action.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $isPartner = $this->helper->isSeller();
        $updatedStatus = 0;
        if ($isPartner == 1) {
            try {
                $gatewayUrl = $this->delhiveryHelper->getGatewayUrl();
                $token = $this->delhiveryHelper->getLicenseKey();
                if ($gatewayUrl =="" || $token =="") {
                    throw new \Magento\Framework\Exception\LocalizedException(
                        __('Please add valid License Key and Gateway URL in plugin configuration')
                    );
                }
                $sellerId = $this->helper->getCustomerId();
                $collection = $this->filter->getCollection($this->orderCollectionFactory->create());
                $ids = $collection->getAllIds();
                $awbNumberList = $this->shipmentFactory->create()->getCollection()
                                            ->addFieldToFilter('order_id', ['in' =>$ids])
                                            ->addFieldToFilter('seller_id', $sellerId)
                                            ->addFieldToFilter('tracking_number', ['neq' => ''])
                                            ->getColumnValues('tracking_number');
                if (!empty($awbNumberList)) {
                    $awbs = implode(',', $awbNumberList);
                    $path = $gatewayUrl.'api/packages/json/?verbose=0&token='.$token.'&waybill='.$awbs;
                    $retValue = $this->delhiveryHelper->executeCurl($path, $token, 'GET', []);
                    $statusupdates = json_decode($retValue);
                    if (isset($statusupdates->Error)) {
                        throw new \Magento\Framework\Exception\LocalizedException(__($statusupdates->Error));
                    }
                    foreach ($statusupdates->ShipmentData as $item) {
                        $newStatus = preg_replace('/\s+/', '', $item->Shipment->Status->Status);
                        $condition = 'awb = '. $item->Shipment->AWB;
                        $this->delhiveryHelper->setTableRecords(
                            $condition,
                            ['status' => $newStatus],
                            'wk_delhivery_awb'
                        );
                        $condition = 'tracking_number = '. $item->Shipment->AWB;
                        $this->delhiveryHelper->setTableRecords(
                            $condition,
                            ['ship_status' => $newStatus],
                            'marketplace_orders_shipments'
                        );
                    }
                    $this->messageManager->addSuccess(__('%1 Waybill(s) Updated Successfully', $updatedStatus));
                } else {
                    $this->messageManager->addNotice(
                        __('There are no AWB for update related to selected order(s).')
                    );
                }
            } catch (\Exception $e) {
                $this->helper->logDataInLogger(
                    "Controller_Order_Ui_AwbStatusUpdate execute : ".$e->getMessage()
                );
                $this->messageManager->addError($e->getMessage());
            }
            return $this->resultRedirectFactory->create()->setPath(
                'marketplace/order/history',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        } else {
            return $this->resultRedirectFactory->create()->setPath(
                'marketplace/account/becomeseller',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        }
    }
}
