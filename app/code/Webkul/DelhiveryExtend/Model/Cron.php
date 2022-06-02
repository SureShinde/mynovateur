<?php
/**
 * @category   Webkul
 * @package    Webkul_DelhiveryExtend
 * @author     Webkul Software Private Limited
 * @copyright  Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license    https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Model;

/**
 * custom cron actions
 */
class Cron
{
    /**
     * @var \Webkul\DelhiveryExtend\Helper\Data
     */
    private $delhiveryHelper;

    /**
     * @var \Webkul\DelhiveryExtend\Model\ShipmentFactory
     */
    private $shipmentFactory;

    /**
     * @var \Webkul\DelhiveryExtend\Logger\Logger
     */
    private $logger;

    /**
     * Class Constructor
     *
     * @param \Webkul\DelhiveryExtend\Helper\Data $delhiveryHelper
     * @param \Webkul\DelhiveryExtend\Model\ShipmentFactory $shipmentFactory
     * @param \Webkul\DelhiveryExtend\Logger\Logger $logger
     */
    public function __construct(
        \Webkul\DelhiveryExtend\Helper\Data $delhiveryHelper,
        \Webkul\DelhiveryExtend\Model\ShipmentFactory $shipmentFactory,
        \Webkul\DelhiveryExtend\Logger\Logger $logger
    ) {
        $this->delhiveryHelper = $delhiveryHelper;
        $this->shipmentFactory = $shipmentFactory;
        $this->logger = $logger;
    }

    /**
     * accessTokenValidate
     */
    public function shipStatusUpdate()
    {
        try {
            $this->logger->info("===============Shipment status update Cron execution start ================ ");
            $awbNumberList = $this->shipmentFactory->create()->getCollection()
                                ->addFieldToFilter('ship_status', ['in' => ['InTransit','Manifested']])
                                ->addFieldToFilter('tracking_number', ['neq' => ''])
                                ->getColumnValues('tracking_number');
            $gatewayUrl = $this->delhiveryHelper->getGatewayUrl();
            $token = $this->delhiveryHelper->getLicenseKey();
            if (!empty($awbNumberList) && $gatewayUrl !== "" && $token !=="") {
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
                $this->logger->addError(__('%1 Waybill(s) Updated Successfully', count($awbNumberList)));
            } else {
                $this->logger->addError('no aws');
            }
        } catch (\Exception $e) {
            $this->logger->addError('QB access Token Validate :'.$e->getMessage());
        }
        $this->logger->info("===============Shipment status update Cron execution end ================ ");
    }
}
