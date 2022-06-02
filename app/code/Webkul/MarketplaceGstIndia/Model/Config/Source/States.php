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

class States implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * country code if india
     */
    public const COUNTRYCODE = 'IN';

    /**
     * @param CountryInformationAcquirerInterface $countryInformationInterface
     */
    public function __construct(
        CountryInformationAcquirerInterface $countryInformationInterface
    ) {
        $this->countryInformationInterface = $countryInformationInterface;
    }

    /**
     * Return list of all regions
     *
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];
        $country = $this->countryInformationInterface->getCountryInfo(self::COUNTRYCODE);
        if (!empty($country)) {
            $regionsData = $country->getAvailableRegions();
            if (!empty($regionsData)) {
                $result[] = [
                    'value' => '',
                    'label' => __('Select')
                ];
                foreach ($regionsData as $region) {
                    $result[] = [
                        'value' => $region->getId(),
                        'label' => $region->getName()
                    ];
                }
            }
        }

        return $result;
    }
}
