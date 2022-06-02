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
namespace Webkul\MarketplaceGstIndia\Plugin\Customer;

use Magento\Framework\View\LayoutInterface;
use Webkul\MarketplaceGstIndia\Block\Customer\AddressEdit as CustomerAddress;

class AddressEdit
{
    /**
     * @var LayoutInterface
     */
    private $layout;

    /**
     * @param LayoutInterface $layout
     */
    public function __construct(
        LayoutInterface $layout
    ) {
        $this->layout = $layout;
    }

    /**
     * Get Name
     *
     * @param \Magento\Customer\Block\Address\Edit $edit
     * @param text $result
     * @return mixed
     */
    public function afterGetNameBlockHtml(
        \Magento\Customer\Block\Address\Edit $edit,
        $result
    ) {
        $customBlock =  $this->layout->createBlock(
            CustomerAddress::class,
            'gst_address_edit_gstin'
        );
        
        return $result.$customBlock->toHtml();
    }
}
