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


namespace Webkul\DelhiveryExtend\Model;

/**
 * Shipment Class
 */
class Shipment extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, \Webkul\DelhiveryExtend\Api\Data\ShipmentInterface
{

    public const NOROUTE_ENTITY_ID = 'no-route';

    public const CACHE_TAG = 'webkul_delhiveryextend_shipment';

    protected $_cacheTag = 'webkul_delhiveryextend_shipment';

    protected $_eventPrefix = 'webkul_delhiveryextend_shipment';

    /**
     * set resource model
     */
    public function _construct()
    {
        $this->_init(\Webkul\DelhiveryExtend\Model\ResourceModel\Shipment::class);
    }

    /**
     * Load No-Route Indexer.
     *
     * @return $this
     */
    public function noRouteReasons()
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    /**
     * Get identities.
     *
     * @return []
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get EntityId
     *
     * @return int
     */
    public function getEntityId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setSellerId($sellerId)
    {
        return $this->setData(self::SELLER_ID, $sellerId);
    }

    /**
     * Get SellerId
     *
     * @return int
     */
    public function getSellerId()
    {
        return parent::getData(self::SELLER_ID);
    }

    /**
     * Set OrderId
     *
     * @param int $orderId
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get OrderId
     *
     * @return int
     */
    public function getOrderId()
    {
        return parent::getData(self::ORDER_ID);
    }

    /**
     * Set ShipmentId
     *
     * @param int $shipmentId
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setShipmentId($shipmentId)
    {
        return $this->setData(self::SHIPMENT_ID, $shipmentId);
    }

    /**
     * Get ShipmentId
     *
     * @return int
     */
    public function getShipmentId()
    {
        return parent::getData(self::SHIPMENT_ID);
    }

    /**
     * Set TrackingNumber
     *
     * @param string $trackingNumber
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setTrackingNumber($trackingNumber)
    {
        return $this->setData(self::TRACKING_NUMBER, $trackingNumber);
    }

    /**
     * Get TrackingNumber
     *
     * @return string
     */
    public function getTrackingNumber()
    {
        return parent::getData(self::TRACKING_NUMBER);
    }

    /**
     * Set ShipStatus
     *
     * @param string $shipStatus
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setShipStatus($shipStatus)
    {
        return $this->setData(self::SHIP_STATUS, $shipStatus);
    }

    /**
     * Get ShipStatus
     *
     * @return string
     */
    public function getShipStatus()
    {
        return parent::getData(self::SHIP_STATUS);
    }

    /**
     * Set LabelPrinted
     *
     * @param bool $labelPrinted
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setLabelPrinted($labelPrinted)
    {
        return $this->setData(self::LABEL_PRINTED, $labelPrinted);
    }

    /**
     * Get LabelPrinted
     *
     * @return bool
     */
    public function getLabelPrinted()
    {
        return parent::getData(self::LABEL_PRINTED);
    }

    /**
     * Set PickupId
     *
     * @param int $pickupId
     * @return Webkul\DelhiveryExtend\Model\ShipmentInterface
     */
    public function setPickupId($pickupId)
    {
        return $this->setData(self::PICKUP_ID, $pickupId);
    }

    /**
     * Get PickupId
     *
     * @return int
     */
    public function getPickupId()
    {
        return parent::getData(self::PICKUP_ID);
    }


}
