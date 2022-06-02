<?php
/**
 * Webkul Software
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 *
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Model\Tax;

use Magento\Framework\App\ObjectManager;
use Webkul\MarketplaceGstIndia\Helper\Data as GstHelper;

/**
 * Tax Calculation Model
 */
class Calculation extends \Magento\Tax\Model\Calculation
{
    /**
     * Get information about tax rates applied to request
     *
     * @param \Magento\Framework\DataObject $request
     * @return array
     */
    public function getAppliedRates($request)
    {
        if ($request->getCountryId() && $request->getCountryId() == 'IN') {
            $this->mpGstHelper = ObjectManager::getInstance()->get(GstHelper::class);
            if ($this->mpGstHelper->getConfigValue('status')) {
                return [];
            }
        }

        return parent::getAppliedRates($request);
    }
}
