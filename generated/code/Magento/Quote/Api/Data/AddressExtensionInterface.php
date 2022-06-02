<?php
namespace Magento\Quote\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Quote\Api\Data\AddressInterface
 */
interface AddressExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\SalesRule\Api\Data\RuleDiscountInterface[]|null
     */
    public function getDiscounts();

    /**
     * @param \Magento\SalesRule\Api\Data\RuleDiscountInterface[] $discounts
     * @return $this
     */
    public function setDiscounts($discounts);

    /**
     * @return int|null
     */
    public function getGiftRegistryId();

    /**
     * @param int $giftRegistryId
     * @return $this
     */
    public function setGiftRegistryId($giftRegistryId);

    /**
     * @return string|null
     */
    public function getPickupLocationCode();

    /**
     * @param string $pickupLocationCode
     * @return $this
     */
    public function setPickupLocationCode($pickupLocationCode);

    /**
     * @return string|null
     */
    public function getGstin();

    /**
     * @param string $gstin
     * @return $this
     */
    public function setGstin($gstin);
}
