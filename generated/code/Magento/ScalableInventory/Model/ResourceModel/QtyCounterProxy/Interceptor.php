<?php
namespace Magento\ScalableInventory\Model\ResourceModel\QtyCounterProxy;

/**
 * Interceptor class for @see \Magento\ScalableInventory\Model\ResourceModel\QtyCounterProxy
 */
class Interceptor extends \Magento\ScalableInventory\Model\ResourceModel\QtyCounterProxy implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\ScalableInventory\Model\ResourceModel\QtyCounter $qtyCounter, \Magento\CatalogInventory\Model\ResourceModel\Stock $stockResource, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry)
    {
        $this->___init();
        parent::__construct($qtyCounter, $stockResource, $scopeConfig, $stockRegistry);
    }

    /**
     * {@inheritdoc}
     */
    public function correctItemsQty(array $items, $websiteId, $operator)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'correctItemsQty');
        return $pluginInfo ? $this->___callPlugins('correctItemsQty', func_get_args(), $pluginInfo) : parent::correctItemsQty($items, $websiteId, $operator);
    }
}
