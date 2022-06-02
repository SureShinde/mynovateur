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
 * DelhiveryWarehouse Interface
 */
interface DelhiveryWarehouseInterface
{

    public const ENTITY_ID = 'entity_id';

    public const NAME = 'name';

    public const SELLER_ID = 'seller_id';

    public const DESCRIPTION = 'description';

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\DelhiveryExtend\Api\Data\DelhiveryWarehouseInterface
     */
    public function setEntityId($entityId);
    /**
     * Get EntityId
     *
     * @return int
     */
    public function getEntityId();
    /**
     * Set Name
     *
     * @param string $name
     * @return Webkul\DelhiveryExtend\Api\Data\DelhiveryWarehouseInterface
     */
    public function setName($name);
    /**
     * Get Name
     *
     * @return string
     */
    public function getName();
    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\DelhiveryExtend\Api\Data\DelhiveryWarehouseInterface
     */
    public function setSellerId($sellerId);
    /**
     * Get SellerId
     *
     * @return int
     */
    public function getSellerId();
    /**
     * Set Description
     *
     * @param string $description
     * @return Webkul\DelhiveryExtend\Api\Data\DelhiveryWarehouseInterface
     */
    public function setDescription($description);
    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription();

}

