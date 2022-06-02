<?php
namespace Redstage\BoqConfigurator\Controller\Product\RecommendedProduct;

/**
 * Interceptor class for @see \Redstage\BoqConfigurator\Controller\Product\RecommendedProduct
 */
class Interceptor extends \Redstage\BoqConfigurator\Controller\Product\RecommendedProduct implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Redstage\BoqConfigurator\Model\BoqGrouproomlinkFactory $productGroupsLinks, \Magento\Catalog\Model\ProductFactory $productFactory, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Api\ProductAttributeRepositoryInterface $productAttributeRepository, \Redstage\BoqConfigurator\Model\BoqProductgroup\Attribute\Source\Options $options, \Magento\Framework\Pricing\Helper\Data $pricingHelper)
    {
        $this->___init();
        parent::__construct($context, $productGroupsLinks, $productFactory, $productCollectionFactory, $productAttributeRepository, $options, $pricingHelper);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductGroupCollection($roomTypeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductGroupCollection');
        return $pluginInfo ? $this->___callPlugins('getProductGroupCollection', func_get_args(), $pluginInfo) : parent::getProductGroupCollection($roomTypeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencySymbol($price)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurrencySymbol');
        return $pluginInfo ? $this->___callPlugins('getCurrencySymbol', func_get_args(), $pluginInfo) : parent::getCurrencySymbol($price);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }

    /**
     * {@inheritdoc}
     */
    public function getActionFlag()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getActionFlag');
        return $pluginInfo ? $this->___callPlugins('getActionFlag', func_get_args(), $pluginInfo) : parent::getActionFlag();
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRequest');
        return $pluginInfo ? $this->___callPlugins('getRequest', func_get_args(), $pluginInfo) : parent::getRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getResponse');
        return $pluginInfo ? $this->___callPlugins('getResponse', func_get_args(), $pluginInfo) : parent::getResponse();
    }
}
