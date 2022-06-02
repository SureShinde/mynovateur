<?php
namespace Redstage\CustomCreditmemo\Block\Adminhtml\Order\Creditmemo\Create;

use Magento\Sales\Model\Order;
use Zend_Currency;
class Reference extends \Magento\Sales\Block\Adminhtml\Items\AbstractItems
{
    /**
     * Source object
     *
     * @var \Magento\Framework\DataObject
     */
    protected $_source;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
     * @param \Magento\CatalogInventory\Api\StockConfigurationInterface $stockConfiguration
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Data $salesData
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\CatalogInventory\Api\StockConfigurationInterface $stockConfiguration,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Data $salesData,
        array $data = []
    ) {
        $this->_salesData = $salesData;
        parent::__construct($context, $stockRegistry, $stockConfiguration, $registry, $data);
    }

    
    /**
     * Get source object
     *
     * @return \Magento\Framework\DataObject
     */
    public function getSource()
    {
        return $this->_source;
    }

    /**
     * Get credit memo shipping amount depend on configuration settings
     *
     * @return float
     */
    
    public function getPaymentReferenceLabel()
    {
        $label = __('Payment Reference Id');
        return $label;
    }

    public function getPaymentReference()
    {        
        return $this->getCreditmemo()->getPayReferenceId();
    }

    /**
     * Retrieve credit memo model instance
     *
     * @return \Magento\Sales\Model\Order\Creditmemo
     */
    public function getCreditmemo()
    {
        return $this->_coreRegistry->registry('current_creditmemo');
    }
}
