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
 * Pickup Interface
 */
interface PickupInterface
{

    public const ENTITY_ID = 'entity_id';

    public const SELLER_ID = 'seller_id';

    public const DELHIVERY_PICKUP_ID = 'delhivery_pickup_id';

    public const PICKUP_LOCATION = 'pickup_location';

    public const INCOMING_CENTER = 'incoming_center';

    public const DESCRIPTION = 'description';

    public const SCHEDULED_DATE_TIME = 'scheduled_date_time';

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\DelhiveryExtend\Api\Data\PickupInterface
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
     * @return Webkul\DelhiveryExtend\Api\Data\PickupInterface
     */
    public function setSellerId($sellerId);
    /**
     * Get SellerId
     *
     * @return int
     */
    public function getSellerId();
    /**
     * Set DelhiveryPickupId
     *
     * @param int $delhiveryPickupId
     * @return Webkul\DelhiveryExtend\Api\Data\PickupInterface
     */
    public function setDelhiveryPickupId($delhiveryPickupId);
    /**
     * Get DelhiveryPickupId
     *
     * @return int
     */
    public function getDelhiveryPickupId();
    /**
     * Set PickupLocation
     *
     * @param string $pickupLocation
     * @return Webkul\DelhiveryExtend\Api\Data\PickupInterface
     */
    public function setPickupLocation($pickupLocation);
    /**
     * Get PickupLocation
     *
     * @return string
     */
    public function getPickupLocation();
    /**
     * Set IncomingCenter
     *
     * @param string $incomingCenter
     * @return Webkul\DelhiveryExtend\Api\Data\PickupInterface
     */
    public function setIncomingCenter($incomingCenter);
    /**
     * Get IncomingCenter
     *
     * @return string
     */
    public function getIncomingCenter();
    /**
     * Set Description
     *
     * @param string $description
     * @return Webkul\DelhiveryExtend\Api\Data\PickupInterface
     */
    public function setDescription($description);
    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription();
    /**
     * Set ScheduledDateTime
     *
     * @param string $scheduledDateTime
     * @return Webkul\DelhiveryExtend\Api\Data\PickupInterface
     */
    public function setScheduledDateTime($scheduledDateTime);
    /**
     * Get ScheduledDateTime
     *
     * @return string
     */
    public function getScheduledDateTime();

}

