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
namespace Webkul\MarketplaceGstIndia\Plugin\Model\Quote\Address;

use \Magento\Quote\Model\Quote\Address;

class ToOrderAddress
{
    /**
     * @var \Magento\Quote\Model\Quote\Address
     */
    protected $gstin;

    /**
     * Order Address
     *
     * @param Magento\Quote\Model\Quote\Address\ToOrderAddress $subject
     * @param callable $proceed
     * @param Address $object
     * @param array $data
     * @return \Magento\Sales\Model\Order\Address
     */
    public function aroundConvert(
        \Magento\Quote\Model\Quote\Address\ToOrderAddress $subject,
        \Closure $proceed,
        Address $object,
        $data = []
    ) {
        $orderAddress = $proceed($object, $data);
        if ($object->getGstin() || $this->gstin) {
            if (!$this->gstin) {
                $this->gstin = $object->getGstin();
            }
            
            $orderAddress->setGstin($this->gstin);
        }
        return $orderAddress;
    }
}
