<?php
namespace Magento\Sales\Model\Order\Address;

/**
 * Interceptor class for @see \Magento\Sales\Model\Order\Address
 */
class Interceptor extends \Magento\Sales\Model\Order\Address implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory, \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory, \Magento\Sales\Model\OrderFactory $orderFactory, \Magento\Directory\Model\RegionFactory $regionFactory, ?\Magento\Framework\Model\ResourceModel\AbstractResource $resource = null, ?\Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $orderFactory, $regionFactory, $resource, $resourceCollection, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function setOrder(\Magento\Sales\Model\Order $order)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setOrder');
        return $pluginInfo ? $this->___callPlugins('setOrder', func_get_args(), $pluginInfo) : parent::setOrder($order);
    }

    /**
     * {@inheritdoc}
     */
    public function getRegionCode()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRegionCode');
        return $pluginInfo ? $this->___callPlugins('getRegionCode', func_get_args(), $pluginInfo) : parent::getRegionCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getName');
        return $pluginInfo ? $this->___callPlugins('getName', func_get_args(), $pluginInfo) : parent::getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setData($key, $value = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setData');
        return $pluginInfo ? $this->___callPlugins('setData', func_get_args(), $pluginInfo) : parent::setData($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function explodeStreetAddress()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'explodeStreetAddress');
        return $pluginInfo ? $this->___callPlugins('explodeStreetAddress', func_get_args(), $pluginInfo) : parent::explodeStreetAddress();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOrder');
        return $pluginInfo ? $this->___callPlugins('getOrder', func_get_args(), $pluginInfo) : parent::getOrder();
    }

    /**
     * {@inheritdoc}
     */
    public function getStreet()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStreet');
        return $pluginInfo ? $this->___callPlugins('getStreet', func_get_args(), $pluginInfo) : parent::getStreet();
    }

    /**
     * {@inheritdoc}
     */
    public function getStreetLine($number)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStreetLine');
        return $pluginInfo ? $this->___callPlugins('getStreetLine', func_get_args(), $pluginInfo) : parent::getStreetLine($number);
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressType()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAddressType');
        return $pluginInfo ? $this->___callPlugins('getAddressType', func_get_args(), $pluginInfo) : parent::getAddressType();
    }

    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCity');
        return $pluginInfo ? $this->___callPlugins('getCity', func_get_args(), $pluginInfo) : parent::getCity();
    }

    /**
     * {@inheritdoc}
     */
    public function getCompany()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCompany');
        return $pluginInfo ? $this->___callPlugins('getCompany', func_get_args(), $pluginInfo) : parent::getCompany();
    }

    /**
     * {@inheritdoc}
     */
    public function getCountryId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCountryId');
        return $pluginInfo ? $this->___callPlugins('getCountryId', func_get_args(), $pluginInfo) : parent::getCountryId();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerAddressId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomerAddressId');
        return $pluginInfo ? $this->___callPlugins('getCustomerAddressId', func_get_args(), $pluginInfo) : parent::getCustomerAddressId();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomerId');
        return $pluginInfo ? $this->___callPlugins('getCustomerId', func_get_args(), $pluginInfo) : parent::getCustomerId();
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEmail');
        return $pluginInfo ? $this->___callPlugins('getEmail', func_get_args(), $pluginInfo) : parent::getEmail();
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityId');
        return $pluginInfo ? $this->___callPlugins('getEntityId', func_get_args(), $pluginInfo) : parent::getEntityId();
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityId($entityId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setEntityId');
        return $pluginInfo ? $this->___callPlugins('setEntityId', func_get_args(), $pluginInfo) : parent::setEntityId($entityId);
    }

    /**
     * {@inheritdoc}
     */
    public function getFax()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFax');
        return $pluginInfo ? $this->___callPlugins('getFax', func_get_args(), $pluginInfo) : parent::getFax();
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstname()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFirstname');
        return $pluginInfo ? $this->___callPlugins('getFirstname', func_get_args(), $pluginInfo) : parent::getFirstname();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastname()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLastname');
        return $pluginInfo ? $this->___callPlugins('getLastname', func_get_args(), $pluginInfo) : parent::getLastname();
    }

    /**
     * {@inheritdoc}
     */
    public function getMiddlename()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMiddlename');
        return $pluginInfo ? $this->___callPlugins('getMiddlename', func_get_args(), $pluginInfo) : parent::getMiddlename();
    }

    /**
     * {@inheritdoc}
     */
    public function getParentId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getParentId');
        return $pluginInfo ? $this->___callPlugins('getParentId', func_get_args(), $pluginInfo) : parent::getParentId();
    }

    /**
     * {@inheritdoc}
     */
    public function getPostcode()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPostcode');
        return $pluginInfo ? $this->___callPlugins('getPostcode', func_get_args(), $pluginInfo) : parent::getPostcode();
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPrefix');
        return $pluginInfo ? $this->___callPlugins('getPrefix', func_get_args(), $pluginInfo) : parent::getPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getRegion()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRegion');
        return $pluginInfo ? $this->___callPlugins('getRegion', func_get_args(), $pluginInfo) : parent::getRegion();
    }

    /**
     * {@inheritdoc}
     */
    public function getRegionId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRegionId');
        return $pluginInfo ? $this->___callPlugins('getRegionId', func_get_args(), $pluginInfo) : parent::getRegionId();
    }

    /**
     * {@inheritdoc}
     */
    public function getSuffix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSuffix');
        return $pluginInfo ? $this->___callPlugins('getSuffix', func_get_args(), $pluginInfo) : parent::getSuffix();
    }

    /**
     * {@inheritdoc}
     */
    public function getTelephone()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTelephone');
        return $pluginInfo ? $this->___callPlugins('getTelephone', func_get_args(), $pluginInfo) : parent::getTelephone();
    }

    /**
     * {@inheritdoc}
     */
    public function getVatId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVatId');
        return $pluginInfo ? $this->___callPlugins('getVatId', func_get_args(), $pluginInfo) : parent::getVatId();
    }

    /**
     * {@inheritdoc}
     */
    public function getVatIsValid()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVatIsValid');
        return $pluginInfo ? $this->___callPlugins('getVatIsValid', func_get_args(), $pluginInfo) : parent::getVatIsValid();
    }

    /**
     * {@inheritdoc}
     */
    public function getVatRequestDate()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVatRequestDate');
        return $pluginInfo ? $this->___callPlugins('getVatRequestDate', func_get_args(), $pluginInfo) : parent::getVatRequestDate();
    }

    /**
     * {@inheritdoc}
     */
    public function getVatRequestId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVatRequestId');
        return $pluginInfo ? $this->___callPlugins('getVatRequestId', func_get_args(), $pluginInfo) : parent::getVatRequestId();
    }

    /**
     * {@inheritdoc}
     */
    public function getVatRequestSuccess()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVatRequestSuccess');
        return $pluginInfo ? $this->___callPlugins('getVatRequestSuccess', func_get_args(), $pluginInfo) : parent::getVatRequestSuccess();
    }

    /**
     * {@inheritdoc}
     */
    public function setParentId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setParentId');
        return $pluginInfo ? $this->___callPlugins('setParentId', func_get_args(), $pluginInfo) : parent::setParentId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomerAddressId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCustomerAddressId');
        return $pluginInfo ? $this->___callPlugins('setCustomerAddressId', func_get_args(), $pluginInfo) : parent::setCustomerAddressId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setRegionId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setRegionId');
        return $pluginInfo ? $this->___callPlugins('setRegionId', func_get_args(), $pluginInfo) : parent::setRegionId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setStreet($street)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setStreet');
        return $pluginInfo ? $this->___callPlugins('setStreet', func_get_args(), $pluginInfo) : parent::setStreet($street);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomerId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCustomerId');
        return $pluginInfo ? $this->___callPlugins('setCustomerId', func_get_args(), $pluginInfo) : parent::setCustomerId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setFax($fax)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFax');
        return $pluginInfo ? $this->___callPlugins('setFax', func_get_args(), $pluginInfo) : parent::setFax($fax);
    }

    /**
     * {@inheritdoc}
     */
    public function setRegion($region)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setRegion');
        return $pluginInfo ? $this->___callPlugins('setRegion', func_get_args(), $pluginInfo) : parent::setRegion($region);
    }

    /**
     * {@inheritdoc}
     */
    public function setPostcode($postcode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setPostcode');
        return $pluginInfo ? $this->___callPlugins('setPostcode', func_get_args(), $pluginInfo) : parent::setPostcode($postcode);
    }

    /**
     * {@inheritdoc}
     */
    public function setLastname($lastname)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setLastname');
        return $pluginInfo ? $this->___callPlugins('setLastname', func_get_args(), $pluginInfo) : parent::setLastname($lastname);
    }

    /**
     * {@inheritdoc}
     */
    public function setCity($city)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCity');
        return $pluginInfo ? $this->___callPlugins('setCity', func_get_args(), $pluginInfo) : parent::setCity($city);
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setEmail');
        return $pluginInfo ? $this->___callPlugins('setEmail', func_get_args(), $pluginInfo) : parent::setEmail($email);
    }

    /**
     * {@inheritdoc}
     */
    public function setTelephone($telephone)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTelephone');
        return $pluginInfo ? $this->___callPlugins('setTelephone', func_get_args(), $pluginInfo) : parent::setTelephone($telephone);
    }

    /**
     * {@inheritdoc}
     */
    public function setCountryId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCountryId');
        return $pluginInfo ? $this->___callPlugins('setCountryId', func_get_args(), $pluginInfo) : parent::setCountryId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstname($firstname)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFirstname');
        return $pluginInfo ? $this->___callPlugins('setFirstname', func_get_args(), $pluginInfo) : parent::setFirstname($firstname);
    }

    /**
     * {@inheritdoc}
     */
    public function setAddressType($addressType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAddressType');
        return $pluginInfo ? $this->___callPlugins('setAddressType', func_get_args(), $pluginInfo) : parent::setAddressType($addressType);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrefix($prefix)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setPrefix');
        return $pluginInfo ? $this->___callPlugins('setPrefix', func_get_args(), $pluginInfo) : parent::setPrefix($prefix);
    }

    /**
     * {@inheritdoc}
     */
    public function setMiddlename($middlename)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setMiddlename');
        return $pluginInfo ? $this->___callPlugins('setMiddlename', func_get_args(), $pluginInfo) : parent::setMiddlename($middlename);
    }

    /**
     * {@inheritdoc}
     */
    public function setSuffix($suffix)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setSuffix');
        return $pluginInfo ? $this->___callPlugins('setSuffix', func_get_args(), $pluginInfo) : parent::setSuffix($suffix);
    }

    /**
     * {@inheritdoc}
     */
    public function setCompany($company)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCompany');
        return $pluginInfo ? $this->___callPlugins('setCompany', func_get_args(), $pluginInfo) : parent::setCompany($company);
    }

    /**
     * {@inheritdoc}
     */
    public function setVatId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setVatId');
        return $pluginInfo ? $this->___callPlugins('setVatId', func_get_args(), $pluginInfo) : parent::setVatId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setVatIsValid($vatIsValid)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setVatIsValid');
        return $pluginInfo ? $this->___callPlugins('setVatIsValid', func_get_args(), $pluginInfo) : parent::setVatIsValid($vatIsValid);
    }

    /**
     * {@inheritdoc}
     */
    public function setVatRequestId($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setVatRequestId');
        return $pluginInfo ? $this->___callPlugins('setVatRequestId', func_get_args(), $pluginInfo) : parent::setVatRequestId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setRegionCode($regionCode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setRegionCode');
        return $pluginInfo ? $this->___callPlugins('setRegionCode', func_get_args(), $pluginInfo) : parent::setRegionCode($regionCode);
    }

    /**
     * {@inheritdoc}
     */
    public function setVatRequestDate($vatRequestDate)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setVatRequestDate');
        return $pluginInfo ? $this->___callPlugins('setVatRequestDate', func_get_args(), $pluginInfo) : parent::setVatRequestDate($vatRequestDate);
    }

    /**
     * {@inheritdoc}
     */
    public function setVatRequestSuccess($vatRequestSuccess)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setVatRequestSuccess');
        return $pluginInfo ? $this->___callPlugins('setVatRequestSuccess', func_get_args(), $pluginInfo) : parent::setVatRequestSuccess($vatRequestSuccess);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensionAttributes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getExtensionAttributes');
        return $pluginInfo ? $this->___callPlugins('getExtensionAttributes', func_get_args(), $pluginInfo) : parent::getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     */
    public function setExtensionAttributes(\Magento\Sales\Api\Data\OrderAddressExtensionInterface $extensionAttributes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setExtensionAttributes');
        return $pluginInfo ? $this->___callPlugins('setExtensionAttributes', func_get_args(), $pluginInfo) : parent::setExtensionAttributes($extensionAttributes);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beforeSave');
        return $pluginInfo ? $this->___callPlugins('beforeSave', func_get_args(), $pluginInfo) : parent::beforeSave();
    }

    /**
     * {@inheritdoc}
     */
    public function getEventObject()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEventObject');
        return $pluginInfo ? $this->___callPlugins('getEventObject', func_get_args(), $pluginInfo) : parent::getEventObject();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomAttributes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomAttributes');
        return $pluginInfo ? $this->___callPlugins('getCustomAttributes', func_get_args(), $pluginInfo) : parent::getCustomAttributes();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomAttribute($attributeCode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomAttribute');
        return $pluginInfo ? $this->___callPlugins('getCustomAttribute', func_get_args(), $pluginInfo) : parent::getCustomAttribute($attributeCode);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomAttributes(array $attributes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCustomAttributes');
        return $pluginInfo ? $this->___callPlugins('setCustomAttributes', func_get_args(), $pluginInfo) : parent::setCustomAttributes($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setCustomAttribute');
        return $pluginInfo ? $this->___callPlugins('setCustomAttribute', func_get_args(), $pluginInfo) : parent::setCustomAttribute($attributeCode, $attributeValue);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetData($key = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetData');
        return $pluginInfo ? $this->___callPlugins('unsetData', func_get_args(), $pluginInfo) : parent::unsetData($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getData($key = '', $index = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getData');
        return $pluginInfo ? $this->___callPlugins('getData', func_get_args(), $pluginInfo) : parent::getData($key, $index);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setId');
        return $pluginInfo ? $this->___callPlugins('setId', func_get_args(), $pluginInfo) : parent::setId($value);
    }

    /**
     * {@inheritdoc}
     */
    public function setIdFieldName($name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setIdFieldName');
        return $pluginInfo ? $this->___callPlugins('setIdFieldName', func_get_args(), $pluginInfo) : parent::setIdFieldName($name);
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
    public function getId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getId');
        return $pluginInfo ? $this->___callPlugins('getId', func_get_args(), $pluginInfo) : parent::getId();
    }

    /**
     * {@inheritdoc}
     */
    public function isDeleted($isDeleted = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isDeleted');
        return $pluginInfo ? $this->___callPlugins('isDeleted', func_get_args(), $pluginInfo) : parent::isDeleted($isDeleted);
    }

    /**
     * {@inheritdoc}
     */
    public function hasDataChanges()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasDataChanges');
        return $pluginInfo ? $this->___callPlugins('hasDataChanges', func_get_args(), $pluginInfo) : parent::hasDataChanges();
    }

    /**
     * {@inheritdoc}
     */
    public function setDataChanges($value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setDataChanges');
        return $pluginInfo ? $this->___callPlugins('setDataChanges', func_get_args(), $pluginInfo) : parent::setDataChanges($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrigData($key = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOrigData');
        return $pluginInfo ? $this->___callPlugins('getOrigData', func_get_args(), $pluginInfo) : parent::getOrigData($key);
    }

    /**
     * {@inheritdoc}
     */
    public function setOrigData($key = null, $data = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setOrigData');
        return $pluginInfo ? $this->___callPlugins('setOrigData', func_get_args(), $pluginInfo) : parent::setOrigData($key, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function dataHasChangedFor($field)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dataHasChangedFor');
        return $pluginInfo ? $this->___callPlugins('dataHasChangedFor', func_get_args(), $pluginInfo) : parent::dataHasChangedFor($field);
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getResourceName');
        return $pluginInfo ? $this->___callPlugins('getResourceName', func_get_args(), $pluginInfo) : parent::getResourceName();
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceCollection()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getResourceCollection');
        return $pluginInfo ? $this->___callPlugins('getResourceCollection', func_get_args(), $pluginInfo) : parent::getResourceCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getCollection()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCollection');
        return $pluginInfo ? $this->___callPlugins('getCollection', func_get_args(), $pluginInfo) : parent::getCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function load($modelId, $field = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        return $pluginInfo ? $this->___callPlugins('load', func_get_args(), $pluginInfo) : parent::load($modelId, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeLoad($identifier, $field = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beforeLoad');
        return $pluginInfo ? $this->___callPlugins('beforeLoad', func_get_args(), $pluginInfo) : parent::beforeLoad($identifier, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function afterLoad()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterLoad');
        return $pluginInfo ? $this->___callPlugins('afterLoad', func_get_args(), $pluginInfo) : parent::afterLoad();
    }

    /**
     * {@inheritdoc}
     */
    public function isSaveAllowed()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isSaveAllowed');
        return $pluginInfo ? $this->___callPlugins('isSaveAllowed', func_get_args(), $pluginInfo) : parent::isSaveAllowed();
    }

    /**
     * {@inheritdoc}
     */
    public function setHasDataChanges($flag)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setHasDataChanges');
        return $pluginInfo ? $this->___callPlugins('setHasDataChanges', func_get_args(), $pluginInfo) : parent::setHasDataChanges($flag);
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        return $pluginInfo ? $this->___callPlugins('save', func_get_args(), $pluginInfo) : parent::save();
    }

    /**
     * {@inheritdoc}
     */
    public function afterCommitCallback()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterCommitCallback');
        return $pluginInfo ? $this->___callPlugins('afterCommitCallback', func_get_args(), $pluginInfo) : parent::afterCommitCallback();
    }

    /**
     * {@inheritdoc}
     */
    public function isObjectNew($flag = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isObjectNew');
        return $pluginInfo ? $this->___callPlugins('isObjectNew', func_get_args(), $pluginInfo) : parent::isObjectNew($flag);
    }

    /**
     * {@inheritdoc}
     */
    public function validateBeforeSave()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validateBeforeSave');
        return $pluginInfo ? $this->___callPlugins('validateBeforeSave', func_get_args(), $pluginInfo) : parent::validateBeforeSave();
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheTags()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCacheTags');
        return $pluginInfo ? $this->___callPlugins('getCacheTags', func_get_args(), $pluginInfo) : parent::getCacheTags();
    }

    /**
     * {@inheritdoc}
     */
    public function cleanModelCache()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'cleanModelCache');
        return $pluginInfo ? $this->___callPlugins('cleanModelCache', func_get_args(), $pluginInfo) : parent::cleanModelCache();
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterSave');
        return $pluginInfo ? $this->___callPlugins('afterSave', func_get_args(), $pluginInfo) : parent::afterSave();
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'delete');
        return $pluginInfo ? $this->___callPlugins('delete', func_get_args(), $pluginInfo) : parent::delete();
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beforeDelete');
        return $pluginInfo ? $this->___callPlugins('beforeDelete', func_get_args(), $pluginInfo) : parent::beforeDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function afterDelete()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterDelete');
        return $pluginInfo ? $this->___callPlugins('afterDelete', func_get_args(), $pluginInfo) : parent::afterDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function afterDeleteCommit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterDeleteCommit');
        return $pluginInfo ? $this->___callPlugins('afterDeleteCommit', func_get_args(), $pluginInfo) : parent::afterDeleteCommit();
    }

    /**
     * {@inheritdoc}
     */
    public function getResource()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getResource');
        return $pluginInfo ? $this->___callPlugins('getResource', func_get_args(), $pluginInfo) : parent::getResource();
    }

    /**
     * {@inheritdoc}
     */
    public function clearInstance()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'clearInstance');
        return $pluginInfo ? $this->___callPlugins('clearInstance', func_get_args(), $pluginInfo) : parent::clearInstance();
    }

    /**
     * {@inheritdoc}
     */
    public function getStoredData()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStoredData');
        return $pluginInfo ? $this->___callPlugins('getStoredData', func_get_args(), $pluginInfo) : parent::getStoredData();
    }

    /**
     * {@inheritdoc}
     */
    public function getEventPrefix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEventPrefix');
        return $pluginInfo ? $this->___callPlugins('getEventPrefix', func_get_args(), $pluginInfo) : parent::getEventPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function addData(array $arr)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addData');
        return $pluginInfo ? $this->___callPlugins('addData', func_get_args(), $pluginInfo) : parent::addData($arr);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataByPath($path)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataByPath');
        return $pluginInfo ? $this->___callPlugins('getDataByPath', func_get_args(), $pluginInfo) : parent::getDataByPath($path);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataByKey($key)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataByKey');
        return $pluginInfo ? $this->___callPlugins('getDataByKey', func_get_args(), $pluginInfo) : parent::getDataByKey($key);
    }

    /**
     * {@inheritdoc}
     */
    public function setDataUsingMethod($key, $args = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setDataUsingMethod');
        return $pluginInfo ? $this->___callPlugins('setDataUsingMethod', func_get_args(), $pluginInfo) : parent::setDataUsingMethod($key, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataUsingMethod($key, $args = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataUsingMethod');
        return $pluginInfo ? $this->___callPlugins('getDataUsingMethod', func_get_args(), $pluginInfo) : parent::getDataUsingMethod($key, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function hasData($key = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasData');
        return $pluginInfo ? $this->___callPlugins('hasData', func_get_args(), $pluginInfo) : parent::hasData($key);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toArray');
        return $pluginInfo ? $this->___callPlugins('toArray', func_get_args(), $pluginInfo) : parent::toArray($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToArray(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToArray');
        return $pluginInfo ? $this->___callPlugins('convertToArray', func_get_args(), $pluginInfo) : parent::convertToArray($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(array $keys = [], $rootName = 'item', $addOpenTag = false, $addCdata = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toXml');
        return $pluginInfo ? $this->___callPlugins('toXml', func_get_args(), $pluginInfo) : parent::toXml($keys, $rootName, $addOpenTag, $addCdata);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToXml(array $arrAttributes = [], $rootName = 'item', $addOpenTag = false, $addCdata = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToXml');
        return $pluginInfo ? $this->___callPlugins('convertToXml', func_get_args(), $pluginInfo) : parent::convertToXml($arrAttributes, $rootName, $addOpenTag, $addCdata);
    }

    /**
     * {@inheritdoc}
     */
    public function toJson(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toJson');
        return $pluginInfo ? $this->___callPlugins('toJson', func_get_args(), $pluginInfo) : parent::toJson($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToJson(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToJson');
        return $pluginInfo ? $this->___callPlugins('convertToJson', func_get_args(), $pluginInfo) : parent::convertToJson($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function toString($format = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toString');
        return $pluginInfo ? $this->___callPlugins('toString', func_get_args(), $pluginInfo) : parent::toString($format);
    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, $args)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, '__call');
        return $pluginInfo ? $this->___callPlugins('__call', func_get_args(), $pluginInfo) : parent::__call($method, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isEmpty');
        return $pluginInfo ? $this->___callPlugins('isEmpty', func_get_args(), $pluginInfo) : parent::isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($keys = [], $valueSeparator = '=', $fieldSeparator = ' ', $quote = '"')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'serialize');
        return $pluginInfo ? $this->___callPlugins('serialize', func_get_args(), $pluginInfo) : parent::serialize($keys, $valueSeparator, $fieldSeparator, $quote);
    }

    /**
     * {@inheritdoc}
     */
    public function debug($data = null, &$objects = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'debug');
        return $pluginInfo ? $this->___callPlugins('debug', func_get_args(), $pluginInfo) : parent::debug($data, $objects);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetSet');
        return $pluginInfo ? $this->___callPlugins('offsetSet', func_get_args(), $pluginInfo) : parent::offsetSet($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetExists');
        return $pluginInfo ? $this->___callPlugins('offsetExists', func_get_args(), $pluginInfo) : parent::offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetUnset');
        return $pluginInfo ? $this->___callPlugins('offsetUnset', func_get_args(), $pluginInfo) : parent::offsetUnset($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetGet');
        return $pluginInfo ? $this->___callPlugins('offsetGet', func_get_args(), $pluginInfo) : parent::offsetGet($offset);
    }
}
