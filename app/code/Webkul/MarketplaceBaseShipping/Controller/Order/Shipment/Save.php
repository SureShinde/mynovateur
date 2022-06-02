<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceBaseShipping
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceBaseShipping\Controller\Order\Shipment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Model\Order\Shipment\Validation\QuantityValidator;

/**
 * Class Save used for saving shipment
 */
class Save extends Action
{

    /**
     * @var \Magento\Shipping\Controller\Adminhtml\Order\ShipmentLoader
     */
    protected $shipmentLoader;

    /**
     * @var \Magento\Shipping\Model\Shipping\LabelGenerator
     */
    protected $labelGenerator;

    /**
     * @var \Magento\Sales\Model\Order\Email\Sender\ShipmentSender
     */
    protected $shipmentSender;

    /**
     * @var \Magento\Sales\Model\Order\Shipment\ShipmentValidatorInterface
     */
    private $shipmentValidator;

    /**
     * @param Context $context
     * @param \Magento\Shipping\Controller\Adminhtml\Order\ShipmentLoader $shipmentLoader
     * @param \Magento\Shipping\Model\Shipping\LabelGenerator $labelGenerator
     * @param \Magento\Sales\Model\Order\Email\Sender\ShipmentSender $shipmentSender
     */
    public function __construct(
        \Webkul\MarketplaceBaseShipping\Helper\Data $baseShippingHelper,
        Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Webkul\DelhiveryExtend\Model\ShipmentFactory $shipmentFactory,
        \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory $sellerWarehouse,
        \Webkul\DelhiveryExtend\Model\PickupFactory $pickupFactory,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Shipping\Controller\Adminhtml\Order\ShipmentLoader $shipmentLoader,
        \Webkul\MarketplaceBaseShipping\Model\Shipping\LabelGenerator $labelGenerator,
        \Magento\Sales\Model\Order\Email\Sender\ShipmentSender $shipmentSender
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->date = $date;
        $this->baseShippingHelper = $baseShippingHelper;
        $this->shipmentLoader = $shipmentLoader;
        $this->labelGenerator = $labelGenerator;
        $this->shipmentSender = $shipmentSender;
        $this->shipmentFactory = $shipmentFactory;
        $this->sellerWarehouse = $sellerWarehouse;
        $this->pickupFactory = $pickupFactory;
        $this->delhiveryHelper = $delhiveryHelper;
        $this->_customerSession = $customerSession;
        $this->logger = $baseShippingHelper->displayErrors();
        parent::__construct($context);
    }

    /**
     * Save shipment and order in one transaction
     *
     * @param \Magento\Sales\Model\Order\Shipment $shipment
     * @return $this
     */
    protected function _saveShipment($shipment)
    {
        $packageData = $this->getRequest()->getParam('packages');
        $shipmentData = $this->_customerSession->getData('shipment_data');
        $sellerId = $this->_customerSession->getCustomerId();
        $shipment->getOrder()->setIsInProcess(true);
        $order = $shipment->getOrder();
        $transaction = $this->_objectManager->create(\Magento\Framework\DB\Transaction::class);
        $transaction->addObject($shipment)
                    ->addObject($shipment->getOrder())
                    ->save();
        $shipmentId = $shipment->getId();
        $trackingNumber = $shipmentData['tracking_number'] ?? '';
        $carrierName = $shipmentData['title'] ?? '';
        $tracks = $shipment->getTracks();
        foreach ($tracks as $track) {
             $trackingNumber = $track->getTrackNumber();
             $carrierName = $track->getTitle();
        }
        $shipmentData = [
            'seller_id' => $sellerId,
            'order_id' => $order->getId(),
            'shipment_id' => $shipmentId,
            'tracking_number' => $trackingNumber,
            'ship_status' => "InTransit",
            'label_printed' => 0,
            'packet_count' => $packageData[1]['params']['no_of_packet'] ?? 1,
            'pickup_id' => 0
        ];
        $mpShipmentRec = $this->shipmentFactory->create()->addData($shipmentData)->save();
        $condition = 'awb = '. $trackingNumber .' AND seller_id = '. $sellerId;
        $this->delhiveryHelper->setTableRecords(
            $condition,
            ['shipment_id' => $shipmentId],
            'wk_delhivery_awb'
        );
        ////// Pickup schedule ////
        $wareHouse = $this->sellerWarehouse->create()->getCollection()
                            ->addFieldToFilter('seller_id', $sellerId)
                            ->setPageSize(1)->setCurPage(1)->getFirstItem();
        if ($wareHouse->getEntityId()) {
            $pickupTime = $this->date->date(new \DateTime($packageData[1]['params']['pickup_time']))
                                        ->format('Y-m-d H:i:s');

            $pclupTimeTmp = explode(" ", $pickupTime);
            $param = [
                "pickup_time" =>  $pclupTimeTmp[1],
                "pickup_date" => $pclupTimeTmp[0],
                "pickup_location" => $wareHouse->getName(),
                "expected_package_count" =>  $packageData[1]['params']['no_of_packet'] ?? 1
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
                $condition = 'shipment_id = '. $shipmentId .' AND seller_id = '. $sellerId . ' AND pickup_id = 0';
                $this->delhiveryHelper->setTableRecords(
                    $condition,
                    ['pickup_id' => $retValue['pickup_id']],
                    'marketplace_orders_shipments'
                );
                $this->messageManager->addSuccess(__(
                    'Pickup Id : %1 scheduled for order #%2.',
                    $retValue['pickup_id'],
                    $order->getIncrementId()
                ));
            } else {
                $error = $this->jsonHelper->jsonEncode($retValue);
                $this->logger->addError('pickup : '.$error);
                $this->messageManager->addError(__('Invalid pickup request for order #%1, %2', $order->getIncrementId(), $error));
            }
        }
        ////// Pickup schedule ////

        return $this;
    }

