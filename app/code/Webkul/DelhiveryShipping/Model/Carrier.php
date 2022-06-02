<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryShipping\Model;

use Magento\Quote\Model\Quote\Address\RateResult\Error;
use Magento\Shipping\Model\Rate\Result;
use Magento\Sales\Model\Order\Shipment;
use Webkul\DelhiveryShipping\Model\ManageawbFactory as AwbFactory;
use Webkul\MarketplaceBaseShipping\Model\ShippingSettingRepository;

class Carrier extends \Webkul\MarketplaceBaseShipping\Model\Carrier\AbstractCarrierOnline

{
    /**
    * Code of the carrier
    *
    * @var string
    */
    const CODE = 'delhivery';

    /**
     * Code of the carrier
     *
     * @var string
     */
    protected $_code = self::CODE;

    /**
     * Rate request data
     *
     * @var RateRequest|null
     */
    protected $_request = null;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Core string
     *
     * @var \Magento\Framework\Stdlib\StringUtils
     */
    protected $string;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $_messageManager;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Xml\Security $security,
        \Magento\Shipping\Model\Simplexml\ElementFactory $xmlElFactory,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory,
        \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Directory\Helper\Data $directoryData,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Webkul\Marketplace\Helper\Orders $marketplaceOrderHelper,
        \Webkul\Marketplace\Model\ProductFactory $mpProductFactory,
        \Webkul\Marketplace\Model\SaleslistFactory $saleslistFactory,
        ShippingSettingRepository $shippingSettingRepository,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Customer\Model\AddressFactory $addressFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Request\Http $requestParam,
        \Magento\Quote\Model\Quote\Item\OptionFactory $quoteOptionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\RequestInterface $requestInterface,
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,
        \Magento\Shipping\Helper\Carrier $carrierHelper,
        \Magento\Shipping\Model\Shipping\LabelGenerator $labelGenerator,
        \Magento\Framework\Session\SessionManager $coreSession,
        \Magento\Framework\Serialize\SerializerInterface $serializerInterface,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
        \Magento\Sales\Model\Order\ShipmentFactory $shipmentFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Webkul\DelhiveryExtend\Model\DelhiveryWarehouseFactory $delhiveryWarehouseFactory,
        \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        AwbFactory $awbFactory,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->string = $string;
        $this->_delhiveryHelper = $delhiveryHelper;
        $this->_delhiveryModelAwb = $delhiveryModelAwb;
        $this->requestParam = $requestParam;
        $this->addressFactory = $addressFactory;
        $this->shipmentFactory = $shipmentFactory;
        $this->productFactory = $productFactory;
        $this->_messageManager = $messageManager;
        $this->_awbFactory = $awbFactory;
        $this->delhiVeryLogger = $delhiVeryLogger;
        $this->delhiveryWarehouseFactory = $delhiveryWarehouseFactory;
        $this->_rateResultFactory = $rateResultFactory;
        $this->connection = $resourceConnection->getConnection();
        $this->checkoutSession = $checkoutSession;
        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $security,
            $xmlElFactory,
            $rateResultFactory,
            $rateMethodFactory,
            $trackFactory,
            $trackErrorFactory,
            $trackStatusFactory,
            $regionFactory,
            $countryFactory,
            $currencyFactory,
            $directoryData,
            $stockRegistry,
            $marketplaceOrderHelper,
            $mpProductFactory,
            $saleslistFactory,
            $shippingSettingRepository,
            $productFactory,
            $addressFactory,
            $customerFactory,
            $customerSession,
            $requestParam,
            $quoteOptionFactory,
            $storeManager,
            $requestInterface,
            $httpClientFactory,
            $carrierHelper,
            $labelGenerator,
            $coreSession,
            $data,
            $serializerInterface,
            $checkoutSession
        );
    }

    /**
     * Collect and get rates
     *
     * @param RateRequest $request
     * @return Result|bool|null
     */
    public function collectRates(\Magento\Quote\Model\Quote\Address\RateRequest $request)
    {
        $requestDelhivery = clone $request;
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        $destPostcode = $request->getDestPostcode();
        $allItems = $request->getAllItems();
        $restProForLocation = [];
        foreach ($allItems as $item) {
            $itemData = $item->getBuyRequest()->getData();
            if (isset($itemData['postal_code']) && $itemData['postal_code'] != $request->getDestPostcode()) {
                array_push($restProForLocation, $item->getName());
            }
        }
        if (!empty($restProForLocation)) {
            $error = $this->_rateErrorFactory->create();
            $error->setCarrier($this->_code);
            $error->setCarrierTitle($this->getConfigData('title'));
            $errorMsg = __('Shipping address not match with products (%1) origin.', implode(',', $restProForLocation));
            $error->setErrorMessage($errorMsg);
            return $error;
        }
        $this->setRequest($requestDelhivery);
        $response = $this->getShippingPricedetail($requestDelhivery);
        return $response;
    }

    /**
     * Calculate the rate according to Tabel Rate shipping defined by the sellers.
     *
     * @param array $request
     * @return Result
     */
    public function getShippingPricedetail(\Magento\Quote\Model\Quote\Address\RateRequest $request)
    {
        $requestData = $request;
        $submethod = [];
        $shippinginfo = [];
        $msg = '';
        $msgArray = [];
        $handling = 0;
        $totalPriceArr = [];
        $priceArr = [];
        $flag = false;
        $check = false;
        $returnError = false;
        $storePickupStatus = false;
        $destCity = $request->getDestCity();
        $destPostcode = $request->getDestPostal();
        $paymentMode = 'Pre-paid';
        $codAmt = 0;
        $subTotal = $this->checkoutSession->getQuote()->getSubtotal();
        $isFreeShip = $this->getConfigData('free_ship') && $this->getConfigData('amount_limit') < $subTotal;
        foreach ($requestData->getShippingDetails() as $shipdetail) {
            $thisMsg = false;
            $priceArr = [];
            $priceRes = 0;
            /*Calculate price itemwise for seller store pickup*/
            $itemPriceDetails = [];
            $items = explode(',', $shipdetail['item_id']);
            $newShipderails = [];
            $newShipderails['seller_id'] = $shipdetail['seller_id'];
            $newShipderails['total_amount'] = $shipdetail['total_amount'];
            $newShipderails['product_name'] = $shipdetail['product_name'];
            if (!$isFreeShip) {
                $awbUrl = $this->_delhiveryHelper->getInvoiceUrl();
                $token = $this->_delhiveryHelper->getLicenseKey();
                $clientId = $this->_delhiveryHelper->getClientId();
                $clientName = $this->_delhiveryHelper->getClientName();

                $path = $awbUrl.'.json?md=S&ss=RTO'.
                '&cgm='.$shipdetail['items_weight'] * 1000 . // for convert KG to GM
                '&o_pin='.$shipdetail['origin_postcode'].
                '&d_pin='.$destPostcode;

                $path = preg_replace('/\s+/', '', $path);
                $rateResponse = $this->_delhiveryHelper->executeCurlForRate($path, $token, "", "");
                $codes =  json_decode($rateResponse, true);

                if (is_array($codes) && count($codes)>0 && isset($codes[0]['total_amount'])) {
                    $response['type']='success';
                    $priceRes = $codes[0]['total_amount'];
                    $methodValue = $this->getConfigData('title');
                    $priceArr[$methodValue] = ['label' => $methodValue, 'amount'=> $priceRes];
                } else {
                    $response['type']='error';
                    $response['msg'] = $codes['error'] ?? json_encode($codes);
                    $this->delhiVeryLogger->addError('delivery rate '.json_encode($response).$path);
                }
            } else {
                $priceArr[$this->getConfigData('title')] = [
                    'label' =>$this->getConfigData('title'),
                    'amount'=> 0
                ];
            }

            /** for test**/
            /*$priceArr[$this->getConfigData('title')] = [
                'label' =>$this->getConfigData('title'),
                'amount'=> 0
            ];*/
            /****/
            /*End seller store pickup*/
            if (empty($priceArr)) {
                list($msg, $msgArray) = $this->getErrorMsg($msgArray, $shipdetail, false);
            }
            if ($this->_delhiveryHelper->isMultiShippingActive() || $storePickupStatus) {
                if (empty($priceArr)) {
                    $totalPriceArr = [];
                    $flag = true;
                    $debugData['result'] = ['error' => 1, 'errormsg'=>$msg];
                    return [];
                }
            } else {
                if (!empty($totalPriceArr)) {
                    foreach ($priceArr as $method => $price) {
                        if (array_key_exists($method, $totalPriceArr)) {
                            $check = true;
                            $totalPriceArr[$method] = $totalPriceArr[$method] + $priceArr[$method];
                        } else {
                            $thisMsg = true;
                            unset($priceArr[$method]);
                        }
                        $flag = $check == true ? false : true;
                    }
                } else {
                    $totalPriceArr = $priceArr;
                }
            }
            if (!empty($priceArr)) {
                foreach ($totalPriceArr as $method => $price) {
                    if (!array_key_exists($method, $priceArr)) {
                        unset($totalPriceArr[$method]);
                    }
                }
            } else {
                $totalPriceArr = [];
                $flag = true;
            }
            if ($flag) {
                if ($thisMsg) {
                    list($msg, $msgArray) = $this->getErrorMsg($msgArray, $shipdetail, true);
                }
                $returnError = true;
                $debugData['result'] = ['error' => 1, 'errormsg'=>$msg];
            }
            //$submethod = $this->getSubMethodsForRate($priceArr);
            $handling = $handling + $priceRes;
            if (!isset($shipdetail['item_id_details'])) {
                $shipdetail['item_id_details'] = [];
            }
            if (!isset($shipdetail['item_name_details'])) {
                $shipdetail['item_name_details'] = [];
            }
            if (!isset($shipdetail['item_qty_details'])) {
                $shipdetail['item_qty_details'] = [];
            }
            array_push(
                $shippinginfo,
                [
                    'seller_id' => $shipdetail['seller_id'],
                    'methodcode' => $this->_code,
                    'shipping_ammount' => $priceRes,
                    'product_name' => $shipdetail['product_name'],
                    'submethod' => [],//$submethod,
                    'item_ids' => $shipdetail['item_id'],
                    'item_price_details' => $itemPriceDetails,
                    'item_id_details' => $shipdetail['item_id_details'],
                    'item_name_details' => $shipdetail['item_name_details'],
                    'item_qty_details' => $shipdetail['item_qty_details']
                ]
            );
        }
        if ($returnError) {
            if ($this->_delhiveryHelper->isMultiShippingActive() || $storePickupStatus) {
                return $debugData;
            }
            return $this->_parseXmlResponse($debugData);
        }
        $totalpric = ['totalprice' => $totalPriceArr, 'costarr' => $priceArr];
        $result = ['handlingfee' => $totalpric, 'shippinginfo' => $shippinginfo, 'error' => 0];
        $shippingAll = $this->_coreSession->getShippingInfo();
        $shippingAll[$this->_code] = $result['shippinginfo'];
        $this->_coreSession->setShippingInfo($shippingAll);
        if ($this->_delhiveryHelper->isMultiShippingActive() || $storePickupStatus) {
            return $result;
        }
        return $this->_parseXmlResponse($totalpric);
    }

    /**
     * Returns value of given variable
     *
     * @param string|int $origValue
     * @param string $pathToValue
     * @return string|int|null
     */
    protected function _getDefaultValue($origValue, $pathToValue)
    {
        if (!$origValue) {
            $origValue = $this->_scopeConfig->getValue(
                $pathToValue,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $this->getStore()
            );
        }
        return $origValue;
    }

    /**
     * set the configuration values.
     *
     * @param \Magento\Framework\DataObject $request
     */
    public function setConfigData(\Magento\Framework\DataObject $request)
    {
        $r = $request;
        return $r;
    }

    /**
     * Get allowed shipping methods.
     *
     * @return string[]
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAllowedMethods()
    {
        return ['delhivery' => $this->getConfigData('name')];
    }

    /**
     * Do request to shipment.
     *
     * @param \Magento\Shipping\Model\Shipment\Request $request
     *
     * @return array|\Magento\Framework\DataObject
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function requestToShipment($request)
    {
        try {
            $packages = $request->getPackages();
            $this->setRawRequest($request);
            $orderId = $this->requestParam->getParam('order_id');
            $sellerId = $this->_customerSession->getCustomerId();
            $request->setOrderId($orderId);
            $request->setSellerId($sellerId);

            if (!is_array($packages) || !$packages) {
                throw new \Magento\Framework\Exception\LocalizedException(__('No packages for request'));
            }
            $result = $this->_doShipmentRequest($request);
            $response = new \Magento\Framework\DataObject(
                [
                    'info' => [
                        [
                            'tracking_number' => $result->getTrackingNumber(),
                            'label_content' => $result->getShippingLabelContent(),
                        ],
                    ],
                ]
            );
            $request->setMasterTrackingId($result->getTrackingNumber());
            return $response;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->_messageManager->addError($e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            $this->_messageManager->addError($e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        }
        //return $response;
    }

    /**
     * Do shipment request to carrier web service,
     *
     * @param \Magento\Framework\DataObject $request
     * @return \Magento\Framework\DataObject
     */
    public function _doShipmentRequest(\Magento\Framework\DataObject $request)
    {
        $this->_prepareShipmentRequest($request);
        $this->_mapPackageToShipment($request);
        $this->setShipemntRequest($request);
        return $this->_createShipmentRequest();
    }

    /**
     * Map request to shipment
     *
     * @param \Magento\Framework\DataObject $request
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _mapPackageToShipment(\Magento\Framework\DataObject $request)
    {
        $request->setOrigCountryId($request->getShipperAddressCountryCode());
        $customsValue = 0;
        $packageWeight = 0;
        $totalPrice = 0;
        $itemsQty = 0;
        $itemsDesc = [];
        $packages = $request->getPackages();
        foreach ($packages as &$piece) {
            $params = $piece['params'];
            $weightUnits = $piece['params']['weight_units'];
            $customsValue += $piece['params']['customs_value'];
            $packageWeight += $piece['params']['weight'];

            foreach ($piece['items'] as $item) {
                $totalPrice += $item['price'];
                $itemsQty += $item['qty'];
                $itemsDesc[] = $item['name'];
            }
        }

        $request->setPackages($packages)
            ->setPackageWeight($packageWeight)
            ->setPackageValue($customsValue)
            ->setValueWithDiscount($customsValue)
            ->setPackageCustomsValue($customsValue)
            ->setQty($itemsQty)
            ->setTotalValue($totalPrice)
            ->setItemDesc(implode(',', $itemsDesc))
            ->setFreeMethodWeight(0);
    }

    /**
     * Make Delhivery Shipment Request.
     *
     * @return string xml
     */
    protected function _createShipmentRequest()
    {
        $request = $this->_rawRequest;
        $sellerId = $this->_request->getSellerId();
        $order = $request->getOrderShipment()->getOrder();
        $result = new \Magento\Framework\DataObject();
        try {
            $requestPackage = $this->requestParam->getParam('packages');
            $sellerWareHouse = $this->getDelhiveryWarehouseOfSeller($sellerId);
            $trackingNumber = $this->_delhiveryHelper->saveManifest($order, $sellerWareHouse, $requestPackage);
            if ($trackingNumber != 0) {
                $this->_changeAwbStatus(
                    $order->getId(),
                    $trackingNumber,
                    $order->getShippingAddress()->getName(),
                    $sellerId
                );
                $result->setShippingLabelContent("delhivery Shipping");
                $result->setTrackingNumber($trackingNumber);
                return $result;
            } else {
                throw new \Magento\Framework\Exception\LocalizedException(__("There are some error during manifest submit"));
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->_messageManager->addError($e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            $this->_messageManager->addError($e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        }
    }

    /**
     * Get DelhiveryWarehouseOfSeller
     *
     * @param int $sellerId
     * @return array
     */
    private function getDelhiveryWarehouseOfSeller($sellerId)
    {
        $sellerOrigin = $this->connection->getTableName('marketplace_shipping_setting');
        $sellerWarehouse = $this->delhiveryWarehouseFactory->create()->getCollection();
        $sellerWarehouse->getSelect()->join(
            $sellerOrigin.' as so',
            'main_table.seller_id = so.seller_id'
        )->where('main_table.seller_id = '.$sellerId);
        return $sellerWarehouse->setPageSize(1)->setCurPage(1)->getFirstItem()->getData();

    }

    /**
     * Prepare and set request in property of current instance
     *
     * @param \Magento\Framework\DataObject $request
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function setShipemntRequest(\Magento\Framework\DataObject $request)
    {
        $this->_request = $request;
        $order = $request->getOrderShipment()->getOrder();
        $this->setStore($request->getStoreId());

        $paramObject = new \Magento\Framework\DataObject();

        $paramObject->setStoreId($request->getStoreId());

        if ($request->getDestPostcode()) {
            $paramObject->setDestPostal($request->getDestPostcode());
        }

        $paramObject->setOrigCountry(
            $this->_getDefaultValue($request->getOrigCountry(), Shipment::XML_PATH_STORE_COUNTRY_ID)
        )->setOrigCountryId(
            $this->_getDefaultValue($request->getOrigCountryId(), Shipment::XML_PATH_STORE_COUNTRY_ID)
        );

        $shippingWeight = $request->getPackageWeight();
        $destAddress = $request->getOrderShipment()->getShippingAddress();
        $street = $destAddress->getStreet();
        $street[1] = isset($street[1])?$street[1]:'';

        $originStreet2 = $this->_scopeConfig->getValue(
            Shipment::XML_PATH_STORE_ADDRESS2,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $paramObject->getStoreId()
        );
        $paramObject->setValue(round($request->getPackageValue(), 2))
            ->setValueWithDiscount($request->getPackageValueWithDiscount())
            ->setCustomsValue($request->getPackageCustomsValue())
            ->setDestStreet($this->string->substr(str_replace("\n", '', $street[0]), 0, 35))
            ->setDestStreetLine2($street[1])
            ->setDestCity($destAddress->getCity())
            ->setDestPhoneNumber($destAddress->getTelephone())
            ->setDestPersonName($destAddress->getName())
            ->setDestCompanyName($destAddress->getCompany())
            ->setDestEmail($destAddress->getEmail())
            ->setDestCountryId($destAddress->getCountryId())
            ->setDestState($destAddress->getRegionId())
            ->setDestPostal($destAddress->getPostcode())
            ->setOrigCompanyName($request->getShipperContactCompanyName())
            ->setOrigCity($request->getShipperAddressCity())
            ->setOrigPhoneNumber($request->getShipperContactPhoneNumber())
            ->setOrigPersonName($request->getShipperContactPersonName())
            ->setOrigEmail(
                $this->_scopeConfig->getValue(
                    'trans_email/ident_general/email',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    $paramObject->getStoreId()
                )
            )
            ->setOrigPostal($request->getShipperAddressPostalCode())
            ->setOrigStreetLine2($originStreet2);

        $paramObject->setOrigStreet(
            $request->getShipperAddressStreet() ? $request->getShipperAddressStreet() : $originStreet2
        );

        $paramObject->setOrigState($request->getShipperAddressStateOrProvinceCode());

        $shippingCharge = $order->getShippingAmount();

        $paramObject->setWeight($shippingWeight)
            ->setQty($request->getQty())
            ->setTotalValue($request->getTotalValue())
            ->setItemDesc($request->getItemDesc())
            ->setOrderShipment($request->getOrderShipment())
            ->setShippingCharge($shippingCharge);

        $paramObject->setBaseSubtotalInclTax($request->getBaseSubtotalInclTax());
        $this->setRawRequest($paramObject);
        return $this;
    }

    protected function _getItemInfo()
    {
        $request = $this->_rawRequest;
        $totalPrice = 0;
        $itemsQty = 0;
        $itemsDesc = [];
        $weight = 0;
        $order = $this->_order;
        foreach ($order->getAllItems() as $itemShipment) {
            if ($itemShipment->getProduct()->isVirtual() || $itemShipment->getParentItem()) {
                continue;
            }

            $unitPrice = 0;
            $packagesParams = $request->getPackages();
            foreach ($packagesParams as $items) {
                $weight = $items['params']['weight'];
                foreach ($items['items'] as $item) {
                    $totalPrice += $item['price'];
                    $itemsQty += $item['qty'];
                    $itemsDesc[] = $item['name'];
                }
            }
        }
        return [$totalPrice, $itemsQty, $itemsDesc, $weight];
    }

    public function proccessAdditionalValidation(\Magento\Framework\DataObject $request)
    {
        return true;
    }

    /**
     * get product weight.
     *
     * @param object $item
     *
     * @return int
     */
    protected function _getItemWeight($item)
    {
        $weight = 0;
        if ($item->getHasChildren()) {
            $_product = $this->productFactory->create()->load($item->getProductId());
            if ($_product->getTypeId() == 'bundle') {
                $childWeight = 0;
                foreach ($item->getChildren() as $child) {
                    $childPro = $this->productFactory->create()->load($child->getProductId());
                    $productWeight = $childPro->getWeight();
                    $childWeight += $productWeight * $child->getQty();
                }
                $weight = $childWeight * $item->getQty();
            } elseif ($_product->getTypeId() == 'configurable') {
                foreach ($item->getChildren() as $child) {
                    $childPro = $this->productFactory->create()->load($child->getProductId());
                    $productWeight = $childPro->getWeight();
                    $weight = $productWeight * $item->getQty();
                }
            }
        } else {
            $_product = $this->productFactory->create()->load($item->getProductId());
            $productWeight = $_product->getWeight();
            $weight = $productWeight * $item->getQty();
            if ($item->getQtyOrdered()) {
                $weight = $productWeight * $item->getQtyOrdered();
            }
        }
        return $weight;
    }

    protected function _getOrigin()
    {
        $r = new \Magento\Framework\DataObject();
        $originPostcode = $this->_scopeConfig->getValue(
            \Magento\Sales\Model\Order\Shipment::XML_PATH_STORE_ZIP,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $r->getStoreId()
        );
        $originCity = $this->_scopeConfig->getValue(
            \Magento\Sales\Model\Order\Shipment::XML_PATH_STORE_CITY,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $r->getStoreId()
        );
        $originCountryId = $this->_scopeConfig->getValue(
            \Magento\Sales\Model\Order\Shipment::XML_PATH_STORE_COUNTRY_ID,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $r->getStoreId()
        );
        return [$originPostcode, $originCity, $originCountryId];
    }

    /**
     * Change Status of AWB number
     *
     * @param int    $orderId
     * @param string $trackingNumber
     * @param string $shipTo
     *
     */
    protected function _changeAwbStatus($orderId, $trackingNumber, $shipTo, $sellerId)
    {
        $awbModel = $this->_awbFactory->create();
        $awbModel->setOrderId($orderId);
        $awbModel->setAwb($trackingNumber);
        $awbModel->setShipmentTo($shipTo);
        $awbModel->setState(1);
        $awbModel->setStatus("InTransit");
        $awbModel->setSellerId($sellerId);
        $awbModel->save();
    }

    /**
     * Get DeliveryShipingCost
     */
    public function getDeliveryShipingCost($sellerOrigin, $customerOrigin, $productId)
    {
        try {
            $paymentMode = 'Pre-paid';
            $codAmt = 0;
            $weight = $this->productFactory->create()->load($productId)->getWeight();
            $weight = $weight ? $weight : 1000;//$product->getWeight();
            $awbUrl = $this->_delhiveryHelper->getInvoiceUrl();
            $token = $this->_delhiveryHelper->getLicenseKey();
            $clientId = $this->_delhiveryHelper->getClientId();
            $clientName = $this->_delhiveryHelper->getClientName();
            $path = $awbUrl.'.json?cl='.$clientName.
            '&pt='.$paymentMode.
            '&zn=A'.
            '&ss=Delivered'.
            '&md=S'.
            '&token='.$token.
            '&cod='.$codAmt.
            '&gm='.$weight.
            '&o_pin='.$sellerOrigin.
            '&d_pin='.$customerOrigin;
            $price = 0;
            $path = preg_replace('/\s+/', '', $path);
            $rateResponse = $this->_delhiveryHelper->executeCurlForRate($path, $token, "", "");
            $codes =  json_decode($rateResponse, true);
            if (is_array($codes) && count($codes)>0 && isset($codes[0]['total_amount'])) {
                $response['type']='success';
                $price = $codes[0]['total_amount'];
                $methodValue = $this->getConfigData('title');
                $priceArr[$methodValue] = ['label' => $methodValue, 'amount'=> $price];
            } else {
                $response['type']='error';
            }
        } catch (\Exception $e) {
            $this->delhiVeryLogger->addError($e->getMessage());
            $price = 0;
        }
        return $price;
    }

    /**
     * [getErrorMsg returns array of custom error messages]
     *
     * @param  array $msgArray
     * @param  array $shipdetail
     * @param  boolean $status
     * @return array
     */
    public function getErrorMsg($msgArray, $shipdetail, $status)
    {
        $productMsg = '';
        $msgArray[] = $shipdetail['product_name'];
        if (!$status) {
            foreach ($msgArray as $key => $product) {
                if ($productMsg=='') {
                    $productMsg = $product;
                } else {
                    $productMsg = $productMsg.", ".$product;
                }
            }
            $msg = __($this->_delhiveryHelper->returnErrorFromConfig());
        } else {
            $msg = __($this->_delhiveryHelper->returnErrorFromConfig());
        }
        return [$msg, $msgArray];
    }

    /**
     * [_parseXmlResponse set Shipping result]
     *
     * @param  array $response
     * @return \Magento\Shipping\Model\Rate\ResultFactory $result
     */
    protected function _parseXmlResponse($response)
    {
        $result = $this->_rateResultFactory->create();
        if (array_key_exists('result', $response) && $response['result']['error'] !== '') {
            $this->_errors[$this->_code] = $response['result']['errormsg'];
            $errors = explode('<br>', $response['result']['errormsg']);
            $error = $this->_rateErrorFactory->create();
            $error->setCarrier($this->_code);
            $error->setCarrierTitle($this->getConfigData('title'));
            foreach ($errors as $key => $value) {
                $errorMsg = $value;
            }
            $error->setErrorMessage($errorMsg);
            return $error;
            // Display error message if there
        } else {
            $totalPriceArr = $response['totalprice'];
            $costArr = $response['costarr'];
            foreach ($totalPriceArr as $method => $price) {
                $rate = $this->_rateMethodFactory->create();
                $rate->setCarrier($this->_code);
                $rate->setCarrierTitle($this->getConfigData('title'));
                $methodCode = $this->getMethodCodeByName($method);
                $rate->setMethod($this->_code);
                $rate->setMethodTitle($method);
                $rate->setCost($costArr[$method]);
                $rate->setPrice($price);
                $result->append($rate);
            }
        }
        return $result;
    }

    /**
     * Get TrackingInfo
     */
    public function getTrackingInfo($trackingId)
    {
        $noInfoText = __('Tracking information not available.');
        try {
            if ($trackingId) {
                $gatewayUrl = $this->_delhiveryHelper->getGatewayUrl();
                $token = $this->_delhiveryHelper->getLicenseKey();
                $path = $gatewayUrl.'api/v1/packages/json/?waybill='.$trackingId.'&token='.$token;
                $retValue = $this->_delhiveryHelper->executeCurl($path, $token, 'GET', [], 'raw');
                $retValue = json_decode($retValue, true);
                if (!empty($retValue['ShipmentData'][0]['Shipment']['Status'])) {
                    $status = $retValue['ShipmentData'][0]['Shipment']['Status'];
                    $trackingInfo = "";
                    $result = $this->_trackFactory->create();
                    $carrierTitle = $this->getConfigData('title');
                    $tracking = $this->_trackStatusFactory->create();
                    $tracking->setCarrier(self::CODE);

                    $tracking->setTracking($trackingId);
                    foreach ($status as $key => $value) {
                        if ($value) {
                            $trackingInfo .= $key.' : '.$value.'; ';
                        }
                    }
                    $tracking->setCarrierTitle($carrierTitle.html_entity_decode($trackingInfo));
                    /*foreach ($status as $key => $value) {
                        $tracking->setData($key, $value);
                    }*/
                    $tracking->addData($status);
                    $result->append($tracking);
                    if ($result instanceof \Magento\Shipping\Model\Tracking\Result) {
                        $trackings = $result->getAllTrackings();
                        if ($trackings) {
                            return $trackings[0];
                        }
                    } elseif (is_string($result) && !empty($result)) {
                        return $result;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->delhiVeryLogger->addError('delhivert getTrackingInfo '.$e->getMessage());
        }
        return $noInfoText;
    }
}
