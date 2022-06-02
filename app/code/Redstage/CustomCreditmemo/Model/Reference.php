<?php
namespace Redstage\CustomCreditmemo\Model;

use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Sales\Api\Data\CreditmemoInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\AbstractModel;
use Magento\Sales\Model\EntityInterface;
use Magento\Sales\Model\Order\Creditmemo;
use Magento\Sales\Model\Order\InvoiceFactory;

class Reference extends \Magento\Framework\Model\AbstractModel
{


    const PAY_REFERENCE_ID = 'pay_reference_id';

    /**
     * Identifier for order history item
     *
     * @var string
     */
    protected $entityType = 'creditmemo';

    /**
     * @var array
     */
    protected static $_states;

    /**
     * @var \Magento\Sales\Model\Order
     */
    protected $_order;

    /**
     * Calculator instances for delta rounding of prices
     *
     * @var array
     */
    protected $_calculators = [];

    /**
     * @var string
     */
    protected $_eventPrefix = 'sales_order_creditmemo';

    /**
     * @var string
     */
    protected $_eventObject = 'creditmemo';

    /**
     * @var \Magento\Sales\Model\Order\Creditmemo\Config
     */
    protected $_creditmemoConfig;

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $_orderFactory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Item\CollectionFactory
     */
    protected $_cmItemCollectionFactory;

    /**
     * @var \Magento\Framework\Math\CalculatorFactory
     */
    protected $_calculatorFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Sales\Model\Order\Creditmemo\CommentFactory
     */
    protected $_commentFactory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Comment\CollectionFactory
     */
    protected $_commentCollectionFactory;

    /**
     * @var PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * @var InvoiceFactory
     */
    private $invoiceFactory;

    /**
     * @var ScopeConfigInterface;
     */
    private $scopeConfig;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param Creditmemo\Config $creditmemoConfig
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Item\CollectionFactory $cmItemCollectionFactory
     * @param \Magento\Framework\Math\CalculatorFactory $calculatorFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param Creditmemo\CommentFactory $commentFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Comment\CollectionFactory $commentCollectionFactory
     * @param PriceCurrencyInterface $priceCurrency
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     * @param InvoiceFactory $invoiceFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param OrderRepositoryInterface $orderRepository
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        \Magento\Sales\Model\Order\Creditmemo\Config $creditmemoConfig,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Item\CollectionFactory $cmItemCollectionFactory,
        \Magento\Framework\Math\CalculatorFactory $calculatorFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Sales\Model\Order\Creditmemo\CommentFactory $commentFactory,
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Comment\CollectionFactory $commentCollectionFactory,
        PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [],
        InvoiceFactory $invoiceFactory = null,
        ScopeConfigInterface $scopeConfig = null,
        OrderRepositoryInterface $orderRepository = null
    ) {
        $this->_creditmemoConfig = $creditmemoConfig;
        $this->_orderFactory = $orderFactory;
        $this->_cmItemCollectionFactory = $cmItemCollectionFactory;
        $this->_calculatorFactory = $calculatorFactory;
        $this->_storeManager = $storeManager;
        $this->_commentFactory = $commentFactory;
        $this->_commentCollectionFactory = $commentCollectionFactory;
        $this->priceCurrency = $priceCurrency;
        $this->invoiceFactory = $invoiceFactory ?: ObjectManager::getInstance()->get(InvoiceFactory::class);
        $this->scopeConfig = $scopeConfig ?: ObjectManager::getInstance()->get(ScopeConfigInterface::class);
        $this->orderRepository = $orderRepository ?? ObjectManager::getInstance()->get(OrderRepositoryInterface::class);
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Initialize creditmemo resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magento\Sales\Model\ResourceModel\Order\Creditmemo::class);
    }
    public function getPayReferenceId()
    {
        return $this->getData(CreditmemoInterface::PAY_REFERENCE_ID);
    }

    
    /**
     * {@inheritdoc}
     */
    public function setPayReferenceId($payReferenceId)
    {
        return $this->setData(CreditmemoInterface::PAY_REFERENCE_ID, $payReferenceId);
    }
}
