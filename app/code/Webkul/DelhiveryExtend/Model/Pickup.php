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
 * Pickup Class
 */
class Pickup extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, \Webkul\DelhiveryExtend\Api\Data\PickupInterface
{

    public const NOROUTE_ENTITY_ID = 'no-route';

    public const CACHE_TAG = 'webkul_delhiveryextend_pickup';

    protected $_cacheTag = 'webkul_delhiveryextend_pickup';

    protected $_eventPrefix = 'webkul_delhiveryextend_pickup';

    /**
     * set resource model
     */
    public function _construct()
    {
        $this->_init(\Webkul\DelhiveryExtend\Model\ResourceModel\Pickup::class);
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
     * @return Webkul\DelhiveryExtend\Model\PickupInterface
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
     * @return Webkul\DelhiveryExtend\Model\PickupInterface
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
     * Set DelhiveryPickupId
     *
     * @param int $delhiveryPickupId
     * @return Webkul\DelhiveryExtend\Model\PickupInterface
     */
    public function setDelhiveryPickupId($delhiveryPickupId)
    {
        return $this->setData(self::DELHIVERY_PICKUP_ID, $delhiveryPickupId);
    }

    /**
     * Get DelhiveryPickupId
     *
     * @return int
     */
    public function getDelhiveryPickupId()
    {
        return parent::getData(self::DELHIVERY_PICKUP_ID);
    }

    /**
     * Set PickupLocation
     *
     * @param string $pickupLocation
     * @return Webkul\DelhiveryExtend\Model\PickupInterface
     */
    public function setPickupLocation($pickupLocation)
    {
        return $this->setData(self::PICKUP_LOCATION, $pickupLocation);
    }

    /**
     * Get PickupLocation
     *
     * @return string
     */
    public function getPickupLocation()
    {
        return parent::getData(self::PICKUP_LOCATION);
    }

    /**
     * Set IncomingCenter
     *
     * @param string $incomingCenter
     * @return Webkul\DelhiveryExtend\Model\PickupInterface
     */
    public function setIncomingCenter($incomingCenter)
    {
        return $this->setData(self::INCOMING_CENTER, $incomingCenter);
    }

    /**
     * Get IncomingCenter
     *
     * @return string
     */
    public function getIncomingCenter()
    {
        return parent::getData(self::INCOMING_CENTER);
    }

    /**
     * Set Description
     *
     * @param string $description
     * @return Webkul\DelhiveryExtend\Model\PickupInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription()
    {
        return parent::getData(self::DESCRIPTION);
    }

    /**
     * Set ScheduledDateTime
     *
     * @param string $scheduledDateTime
     * @return Webkul\DelhiveryExtend\Model\PickupInterface
     */
    public function setScheduledDateTime($scheduledDateTime)
    {
        return $this->setData(self::SCHEDULED_DATE_TIME, $scheduledDateTime);
    }

    /**
     * Get ScheduledDateTime
     *
     * @return string
     */
    public function getScheduledDateTime()
    {
        return parent::getData(self::SCHEDULED_DATE_TIME);
    }


}

