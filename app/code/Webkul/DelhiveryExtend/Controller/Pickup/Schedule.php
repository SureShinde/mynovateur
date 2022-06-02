<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryExtend\Controller\Pickup;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url as CustomerUrl;
use Webkul\Marketplace\Helper\Data as HelperData;
use Webkul\DelhiveryExtend\Model\ResourceModel\Shipment\CollectionFactory as ShipmentCollection;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * Webkul Marketplace Order Printinvoice controller.
 */
class Schedule extends Action implements \Magento\Framework\App\CsrfAwareActionInterface
{
    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * @var MpOrdersCollection
     */
    protected $mpOrdersCollection;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @param Context $context
     * @param HelperData $helper
     * @param MpOrdersCollection $mpOrdersCollection
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper
     * @param \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb
     * @param \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory $sellerWarehouse
     * @param \Webkul\DelhiveryExtend\Model\PickupFactory $pickupFactory
     * @param TimezoneInterface $date
     */
    public function __construct(
        Context $context,
        HelperData $helper,
        ShipmentCollection $shipmentCollection,
        Session $customerSession,
        CustomerUrl $customerUrl,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
        \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory $sellerWarehouse,
        \Webkul\DelhiveryExtend\Model\PickupFactory $pickupFactory,
        TimezoneInterface $date
    ) {
        $this->helper = $helper;
        $this->shipmentCollection = $shipmentCollection;
        $this->_customerSession = $customerSession;
        $this->customerUrl = $customerUrl;
        $this->jsonHelper = $jsonHelper;
        $this->delhiveryHelper = $delhiveryHelper;
        $this->delhiveryModelAwb = $delhiveryModelAwb;
        $this->sellerWarehouse = $sellerWarehouse;
        $this->pickupFactory = $pickupFactory;
        $this->date = $date;
        $this->logger = $delhiveryHelper->getLogger();
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
        try {
            $isPartner = $this->helper->isSeller();
            $postData = $this->getRequest()->getParams();
            if ($this->getRequest()->isPost() && $isPartner && !empty($postData['selections'])
                && !empty($postData['pickup_time'])) {
                $sellerId = $this->helper->getCustomerId();
                $shipmentPacketCount = $this->shipmentCollection->create()
                                            ->addFieldToFilter('entity_id', ['in' => $postData['selections']])
                                            ->addFieldToFilter('seller_id', ['eq' => $sellerId])
                                            ->addFieldToFilter('pickup_id', ['eq' => 0])
                                            ->addExpressionFieldToSelect(
                                                'total_packet',
                                                'SUM({{packet_count}})',
                                                'packet_count'
                                            )->setPageSize(1)->setCurPage(1)->getFirstItem()->getTotalPacket();
                $wareHouse = $this->sellerWarehouse->create()->getCollection()
                                    ->addFieldToFilter('seller_id', $sellerId)
                                    ->setPageSize(1)->setCurPage(1)->getFirstItem();
                if ($shipmentPacketCount && $wareHouse->getEntityId()) {
                    $pickupTime = $this->date->date(new \DateTime($postData['pickup_time']))->format('Y-m-d H:i:s');

                    $pclupTimeTmp = explode(" ", $pickupTime);
                    $param = [
                        "pickup_time" =>  $pclupTimeTmp[1],
                        "pickup_date" => $pclupTimeTmp[0],
                        "pickup_location" => $wareHouse->getName(),
                        "expected_package_count" =>  $shipmentPacketCount
                    ];
                    $gatewayUrl = $this->delhiveryHelper->getGatewayUrl();
                    $token = $this->delhiveryHelper->getLicenseKey();
                    $path = $gatewayUrl.'fm/request/new/';
                    $retValue = $this->delhiveryHelper->executeCurl($path, $token, 'POST', $param, 'json');
                    $retValue = $this->jsonHelper->jsonDecode($retValue);
                    if (empty($retValue['error']) && !empty($retValue['pickup_id'])) {
                        $pickupData = [
                            'seller_id' => $sellerId,
                            'delhivery_pickup_id' => $retValue['pickup_id'],
                            'pickup_location' => $retValue['pickup_location_name'],
                            'incoming_center' => $retValue['incoming_center_name'],
                            'package_count' => $retValue['expected_package_count'],
                            'scheduled_date_time' => $retValue['pickup_date'].' '.$retValue['pickup_time']
                        ];
                        $this->pickupFactory->create()->setData($pickupData)->save();
                        $condition = 'entity_id in ('.implode(',', $postData['selections']).') AND seller_id = '
                                        . $sellerId . ' AND pickup_id = 0';
                        $this->delhiveryHelper->setTableRecords(
                            $condition,
                            ['pickup_id' => $retValue['pickup_id']],
                            'marketplace_orders_shipments'
                        );
                        $message = __(
                            'Pickup Id : %1 scheduled for %2 orders.',
                            $retValue['pickup_id'],
                            $retValue['expected_package_count']
                        );
                        $response = ['status' => true, 'message' => $message];
                    } else {
                        $response = [
                            'status' => false,
                            'message' => $retValue['data']['message'] ?? $this->jsonHelper->jsonEncode($retValue)
                        ];
                    }
                } else {
                    $response = [
                        'status' => false,
                        'message' => __('No order for pickup or Origin not set.')
                    ];
                }
            } else {
                $response = [
                    'status' => false,
                    'error_msg' => __('Invalid request.')
                ];
            }
        } catch (\Exception $e) {
            $this->logger->addError('schedule : '.$e->getMessage());
            $this->messageManager->addError($e->getMessage());
            $response = [
                'status' => false,
                'error_msg' => $e->getMessage()
            ];
        }
        $this->getResponse()->representJson($this->jsonHelper->jsonEncode($response));
    }
}
