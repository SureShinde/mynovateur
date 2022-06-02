<?php
/**
 * Webkul Software.
 *
 * @category Webkul
 * @package Webkul_DelhiveryExtend
 * @author Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license https://store.webkul.com/license.html
 */


namespace Webkul\DelhiveryExtend\Api\Data;

/**
 * Shipment Interface
 */
interface ShipmentInterface
{

    public const ENTITY_ID = 'entity_id';

    public const SELLER_ID = 'seller_id';

    public const ORDER_ID = 'order_id';

    public const SHIPMENT_ID = 'shipment_id';

    public const TRACKING_NUMBER = 'tracking_number';

    public const SHIP_STATUS = 'ship_status';

    public const LABEL_PRINTED = 'label_printed';

    public const PICKUP_ID = 'pickup_id';

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setEntityId($entityId);
    /**
     * Get EntityId
     *
     * @return int
     */
    public function getEntityId();
    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setSellerId($sellerId);
    /**
     * Get SellerId
     *
     * @return int
     */
    public function getSellerId();
    /**
     * Set OrderId
     *
     * @param int $orderId
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setOrderId($orderId);
    /**
     * Get OrderId
     *
     * @return int
     */
    public function getOrderId();
    /**
     * Set ShipmentId
     *
     * @param int $shipmentId
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setShipmentId($shipmentId);
    /**
     * Get ShipmentId
     *
     * @return int
     */
    public function getShipmentId();
    /**
     * Set TrackingNumber
     *
     * @param string $trackingNumber
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setTrackingNumber($trackingNumber);
    /**
     * Get TrackingNumber
     *
     * @return string
     */
    public function getTrackingNumber();
    /**
     * Set ShipStatus
     *
     * @param string $shipStatus
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setShipStatus($shipStatus);
    /**
     * Get ShipStatus
     *
     * @return string
     */
    public function getShipStatus();
    /**
     * Set LabelPrinted
     *
     * @param bool $labelPrinted
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setLabelPrinted($labelPrinted);
    /**
     * Get LabelPrinted
     *
     * @return bool
     */
    public function getLabelPrinted();
    /**
     * Set PickupId
     *
     * @param int $pickupId
     * @return Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
     */
    public function setPickupId($pickupId);
    /**
     * Get PickupId
     *
     * @return int
     */
    public function getPickupId();

}
