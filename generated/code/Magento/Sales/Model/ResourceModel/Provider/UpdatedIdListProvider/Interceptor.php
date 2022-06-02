<?php
namespace Magento\Sales\Model\ResourceModel\Provider\UpdatedIdListProvider;

/**
 * Interceptor class for @see \Magento\Sales\Model\ResourceModel\Provider\UpdatedIdListProvider
 */
class Interceptor extends \Magento\Sales\Model\ResourceModel\Provider\UpdatedIdListProvider implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ResourceConnection $resourceConnection)
    {
        $this->___init();
        parent::__construct($resourceConnection);
    }

    /**
     * {@inheritdoc}
     */
    public function getIds($mainTableName, $gridTableName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIds');
        return $pluginInfo ? $this->___callPlugins('getIds', func_get_args(), $pluginInfo) : parent::getIds($mainTableName, $gridTableName);
    }
}
