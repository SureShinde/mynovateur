<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CoreFix
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\CoreFix\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\Data\AddressInterface;

/**
 * Quote shipping/billing address validator service.
 *
 * @SuppressWarnings(PHPMD.CookieAndSessionMisuse)
 */
class ShippingMethodManagement extends \Magento\Quote\Model\ShippingMethodManagement
{
    /**
     * Get list of available shipping methods
     *
     * @param Quote $quote
     * @param ExtensibleDataInterface $address
     * @return ShippingMethodInterface[]
     */
    private function getShippingMethods(Quote $quote, $address)
    {
        $output = [];
        $shippingAddress = $quote->getShippingAddress();
        //$shippingAddress->addData($this->extractAddressData($address));
        $addressData = $this->extractAddressData($address);
        if (array_key_exists('extension_attributes', $addressData)) {
            unset($addressData['extension_attributes']);
        }
        $shippingAddress->addData($addressData);
        $shippingAddress->setCollectShippingRates(true);

        $this->totalsCollector->collectAddressTotals($quote, $shippingAddress);
        $quoteCustomerGroupId = $quote->getCustomerGroupId();
        $customerGroupId = $this->customerSession->getCustomerGroupId();
        $isCustomerGroupChanged = $quoteCustomerGroupId !== $customerGroupId;
        if ($isCustomerGroupChanged) {
            $quote->setCustomerGroupId($customerGroupId);
        }
        $shippingRates = $shippingAddress->getGroupedAllShippingRates();
        foreach ($shippingRates as $carrierRates) {
            foreach ($carrierRates as $rate) {
                $output[] = $this->converter->modelToDataObject($rate, $quote->getQuoteCurrencyCode());
            }
        }
        if ($isCustomerGroupChanged) {
            $quote->setCustomerGroupId($quoteCustomerGroupId);
        }
        return $output;
    }
}
