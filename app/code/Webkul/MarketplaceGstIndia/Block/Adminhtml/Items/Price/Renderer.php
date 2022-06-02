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
namespace Webkul\MarketplaceGstIndia\Block\Adminhtml\Items\Price;

use Magento\Sales\Model\Order\Creditmemo\Item as CreditmemoItem;
use Magento\Sales\Model\Order\Invoice\Item as InvoiceItem;
use Magento\Sales\Model\Order\Item;
use Magento\Quote\Model\Quote\Item\AbstractItem as QuoteItem;
use Webkul\MarketplaceGstIndia\Block\Item\Price\Renderer as ItemPriceRenderer;

/**
 * Sales Order items price column renderer
 */
class Renderer extends \Magento\Tax\Block\Adminhtml\Items\Price\Renderer
{
    /**
     * @var Webkul\MarketplaceGstIndia\Block\Item\Price\Renderer
     */
    protected $itemPriceRenderer;

    // @codingStandardsIgnoreStart
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Sales\Block\Adminhtml\Items\Column\DefaultColumn $defaultColumnRenderer
     * @param \Magento\Tax\Helper\Data $taxHelper
     * @param ItemPriceRenderer $itemPriceRenderer
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Block\Adminhtml\Items\Column\DefaultColumn $defaultColumnRenderer,
        \Magento\Tax\Helper\Data $taxHelper,
        ItemPriceRenderer $itemPriceRenderer,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $defaultColumnRenderer,
            $taxHelper,
            $itemPriceRenderer,
            $data
        );
    }
    // @codingStandardsIgnoreEnd

    /**
     * Calculate total amount for the item
     *
     * @param Item|QuoteItem|InvoiceItem|CreditmemoItem $item
     * @return mixed
     */
    public function getTotalAmount($item)
    {
        return $this->itemPriceRenderer->getTotalAmount($item);
    }

    /**
     * Calculate base total amount for the item
     *
     * @param Item|QuoteItem|InvoiceItem|CreditmemoItem $item
     * @return mixed
     */
    public function getBaseTotalAmount($item)
    {
        return $this->itemPriceRenderer->getTotalAmount($item);
    }
}
