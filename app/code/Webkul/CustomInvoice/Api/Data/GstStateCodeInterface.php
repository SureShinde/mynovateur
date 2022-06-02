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


namespace Webkul\CustomInvoice\Api\Data;

/**
 * GstStateCode Interface
 */
interface GstStateCodeInterface
{

    public const ENTITY_ID = 'entity_id';

    public const STATE_CODE = 'state_code';

    public const GST_STATE_CODE = 'gst_state_code';

    public const COUNTRY_CODE = 'country_code';

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\CustomInvoice\Api\Data\GstStateCodeInterface
     */
    public function setEntityId($entityId);
    /**
     * Get EntityId
     *
     * @return int
     */
    public function getEntityId();
    /**
     * Set StateCode
     *
     * @param string $stateCode
     * @return Webkul\CustomInvoice\Api\Data\GstStateCodeInterface
     */
    public function setStateCode($stateCode);
    /**
     * Get StateCode
     *
     * @return string
     */
    public function getStateCode();
    /**
     * Set GstStateCode
     *
     * @param string $gstStateCode
     * @return Webkul\CustomInvoice\Api\Data\GstStateCodeInterface
     */
    public function setGstStateCode($gstStateCode);
    /**
     * Get GstStateCode
     *
     * @return string
     */
    public function getGstStateCode();
    /**
     * Set CountryCode
     *
     * @param string $countryCode
     * @return Webkul\CustomInvoice\Api\Data\GstStateCodeInterface
     */
    public function setCountryCode($countryCode);
    /**
     * Get CountryCode
     *
     * @return string
     */
    public function getCountryCode();

}

