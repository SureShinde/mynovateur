<?php
namespace Magento\CustomerSegment\Model\ResourceModel\Segment;

/**
 * Interceptor class for @see \Magento\CustomerSegment\Model\ResourceModel\Segment
 */
class Interceptor extends \Magento\CustomerSegment\Model\ResourceModel\Segment implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Magento\CustomerSegment\Model\ResourceModel\Helper $resourceHelper, \Magento\Customer\Model\Config\Share $configShare, \Magento\Framework\Stdlib\DateTime $dateTime, \Magento\Quote\Model\ResourceModel\Quote $resourceQuote, \Magento\Quote\Model\QueryResolver $queryResolver, $connectionName = null, ?\Magento\CustomerSegment\Model\ResourceModel\Customer\LinksMatcher $customerLinksMatcher = null)
    {
        $this->___init();
        parent::__construct($context, $resourceHelper, $configShare, $dateTime, $resourceQuote, $queryResolver, $connectionName, $customerLinksMatcher);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteSegmentCustomers($segment)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'deleteSegmentCustomers');
        return $pluginInfo ? $this->___callPlugins('deleteSegmentCustomers', func_get_args(), $pluginInfo) : parent::deleteSegmentCustomers($segment);
    }

    /**
     * {@inheritdoc}
     */
    public function saveCustomersFromSelect($segment, $select)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveCustomersFromSelect');
        return $pluginInfo ? $this->___callPlugins('saveCustomersFromSelect', func_get_args(), $pluginInfo) : parent::saveCustomersFromSelect($segment, $select);
    }

    /**
     * {@inheritdoc}
     */
    public function getSegmentCustomersQty($segmentId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSegmentCustomersQty');
        return $pluginInfo ? $this->___callPlugins('getSegmentCustomersQty', func_get_args(), $pluginInfo) : parent::getSegmentCustomersQty($segmentId);
    }

    /**
     * {@inheritdoc}
     */
    public function aggregateMatchedCustomers($segment)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'aggregateMatchedCustomers');
        return $pluginInfo ? $this->___callPlugins('aggregateMatchedCustomers', func_get_args(), $pluginInfo) : parent::aggregateMatchedCustomers($segment);
    }

    /**
     * {@inheritdoc}
     */
    public function runConditionSql($sql, $bindParams)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'runConditionSql');
        return $pluginInfo ? $this->___callPlugins('runConditionSql', func_get_args(), $pluginInfo) : parent::runConditionSql($sql, $bindParams);
    }

    /**
     * {@inheritdoc}
     */
    public function createSelect()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createSelect');
        return $pluginInfo ? $this->___callPlugins('createSelect', func_get_args(), $pluginInfo) : parent::createSelect();
    }

    /**
     * {@inheritdoc}
     */
    public function quoteInto($string, $param)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'quoteInto');
        return $pluginInfo ? $this->___callPlugins('quoteInto', func_get_args(), $pluginInfo) : parent::quoteInto($string, $param);
    }

    /**
     * {@inheritdoc}
     */
    public function getSqlOperator($operator)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSqlOperator');
        return $pluginInfo ? $this->___callPlugins('getSqlOperator', func_get_args(), $pluginInfo) : parent::getSqlOperator($operator);
    }

    /**
     * {@inheritdoc}
     */
    public function createConditionSql($field, $operator, $value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createConditionSql');
        return $pluginInfo ? $this->___callPlugins('createConditionSql', func_get_args(), $pluginInfo) : parent::createConditionSql($field, $operator, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getActiveSegmentsByIds($segmentIds)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getActiveSegmentsByIds');
        return $pluginInfo ? $this->___callPlugins('getActiveSegmentsByIds', func_get_args(), $pluginInfo) : parent::getActiveSegmentsByIds($segmentIds);
    }

    /**
     * {@inheritdoc}
     */
    public function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, '_beforeSave');
        return $pluginInfo ? $this->___callPlugins('_beforeSave', func_get_args(), $pluginInfo) : parent::_beforeSave($object);
    }

    /**
     * {@inheritdoc}
     */
    public function bindRuleToEntity($ruleIds, $entityIds, $entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'bindRuleToEntity');
        return $pluginInfo ? $this->___callPlugins('bindRuleToEntity', func_get_args(), $pluginInfo) : parent::bindRuleToEntity($ruleIds, $entityIds, $entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function unbindRuleFromEntity($ruleIds, $entityIds, $entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unbindRuleFromEntity');
        return $pluginInfo ? $this->___callPlugins('unbindRuleFromEntity', func_get_args(), $pluginInfo) : parent::unbindRuleFromEntity($ruleIds, $entityIds, $entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedEntityIds($ruleId, $entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAssociatedEntityIds');
        return $pluginInfo ? $this->___callPlugins('getAssociatedEntityIds', func_get_args(), $pluginInfo) : parent::getAssociatedEntityIds($ruleId, $entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function getWebsiteIds($ruleId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWebsiteIds');
        return $pluginInfo ? $this->___callPlugins('getWebsiteIds', func_get_args(), $pluginInfo) : parent::getWebsiteIds($ruleId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerGroupIds($ruleId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomerGroupIds');
        return $pluginInfo ? $this->___callPlugins('getCustomerGroupIds', func_get_args(), $pluginInfo) : parent::getCustomerGroupIds($ruleId);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdFieldName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIdFieldName');
        return $pluginInfo ? $this->___callPlugins('getIdFieldName', func_get_args(), $pluginInfo) : parent::getIdFieldName();
    }

    /**
     * {@inheritdoc}
     */
    public function getMainTable()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMainTable');
        return $pluginInfo ? $this->___callPlugins('getMainTable', func_get_args(), $pluginInfo) : parent::getMainTable();
    }

    /**
     * {@inheritdoc}
     */
    public function getTable($tableName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTable');
        return $pluginInfo ? $this->___callPlugins('getTable', func_get_args(), $pluginInfo) : parent::getTable($tableName);
    }

    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getConnection');
        return $pluginInfo ? $this->___callPlugins('getConnection', func_get_args(), $pluginInfo) : parent::getConnection();
    }

    /**
     * {@inheritdoc}
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        return $pluginInfo ? $this->___callPlugins('load', func_get_args(), $pluginInfo) : parent::load($object, $value, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        return $pluginInfo ? $this->___callPlugins('save', func_get_args(), $pluginInfo) : parent::save($object);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'delete');
        return $pluginInfo ? $this->___callPlugins('delete', func_get_args(), $pluginInfo) : parent::delete($object);
    }

    /**
     * {@inheritdoc}
     */
    public function addUniqueField($field)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addUniqueField');
        return $pluginInfo ? $this->___callPlugins('addUniqueField', func_get_args(), $pluginInfo) : parent::addUniqueField($field);
    }

    /**
     * {@inheritdoc}
     */
    public function resetUniqueField()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resetUniqueField');
        return $pluginInfo ? $this->___callPlugins('resetUniqueField', func_get_args(), $pluginInfo) : parent::resetUniqueField();
    }

    /**
     * {@inheritdoc}
     */
    public function unserializeFields(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unserializeFields');
        return $pluginInfo ? $this->___callPlugins('unserializeFields', func_get_args(), $pluginInfo) : parent::unserializeFields($object);
    }

    /**
     * {@inheritdoc}
     */
    public function getUniqueFields()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUniqueFields');
        return $pluginInfo ? $this->___callPlugins('getUniqueFields', func_get_args(), $pluginInfo) : parent::getUniqueFields();
    }

    /**
     * {@inheritdoc}
     */
    public function hasDataChanged($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasDataChanged');
        return $pluginInfo ? $this->___callPlugins('hasDataChanged', func_get_args(), $pluginInfo) : parent::hasDataChanged($object);
    }

    /**
     * {@inheritdoc}
     */
    public function getChecksum($table)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChecksum');
        return $pluginInfo ? $this->___callPlugins('getChecksum', func_get_args(), $pluginInfo) : parent::getChecksum($table);
    }

    /**
     * {@inheritdoc}
     */
    public function afterLoad(\Magento\Framework\DataObject $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterLoad');
        return $pluginInfo ? $this->___callPlugins('afterLoad', func_get_args(), $pluginInfo) : parent::afterLoad($object);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave(\Magento\Framework\DataObject $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beforeSave');
        return $pluginInfo ? $this->___callPlugins('beforeSave', func_get_args(), $pluginInfo) : parent::beforeSave($object);
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave(\Magento\Framework\DataObject $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterSave');
        return $pluginInfo ? $this->___callPlugins('afterSave', func_get_args(), $pluginInfo) : parent::afterSave($object);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete(\Magento\Framework\DataObject $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beforeDelete');
        return $pluginInfo ? $this->___callPlugins('beforeDelete', func_get_args(), $pluginInfo) : parent::beforeDelete($object);
    }

    /**
     * {@inheritdoc}
     */
    public function afterDelete(\Magento\Framework\DataObject $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterDelete');
        return $pluginInfo ? $this->___callPlugins('afterDelete', func_get_args(), $pluginInfo) : parent::afterDelete($object);
    }

    /**
     * {@inheritdoc}
     */
    public function serializeFields(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'serializeFields');
        return $pluginInfo ? $this->___callPlugins('serializeFields', func_get_args(), $pluginInfo) : parent::serializeFields($object);
    }

    /**
     * {@inheritdoc}
     */
    public function beginTransaction()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beginTransaction');
        return $pluginInfo ? $this->___callPlugins('beginTransaction', func_get_args(), $pluginInfo) : parent::beginTransaction();
    }

    /**
     * {@inheritdoc}
     */
    public function addCommitCallback($callback)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addCommitCallback');
        return $pluginInfo ? $this->___callPlugins('addCommitCallback', func_get_args(), $pluginInfo) : parent::addCommitCallback($callback);
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'commit');
        return $pluginInfo ? $this->___callPlugins('commit', func_get_args(), $pluginInfo) : parent::commit();
    }

    /**
     * {@inheritdoc}
     */
    public function rollBack()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'rollBack');
        return $pluginInfo ? $this->___callPlugins('rollBack', func_get_args(), $pluginInfo) : parent::rollBack();
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationRulesBeforeSave()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValidationRulesBeforeSave');
        return $pluginInfo ? $this->___callPlugins('getValidationRulesBeforeSave', func_get_args(), $pluginInfo) : parent::getValidationRulesBeforeSave();
    }
}
