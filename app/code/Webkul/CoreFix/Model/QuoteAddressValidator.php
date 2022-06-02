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
class QuoteAddressValidator extends \Magento\Quote\Model\QuoteAddressValidator
{
    /**
     * Validate address.
     *
     * @param AddressInterface $address
     * @param int|null $customerId Cart belongs to
     * @return void
     * @throws \Magento\Framework\Exception\InputException The specified address belongs to another customer.
     * @throws \Magento\Framework\Exception\NoSuchEntityException The specified customer ID or address ID is not valid.
     */
    private function doValidate(AddressInterface $address, ?int $customerId): void
    {
        //validate customer id
        if ($customerId) {
            $customer = $this->customerRepository->getById($customerId);
            if (!$customer->getId()) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(
                    __('Invalid customer id %1', $customerId)
                );
            }
        }

        if ($address->getCustomerAddressId()) {
            //Existing address cannot belong to a guest
            if (!$customerId) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(
                    __('Invalid customer address id %1', $address->getCustomerAddressId())
                );
            }
            //Validating address ID
            try {
                $this->addressRepository->getById($address->getCustomerAddressId());
            } catch (NoSuchEntityException $e) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(
                    __('Invalid address id %1', $address->getId())
                );
            }
            //Finding available customer's addresses
            $applicableAddressIds = array_map(function ($address) {
                /** @var \Magento\Customer\Api\Data\AddressInterface $address */
                return $address->getId();
            }, $this->customerRepository->getById($customerId)->getAddresses());
            if (!in_array($address->getCustomerAddressId(), $applicableAddressIds)) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(
                    __('Invalid customer address id %1', $address->getCustomerAddressId())
                );
            }
        }
    }
}
