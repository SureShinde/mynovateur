<?php
namespace Magento\Catalog\Pricing\Price\FinalPrice;

/**
 * Interceptor class for @see \Magento\Catalog\Pricing\Price\FinalPrice
 */
class Interceptor extends \Magento\Catalog\Pricing\Price\FinalPrice implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Pricing\SaleableInterface $saleableItem, $quantity, \Magento\Framework\Pricing\Adjustment\CalculatorInterface $calculator, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency)
    {
        $this->___init();
        parent::__construct($saleableItem, $quantity, $calculator, $priceCurrency);
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
