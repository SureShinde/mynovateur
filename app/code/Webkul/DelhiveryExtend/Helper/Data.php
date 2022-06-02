<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryExtend\Helper;

use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator;
use Webkul\DelhiveryShipping\Model\ManageawbFactory as AwbFactory;
use Webkul\DelhiveryShipping\Model\ResourceModel\Manageawb\CollectionFactory as AwbCollectionFactory;
use Magento\Sales\Model\OrderFactory as OrderFactory;
use Magento\Sales\Model\Order\AddressFactory as AddressFactory;
use Magento\Customer\Model\CustomerFactory as CustomerFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * DelhiveryExtend data helper.
 */
class Data extends \Webkul\DelhiveryShipping\Helper\Data
{
    const WAREHOUSE_CREATE_URL = "api/backend/clientwarehouse/create/";
    const WAREHOUSE_EDIT_URL = "api/backend/clientwarehouse/edit/";

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param DateTime $date
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param \Magento\Customer\Model\Session $customerSession
     * @param AwbCollectionFactory $awbCollectionFactory
     * @param AwbFactory $awbFactory
     * @param OrderFactory $orderFactory
     * @param AddressFactory $addressFactory
     * @param CustomerFactory $customerFactory
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Directory\Model\CountryFactory $countryFactory
     * @param \Webkul\DelhiveryExtend\Logger\Logger $logger
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
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
        \Webkul\DelhiveryExtend\Logger\Logger $logger,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Magento\Framework\View\Asset\Repository $assetRepo
    ) {
        $this->messageManager = $messageManager;
        $this->logger = $logger;
        $this->configWriter = $configWriter;
        $this->assetRepo = $assetRepo;
        parent::__construct(
            $context,
            $date,
            $storeManager,
            $resource,
            $customerSession,
            $awbCollectionFactory,
            $awbFactory,
            $orderFactory,
            $addressFactory,
            $customerFactory,
            $transportBuilder,
            $inlineTranslation,
            $jsonHelper,
            $productFactory,
            $countryFactory,
            $logger
        );
    }

    /**
     * Get Warehouse CreateUrl
     */
    public function getWarehouseCreateUrl()
    {
        $gatewayUrl = $this->getGatewayUrl();
        return $gatewayUrl.self::WAREHOUSE_CREATE_URL;
    }

    /**
     * Get Warehouse EditUrl
     */
    public function getWarehouseEditUrl()
    {
        $gatewayUrl = $this->getGatewayUrl();
        return $gatewayUrl.self::WAREHOUSE_EDIT_URL;
    }

    /**
     * Create Warehouse
     */
    public function createWarehouse($path, $warehouseData)
    {
        try {
            $token = $this->getLicenseKey();
            $type = 'POST';
            $warehouseData = $this->executeCurlRequest($path, $token, $type, $warehouseData);
            return $warehouseData;
        } catch (\Exception $e) {
            $this->logger->addError('DelhiveryExtend : '.$e->getMessage());
            return false;
        }
    }

    /**
     * Function to execute curl
     *
     * @param string $url
     * @param string $token
     * @param string $type
     * @param array $params
     * @return API response
     */
    public function executeCurlRequest($url, $token, $type, $params)
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
          CURLOPT_CUSTOMREQUEST => $type,
          CURLOPT_POSTFIELDS => $this->_jsonHelper->jsonEncode($params),
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json',
            'authorization: Token '.$token,
            'accept: application/json'
          ),
        ));

        $response = curl_exec($curl);
        return $this->_jsonHelper->jsonDecode($response);
    }

    /**
     * Get postal data Config
     *
     * @return bool
     */
    public function getPostalFileData($path)
    {
        return $this->_scopeConfig->getValue($path);
    }

    /**
     * Check to upload file
     *
     * @return bool
     */
    public function checkToUpload()
    {
        $config = 'mpassignproduct/postal_code/enable_upload';
        return $this->_scopeConfig->getValue($config);
    }

    /**
     * Set flag value to default
     *
     * @return bool
     */
    public function setCheckToDefault($path)
    {
        $value = '0';
        $this->configWriter->save($path, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
    }
    /**
     * Check to upload file
     *
     * @return bool
     */
    public function checkToUploadMassProductAssign()
    {
        $config = 'mpassignproduct/seller_product_assign/enable_product_assign_upload';
        return $this->_scopeConfig->getValue($config);
    }

    public function getSampleFileUrl($filename)
    {
       return $this->assetRepo->getUrl("Webkul_DelhiveryExtend::samples/". $filename);
    }
}
