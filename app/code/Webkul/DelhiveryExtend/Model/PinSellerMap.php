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
 * PinSellerMap Class
 */
class PinSellerMap extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, \Webkul\DelhiveryExtend\Api\Data\PinSellerMapInterface
{

    public const NOROUTE_ENTITY_ID = 'no-route';

    public const CACHE_TAG = 'webkul_delhiveryextend_pinsellermap';

    protected $_cacheTag = 'webkul_delhiveryextend_pinsellermap';

    protected $_eventPrefix = 'webkul_delhiveryextend_pinsellermap';

    /**
     * set resource model
     */
    public function _construct()
    {
        $this->_init(\Webkul\DelhiveryExtend\Model\ResourceModel\PinSellerMap::class);
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
     * @return Webkul\DelhiveryExtend\Model\PinSellerMapInterface
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
     * Set Pincode
     *
     * @param int $pincode
     * @return Webkul\DelhiveryExtend\Model\PinSellerMapInterface
     */
    public function setPincode($pincode)
    {
        return $this->setData(self::PINCODE, $pincode);
    }

    /**
     * Get Pincode
     *
     * @return int
     */
    public function getPincode()
    {
        return parent::getData(self::PINCODE);
    }

    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\DelhiveryExtend\Model\PinSellerMapInterface
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


}

