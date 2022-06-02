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
namespace Webkul\MarketplaceGstIndia\Plugin;

class ShippingInformationManagementPlugin
{
    /**
     * Save Address
     *
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param int $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();
        $billingAddress = $addressInformation->getBillingAddress();
        $extensionAttributes = $shippingAddress->getExtensionAttributes();
        $billingExtensionAttributes = $billingAddress->getExtensionAttributes();

        if ($extensionAttributes) {
            if ($extensionAttributes->getGstin()) {
                $gstin = $extensionAttributes->getGstin();
                $shippingAddress->setGstin($gstin);
            } else {
                $shippingAddress->setGstin('');
            }
        }

        if ($billingExtensionAttributes) {
            if ($billingExtensionAttributes->getGstin()) {
                $gstin = $billingExtensionAttributes->getGstin();
                $billingAddress->setGstin($gstin);
            } else {
                $billingAddress->setGstin('');
            }
        }
    }
}
