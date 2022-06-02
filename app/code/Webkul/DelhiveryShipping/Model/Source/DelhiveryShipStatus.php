<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Marketplace
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryShipping\Model\Source;

/**
 * Class OrderListStatus
 */
class DelhiveryShipStatus implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'label' =>  __('In Transit'),
                'row_label' =>  "<span class='wk-mp-grid-status wk-mp-grid-status-InTransit'>In Transit</span>",
                'value' => 'InTransit',
            ],
            [
                'label' =>  __('Manifested'),
                'row_label' =>  "<span class='wk-mp-grid-status wk-mp-grid-status-Manifested'>Manifested</span>",
                'value' => 'Manifested',
            ],
            [
                'label' =>  __('Dispatched'),
                'row_label' =>  "<span class='wk-mp-grid-status wk-mp-grid-status-InTransit'>Dispatched</span>",
                'value' => 'Dispatched',
            ],
            [
                'label' =>  __('Pending'),
                'row_label' =>  "<span class='wk-mp-grid-status wk-mp-grid-status-InTransit'>Pending</span>",
                'value' => 'Pending',
            ],
        ];
        return $options;
    }
}
