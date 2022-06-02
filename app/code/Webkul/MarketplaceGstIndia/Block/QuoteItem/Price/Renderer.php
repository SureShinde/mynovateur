<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webkul\MarketplaceGstIndia\Block\QuoteItem\Price;

use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Sales\Model\Order\CreditMemo\Item as CreditMemoItem;
use Magento\Sales\Model\Order\Invoice\Item as InvoiceItem;
use Magento\Sales\Model\Order\Item as OrderItem;

/**
 * Item price render block
 *
 * @api
 * @author      Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
 */
class Renderer extends \Magento\Tax\Block\Item\Price\Renderer
{
    /**
     * @var \Magento\Weee\Helper\Data
     */
    protected $weeeHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Tax\Helper\Data $taxHelper
     * @param PriceCurrencyInterface $priceCurrency
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $gstHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Tax\Helper\Data $taxHelper,
        PriceCurrencyInterface $priceCurrency,
        \Webkul\MarketplaceGstIndia\Helper\Data $gstHelper,
        array $data = []
    ) {
        $this->gstHelper = $gstHelper;
        parent::__construct($context, $taxHelper, $priceCurrency, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Get display price for unit price including tax.
     *
     * The Weee amount will be added to unit price including tax depending on Weee display setting.
     *
     * @return float
     */
    public function getUnitDisplayPriceInclTax()
    {
        $priceInclTax = $this->getItem()->getPriceInclTax();

        // if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
        //     return $priceInclTax;
        // }

        // if ($this->getIncludeWeeeFlag()) {
        //     return $priceInclTax + $this->weeeHelper->getWeeeTaxInclTax($this->getItem());
        // }

        return $priceInclTax;
    }

    /**
     * Get base price for unit price including tax.
     *
     * The Weee amount will be added to unit price including tax depending on Weee display setting.
     *
     * @return float
     */
    public function getBaseUnitDisplayPriceInclTax()
    {
        $basePriceInclTax = $this->getItem()->getBasePriceInclTax();

        // if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
        //     return $basePriceInclTax;
        // }

        // if ($this->getIncludeWeeeFlag()) {
        //     return $basePriceInclTax + $this->weeeHelper->getBaseWeeeTaxInclTax($this->getItem());
        // }

        return $basePriceInclTax;
    }

    /**
     * Get display price for row total including tax.
     *
     * The Weee amount will be added to row total including tax depending on Weee display setting.
     *
     * @return float
     */
    public function getRowDisplayPriceInclTax()
    {
        $rowTotalInclTax = $this->getItem()->getRowTotalInclTax();

        // if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
        //     return $rowTotalInclTax;
        // }

        // if ($this->getIncludeWeeeFlag()) {
        //     return $rowTotalInclTax + $this->weeeHelper->getRowWeeeTaxInclTax($this->getItem());
        // }

        return $rowTotalInclTax;
    }

    /**
     * Get base price for row total including tax.
     *
     * The Weee amount will be added to row total including tax depending on Weee display setting.
     *
     * @return float
     */
    public function getBaseRowDisplayPriceInclTax()
    {
        $baseRowTotalInclTax = $this->getItem()->getBaseRowTotalInclTax();

        // if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
        //     return $baseRowTotalInclTax;
        // }

        // if ($this->getIncludeWeeeFlag()) {
        //     return $baseRowTotalInclTax + $this->weeeHelper->getBaseRowWeeeTaxInclTax($this->getItem());
        // }

        return $baseRowTotalInclTax;
    }

    /**
     * Get display price for unit price excluding tax.
     *
     * The Weee amount will be added to unit price depending on Weee display setting.
     *
     * @return float
     */
    public function getUnitDisplayPriceExclTax()
    {
        $priceExclTax = $this->getItemDisplayPriceExclTax();
        // if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
        //     return $priceExclTax;
        // }

        // if ($this->getIncludeWeeeFlag()) {
        //     return $priceExclTax + $this->weeeHelper->getWeeeTaxAppliedAmount($this->getItem());
        // }

        return $priceExclTax;
    }

    /**
     * Get base price for unit price excluding tax.
     *
     * The Weee amount will be added to unit price depending on Weee display setting.
     *
     * @return float
     */
    public function getBaseUnitDisplayPriceExclTax()
    {
        $orderItem = $this->getItem();
        if ($orderItem instanceof InvoiceItem || $orderItem instanceof CreditMemoItem) {
            $orderItem = $orderItem->getOrderItem();
        }

        $qty = $orderItem->getQtyOrdered();
        $basePriceExclTax = $orderItem->getBaseRowTotal() / $qty;

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $basePriceExclTax;
        }

        if ($this->getIncludeWeeeFlag()) {
            return $basePriceExclTax + $this->getItem()->getBaseWeeeTaxAppliedAmount();
        }

        return $basePriceExclTax;
    }

    /**
     * Get display price for row total excluding tax.
     *
     * The Weee amount will be added to row total depending on Weee display setting.
     *
     * @return float
     */
    public function getRowDisplayPriceExclTax()
    {
        $rowTotalExclTax = $this->getItem()->getRowTotal();

        // if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
        //     return $rowTotalExclTax;
        // }

        // if ($this->getIncludeWeeeFlag()) {
        //     return $rowTotalExclTax + $this->weeeHelper->getWeeeTaxAppliedRowAmount($this->getItem());
        // }

        return $rowTotalExclTax;
    }

    /**
     * Get base price for row total excluding tax.
     *
     * The Weee amount will be added to row total depending on Weee display setting.
     *
     * @return float
     */
    public function getBaseRowDisplayPriceExclTax()
    {
        $baseRowTotalExclTax = $this->getItem()->getBaseRowTotal();

        // if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
        //     return $baseRowTotalExclTax;
        // }

        // if ($this->getIncludeWeeeFlag()) {
        //     return $baseRowTotalExclTax + $this->getItem()->getBaseWeeeTaxAppliedRowAmnt();
        // }

        return $baseRowTotalExclTax;
    }

    /**
     * Get final unit display price including tax.
     *
     * This will add Weee amount to unit price include tax.
     *
     * @return float
     */
    public function getFinalUnitDisplayPriceInclTax()
    {
        $priceInclTaxMpGst = $this->getItem()->getPriceInclTax();

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $priceInclTaxMpGst;
        }

        return $priceInclTaxMpGst + $this->weeeHelper->getWeeeTaxInclTax($this->getItem());
    }

    /**
     * Get base final unit display price including tax.
     *
     * This will add Weee amount to unit price include tax.
     *
     * @return float
     */
    public function getBaseFinalUnitDisplayPriceInclTax()
    {
        $basePriceInclTaxMpGst = $this->getItem()->getBasePriceInclTax();

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $basePriceInclTaxMpGst;
        }

        return $basePriceInclTaxMpGst + $this->weeeHelper->getBaseWeeeTaxInclTax($this->getItem());
    }

    /**
     * Get final row display price including tax.
     *
     * This will add weee amount to rowTotalInclTax.
     *
     * @return float
     */
    public function getFinalRowDisplayPriceInclTax()
    {
        $rowTotalInclTaxMpGst = $this->getItem()->getRowTotalInclTax();

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $rowTotalInclTaxMpGst;
        }

        return $rowTotalInclTaxMpGst + $this->weeeHelper->getRowWeeeTaxInclTax($this->getItem());
    }

    /**
     * Get base final row display price including tax.
     *
     * This will add weee amount to rowTotalInclTax.
     *
     * @return float
     */
    public function getBaseFinalRowDisplayPriceInclTax()
    {
        $baseRowTotalInclTax = $this->getItem()->getBaseRowTotalInclTax();

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $baseRowTotalInclTax;
        }

        return $baseRowTotalInclTax + $this->weeeHelper->getBaseRowWeeeTaxInclTax($this->getItem());
    }

    /**
     * Get final unit display price excluding tax
     *
     * @return float
     */
    public function getFinalUnitDisplayPriceExclTax()
    {
        $priceExclTaxMpGst = $this->getItemDisplayPriceExclTax();

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $priceExclTaxMpGst;
        }

        return $priceExclTaxMpGst + $this->weeeHelper->getWeeeTaxAppliedAmount($this->getItem());
    }

    /**
     * Get base final unit display price excluding tax
     *
     * @return float
     */
    public function getBaseFinalUnitDisplayPriceExclTax()
    {
        $orderItem = $this->getItem();
        if ($orderItem instanceof InvoiceItem || $orderItem instanceof CreditMemoItem) {
            $orderItem = $orderItem->getOrderItem();
        }

        $qty = $orderItem->getQtyOrdered();
        $basePriceExclTax = $orderItem->getBaseRowTotal() / $qty;

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $basePriceExclTax;
        }

        return $basePriceExclTax + $this->getItem()->getBaseWeeeTaxAppliedAmount();
    }

    /**
     * Get final row display price excluding tax.
     *
     * This will add Weee amount to rowTotal.
     *
     * @return float
     */
    public function getFinalRowDisplayPriceExclTax()
    {
        $rowTotalExclTaxGst = $this->getItem()->getRowTotal();

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $rowTotalExclTaxGst;
        }

        return $rowTotalExclTaxGst + $this->weeeHelper->getWeeeTaxAppliedRowAmount($this->getItem());
    }

    /**
     * Get base final row display price excluding tax.
     *
     * This will add Weee amount to rowTotal.
     *
     * @return float
     */
    public function getBaseFinalRowDisplayPriceExclTax()
    {
        $baseRowTotalExclTax = $this->getItem()->getBaseRowTotal();

        if (!$this->weeeHelper->isEnabled($this->getStoreId())) {
            return $baseRowTotalExclTax;
        }

        return $baseRowTotalExclTax + $this->getItem()->getBaseWeeeTaxAppliedRowAmnt();
    }

    /**
     * Whether to display final price that include Weee amounts
     *
     * @return bool
     */
    public function displayFinalPrice()
    {
        $flagNew = $this->weeeHelper->typeOfDisplay(
            WeeeDisplayConfig::DISPLAY_EXCL_DESCR_INCL,
            $this->getZone(),
            $this->getStoreId()
        );

        if (!$flagNew) {
            return false;
        }

        if ($this->weeeHelper->getWeeeTaxAppliedAmount($this->getItem()) <= 0) {
            return false;
        }
        return true;
    }

    /**
     * Return the total amount minus discount
     *
     * @param OrderItem|InvoiceItem|CreditMemoItem $item
     * @return mixed
     */
    public function getTotalAmount($item)
    {
        $itemQtyUpdated = $item->getQty();
        if ($item instanceof \Magento\Sales\Model\Order\Item) {
            $itemQtyUpdated = $item->getQtyOrdered();
        }
        $gst = ($itemQtyUpdated > 0) ? $item->getGst() : 0;
        if ((($item instanceof \Magento\Sales\Model\Order\Invoice\Item)
            || ($item instanceof \Magento\Sales\Model\Order\Creditmemo\Item))
            && $itemQtyUpdated > 0
        ) {
            $orderItem = $item->getOrderItem();
            $ratio = $itemQtyUpdated / $orderItem->getQtyOrdered();
            $gst = ($orderItem->getData('gst') * $ratio);
        }
        $totalAmount = $item->getRowTotal()
            - $item->getDiscountAmount()
            + $item->getTaxAmount()
            + $item->getDiscountTaxCompensationAmount()
            + $gst;
            
        return $totalAmount;
    }

    /**
     * Return the total amount minus discount
     *
     * @param OrderItem|InvoiceItem|CreditMemoItem $item
     * @return mixed
     */
    public function getBaseTotalAmount($item)
    {
        $itemQty = $item->getQty();
        if ($item instanceof \Magento\Sales\Model\Order\Item) {
            $itemQty = $item->getQtyOrdered();
        }
        $gst = ($itemQty > 0) ? $item->getGst() : 0;
        if ((($item instanceof \Magento\Sales\Model\Order\Invoice\Item)
            || ($item instanceof \Magento\Sales\Model\Order\Creditmemo\Item))
            && $itemQty > 0
        ) {
            $orderItem = $item->getOrderItem();
            $ratio = $itemQty / $orderItem->getQtyOrdered();
            $gst = ($orderItem->getData('gst') * $ratio);
        }
        $totalAmount = $item->getBaseRowTotal()
            - $item->getDiscountAmount()
            + $item->getTaxAmount()
            + $item->getDiscountTaxCompensationAmount()
            + $gst;
            
        return $totalAmount;
    }
}
