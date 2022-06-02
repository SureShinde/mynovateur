<?php
namespace Magento\Framework\Setup\Declaration\Schema\Diff\Diff;

/**
 * Interceptor class for @see \Magento\Framework\Setup\Declaration\Schema\Diff\Diff
 */
class Interceptor extends \Magento\Framework\Setup\Declaration\Schema\Diff\Diff implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Component\ComponentRegistrar $componentRegistrar, \Magento\Framework\Setup\Declaration\Schema\ElementHistoryFactory $elementHistoryFactory, array $tableIndexes, array $destructiveOperations)
    {
        $this->___init();
        parent::__construct($componentRegistrar, $elementHistoryFactory, $tableIndexes, $destructiveOperations);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAll');
        return $pluginInfo ? $this->___callPlugins('getAll', func_get_args(), $pluginInfo) : parent::getAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getChange($table, $operation)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChange');
        return $pluginInfo ? $this->___callPlugins('getChange', func_get_args(), $pluginInfo) : parent::getChange($table, $operation);
    }

    /**
     * {@inheritdoc}
     */
    public function canBeRegistered(\Magento\Framework\Setup\Declaration\Schema\Dto\ElementInterface $object, $operation) : bool
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canBeRegistered');
        return $pluginInfo ? $this->___callPlugins('canBeRegistered', func_get_args(), $pluginInfo) : parent::canBeRegistered($object, $operation);
    }

    /**
     * {@inheritdoc}
     */
    public function register(\Magento\Framework\Setup\Declaration\Schema\Dto\ElementInterface $dtoObject, $operation, ?\Magento\Framework\Setup\Declaration\Schema\Dto\ElementInterface $oldDtoObject = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'register');
        return $pluginInfo ? $this->___callPlugins('register', func_get_args(), $pluginInfo) : parent::register($dtoObject, $operation, $oldDtoObject);
    }
}
