<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Webkul\DelhiveryExtend\Model\Order;

use Magento\Framework\Api\AttributeValueFactory;

/**
 * @method int getParentId()
 * @method float getWeight()
 * @method float getQty()
 * @method int getOrderId()
 * @method string getDescription()
 * @method string getTitle()
 * @method string getCarrierCode()
 * @method string getCreatedAt()
 * @method string getUpdatedAt()
 * @method \Magento\Sales\Api\Data\ShipmentTrackExtensionInterface getExtensionAttributes()
 */
class Track extends \Magento\Shipping\Model\Order\Track
{
    /**
     * Retrieve detail for shipment track
     *
     * @return \Magento\Framework\Phrase|string
     */
    public function getNumberDetail()
    {
        $carrierInstance = $this->_carrierFactory->create($this->getCarrierCode());
        if (!$carrierInstance) {
            $custom = [];
            $custom['title'] = $this->getTitle();
            $custom['number'] = $this->getTrackNumber();
            return $custom;
        } else {
            $carrierInstance->setStore($this->getStore());
        }

        $trackingInfo = $carrierInstance->getTrackingInfo($this->getNumber());
        if (!$trackingInfo) {
            return (string)__('No detail for number "%1"', $this->getNumber());
        }
        return $trackingInfo;
    }
}
