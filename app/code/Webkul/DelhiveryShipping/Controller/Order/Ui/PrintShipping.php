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
use Webkul\Marketplace\Model\ResourceModel\Orders\CollectionFactory as MpOrdersCollection;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * Webkul Marketplace Order Printinvoice controller.
 */
class PrintShipping extends Action implements \Magento\Framework\App\CsrfAwareActionInterface
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
     * @var MpOrdersCollection
     */
    protected $mpOrdersCollection;

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
     * @param MpOrdersCollection $mpOrdersCollection,
     * @param \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
     * @param \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
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
        \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
        \Webkul\DelhiveryShipping\Model\ShippingLabelFactory $shippingLabel,
        DateTime $date
    ) {
        $this->filter = $filter;
        $this->_customerSession = $customerSession;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->helper = $helper;
        $this->customerUrl = $customerUrl;
        $this->shipmentFactory = $shipmentFactory;
        $this->delhiveryHelper = $delhiveryHelper;
        $this->delhiveryModelAwb = $delhiveryModelAwb;
        $this->shippingLabel = $shippingLabel;
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
                    $result = $this->delhiveryHelper->executeShippingLabelCurl($awbs);
                    $result = json_decode($result);
                    if (isset($result->Error)) {
                        throw new \Magento\Framework\Exception\LocalizedException(__($result->Error));
                    }
                    if (isset($result->packages)) {
                        $pdf = $this->shippingLabel->create()->getPdfData($result);
                        $condition = 'tracking_number in ('.implode(',', $awbNumberList).') AND seller_id = '.$sellerId;
                        $this->delhiveryHelper->setTableRecords(
                            $condition,
                            ['label_printed' => 1],
                            'marketplace_orders_shipments'
                        );
                    } else {
                        $this->messageManager->addError(
                            __("Please Submit Manifest and AWD Status , Before generatting shipping label")
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
