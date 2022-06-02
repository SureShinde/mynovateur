<?php
namespace Magento\Sales\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Sales\Api\Data\OrderItemInterface
 */
interface OrderItemExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\GiftMessage\Api\Data\MessageInterface|null
     */
    public function getGiftMessage();

    /**
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return $this
     */
    public function setGiftMessage(\Magento\GiftMessage\Api\Data\MessageInterface $giftMessage);

    /**
     * @return string|null
     */
    public function getGwId();

    /**
     * @param string $gwId
     * @return $this
     */
    public function setGwId($gwId);

    /**
     * @return string|null
     */
    public function getGwBasePrice();

    /**
     * @param string $gwBasePrice
     * @return $this
     */
    public function setGwBasePrice($gwBasePrice);

    /**
     * @return string|null
     */
    public function getGwPrice();

    /**
     * @param string $gwPrice
     * @return $this
     */
    public function setGwPrice($gwPrice);

    /**
     * @return string|null
     */
    public function getGwBaseTaxAmount();

    /**
     * @param string $gwBaseTaxAmount
     * @return $this
     */
    public function setGwBaseTaxAmount($gwBaseTaxAmount);

    /**
     * @return string|null
     */
    public function getGwTaxAmount();

    /**
     * @param string $gwTaxAmount
     * @return $this
     */
    public function setGwTaxAmount($gwTaxAmount);

    /**
     * @return string|null
     */
    public function getGwBasePriceInvoiced();

    /**
     * @param string $gwBasePriceInvoiced
     * @return $this
     */
    public function setGwBasePriceInvoiced($gwBasePriceInvoiced);

    /**
     * @return string|null
     */
    public function getGwPriceInvoiced();

    /**
     * @param string $gwPriceInvoiced
     * @return $this
     */
    public function setGwPriceInvoiced($gwPriceInvoiced);

    /**
     * @return string|null
     */
    public function getGwBaseTaxAmountInvoiced();

    /**
     * @param string $gwBaseTaxAmountInvoiced
     * @return $this
     */
    public function setGwBaseTaxAmountInvoiced($gwBaseTaxAmountInvoiced);

    /**
     * @return string|null
     */
    public function getGwTaxAmountInvoiced();

    /**
     * @param string $gwTaxAmountInvoiced
     * @return $this
     */
    public function setGwTaxAmountInvoiced($gwTaxAmountInvoiced);

    /**
     * @return string|null
     */
    public function getGwBasePriceRefunded();

    /**
     * @param string $gwBasePriceRefunded
     * @return $this
     */
    public function setGwBasePriceRefunded($gwBasePriceRefunded);

    /**
     * @return string|null
     */
    public function getGwPriceRefunded();

    /**
     * @param string $gwPriceRefunded
     * @return $this
     */
    public function setGwPriceRefunded($gwPriceRefunded);

    /**
     * @return string|null
     */
    public function getGwBaseTaxAmountRefunded();

    /**
     * @param string $gwBaseTaxAmountRefunded
     * @return $this
     */
    public function setGwBaseTaxAmountRefunded($gwBaseTaxAmountRefunded);

    /**
     * @return string|null
     */
    public function getGwTaxAmountRefunded();

    /**
     * @param string $gwTaxAmountRefunded
     * @return $this
     */
    public function setGwTaxAmountRefunded($gwTaxAmountRefunded);

    /**
     * @return string[]|null
     */
    public function getVertexTaxCodes();

    /**
     * @param string[] $vertexTaxCodes
     * @return $this
     */
    public function setVertexTaxCodes($vertexTaxCodes);

    /**
     * @return string[]|null
     */
    public function getInvoiceTextCodes();

    /**
     * @param string[] $invoiceTextCodes
     * @return $this
     */
    public function setInvoiceTextCodes($invoiceTextCodes);

    /**
     * @return string[]|null
     */
    public function getTaxCodes();

    /**
     * @param string[] $taxCodes
     * @return $this
     */
    public function setTaxCodes($taxCodes);

    /**
     * @return \Vertex\Tax\Api\Data\CommodityCodeInterface|null
     */
    public function getVertexCommodityCode();

    /**
     * @param \Vertex\Tax\Api\Data\CommodityCodeInterface $vertexCommodityCode
     * @return $this
     */
    public function setVertexCommodityCode(\Vertex\Tax\Api\Data\CommodityCodeInterface $vertexCommodityCode);

    /**
     * @return integer|null
     */
    public function getSgst();

    /**
     * @param integer $sgst
     * @return $this
     */
    public function setSgst($sgst);

    /**
     * @return integer|null
     */
    public function getSgstPercent();

    /**
     * @param integer $sgstPercent
     * @return $this
     */
    public function setSgstPercent($sgstPercent);

    /**
     * @return integer|null
     */
    public function getCgst();

    /**
     * @param integer $cgst
     * @return $this
     */
    public function setCgst($cgst);

    /**
     * @return integer|null
     */
    public function getCgstPercent();

    /**
     * @param integer $cgstPercent
     * @return $this
     */
    public function setCgstPercent($cgstPercent);

    /**
     * @return integer|null
     */
    public function getIgst();

    /**
     * @param integer $igst
     * @return $this
     */
    public function setIgst($igst);

    /**
     * @return integer|null
     */
    public function getIgstPercent();

    /**
     * @param integer $igstPercent
     * @return $this
     */
    public function setIgstPercent($igstPercent);

    /**
     * @return integer|null
     */
    public function getUtgst();

    /**
     * @param integer $utgst
     * @return $this
     */
    public function setUtgst($utgst);

    /**
     * @return integer|null
     */
    public function getUtgstPercent();

    /**
     * @param integer $utgstPercent
     * @return $this
     */
    public function setUtgstPercent($utgstPercent);

    /**
     * @return integer|null
     */
    public function getGst();

    /**
     * @param integer $gst
     * @return $this
     */
    public function setGst($gst);

    /**
     * @return string|null
     */
    public function getHsn();

    /**
     * @param string $hsn
     * @return $this
     */
    public function setHsn($hsn);
}