    /**
     * Save shipment
     * We can save only new shipment. Existing shipments are not editable
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $displayErrors=$this->baseShippingHelper->displayErrors();

        $isPost = $this->getRequest()->isPost();
        if (!$isPost) {
            $this->messageManager->addError(__('We can\'t save the shipment right now.'));
            return $resultRedirect->setPath(
                'marketplace/order/view',
                ['id' => $this->getRequest()->getParam('order_id')]
            );
        }

        $data = $this->getRequest()->getParam('shipment');
        $data['items'] = [];
        $packages = $this->getRequest()->getParam('packages');
        foreach ($packages as $package) {
            $items = $package['items'];
            foreach ($items as $k=>$v) {
                $data['items'][$k] = $v['qty'];
            }
        }
        // echo '<pre>'; print_r($data); die;

        $isNeedCreateLabel = isset($data['create_shipping_label']) && $data['create_shipping_label'];

        $responseAjax = new \Magento\Framework\DataObject();

        try {
            $this->shipmentLoader->setOrderId($this->getRequest()->getParam('order_id'));
            $this->shipmentLoader->setShipmentId($this->getRequest()->getParam('shipment_id'));
            $this->shipmentLoader->setShipment($data);
            $this->shipmentLoader->setTracking($this->getRequest()->getParam('tracking'));
            $shipment = $this->shipmentLoader->load();
            if (!$shipment) {
                $this->_forward('noroute');
                return;
            }

            $validationResult = $this->getShipmentValidator()
                ->validate($shipment, [QuantityValidator::class]);

            if ($validationResult->hasMessages()) {
                $this->messageManager->addError(
                    __("Shipment Document Validation Error(s):\n" . implode("\n", $validationResult->getMessages()))
                );
                $this->_redirect('marketplace/order/view', ['order_id' => $this->getRequest()->getParam('order_id')]);
                return;
            }
            $shipment->register();

            if ($isNeedCreateLabel) {
                $this->labelGenerator->create($shipment, $this->_request);
                $responseAjax->setOk(true);
            }

            $this->_saveShipment($shipment);

            if (!empty($data['send_email'])) {
                $this->shipmentSender->send($shipment);
            }

            $shipmentCreatedMessage = __('The shipment has been created.');
            $labelCreatedMessage = __('You created the shipping label.');

            $this->messageManager->addSuccess(
                $isNeedCreateLabel ? $shipmentCreatedMessage . ' ' . $labelCreatedMessage : $shipmentCreatedMessage
            );
            //$this->_objectManager->get(\Magento\Backend\Model\Session::class)->getCommentText(true);
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            if ($isNeedCreateLabel) {
                $responseAjax->setError(true);
                $responseAjax->setMessage($e->getMessage());
            } else {
                $this->messageManager->addError($e->getMessage());
                $this->_redirect('marketplace/order/view', ['order_id' => $this->getRequest()->getParam('order_id')]);
            }
        } catch (\Exception $e) {
            $displayErrors->critical($e->getMessage());
            if ($isNeedCreateLabel) {
                $responseAjax->setError(true);
                $responseAjax->setMessage(__($e->getMessage()));
                //$responseAjax->setMessage(__('An error occurred while creating shipping label.'));
            } else {
                $this->messageManager->addError(__('Cannot save shipment.'));
                $this->_redirect('marketplace/order/view', ['order_id' => $this->getRequest()->getParam('order_id')]);
            }
        }
        if ($isNeedCreateLabel) {
            $this->getResponse()->representJson($responseAjax->toJson());
        } else {
            $this->_redirect('marketplace/order/view', ['order_id' => $shipment->getOrderId()]);
        }
    }

    /**
     * @return \Magento\Sales\Model\Order\Shipment\ShipmentValidatorInterface
     * @deprecated 100.1.1
     */
    private function getShipmentValidator()
    {
        if ($this->shipmentValidator === null) {
            $this->shipmentValidator = $this->_objectManager->get(
                \Magento\Sales\Model\Order\Shipment\ShipmentValidatorInterface::class
            );
        }

        return $this->shipmentValidator;
    }
}
