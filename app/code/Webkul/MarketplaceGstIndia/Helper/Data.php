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
namespace Webkul\MarketplaceGstIndia\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Tax\Helper\Data as TaxHelper;
use Webkul\MarketplaceGstIndia\Model\Config\Source\PriceType;

/**
 * Class Data Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper implements ArgumentInterface
{
    public const GSTAPPLYDATE = "2017-06-30 11:59:59";

    /**
     * @var $_scopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var OrderRepositoryInterface
     */
    protected $_orderRepository;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;

    /**
     * @var \Magento\Quote\Model\Quote\ItemFactory
     */
    protected $quoteItemFactory;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @param Context $context
     * @param TaxHelper $taxHelper
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Quote\Model\Quote\ItemFactory $quoteItemFactory
     * @param \Magento\Catalog\Helper\Data $catalogHelper
     * @param \Webkul\Marketplace\Helper\Data $mpHelper
     * @param \Webkul\Marketplace\Helper\Orders $moOrderHelper
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        Context $context,
        TaxHelper $taxHelper,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Model\Quote\ItemFactory $quoteItemFactory,
        \Magento\Catalog\Helper\Data $catalogHelper,
        \Webkul\Marketplace\Helper\Data $mpHelper,
        \Webkul\Marketplace\Helper\Orders $moOrderHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    ) {
        parent::__construct($context);
        $this->taxHelper = $taxHelper;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $context->getScopeConfig();
        $this->productRepository = $productRepository;
        $this->_orderRepository = $orderRepository;
        $this->_checkoutSession = $checkoutSession;
        $this->quoteItemFactory = $quoteItemFactory;
        $this->catalogHelper = $catalogHelper;
        $this->mpHelper = $mpHelper;
        $this->moOrderHelper = $moOrderHelper;
        $this->customerRepository = $customerRepository;
    }

    /**
     * This function will return Store config value
     *
     * @param string $field
     * @param string|null $path
     * @return string|null
     */
    public function getConfigValue($field, $path = null)
    {
        $path = (empty($path)) ? 'mpgst/general_settings/' : $path;
        if ($field) {
            return $this->scopeConfig->getValue($path.$field, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        }
    }
    /**
     * Get status
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->getConfigValue('status');
    }

    /**
     * Get Product by Id
     *
     * @param int $productId
     * @return $Product
     */
    public function getProductById($productId)
    {
        $productData = $this->productRepository->getById($productId);
        return $productData;
    }

    /**
     * Get Tax Helper
     *
     * @return void
     */
    public function getTaxHelper()
    {
        return $this->taxHelper;
    }

    /**
     * Get Mp Order Helper
     *
     * @return object
     */
    public function getMpOrderHelper()
    {
        return $this->moOrderHelper;
    }

    /**
     * Get Order By Id
     *
     * @param int $orderId
     * @return $order
     */
    public function getOrderById($orderId)
    {
        $order = $this->_orderRepository->get($orderId);
        return $order;
    }

    /**
     * This function will return Tax configuration values
     *
     * @param int $id
     * @return boolean|int|string
     */
    public function getTaxConfigurationValues($id)
    {
        return $this->scopeConfig->getValue($id, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get checkout session
     *
     * @return object
     */
    public function getCheckoutSession()
    {
        return $this->_checkoutSession;
    }

    /**
     * Get Quote Item By Id
     *
     * @param id $itemId
     * @return object
     */
    public function getQuoteItemById($itemId)
    {
        $quoteItem = $this->quoteItemFactory->create()->load($itemId);
        return $quoteItem;
    }

    /**
     * Get Customer By Id
     *
     * @param id $customerId
     * @return object
     */
    public function getCustomerById($customerId)
    {
        $customer = $this->customerRepository->getById($customerId);
        return $customer;
    }

    /**
     * Get Country From Order
     *
     * @param object $order
     * @return string
     */
    public function getCountryFromOrder($order)
    {
        $countryId = "";
        if ($order && $order->getShippingAddress() && $order->getShippingAddress()->getData('country_id') != '') {
            $countryId = $order->getShippingAddress()->getData('country_id');
        } elseif ($order && $order->getBillingAddress() && $order->getBillingAddress()->getData('country_id') != '') {
            $countryId = $order->getBillingAddress()->getData('country_id');
        }

        return $countryId;
    }

    /**
     * Get Catalog Helper
     *
     * @return object
     */
    public function getCatalogHelper()
    {
        return $this->catalogHelper;
    }

    /**
     * Array Merge
     *
     * @param array $firstArray
     * @param array $secondArray
     * @return array
     */
    public function arrayMerge($firstArray, $secondArray)
    {
        return array_merge($firstArray, $secondArray);
    }

    /**
     * Get Quote Item Object
     *
     * @return object
     */
    public function getQuoteItemObject()
    {
        return $this->quoteItemFactory->create();
    }

    /**
     * Get Quote Item Object
     *
     * @param object $items
     * @return object
     */
    public function getTotalGst($items)
    {
        $gstAmount = 0;
        foreach ($items as $item) {
            $orderItem = $item->getOrderItem();
            $orderItemQty = $orderItem->getQtyOrdered();
            if (!$orderItemQty || $orderItem->isDummy() || $item->getQty() < 0) {
                continue;
            }
            $ratio = $item->getQty() / $orderItemQty;
            $orderItemGstAmount = $orderItem->getGst();
            $gstAmount += $orderItemGstAmount * $ratio;
        }

        return $gstAmount;
    }

    /**
     * Get Marketplace Helper
     *
     * @return object
     */
    public function getMpHelper()
    {
        return $this->mpHelper;
    }

    /**
     * Get Credit Memo Info
     *
     * @param object $creditmemoCollection
     * @param object $invoice
     * @return array
     */
    public function getCreditMemoInfo($creditmemoCollection, $invoice)
    {
        $creditmemoTotalAmount = 0;
        $creditmemoSubtotal = 0;
        $creditmemoShippingAmount = 0;
        $creditmemoDiscountAmount = 0;
        $creditmemoTaxAmount = 0;

        $creditmemoBaseTotalAmount = 0;
        $creditmemoBaseSubtotal = 0;
        $creditmemoBaseShippingAmount = 0;
        $creditmemoBaseDiscountAmount = 0;
        $creditmemoBaseTaxAmount = 0;

        $gst = 0;

        foreach ($invoice->getAllItems() as $item) {
            $gst += $item->getGst();
        }
        if ($this->getConfigValue('status')) {
            $invoice->setBaseTaxAmount($gst);
            $invoice->setTaxAmount($gst);
        }

        foreach ($creditmemoCollection as $creditmemo) {
            $creditmemoTotalAmount = $creditmemoTotalAmount + $creditmemo['grand_total'];
            $creditmemoSubtotal = $creditmemoSubtotal + $creditmemo['subtotal'];
            $creditmemoShippingAmount = $creditmemoShippingAmount + $creditmemo['shipping_amount'];
            $creditmemoDiscountAmount = $creditmemoDiscountAmount + $creditmemo['discount_amount'];
            $creditmemoTaxAmount = $creditmemoTaxAmount + $creditmemo['tax_amount'];
            // Calculate Base Amounts
            $creditmemoBaseTotalAmount = $creditmemoBaseTotalAmount + $creditmemo['base_grand_total'];
            $creditmemoBaseSubtotal = $creditmemoBaseSubtotal + $creditmemo['base_subtotal'];
            $creditmemoBaseShippingAmount = $creditmemoBaseShippingAmount + $creditmemo['base_shipping_amount'];
            $creditmemoBaseDiscountAmount = $creditmemoBaseDiscountAmount + $creditmemo['base_discount_amount'];
            $creditmemoBaseTaxAmount = $creditmemoBaseTaxAmount + $creditmemo['base_tax_amount'];
        }
        $invoicePaidAmount = $invoice->getGrandTotal();
        $invoiceSubtotal = $invoice->getSubtotal();
        $invoiceShippingAmount = $invoice->getShippingAmount();
        $invoiceDiscountAmount = $invoice->getDiscountAmount();
        $invoiceTaxAmount = $invoice->getTaxAmount();
        // Calculate Base Amounts
        $invoiceBaseGrandTotal = $invoice->getBaseGrandTotal();
        $invoiceBaseSubtotal = $invoice->getBaseSubtotal();
        $invoiceBaseShippingAmount = $invoice->getBaseShippingAmount();
        $invoiceBaseDiscountAmount = $invoice->getBaseDiscountAmount();
        $invoiceBaseTaxAmount = $invoice->getBaseTaxAmount();
        $subtotal = $invoiceBaseSubtotal - $creditmemoBaseSubtotal;
        $totalCouponAmount = $invoiceBaseDiscountAmount + $creditmemoBaseDiscountAmount;
        $totalShippingAmount = $invoiceBaseShippingAmount - $creditmemoBaseShippingAmount;
        $totalTaxAmount = $invoiceBaseTaxAmount - $creditmemoBaseTaxAmount;
        $grandTotal = $invoiceBaseGrandTotal - $creditmemoBaseTotalAmount;

        return [
            'invoiceBaseGrandTotal' => $invoiceBaseGrandTotal,
            'invoicePaidAmount' => $invoicePaidAmount,
            'creditmemoTotalAmount' => $creditmemoTotalAmount,
            'invoiceShippingAmount' => $invoiceShippingAmount,
            'creditmemoShippingAmount' => $creditmemoShippingAmount,
            'invoicePaidAmount' => $invoicePaidAmount,
            'subtotal' => $subtotal,
            'totalCouponAmount' => $totalCouponAmount,
            'totalTaxAmount' => $totalTaxAmount,
            'totalShippingAmount' => $totalShippingAmount,
            'grandTotal' => $grandTotal

        ];
    }
    /**
     * Get gst
     *
     * @param int $item
     * @param object $itemtaxDetails
     * @return int
     */
    public function calculateGst($item, $itemtaxDetails)
    {
        $taxPercent = 0;
        $hsn = null;

        $itemPrice = $itemtaxDetails->getOriginalPrice();
        $gst = 0;

        if ($itemtaxDetails->getHasChildren()) {
            foreach ($itemtaxDetails->getChildren() as $child) {
                if ($itemtaxDetails->getProductType() == 'configurable') {
                    $itemtaxDetails = $item->getOriginalPrice();
                } else {
                    $itemtaxDetails = $child->getOriginalPrice();
                }
                $productId = $child->getProductId();
                if (!empty($productId)) {
                    $product = $this->getProductById($productId);
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
                $gst += (($itemPrice*$child->getQty()* $itemtaxDetails->getQty())*$taxPercent)/100;

            }
        } else {
            $productId = $itemtaxDetails->getProductId();
            if (!empty($productId)) {
                $product = $this->getProductById($productId);
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
            $gst = (($itemPrice*$itemtaxDetails->getQty())*$taxPercent)/100;
        }
        return $gst;
    }
    /**
     * The price should be base price
     *
     * @param object $item
     * @param object $itemTaxDetails
     * @param object $gst
     * @return bool
     */
    public function updateItemTaxInfo($item, $itemTaxDetails, $gst)
    {
        $itemPrice = $itemTaxDetails->getOriginalPrice();
        if ($this->taxHelper->priceIncludesTax()) {
            //The price should be base price
            $item->setPrice(($itemPrice - ($gst/$item->getQty())));
            // $item->setCalculationPrice($itemPrice -($gst/$item->getQty()))  ;
            $item->setConvertedPrice($itemPrice - ($gst/$item->getQty()));
            $item->setPriceInclTax($itemPrice);
            $item->setRowTotal(($itemPrice*$item->getQty() - $gst));
            $item->setRowTotalInclTax(($itemPrice*$item->getQty()));

            $item->setBasePrice($itemPrice - ($gst/$item->getQty()));
            $item->setBasePriceInclTax($itemPrice);
            $item->setBaseRowTotal(($itemPrice*$item->getQty()) - $gst);
            $item->setBaseRowTotalInclTax(($itemPrice*$item->getQty()));
        } else {
            //The price should be base price
            $item->setPrice($itemPrice);

            $item->setConvertedPrice($itemPrice);
            $item->setPriceInclTax($itemPrice + $gst);
            $item->setRowTotal(($itemPrice*$item->getQty()));
            $item->setRowTotalInclTax(($itemPrice*$item->getQty()) + $gst);

            $item->setBasePrice($itemPrice);
            $item->setBasePriceInclTax($itemPrice + $gst);
            $item->setBaseRowTotal(($itemPrice*$item->getQty()));
            $item->setBaseRowTotalInclTax(($itemPrice*$item->getQty()) + $gst);
        }

        return $this;
    }

    /**
     * Get base currency code
     *
     * @return bool
     */
    public function getBaseCurrencyCode()
    {
        return $this->storeManager->getStore()->getBaseCurrencyCode();
    }
    /**
     * Get current currency code
     *
     * @return bool
     */
    public function getCurrentCurrencyCode()
    {
        return $this->storeManager->getStore()->getCurrentCurrencyCode();
    }

    /**
     * Get gst
     *
     * @return bool
     */
    public function isGstExclude()
    {
        return ($this->getConfigValue('product_price_type') == PriceType::EXCLUDE_GST) ? true : false;
    }

    /**
     * Show Inclusive and Exclusive
     *
     * @return bool
     */
    public function showIncludeExclude()
    {
        return $this->getConfigValue('show_inclusive_exclusive');
    }
}
