<?php
namespace Magento\Sales\Api\Data;

/**
 * Extension class for @see \Magento\Sales\Api\Data\OrderItemInterface
 */
class OrderItemExtension extends \Magento\Framework\Api\AbstractSimpleObject implements OrderItemExtensionInterface
{
    /**
     * @return \Magento\GiftMessage\Api\Data\MessageInterface|null
     */
    public function getGiftMessage()
    {
        return $this->_get('gift_message');
    }

    /**
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return $this
     */
    public function setGiftMessage(\Magento\GiftMessage\Api\Data\MessageInterface $giftMessage)
    {
        $this->setData('gift_message', $giftMessage);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwId()
    {
        return $this->_get('gw_id');
    }

    /**
     * @param string $gwId
     * @return $this
     */
    public function setGwId($gwId)
    {
        $this->setData('gw_id', $gwId);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBasePrice()
    {
        return $this->_get('gw_base_price');
    }

    /**
     * @param string $gwBasePrice
     * @return $this
     */
    public function setGwBasePrice($gwBasePrice)
    {
        $this->setData('gw_base_price', $gwBasePrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwPrice()
    {
        return $this->_get('gw_price');
    }

    /**
     * @param string $gwPrice
     * @return $this
     */
    public function setGwPrice($gwPrice)
    {
        $this->setData('gw_price', $gwPrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBaseTaxAmount()
    {
        return $this->_get('gw_base_tax_amount');
    }

    /**
     * @param string $gwBaseTaxAmount
     * @return $this
     */
    public function setGwBaseTaxAmount($gwBaseTaxAmount)
    {
        $this->setData('gw_base_tax_amount', $gwBaseTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwTaxAmount()
    {
        return $this->_get('gw_tax_amount');
    }

    /**
     * @param string $gwTaxAmount
     * @return $this
     */
    public function setGwTaxAmount($gwTaxAmount)
    {
        $this->setData('gw_tax_amount', $gwTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBasePriceInvoiced()
    {
        return $this->_get('gw_base_price_invoiced');
    }

    /**
     * @param string $gwBasePriceInvoiced
     * @return $this
     */
    public function setGwBasePriceInvoiced($gwBasePriceInvoiced)
    {
        $this->setData('gw_base_price_invoiced', $gwBasePriceInvoiced);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwPriceInvoiced()
    {
        return $this->_get('gw_price_invoiced');
    }

    /**
     * @param string $gwPriceInvoiced
     * @return $this
     */
    public function setGwPriceInvoiced($gwPriceInvoiced)
    {
        $this->setData('gw_price_invoiced', $gwPriceInvoiced);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBaseTaxAmountInvoiced()
    {
        return $this->_get('gw_base_tax_amount_invoiced');
    }

    /**
     * @param string $gwBaseTaxAmountInvoiced
     * @return $this
     */
    public function setGwBaseTaxAmountInvoiced($gwBaseTaxAmountInvoiced)
    {
        $this->setData('gw_base_tax_amount_invoiced', $gwBaseTaxAmountInvoiced);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwTaxAmountInvoiced()
    {
        return $this->_get('gw_tax_amount_invoiced');
    }

    /**
     * @param string $gwTaxAmountInvoiced
     * @return $this
     */
    public function setGwTaxAmountInvoiced($gwTaxAmountInvoiced)
    {
        $this->setData('gw_tax_amount_invoiced', $gwTaxAmountInvoiced);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBasePriceRefunded()
    {
        return $this->_get('gw_base_price_refunded');
    }

    /**
     * @param string $gwBasePriceRefunded
     * @return $this
     */
    public function setGwBasePriceRefunded($gwBasePriceRefunded)
    {
        $this->setData('gw_base_price_refunded', $gwBasePriceRefunded);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwPriceRefunded()
    {
        return $this->_get('gw_price_refunded');
    }

    /**
     * @param string $gwPriceRefunded
     * @return $this
     */
    public function setGwPriceRefunded($gwPriceRefunded)
    {
        $this->setData('gw_price_refunded', $gwPriceRefunded);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBaseTaxAmountRefunded()
    {
        return $this->_get('gw_base_tax_amount_refunded');
    }

    /**
     * @param string $gwBaseTaxAmountRefunded
     * @return $this
     */
    public function setGwBaseTaxAmountRefunded($gwBaseTaxAmountRefunded)
    {
        $this->setData('gw_base_tax_amount_refunded', $gwBaseTaxAmountRefunded);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwTaxAmountRefunded()
    {
        return $this->_get('gw_tax_amount_refunded');
    }

    /**
     * @param string $gwTaxAmountRefunded
     * @return $this
     */
    public function setGwTaxAmountRefunded($gwTaxAmountRefunded)
    {
        $this->setData('gw_tax_amount_refunded', $gwTaxAmountRefunded);
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getVertexTaxCodes()
    {
        return $this->_get('vertex_tax_codes');
    }

    /**
     * @param string[] $vertexTaxCodes
     * @return $this
     */
    public function setVertexTaxCodes($vertexTaxCodes)
    {
        $this->setData('vertex_tax_codes', $vertexTaxCodes);
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getInvoiceTextCodes()
    {
        return $this->_get('invoice_text_codes');
    }

    /**
     * @param string[] $invoiceTextCodes
     * @return $this
     */
    public function setInvoiceTextCodes($invoiceTextCodes)
    {
        $this->setData('invoice_text_codes', $invoiceTextCodes);
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getTaxCodes()
    {
        return $this->_get('tax_codes');
    }

    /**
     * @param string[] $taxCodes
     * @return $this
     */
    public function setTaxCodes($taxCodes)
    {
        $this->setData('tax_codes', $taxCodes);
        return $this;
    }

    /**
     * @return \Vertex\Tax\Api\Data\CommodityCodeInterface|null
     */
    public function getVertexCommodityCode()
    {
        return $this->_get('vertex_commodity_code');
    }

    /**
     * @param \Vertex\Tax\Api\Data\CommodityCodeInterface $vertexCommodityCode
     * @return $this
     */
    public function setVertexCommodityCode(\Vertex\Tax\Api\Data\CommodityCodeInterface $vertexCommodityCode)
    {
        $this->setData('vertex_commodity_code', $vertexCommodityCode);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getSgst()
    {
        return $this->_get('sgst');
    }

    /**
     * @param integer $sgst
     * @return $this
     */
    public function setSgst($sgst)
    {
        $this->setData('sgst', $sgst);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getSgstPercent()
    {
        return $this->_get('sgst_percent');
    }

    /**
     * @param integer $sgstPercent
     * @return $this
     */
    public function setSgstPercent($sgstPercent)
    {
        $this->setData('sgst_percent', $sgstPercent);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getCgst()
    {
        return $this->_get('cgst');
    }

    /**
     * @param integer $cgst
     * @return $this
     */
    public function setCgst($cgst)
    {
        $this->setData('cgst', $cgst);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getCgstPercent()
    {
        return $this->_get('cgst_percent');
    }

    /**
     * @param integer $cgstPercent
     * @return $this
     */
    public function setCgstPercent($cgstPercent)
    {
        $this->setData('cgst_percent', $cgstPercent);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getIgst()
    {
        return $this->_get('igst');
    }

    /**
     * @param integer $igst
     * @return $this
     */
    public function setIgst($igst)
    {
        $this->setData('igst', $igst);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getIgstPercent()
    {
        return $this->_get('igst_percent');
    }

    /**
     * @param integer $igstPercent
     * @return $this
     */
    public function setIgstPercent($igstPercent)
    {
        $this->setData('igst_percent', $igstPercent);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getUtgst()
    {
        return $this->_get('utgst');
    }

    /**
     * @param integer $utgst
     * @return $this
     */
    public function setUtgst($utgst)
    {
        $this->setData('utgst', $utgst);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getUtgstPercent()
    {
        return $this->_get('utgst_percent');
    }

    /**
     * @param integer $utgstPercent
     * @return $this
     */
    public function setUtgstPercent($utgstPercent)
    {
        $this->setData('utgst_percent', $utgstPercent);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getGst()
    {
        return $this->_get('gst');
    }

    /**
     * @param integer $gst
     * @return $this
     */
    public function setGst($gst)
    {
        $this->setData('gst', $gst);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHsn()
    {
        return $this->_get('hsn');
    }

    /**
     * @param string $hsn
     * @return $this
     */
    public function setHsn($hsn)
    {
        $this->setData('hsn', $hsn);
        return $this;
    }
}
