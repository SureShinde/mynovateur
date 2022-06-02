<?php
namespace Magento\Setup\Model\DeclarationInstaller;

/**
 * Interceptor class for @see \Magento\Setup\Model\DeclarationInstaller
 */
class Interceptor extends \Magento\Setup\Model\DeclarationInstaller implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Setup\Declaration\Schema\SchemaConfigInterface $schemaConfig, \Magento\Framework\Setup\Declaration\Schema\Diff\SchemaDiff $schemaDiff, \Magento\Framework\Setup\Declaration\Schema\OperationsExecutor $operationsExecutor)
    {
        $this->___init();
        parent::__construct($schemaConfig, $schemaDiff, $operationsExecutor);
    }

    /**
     * {@inheritdoc}
     */
    public function installSchema(array $requestData)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'installSchema');
        return $pluginInfo ? $this->___callPlugins('installSchema', func_get_args(), $pluginInfo) : parent::installSchema($requestData);
    }
}
