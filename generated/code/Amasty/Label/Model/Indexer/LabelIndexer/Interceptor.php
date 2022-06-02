<?php
namespace Amasty\Label\Model\Indexer\LabelIndexer;

/**
 * Interceptor class for @see \Amasty\Label\Model\Indexer\LabelIndexer
 */
class Interceptor extends \Amasty\Label\Model\Indexer\LabelIndexer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Amasty\Label\Model\Indexer\IndexBuilder $indexBuilder, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\App\CacheInterface $cacheManager, \Magento\Framework\Indexer\IndexerRegistry $indexerRegistry, \Amasty\Label\Model\Indexer\LabelIndexerRegistry $labelIndexerRegistry)
    {
        $this->___init();
        parent::__construct($indexBuilder, $eventManager, $cacheManager, $indexerRegistry, $labelIndexerRegistry);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($ids)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function executeFull()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeFull');
        return $pluginInfo ? $this->___callPlugins('executeFull', func_get_args(), $pluginInfo) : parent::executeFull();
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentities()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIdentities');
        return $pluginInfo ? $this->___callPlugins('getIdentities', func_get_args(), $pluginInfo) : parent::getIdentities();
    }

    /**
     * {@inheritdoc}
     */
    public function executeList(array $ids)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeList');
        return $pluginInfo ? $this->___callPlugins('executeList', func_get_args(), $pluginInfo) : parent::executeList($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function executeRow($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeRow');
        return $pluginInfo ? $this->___callPlugins('executeRow', func_get_args(), $pluginInfo) : parent::executeRow($id);
    }

    /**
     * {@inheritdoc}
     */
    public function doExecuteFull()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'doExecuteFull');
        return $pluginInfo ? $this->___callPlugins('doExecuteFull', func_get_args(), $pluginInfo) : parent::doExecuteFull();
    }

    /**
     * {@inheritdoc}
     */
    public function executeByLabelId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeByLabelId');
        return $pluginInfo ? $this->___callPlugins('executeByLabelId', func_get_args(), $pluginInfo) : parent::executeByLabelId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function executeByLabelIds($ids)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'executeByLabelIds');
        return $pluginInfo ? $this->___callPlugins('executeByLabelIds', func_get_args(), $pluginInfo) : parent::executeByLabelIds($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function invalidateIndex()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'invalidateIndex');
        return $pluginInfo ? $this->___callPlugins('invalidateIndex', func_get_args(), $pluginInfo) : parent::invalidateIndex();
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexer()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexer');
        return $pluginInfo ? $this->___callPlugins('getIndexer', func_get_args(), $pluginInfo) : parent::getIndexer();
    }

    /**
     * {@inheritdoc}
     */
    public function reindexRow($id, $forceReindex = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'reindexRow');
        return $pluginInfo ? $this->___callPlugins('reindexRow', func_get_args(), $pluginInfo) : parent::reindexRow($id, $forceReindex);
    }

    /**
     * {@inheritdoc}
     */
    public function reindexList($ids, $forceReindex = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'reindexList');
        return $pluginInfo ? $this->___callPlugins('reindexList', func_get_args(), $pluginInfo) : parent::reindexList($ids, $forceReindex);
    }

    /**
     * {@inheritdoc}
     */
    public function reindexAll()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'reindexAll');
        return $pluginInfo ? $this->___callPlugins('reindexAll', func_get_args(), $pluginInfo) : parent::reindexAll();
    }

    /**
     * {@inheritdoc}
     */
    public function markIndexerAsInvalid()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'markIndexerAsInvalid');
        return $pluginInfo ? $this->___callPlugins('markIndexerAsInvalid', func_get_args(), $pluginInfo) : parent::markIndexerAsInvalid();
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexerId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexerId');
        return $pluginInfo ? $this->___callPlugins('getIndexerId', func_get_args(), $pluginInfo) : parent::getIndexerId();
    }

    /**
     * {@inheritdoc}
     */
    public function isIndexerScheduled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isIndexerScheduled');
        return $pluginInfo ? $this->___callPlugins('isIndexerScheduled', func_get_args(), $pluginInfo) : parent::isIndexerScheduled();
    }
}
