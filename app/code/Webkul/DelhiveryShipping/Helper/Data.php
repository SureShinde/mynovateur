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

namespace Webkul\DelhiveryShipping\Helper;

use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator;
use Webkul\DelhiveryShipping\Model\ManageawbFactory as AwbFactory;
use Webkul\DelhiveryShipping\Model\ResourceModel\Manageawb\CollectionFactory as AwbCollectionFactory;
use Magento\Sales\Model\OrderFactory as OrderFactory;
use Magento\Sales\Model\Order\AddressFactory as AddressFactory;
use Magento\Customer\Model\CustomerFactory as CustomerFactory;

/**
 * delhiveryShipping data helper.
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const PINCODE_URL = "c/api/pin-codes/";
    const INVOICE_URL = "api/kinko/v1/invoice/charges/";
    const AWB_URL = "waybill/api/bulk/";
    const PACKING_SLIP_URL = "api/p/packing_slip?wbns=";
    //const PACKAGE_CREATE_URL = "cmu/push/json/?token=";
    const PACKAGE_CREATE_URL = "api/cmu/create.json";

    /**
     * @var Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    protected $_template;

    /**
     * @param Magento\Framework\App\Helper\Context        $context
     * @param Magento\Store\Model\StoreManagerInterface   $_storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        DateTime $date,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Customer\Model\Session $customerSession,
        AwbCollectionFactory $awbCollectionFactory,
        AwbFactory $awbFactory,
        OrderFactory $orderFactory,
        AddressFactory $addressFactory,
        CustomerFactory $customerFactory,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Webkul\DelhiveryExtend\Logger\Logger $logger
    ) {
        $this->_date = $date;
        $this->_storeManager = $storeManager;
        $this->connection = $resource->getConnection();
        $this->_customerSession = $customerSession;
        $this->_scopeConfig = $context->getScopeConfig();
        $this->_awbCollectionFactory = $awbCollectionFactory;
        $this->_awbFactory = $awbFactory;
        $this->_orderFactory = $orderFactory;
        $this->_addressFactory = $addressFactory;
        $this->_customerFactory = $customerFactory;
        $this->_transportBuilder = $transportBuilder;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_jsonHelper = $jsonHelper;
        $this->_productFactory = $productFactory;
        $this->countryFactory = $countryFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Get Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * function to get Config Data.
     * @return string
     */
    public function getConfigValue($field = false)
    {
        if ($field) {
            return $this->scopeConfig
                    ->getValue(
                        $field,
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                        $this->getStoreId()
                    );
        } else {
            return;
        }
    }

    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function getGatewayUrl()
    {
        //for production http://track.delhivery.com/
        return $this->getConfigValue('carriers/delhivery/gateway_url');
    }

    public function getLicenseKey()
    {
        return $this->getConfigValue('carriers/delhivery/licensekey');
    }

    public function getClientName()
    {
        return $this->getConfigValue('carriers/delhivery/name');
    }

    public function getClientId()
    {
        return $this->getConfigValue('carriers/delhivery/clientid');
    }

    public function getWarehouseName()
    {
        return $this->getConfigValue('carriers/delhivery/pickup');
    }

    public function getPincodeUrl()
    {
        $gateway_url = $this->getGatewayUrl();
        $url = $gateway_url.self::PINCODE_URL;
        return $url;
    }

    public function getAwbUrl()
    {
        $gateway_url = $this->getGatewayUrl();
        $url = $gateway_url.self::AWB_URL;
        return $url;
    }

    public function getInvoiceUrl()
    {
        $gateway_url = $this->getGatewayUrl();
        return $gateway_url.self::INVOICE_URL;
    }

    public function getPackingSlipUrl()
    {
        $gateway_url = $this->getGatewayUrl();
        $url = $gateway_url.self::PACKING_SLIP_URL;
        return $url;
    }

    public function getPackageCreateUrl()
    {
        $gateway_url = $this->getGatewayUrl();
        $url = $gateway_url.self::PACKAGE_CREATE_URL;
        return $url;
    }

    public function getStoreName()
    {
        return $this->getConfigValue('general/store_information/name');
    }

    public function getStorePhone()
    {
        return $this->getConfigValue('general/store_information/phone');
    }

    public function getStoreCity()
    {
        return $this->getConfigValue('shipping/origin/city');
    }

    public function getStoreCountry()
    {
        return $this->getConfigValue('shipping/origin/country_id');
    }

    public function getStoreState()
    {
        return $this->getConfigValue('shipping/origin/region_id');
    }

    public function getStorePin()
    {
        return $this->getConfigValue('shipping/origin/postcode');
    }

    public function getStoreStreet()
    {
        return $this->getConfigValue('shipping/origin/street_line1');
    }

    /*
    * Function to execute curl
    * @return API response
    */
    public function executeCurl($url, $token, $type, $params, $requestType = 'raw')
    {
        $requestList = [
            'raw' => 'application/x-www-form-urlencoded',
            'json' => 'application/json'
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $type,
          CURLOPT_POSTFIELDS => $requestType == 'raw' ? http_build_query($params) : json_encode($params),
          CURLOPT_HTTPHEADER => array(
            'content-type: '.$requestList[$requestType],
            'authorization: Token '.$token,
            'accept: application/json'
          ),
        ));
        $retValue = curl_exec($curl);
        curl_close($curl);
        return $retValue;
    }

    /*
    * Function to execute curl
    * @return API response
    */
    public function executeCurlForRate($url, $token, $type, $params)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json',
            'authorization: Token '.$token,
            'accept: application/json'
          ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function saveManifest($order, $sellerWarehouse=[], $requestPackage=[])
    {
        try {
            $trackingNumber = 0;
            $url = $this->getPackageCreateUrl();
            $token = $this->getLicenseKey();
            $clientId = $this->getClientId();
            $trackingNumber = 0;
            if ($url =="" || $token =="" || $clientId =="") {
                throw new \Magento\Framework\Exception\LocalizedException(__('Please add valid License Key, Client ID and Gateway URL in plugin configuration'));
            }

            if (!empty($sellerWarehouse) && !empty($requestPackage)) {
                $warehouseName = $sellerWarehouse['name'];
                $weight = 0;
                $totalPrice = 0;
                $itemsQty = 0;
                $itemsDesc = [];
                $nofPacket = 1;
                foreach ($requestPackage as $packageInfo) {
                    $weight = $packageInfo['params']['weight'] * 1000;
                    $nofPacket = $packageInfo['params']['no_of_packet'] ?? 1;
                    foreach ($packageInfo['items'] as $reqItem) {
                        //$weight += $reqItem['weight'];
                        $itemsDesc[] = $reqItem['name'];
                        $totalPrice += $reqItem['price'];
                        $itemsQty += $reqItem['qty'];
                    }
                }

                //$url .= $token;
                $address = $this->_addressFactory->create()->load($order->getShippingAddressId());
                $sellerAdd = $this->setReturnAddress($sellerWarehouse);

                $pickupLocation = [
                    "add" => $sellerAdd['add'],
                	"city"=> $sellerAdd['city'],
                	"country"=> $sellerAdd['country'],
                	"name"=> $warehouseName,
                	"phone"=> $sellerAdd['phone'],
                	"pin"=> $sellerAdd['pin']
                ]; // package data feed

                $methodcode = 'Prepaid';//($order->getPayment()->getMethodInstance()->getCode() == 'cashondelivery' ) ? 'COD' :'Prepaid';
                $codamount = $totalPrice;//($order->getPayment()->getMethodInstance()->getCode()  == 'cashondelivery' ) ? $order->getGrandTotal() : "00.00";
                //list($totalPrice, $itemsQty, $itemsDesc) = $this->getItemInfo($order);
                /////////////start: building the package feed/////////////////////
                # shipment details
                $shipment = [
                    'waybill' => "",
                    'client' => $this->getClientName(),
                    'name' => $address->getName(),
                    'order' => $order->getIncrementId().'--'.rand(0, 9999),
                    'products_desc' => $itemsDesc[0],
                    'order_date' => $order->getCreatedAt(),
                    'payment_mode' => $methodcode,
                    'total_amount' => $totalPrice,
                    'cod_amount' => $codamount,
                    'add' => $address['street'],
                    'city' => $address->getCity(),
                    'country' => $address->getCountryId(),
                    'pin' => $address->getPostcode(),
                    # return fields where the package has to be returned in case not delivered
                    'return_add' => $sellerAdd['add'],
                    'return_city' => $sellerAdd['city'],
                    'return_country' => $sellerAdd['country'],
                    'return_name' => $sellerAdd['name'],
                    'return_state' => $sellerAdd['state'],
                    'return_phone' => $sellerAdd['phone'],
                    'return_pin' => $sellerAdd['pin'],
                    # seller weight and dimensions
                    'weight' => $weight,
                    'quantity' => $itemsQty,
                ];
                /////////////////////
                if ($nofPacket > 1) {
                    $shipment['sst'] = "mps";
                    $shipment['package_count'] = $nofPacket;
                    $shipment['hsn_code'] = "mps";
                    $shipment['seller_inv'] = 'Random : '.rand(999, 999999);
                }

                if ($address->getRegion()) {
                     $shipment['state'] = $address->getRegion();
                }
                if ($address->getTelephone()) {
                    $shipment['phone'] = $address->getTelephone();
                }
                /////////////end: building the package feed/////////////////////
                $packageData = [
                    'shipments' => [$shipment],
                    'pickup_location' => $pickupLocation
                ];

                $params = [
                    'format' => 'json',
                    'data' => $this->_jsonHelper->jsonEncode($packageData)
                ]; // this will contain request meta and the package feed
                $result = $this->executeCurl($url, $token, 'POST', $params);
                $result = $this->_jsonHelper->jsonDecode($result);
                if (isset($result['success']) && $result['success']==1) {
                    $trackingNumber = $result['packages'][0]["waybill"] ?? 0;
                    return $trackingNumber;
                } else {
                    $error = $result['packages'][0]["remarks"][0] ?? "There are some error during manifest submit";
                    $this->logger->addError('package create : '.json_encode($result));
                    throw new \Magento\Framework\Exception\LocalizedException(__($error));
                }
            }
        } catch (\Exception $e) {
            $this->logger->addError('saveManifest : '.$e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        }
    }

    public function getItemInfo($order)
    {
        $totalPrice = 0;
        $itemsQty = 0;
        $itemsDesc = [];
        foreach ($order->getAllItems() as $itemShipment) {
            if ($itemShipment->getProduct()->isVirtual() || $itemShipment->getParentItem()) {
                continue;
            }

            if ($totalPrice == 0) {
                $totalPrice = $order->getGrandTotal();
            }
            $itemsQty += $itemShipment->getQtyOrdered();
            $itemsDesc[] = $itemShipment->getName();
        }
        return [$totalPrice, $itemsQty, $itemsDesc];
    }

    /**
     * [sendNewSellerRequest description].
     *
     * @param Mixed $emailTemplateVariables
     * @param Mixed $senderInfo
     * @param Mixed $receiverInfo
     */
    public function sendNotificationMailToAdmin($emailTemplateVariables, $senderInfo, $receiverInfo)
    {
        $templateOptions = [
            'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
            'store' => $this->_storeManager->getStore()->getId()
        ];
        $this->_inlineTranslation->suspend();
        $transport = $this->_transportBuilder->setTemplateIdentifier('notify_admin_for_awb')
                        ->setTemplateOptions($templateOptions)
                        ->setTemplateVars($emailTemplateVariables)
                        ->setFrom($senderInfo)
                        ->addTo($receiverInfo)
                        ->getTransport();
        $transport->sendMessage();
        $this->_inlineTranslation->resume();
    }

    /**
     * [executeShippingLabelCurl generate shipping label].
     *
     * @param string $trackingNumber
     */
    public function executeShippingLabelCurl($trackingNumber)
    {
        $token = $this->getLicenseKey();
        $url = $this->getPackingSlipUrl().$trackingNumber;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json','Authorization: Token '.$token]);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * Set Return Address
     *
     * @param array $sellerWarehouse
     * @return array
     */
    public function setReturnAddress($sellerWarehouse)
    {
        $returnAdd = [
            'add' => implode(" ", json_decode($sellerWarehouse['street'], true)),
            'phone' => $sellerWarehouse['telephone'],
            'name' => $sellerWarehouse['company'],
            'city' => $sellerWarehouse['city'],
            'state' => $sellerWarehouse['region'],
            'country' => $this->countryFactory->create()
                                ->loadByCode($sellerWarehouse['country_id'])->getName(),
            'pin' => $sellerWarehouse['postal_code'],
        ];
        return $returnAdd;
    }

    /**
     * Function returnErrorFromConfig
     *
     * @return int
     */
    public function returnErrorFromConfig()
    {
        return $this->_scopeConfig->getValue(
            'carriers/delhivery/specificerrmsg',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Function isMultiShippingActive
     */
    public function isMultiShippingActive()
    {
        if ($this->_moduleManager->isOutputEnabled("Webkul_MpMultiShipping") &&
        $this->_scopeConfig->getValue('carriers/mpmultishipping/active')) {
            return true;
        }
        return false;
    }

    /**
     * Update Data for given condition for collection
     *
     * @param int|string $limit
     * @param int|string $offset
     * @return array
     */
    public function setTableRecords($condition, $columnData, $tableName)
    {
        return $this->connection->update(
            $this->connection->getTableName($tableName),
            $columnData,
            $where = $condition
        );
    }
}
