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
namespace Webkul\MarketplaceGstIndia\Model\Total\Quote;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Tax\Api\Data\TaxDetailsItemInterfaceFactory;

class Gst extends AbstractTotal
{
    /**
     * Constant for gst item type
     */
    public const ITEM_TYPE = 'gst';

    /**
     * @var bool
     */
    protected $_exclusiveGst = true;
    /**
     * @var bool
     */
    protected $_showInclExcl = true;
    /**
     * @var \Magento\Store\Model\Store
     */
    protected $_store;

    /**
     * Accumulates totals for gst
     *
     * @var int
     */
    protected $totalGst = 0;

    /**
     * @var string
     */

    protected $gstType = '';
    /**
     * @var string
     */
    protected $adminGstType = '';

    /**
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper
     * @param \Webkul\Marketplace\Helper\Data $mpHelper
     * @param PriceCurrencyInterface $priceCurrency
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Magento\Tax\Helper\Data $taxHelper
     * @param \Magento\Tax\Model\Config $taxConfig
     * @param TaxDetailsItemInterfaceFactory $taxDetailsItemFactory
     */
    public function __construct(
        \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper,
        \Webkul\Marketplace\Helper\Data $mpHelper,
        PriceCurrencyInterface $priceCurrency,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Tax\Helper\Data $taxHelper,
        \Magento\Tax\Model\Config $taxConfig,
        \Psr\Log\LoggerInterface $logger,
        TaxDetailsItemInterfaceFactory $taxDetailsItemFactory
    ) {
        $this->setCode('gst');
        $this->mpGstHelper = $mpGstHelper;
        $this->mpHelper = $mpHelper;
        $this->priceCurrency = $priceCurrency;
        $this->customerRepository = $customerRepository;
        $this->taxHelper = $taxHelper;
        $this->taxDetailsItemFactory = $taxDetailsItemFactory;
        $this->taxConfig = $taxConfig;
        $this->_exclusiveGst = $this->mpGstHelper->isGstExclude();
        $this->_showInclExcl = $this->mpGstHelper->showIncludeExclude();
        $this->_logger = $logger;
    }

    /**
     * Collect gst amounts for the quote / order
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        $this->_store = $quote->getStore();
        if (!$this->mpGstHelper->isEnabled()) {
            return $this;
        }
        /*$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/gst.log');
        $logger = new \Zend\Log\Logger();*/

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/gst.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('call gst method'); 
        //$logger->info(print_r($object->getData(), true));
        //$this->_logger->debug("call gst method");
        $address = $shippingAssignment->getShipping()->getAddress();
        if ($address->getCountryId() != 'IN') {
            return $this;
        }
        $items = $shippingAssignment->getItems();
        if (!count($items)) {
            return $this;
        }

        $regionId = null;
        $productionState = $this->mpGstHelper->getConfigValue('state');
        if ($address) {
            $regionId = $address->getRegionId();
        } else {
            if (!empty($shippingAssignment->getBilling())) {
                $billingAddress = $shippingAssignment->getBilling()->getAddress();
                $regionId = $billingAddress->getRegionId();
            }
        }
        $logger->info("call gst method1");
        $utArray=[533,538,540,541,551];
        $this->utGstToken=0;
        if ($regionId == $productionState) {
            $this->gstType = 'intra';
            if (in_array($regionId, $utArray)) {
                $this->utGstToken= 1;
            }
        } else {
            $this->gstType = 'inter';
        }
        $this->adminGstType = $this->gstType;
        $this->totalBaseGst = 0;
        $this->totalGst = 0;
        $this->igst = 0;
        $this->sgst = 0;
        $this->cgst = 0;
        $this->utgst = 0;
        $subtotal = $baseSubtotal = 0;
        $discountTaxCompensation = $baseDiscountTaxCompensation = 0;
        $tax = $baseTax = 0;
        $subtotalInclTax = $baseSubtotalInclTax = 0;
        foreach ($items as $item) {
            $logger->info($item->getName());
            if ($item->getParentItem()) {
                continue;
            }

            $this->resetItemData($item);
            $this->createTaxItemData($item, $this->calculateGst($item));

            if ($item->getHasChildren()) {
                foreach ($item->getChildren() as $child) {
                    $this->resetItemData($child);
                    $this->process($address, $total, $child, $item, $regionId);
                }
            } else {
                $this->process($address, $total, $item, null, $regionId);
            }
            $this->updateItemTaxInfo($item, $this->calculateGst($item));

            $subtotal += $item->getRowTotal();
            $baseSubtotal += $item->getBaseRowTotal();
            $subtotalInclTax += $item->getRowTotalInclTax();
            $baseSubtotalInclTax += $item->getBaseRowTotalInclTax();
        }
        $total->setTotalAmount('subtotal', $subtotal);
        $total->setBaseTotalAmount('subtotal', $baseSubtotal);
        $total->setSubtotalInclTax($subtotalInclTax);
        $total->setBaseSubtotalTotalInclTax($baseSubtotalInclTax);
        $total->setBaseSubtotalInclTax($baseSubtotalInclTax);
        $address = $shippingAssignment->getShipping()->getAddress();
        $address->setBaseSubtotalTotalInclTax($baseSubtotalInclTax);
        $address->setSubtotal($total->getSubtotal());
        $address->setBaseSubtotal($total->getBaseSubtotal());

