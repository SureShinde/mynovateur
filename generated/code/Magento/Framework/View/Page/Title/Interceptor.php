<?php
namespace Magento\Framework\View\Page\Title;

/**
 * Interceptor class for @see \Magento\Framework\View\Page\Title
 */
class Interceptor extends \Magento\Framework\View\Page\Title implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->___init();
        parent::__construct($scopeConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function set($title)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'set');
        return $pluginInfo ? $this->___callPlugins('set', func_get_args(), $pluginInfo) : parent::set($title);
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'get');
        return $pluginInfo ? $this->___callPlugins('get', func_get_args(), $pluginInfo) : parent::get();
    }

    /**
     * {@inheritdoc}
     */
    public function getShort()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getShort');
        return $pluginInfo ? $this->___callPlugins('getShort', func_get_args(), $pluginInfo) : parent::getShort();
    }

    /**
     * {@inheritdoc}
     */
    public function getShortHeading()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getShortHeading');
        return $pluginInfo ? $this->___callPlugins('getShortHeading', func_get_args(), $pluginInfo) : parent::getShortHeading();
    }

    /**
     * {@inheritdoc}
     */
    public function getDefault()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefault');
        return $pluginInfo ? $this->___callPlugins('getDefault', func_get_args(), $pluginInfo) : parent::getDefault();
    }

    /**
     * {@inheritdoc}
     */
    public function append($suffix)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'append');
        return $pluginInfo ? $this->___callPlugins('append', func_get_args(), $pluginInfo) : parent::append($suffix);
    }

    /**
     * {@inheritdoc}
     */
    public function prepend($prefix)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepend');
        return $pluginInfo ? $this->___callPlugins('prepend', func_get_args(), $pluginInfo) : parent::prepend($prefix);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetValue()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetValue');
        return $pluginInfo ? $this->___callPlugins('unsetValue', func_get_args(), $pluginInfo) : parent::unsetValue();
    }
}
