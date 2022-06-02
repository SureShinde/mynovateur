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
 * PinSellerMap Interface
 */
interface PinSellerMapInterface
{

    public const ENTITY_ID = 'entity_id';

    public const PINCODE = 'pincode';

    public const SELLER_ID = 'seller_id';

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\DelhiveryExtend\Api\Data\PinSellerMapInterface
     */
    public function setEntityId($entityId);
    /**
     * Get EntityId
     *
     * @return int
     */
    public function getEntityId();
    /**
     * Set Pincode
     *
     * @param int $pincode
     * @return Webkul\DelhiveryExtend\Api\Data\PinSellerMapInterface
     */
    public function setPincode($pincode);
    /**
     * Get Pincode
     *
     * @return int
     */
    public function getPincode();
    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\DelhiveryExtend\Api\Data\PinSellerMapInterface
     */
    public function setSellerId($sellerId);
    /**
     * Get SellerId
     *
     * @return int
     */
    public function getSellerId();

}

