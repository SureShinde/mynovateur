<?php
namespace Magento\Msrp\Pricing\Price\MsrpPrice;

/**
 * Interceptor class for @see \Magento\Msrp\Pricing\Price\MsrpPrice
 */
class Interceptor extends \Magento\Msrp\Pricing\Price\MsrpPrice implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Model\Product $saleableItem, $quantity, \Magento\Framework\Pricing\Adjustment\CalculatorInterface $calculator, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\Msrp\Helper\Data $msrpData, \Magento\Msrp\Model\Config $config)
    {
        $this->___init();
        parent::__construct($saleableItem, $quantity, $calculator, $priceCurrency, $msrpData, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function isShowPriceOnGesture()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isShowPriceOnGesture');
        return $pluginInfo ? $this->___callPlugins('isShowPriceOnGesture', func_get_args(), $pluginInfo) : parent::isShowPriceOnGesture();
    }

    /**
     * {@inheritdoc}
     */
    public function getMsrpPriceMessage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMsrpPriceMessage');
        return $pluginInfo ? $this->___callPlugins('getMsrpPriceMessage', func_get_args(), $pluginInfo) : parent::getMsrpPriceMessage();
    }

    /**
     * {@inheritdoc}
     */
    public function isMsrpEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isMsrpEnabled');
        return $pluginInfo ? $this->___callPlugins('isMsrpEnabled', func_get_args(), $pluginInfo) : parent::isMsrpEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function canApplyMsrp(\Magento\Catalog\Model\Product $product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canApplyMsrp');
        return $pluginInfo ? $this->___callPlugins('canApplyMsrp', func_get_args(), $pluginInfo) : parent::canApplyMsrp($product);
    }

    /**
     * {@inheritdoc}
     */
    public function isMinimalPriceLessMsrp(\Magento\Catalog\Model\Product $product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isMinimalPriceLessMsrp');
        return $pluginInfo ? $this->___callPlugins('isMinimalPriceLessMsrp', func_get_args(), $pluginInfo) : parent::isMinimalPriceLessMsrp($product);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValue');
        return $pluginInfo ? $this->___callPlugins('getValue', func_get_args(), $pluginInfo) : parent::getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function getMinimalPrice()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMinimalPrice');
        return $pluginInfo ? $this->___callPlugins('getMinimalPrice', func_get_args(), $pluginInfo) : parent::getMinimalPrice();
    }

    /**
     * {@inheritdoc}
     */
    public function getMaximalPrice()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMaximalPrice');
        return $pluginInfo ? $this->___callPlugins('getMaximalPrice', func_get_args(), $pluginInfo) : parent::getMaximalPrice();
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAmount');
        return $pluginInfo ? $this->___callPlugins('getAmount', func_get_args(), $pluginInfo) : parent::getAmount();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomAmount($amount = null, $exclude = null, $context = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomAmount');
        return $pluginInfo ? $this->___callPlugins('getCustomAmount', func_get_args(), $pluginInfo) : parent::getCustomAmount($amount, $exclude, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getPriceCode()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPriceCode');
        return $pluginInfo ? $this->___callPlugins('getPriceCode', func_get_args(), $pluginInfo) : parent::getPriceCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getProduct()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProduct');
        return $pluginInfo ? $this->___callPlugins('getProduct', func_get_args(), $pluginInfo) : parent::getProduct();
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getQuantity');
        return $pluginInfo ? $this->___callPlugins('getQuantity', func_get_args(), $pluginInfo) : parent::getQuantity();
    }
}
