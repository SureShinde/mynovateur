<?php
namespace Magento\GiftRegistry\Helper\Data;

/**
 * Interceptor class for @see \Magento\GiftRegistry\Helper\Data
 */
class Interceptor extends \Magento\GiftRegistry\Helper\Data implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Magento\Customer\Model\Session $customerSession, \Magento\GiftRegistry\Model\EntityFactory $entityFactory, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Framework\Escaper $escaper, \Magento\Framework\Locale\ResolverInterface $localeResolver, \Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->___init();
        parent::__construct($context, $customerSession, $entityFactory, $localeDate, $escaper, $localeResolver, $storeManager);
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isEnabled');
        return $pluginInfo ? $this->___callPlugins('isEnabled', func_get_args(), $pluginInfo) : parent::isEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getRecipientsLimit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRecipientsLimit');
        return $pluginInfo ? $this->___callPlugins('getRecipientsLimit', func_get_args(), $pluginInfo) : parent::getRecipientsLimit();
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressIdPrefix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAddressIdPrefix');
        return $pluginInfo ? $this->___callPlugins('getAddressIdPrefix', func_get_args(), $pluginInfo) : parent::getAddressIdPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxRegistrant($store = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMaxRegistrant');
        return $pluginInfo ? $this->___callPlugins('getMaxRegistrant', func_get_args(), $pluginInfo) : parent::getMaxRegistrant($store);
    }

    /**
     * {@inheritdoc}
     */
    public function validateCustomAttributes($customValues, $attributes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validateCustomAttributes');
        return $pluginInfo ? $this->___callPlugins('validateCustomAttributes', func_get_args(), $pluginInfo) : parent::validateCustomAttributes($customValues, $attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentCustomerEntityOptions()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurrentCustomerEntityOptions');
        return $pluginInfo ? $this->___callPlugins('getCurrentCustomerEntityOptions', func_get_args(), $pluginInfo) : parent::getCurrentCustomerEntityOptions();
    }

    /**
     * {@inheritdoc}
     */
    public function filterDatesByFormat($data, $fieldDateFormats)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'filterDatesByFormat');
        return $pluginInfo ? $this->___callPlugins('filterDatesByFormat', func_get_args(), $pluginInfo) : parent::filterDatesByFormat($data, $fieldDateFormats);
    }

    /**
     * {@inheritdoc}
     */
    public function _filterDate($value, $formatIn = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, '_filterDate');
        return $pluginInfo ? $this->___callPlugins('_filterDate', func_get_args(), $pluginInfo) : parent::_filterDate($value, $formatIn);
    }

    /**
     * {@inheritdoc}
     */
    public function getRegistryLink($entity)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRegistryLink');
        return $pluginInfo ? $this->___callPlugins('getRegistryLink', func_get_args(), $pluginInfo) : parent::getRegistryLink($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function canAddToGiftRegistry($item)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canAddToGiftRegistry');
        return $pluginInfo ? $this->___callPlugins('canAddToGiftRegistry', func_get_args(), $pluginInfo) : parent::canAddToGiftRegistry($item);
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isModuleOutputEnabled');
        return $pluginInfo ? $this->___callPlugins('isModuleOutputEnabled', func_get_args(), $pluginInfo) : parent::isModuleOutputEnabled($moduleName);
    }
}