        if ($this->_exclusiveGst) {
            $total->setTotalAmount(
                self::ITEM_TYPE,
                $this->priceCurrency->round(
                    $this->priceCurrency->convert($this->totalGst, $this->_store)
                )
            );
            $total->setBaseTotalAmount(self::ITEM_TYPE, $this->totalGst);
        }
        $logger->info("call gst method3");
        $logger->info($this->totalGst);
        $total->setBaseTotalAmount(self::ITEM_TYPE, $this->totalBaseGst);
        $total->setGst(($this->totalGst));
        $total->setBaseGst($this->totalBaseGst);
        $total->setGrandTotal($total->getGrandTotal());
        $total->setBaseGrandTotal($total->getBaseGrandTotal());

        return $this;
    }
    /**
     * Calculate tax data
     *
     * @param  object $item
     * @param  object $gst
     * @return void|$this
     */
    protected function createTaxItemData($item, $gst)
    {
        $taxDetailsItem = $this->taxDetailsItemFactory->create();

        $taxDetailsItem->setCode('gst')
            ->setType($item->getType())
            ->setRowTax($gst)
            ->setPrice(60)
            ->setPriceInclTax(60)
            ->setRowTotal($item->getRowTotal())
            ->setRowTotalInclTax($item->getRowTotalInclTax())
            ->setDiscountTaxCompensationAmount(0)
            ->setTaxPercent(20)
            ;

        return $taxDetailsItem;
    }
    /**
     * Calculate GST
     *
     * @param  object $item
     * @return void|$this
     */
    protected function calculateGst($item)
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/gst.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info("call gst method:calculateGst");
        $taxPercent = 0;
        $hsn = null;
        $itemPrice = $item->getPrice();
        $gst = 0;

        if ($item->getHasChildren()) {
            foreach ($item->getChildren() as $child) {
                if ($item->getProductType() == 'configurable') {
                    $itemPrice = $item->getPrice();
                } else {
                    $itemPrice = $child->getPrice();
                }
                $productId = $child->getProductId();
                if (!empty($productId)) {
                    $product = $this->mpGstHelper->getProductById($productId);
                    $taxClassId = $this->mpGstHelper->getConfigValue('default_product_tax_class', 'tax/classes/');
                    if ($product->getTaxClassId() != $taxClassId) {
                        return;
                    }
                    $taxPercent = $product->getGstPercent();
                    $hsn = $product->getHsnCode();
                    if (!empty($product->getGstMinPrice())
                        && !empty($product->getGstPercentMax())
                        && $itemPrice <= $product->getGstMinPrice()
                    ) {
                        $taxPercent = $product->getGstPercentMax();
                    }
                }
                $gst += (($itemPrice*$child->getQty()* $item->getQty())*$taxPercent)/100;

            }
        } else {
            $productId = $item->getProductId();
            if (!empty($productId)) {
                $product = $this->mpGstHelper->getProductById($productId);
                if ($product->getTaxClassId() != 2) {
                    return;
                }
                $taxPercent = $product->getGstPercent();
                $logger->info('taxPercent');
                $logger->info($taxPercent);
                $hsn = $product->getHsnCode();
                if (!empty($product->getGstMinPrice())
                    && !empty($product->getGstPercentMax())
                    && $itemPrice <= $product->getGstMinPrice()
                ) {
                    $taxPercent = $product->getGstPercentMax();
                }
            }
            if ($this->_exclusiveGst) {
                $gst = (($itemPrice*$item->getQty())*$taxPercent)/100;
            } else {
                $gst = ($itemPrice*$item->getQty()) - ($itemPrice*$item->getQty())/(($taxPercent/100)+1);
            }

        }
        return $gst;
    }

    /**
     * Calculate total
     *
     * @param   \Magento\Quote\Model\Quote\Address $address
     * @param   \Magento\Quote\Model\Quote\Address\Total $total
     * @param   \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @param   \Magento\Quote\Api\Data\ShippingAssignmentInterface $parent
     * @param   int $regionId
     * @return  void|$this
     */
    protected function process(
        \Magento\Quote\Model\Quote\Address $address,
        \Magento\Quote\Model\Quote\Address\Total $total,
        $item,
        $parent = null,
        $regionId = null
    ) {
        $this->_logger->debug("call gst method:process");
        $taxPercent = 0;
        $hsn = null;
        $itemPrice = $item->getPrice();
        $baseitemPrice = $item->getBasePrice();
        $this->_logger->debug("call gst method:getBasePrice");
        $this->_logger->debug($item->getBasePrice());
        $this->_logger->debug("call gst method:getPrice");
        $this->_logger->debug($item->getPrice());
        if (!empty($parent) && $parent->getProductType() == 'configurable') {
            $itemPrice = $parent->getPrice();
        }

        $productId = $item->getProductId();
        if (!empty($productId)) {
            $product = $this->mpGstHelper->getProductById($productId);
            if ($product->getTaxClassId() != 2) {
                return;
            }
            $taxPercent = $product->getGstPercent();
            $hsn = $product->getHsnCode();
            if (!empty($product->getGstMinPrice())
                && !empty($product->getGstPercentMax())
                && $itemPrice <= $product->getGstMinPrice()
            ) {
                $taxPercent = $product->getGstPercentMax();
            }
        }
        if (!empty($item->getParentItem())) {
            $gst = (($itemPrice*$item->getQty()* $item->getParentItem()->getQty())*$taxPercent)/100;
            $basegst = (($baseitemPrice*$item->getQty()* $item->getParentItem()->getQty())*$taxPercent)/100;
        } else {
            $gst = (($itemPrice*$item->getQty())*$taxPercent)/100;
            $basegst = (($baseitemPrice*$item->getQty())*$taxPercent)/100;

        }
        $this->totalBaseGst = $this->totalBaseGst + $basegst;
        $this->totalGst = $this->totalGst + $gst;
        $sellerProductData = $this->mpHelper->getSellerProductDataByProductId($productId);
        if ($sellerProductData->getSize()) {
            $sellerId = $sellerProductData->getFirstItem()->getSellerId();
            $customerData = $this->customerRepository->getById($sellerId);
            $sellerProductionState = $customerData->getCustomAttribute('seller_production_state');

            if (!empty($sellerProductionState)) {
                if (!empty($sellerProductionState->getValue()) && $regionId == $sellerProductionState->getValue()) {
                    $this->gstType = 'intra';
                } else {
                    $this->gstType = 'inter';
                }
            } else {
                $this->gstType = $this->adminGstType;
            }
        } else {
            $this->gstType = $this->adminGstType;
        }

        if (!empty($parent) && $parent->getProductType() == 'configurable') {
            $parent->setGst($gst);
            $parent->setHsn($hsn);

            if ($this->gstType == 'inter') {
                $parent->setSgst(0);
                $parent->setSgstPercent(0);

                $parent->setCgst(0);
                $parent->setCgstPercent(0);

                $parent->setIgst($gst);
                $parent->setIgstPercent($taxPercent);
                $this->igst = $gst;
            } else {
                if ($this->utGstToken==1) {
                    $parent->setSgst(0);
                    $parent->setSgstPercent(0);
                    $parent->setCgst($gst/2);
                    $parent->setCgstPercent($taxPercent/2);
                    $this->cgst = $gst/2;
                    $parent->setIgst(0);
                    $parent->setIgstPercent(0);
                    $parent->setUtgst($gst/2);
                    $parent->setUtgstPercent($taxPercent/2);
                    $this->utgst = $gst/2;

                } else {
                    $parent->setSgst($gst/2);
                    $parent->setSgstPercent($taxPercent/2);
                    $this->sgst = $gst/2;
                    $parent->setCgst($gst/2);
                    $parent->setCgstPercent($taxPercent/2);
                    $this->cgst = $gst/2;
                    $parent->setIgst(0);
                    $parent->setIgstPercent(0);
                }
            }

            return;
        }

        $item->setGst($gst);
        $item->setHsn($hsn);

        if ($this->gstType == 'inter') {
            $item->setSgst(0);
            $item->setSgstPercent(0);

            $item->setCgst(0);
            $item->setCgstPercent(0);

            $item->setIgst($gst);
            $item->setIgstPercent($taxPercent);
            $this->igst = $gst;
        } else {
            if ($this->utGstToken==1) {
                $item->setSgst(0);
                $item->setSgstPercent(0);
                $item->setCgst($gst/2);
                $item->setCgstPercent($taxPercent/2);
                $this->cgst = $gst/2;
                $item->setIgst(0);
                $item->setIgstPercent(0);
                $item->setUtgst($gst/2);
                $item->setUtgstPercent($taxPercent/2);
                $this->utgst = $gst/2;
            } else {
                $item->setSgst($gst/2);
                $item->setSgstPercent($taxPercent/2);
                $this->sgst = $gst/2;
                $item->setCgst($gst/2);
                $item->setCgstPercent($taxPercent/2);
                $this->cgst = $gst/2;
                $item->setIgst(0);
                $item->setIgstPercent(0);
            }
        }
    }
    /**
     * Update Item tax info
     *
     * @param   \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @param   int $gst
     * @return  void|$this
     */
    public function updateItemTaxInfo($item, $gst)
    {
        $itemPrice = $item->getPrice();
        $baseitemPrice = $item->getBasePrice();
        $productId = $item->getProductId();
        if (!empty($productId)) {
            $product = $this->mpGstHelper->getProductById($productId);
            if ($product->getTaxClassId() != 2) {
                return;
            }
            $taxPercent = $product->getGstPercent();
            $hsn = $product->getHsnCode();
            if (!empty($product->getGstMinPrice())
                && !empty($product->getGstPercentMax())
                && $itemPrice <= $product->getGstMinPrice()
            ) {
                $taxPercent = $product->getGstPercentMax();
            }
        }
        $basegst = (($baseitemPrice*$item->getQty())*$taxPercent)/100;
        if ($this->taxHelper->priceIncludesTax()) {
            //The price should be base price
            $item->setPrice(($itemPrice - ($gst/$item->getQty())));

            $item->setConvertedPrice(($itemPrice - ($gst/$item->getQty())));
            $item->setPriceInclTax($itemPrice);
            $item->setRowTotal(($itemPrice*$item->getQty() - $gst));
            $item->setRowTotalInclTax(($itemPrice*$item->getQty()));

            $item->setBasePrice($baseitemPrice - ($basegst/$item->getQty()));
            $item->setBasePriceInclTax($baseitemPrice);
            $item->setBaseRowTotal(($baseitemPrice*$item->getQty()) - $basegst);
            $item->setBaseRowTotalInclTax(($baseitemPrice*$item->getQty()));
        } else {
            //The price should be base price
            $item->setPrice($itemPrice);

            $item->setConvertedPrice($itemPrice);
            $item->setPriceInclTax($itemPrice + $gst);
            $item->setRowTotal(($itemPrice*$item->getQty()));
            $item->setRowTotalInclTax(($itemPrice*$item->getQty()) + $gst);

            $item->setBasePrice($baseitemPrice);
            $item->setBasePriceInclTax($baseitemPrice + $basegst);
            $item->setBaseRowTotal(($baseitemPrice*$item->getQty()));
            $item->setBaseRowTotalInclTax(($baseitemPrice*$item->getQty()) + $basegst);
        }

        return $this;
    }
    /**
     * Process product item
     *
     * @param ShippingAssignmentInterface $shippingAssignment
     * @param array $itemTaxDetails
     * @param QuoteAddress\Total $total
     * @return void
     */
    protected function processProductItems(
        ShippingAssignmentInterface $shippingAssignment,
        array $itemTaxDetails,
        QuoteAddress\Total $total
    ) {
        $store = $shippingAssignment->getShipping()->getAddress()->getQuote()->getStore();

        /** @var AbstractItem[] $keyedAddressItems */
        $keyedAddressItems = [];
        foreach ($shippingAssignment->getItems() as $addressItem) {
            $keyedAddressItems[$addressItem->getTaxCalculationItemId()] = $addressItem;
        }

        $subtotal = $baseSubtotal = 0;
        $discountTaxCompensation = $baseDiscountTaxCompensation = 0;
        $tax = $baseTax = 0;
        $subtotalInclTax = $baseSubtotalInclTax = 0;

        foreach ($itemTaxDetails as $code => $itemTaxDetail) {
            /** @var TaxDetailsItemInterface $taxDetailUpdated */
            $taxDetailUpdated = $itemTaxDetail[self::KEY_ITEM];
            /** @var TaxDetailsItemInterface $baseTaxDetail */
            $baseTaxDetail = $itemTaxDetail[self::KEY_BASE_ITEM];
            $quoteItem = $keyedAddressItems[$code];
            $this->updateItemTaxInfo($quoteItem, $taxDetailUpdated, $baseTaxDetail, $store);

            //Update aggregated values
            if ($quoteItem->getHasChildren() && $quoteItem->isChildrenCalculated()) {
                //avoid double counting
                continue;
            }
            $subtotal += $taxDetailUpdated->getRowTotal();
            $baseSubtotal += $baseTaxDetail->getRowTotal();
            $discountTaxCompensation += $taxDetailUpdated->getDiscountTaxCompensationAmount();
            $baseDiscountTaxCompensation += $baseTaxDetail->getDiscountTaxCompensationAmount();
            $tax += $taxDetailUpdated->getRowTax();
            $baseTax += $baseTaxDetail->getRowTax();
            $subtotalInclTax += $taxDetailUpdated->getRowTotalInclTax();
            $baseSubtotalInclTax += $baseTaxDetail->getRowTotalInclTax();
        }

        //Set aggregated values
        /*$total->setTotalAmount('subtotal', $subtotal);
        $total->setBaseTotalAmount('subtotal', $baseSubtotal);
        $total->setTotalAmount('tax', $tax);
        $total->setBaseTotalAmount('tax', $baseTax);
        $total->setTotalAmount('discount_tax_compensation', $discountTaxCompensation);
        $total->setBaseTotalAmount('discount_tax_compensation', $baseDiscountTaxCompensation);

        $total->setSubtotalInclTax($subtotalInclTax);
        $total->setBaseSubtotalTotalInclTax($baseSubtotalInclTax);
        $total->setBaseSubtotalInclTax($baseSubtotalInclTax);
        $addressUpdated = $shippingAssignment->getShipping()->getAddress();
        $addressUpdated->setBaseTaxAmount($baseTax);
        $addressUpdated->setBaseSubtotalTotalInclTax($baseSubtotalInclTax);
        $addressUpdated->setSubtotal($total->getSubtotal());
        $addressUpdated->setBaseSubtotal($total->getBaseSubtotal());*/
        return $this;
    }

    /**
     * Reset information about Tax and Wee on FPT for shopping cart item
     *
     * @param   \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @return  void
     */
    protected function resetItemData($item)
    {
        $item->setSgst(0);
        $item->setSgstPercent(0);

        $item->setCgst(0);
        $item->setCgstPercent(0);

        $item->setIgst(0);
        $item->setIgstPercent(0);

        $item->setUtgst(0);
        $item->setUtgstPercent(0);

        $item->setGst(0);
        $item->setHsn('');
    }
    /**
     * Reset values
     *
     * @param   Address\Total $total
     * @return  void
     */
    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array|null
     */
    /**
     * Assign subtotal amount and label to address object
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array
     */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $countryId = $quote->getShippingAddress()->getCountryId();
        if (!$countryId) {
            $countryId = $quote->getBillingAddress()->getCountryId();
        }
        if ($countryId != 'IN') {
            return null;
        }
        $items = isset($total['address_quote_items']) ? $total['address_quote_items'] : [];
        $this->totalGst = 0;
        $this->sgst = 0;
        $this->cgst = 0;
        $this->igst = 0;
        $this->utgst = 0;
        foreach ($items as $item) {
            $this->totalGst += $item->getGst();
            $this->sgst += $item->getSgst();
            $this->cgst += $item->getCgst();
            $this->igst += $item->getIgst();
            $this->utgst += $item->getUtgst();
        }
        if (!$this->totalGst) {
            return null;
        }
        $gstText = __('GST');
        if ($this->_showInclExcl == 1) {
            if ($this->_exclusiveGst) {
                $gstText = __('Excl. GST');
            } else {
                $gstText = __('Incl. GST');
            }
        }

        return [
            [
                'code' => self::ITEM_TYPE,
                'title' => $gstText,
                'value' => $this->priceCurrency->round(
                    $this->totalGst
                )
            ],
            [
                'code' => 'sgst',
                'title' => __('SGST'),
                'value' => $this->priceCurrency->round(
                    $this->sgst,
                    $this->_store
                )
            ],
            [
                'code' => 'cgst',
                'title' => __('CGST'),
                'value' => $this->priceCurrency->round(
                    $this->cgst
                )
            ],
            [
                'code' => 'igst',
                'title' => __('IGST'),
                'value' => $this->priceCurrency->round(
                    $this->igst
                )
            ],
            [
                'code' => 'utgst',
                'title' => __('UTGST'),
                'value' => $this->priceCurrency->round(
                    $this->utgst
                )
            ],
        ];
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('GST');
    }
}
