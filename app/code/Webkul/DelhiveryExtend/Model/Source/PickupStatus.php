<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Model\Source;

/**
 * Class PickupStatus
 */
class PickupStatus implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['label' =>  __('Pending'), 'value' => 0],
            ['label' =>  __('Done'), 'value' => 1]
        ];
        return $options;
    }
}
