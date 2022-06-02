<?php

namespace Amasty\ProductAttachment\Model\SourceOptions;

class OrderStatus extends \Magento\Sales\Model\Config\Source\Order\Status
{
    public function toOptionArray()
    {
        //remove Please Select option
        return array_slice(parent::toOptionArray(), 1);
    }
}
