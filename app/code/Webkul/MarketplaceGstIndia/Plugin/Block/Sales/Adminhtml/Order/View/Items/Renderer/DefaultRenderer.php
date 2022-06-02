<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 *
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Plugin\Block\Sales\Adminhtml\Order\View\Items\Renderer;

use Magento\Sales\Block\Adminhtml\Order\View\Items\Renderer\DefaultRenderer as MagentoDefaultRenderer;

/** DefaultRenderer Plugin */
class DefaultRenderer
{
    /**
     * BundleRenderer Plugin
     *
     * @param MagentoDefaultRenderer $defaultRenderer
     * @param \Closure $proceed
     * @param \Magento\Framework\DataObject $item
     * @param string $column
     * @param string $field
     * @return void
     */
    public function aroundGetColumnHtml(
        MagentoDefaultRenderer $defaultRenderer,
        \Closure $proceed,
        \Magento\Framework\DataObject $item,
        $column,
        $field = null
    ) {
        $customColumns = [
            'sgst',
            'cgst',
            'igst',
            'utgst',
            'gst'
        ];
        if (in_array($column, $customColumns)) {
            $html = $item->getOrder()->formatPrice($item->getData($column));
            if ($item->getData('sgst') !=0 && $column == 'sgst') {
                $html .= '('.((float)$item->getData('sgst_percent')). '%)';
            }
            if ($item->getData('cgst') !=0 && $column == 'cgst') {
                $html .= '('.((float)$item->getData('cgst_percent')). '%)';
            }
            if ($item->getData('igst') !=0 && $column == 'igst') {
                $html .= '('.((float)$item->getData('igst_percent')). '%)';
            }
            if ($item->getData('utgst') !=0 && $column == 'utgst') {
                $html .= '('.((float)$item->getData('utgst_percent')). '%)';
            }
            $result = $html;
        } else {
            if ($field) {
                $result = $proceed($item, $column, $field);
            } else {
                $result = $proceed($item, $column);
            }
        }
        return $result;
    }
}
