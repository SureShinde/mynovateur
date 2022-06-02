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
use Magento\Framework\App\Action\Context;
use Webkul\Marketplace\Helper\Data as HelperData;
use Webkul\Marketplace\Model\ResourceModel\Orders\CollectionFactory as MpOrdersCollection;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * Webkul Marketplace Order Printinvoice controller.
 */
class Pickup extends \Magento\Customer\Controller\AbstractAccount
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
        MpOrdersCollection $mpOrdersCollection,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
        \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory $sellerWarehouse,
        \Webkul\DelhiveryExtend\Model\PickupFactory $pickupFactory,
        TimezoneInterface $date
    ) {
        $this->helper = $helper;
        $this->mpOrdersCollection = $mpOrdersCollection;
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
     * Mass delete seller products action.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        try {
            $isPartner = $this->helper->isSeller();
            $postData = $this->getRequest()->getParams();
            if ($this->getRequest()->isPost() && $isPartner
                && !empty($postData['selections']) && !empty($postData['pickup_time'])) {
                $sellerId = $this->helper->getCustomerId();
                $mpOrderCollection = $this->mpOrdersCollection->create()
                                            ->addFieldToFilter('order_id', ['in' => $postData['selections']])
                                            ->addFieldToFilter('seller_id', ['eq' => $sellerId])
                                            ->addFieldToFilter('pickup_id', ['eq' => 0]);
                $wareHouse = $this->sellerWarehouse->create()->getCollection()
                                    ->addFieldToFilter('seller_id', $sellerId)
                                    ->setPageSize(1)->setCurPage(1)->getFirstItem();
                if ($mpOrderCollection->getSize() && $wareHouse->getEntityId()) {
                    $pickupTime = $this->date->date(new \DateTime($postData['pickup_time']))->format('Y-m-d H:i:s');

                    $pclupTimeTmp = explode(" ", $pickupTime);
                    $param = [
                        "pickup_time" =>  $pclupTimeTmp[1],
                        "pickup_date" => $pclupTimeTmp[0],
                        "pickup_location" => $wareHouse->getName(),
                        "expected_package_count" =>  $mpOrderCollection->getSize()
                    ];
                    $gatewayUrl = $this->delhiveryHelper->getGatewayUrl();
                    $token = $this->delhiveryHelper->getLicenseKey();
                    $path = $gatewayUrl.'fm/request/new/';
                    $retValue = $this->delhiveryHelper->executeCurl($path, $token, 'POST', $param, 'json');
                    $retValue = $this->jsonHelper->jsonDecode($retValue);
                    if (empty($retValue['error']) && !empty($retValue['pickup_id'])) {
                        $condition = 'order_id in ('.implode(',', $postData['selections']).') AND seller_id = '
                                        . $sellerId . ' AND pickup_id = 0';
                        $pickupData = [
                            'seller_id' => $sellerId,
                            'delhivery_pickup_id' => $retValue['pickup_id'],
                            'pickup_location' => $retValue['pickup_location_name'],
                            'incoming_center' => $retValue['incoming_center_name'],
                            'package_count' => $retValue['expected_package_count'],
                            'scheduled_date_time' => $retValue['pickup_date'].' '.$retValue['pickup_time']
                        ];
                        $this->pickupFactory->create()->setData($pickupData)->save();
                        $this->delhiveryHelper->setTableRecords(
                            $condition,
                            ['pickup_id' => $retValue['pickup_id']],
                            'marketplace_orders'
                        );
                        $response = [
                            'status' => true,
                            'message' => __(
                                'Pickup Id : %1 scheduled for %2 orders.',
                                $retValue['pickup_id'],
                                $retValue['expected_package_count']
                            )
                        ];
                    } else {
                        $this->logger->addError('pickup : '.$this->jsonHelper->jsonEncode($retValue));
                        $response = [
                            'status' => false,
                            'message' => $retValue['data']['message'] ?? __('Invalid request.')
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
            $response = [
                'status' => false,
                'error_msg' => $e->getMessage()
            ];
        }
        $this->getResponse()->representJson($this->jsonHelper->jsonEncode($response));
    }
}
