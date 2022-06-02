<?php
/**
 * Webkul Software.
 *
 * @category Webkul
 * @package Webkul_CustomInvoice
 * @author Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license https://store.webkul.com/license.html
 */


namespace Webkul\CustomInvoice\Model;

/**
 * GstStateCode Class
 */
class GstStateCode extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, \Webkul\CustomInvoice\Api\Data\GstStateCodeInterface
{

    public const NOROUTE_ENTITY_ID = 'no-route';

    public const CACHE_TAG = 'webkul_custominvoice_gststatecode';

    protected $_cacheTag = 'webkul_custominvoice_gststatecode';

    protected $_eventPrefix = 'webkul_custominvoice_gststatecode';

    /**
     * set resource model
     */
    public function _construct()
    {
        $this->_init(\Webkul\CustomInvoice\Model\ResourceModel\GstStateCode::class);
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
     * @return Webkul\CustomInvoice\Model\GstStateCodeInterface
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
     * Set StateCode
     *
     * @param string $stateCode
     * @return Webkul\CustomInvoice\Model\GstStateCodeInterface
     */
    public function setStateCode($stateCode)
    {
        return $this->setData(self::STATE_CODE, $stateCode);
    }

    /**
     * Get StateCode
     *
     * @return string
     */
    public function getStateCode()
    {
        return parent::getData(self::STATE_CODE);
    }

    /**
     * Set GstStateCode
     *
     * @param string $gstStateCode
     * @return Webkul\CustomInvoice\Model\GstStateCodeInterface
     */
    public function setGstStateCode($gstStateCode)
    {
        return $this->setData(self::GST_STATE_CODE, $gstStateCode);
    }

    /**
     * Get GstStateCode
     *
     * @return string
     */
    public function getGstStateCode()
    {
        return parent::getData(self::GST_STATE_CODE);
    }

    /**
     * Set CountryCode
     *
     * @param string $countryCode
     * @return Webkul\CustomInvoice\Model\GstStateCodeInterface
     */
    public function setCountryCode($countryCode)
    {
        return $this->setData(self::COUNTRY_CODE, $countryCode);
    }

    /**
     * Get CountryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return parent::getData(self::COUNTRY_CODE);
    }


}

