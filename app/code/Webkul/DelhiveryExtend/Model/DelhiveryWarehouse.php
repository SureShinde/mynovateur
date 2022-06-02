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
 * DelhiveryWarehouse Class
 */
class DelhiveryWarehouse extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, \Webkul\DelhiveryExtend\Api\Data\DelhiveryWarehouseInterface
{

    public const NOROUTE_ENTITY_ID = 'no-route';

    public const CACHE_TAG = 'webkul_delhiveryextend_delhiverywarehouse';

    protected $_cacheTag = 'webkul_delhiveryextend_delhiverywarehouse';

    protected $_eventPrefix = 'webkul_delhiveryextend_delhiverywarehouse';

    /**
     * set resource model
     */
    public function _construct()
    {
        $this->_init(\Webkul\DelhiveryExtend\Model\ResourceModel\DelhiveryWarehouse::class);
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
     * @return Webkul\DelhiveryExtend\Model\DelhiveryWarehouseInterface
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
     * Set Name
     *
     * @param string $name
     * @return Webkul\DelhiveryExtend\Model\DelhiveryWarehouseInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return parent::getData(self::NAME);
    }

    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\DelhiveryExtend\Model\DelhiveryWarehouseInterface
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
     * Set Description
     *
     * @param string $description
     * @return Webkul\DelhiveryExtend\Model\DelhiveryWarehouseInterface
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


}

