<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomInvoice
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\CustomInvoice\Model\Config\Source;

/**
 * Used in creating options for getting product type value.
 */
class Position
{
    /**
     * Options getter.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $data = [
            ['value' => 0, 'label' => __('Top Left In Header')],
            ['value' => 1, 'label' => __('Top Right In Header')]
        ];
        return $data;
    }
}
