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
namespace Webkul\MarketplaceGstIndia\Block\Customer;

use Magento\Framework\View\Element\Template;
use Webkul\MarketplaceGstIndia\Block\Customer\Widget\Gstin;

class AddressEdit extends Template
{
    /**
     * Load the html
     */
    protected function _toHtml()
    {
        $gstinWidgetBlock = $this->getLayout()->createBlock(Gstin::class);
        return $gstinWidgetBlock->toHtml();
    }
}
