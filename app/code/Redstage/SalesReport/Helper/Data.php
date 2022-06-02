<?php
/**
 * Redstage SalesReport module purpose admin user can view sales report.
 *
 * @category: PHP
 * @package: Redstage/SalesReport
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Anjulata Gupta <agupta@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_SalesReport
 */

namespace Redstage\SalesReport\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Redstage SalesReport Helper Data.
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get Weight Unit
     *
     * @return string
     */
    public function getWeightUnit()
    {
        return $this->scopeConfig->getValue(
            'general/locale/weight_unit',
            ScopeInterface::SCOPE_STORE
        );
    }

   
}
