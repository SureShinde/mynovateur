<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Model\Config\Source;

use \Magento\Directory\Api\CountryInformationAcquirerInterface;

class PriceType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * country code if india
     */
    public const INCLUDE_GST = 2;
    /**
     * country code if india
     */
    public const EXCLUDE_GST = 1;

    /**
     * Return list of all regions
     *
     * @return array
     */
    public function toOptionArray()
    {
        $result[] = [
            'value' => self::EXCLUDE_GST,
            'label' => __('Excluding GST')
        ];
        $result[] = [
            'value' => self::INCLUDE_GST,
            'label' => __('Including GST')
        ];

        return $result;
    }
}
