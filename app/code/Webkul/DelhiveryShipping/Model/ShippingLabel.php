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

use Magento\Customer\Model\Session;
use Dompdf\Dompdf;
use Magento\Framework\App\Filesystem\DirectoryList as Directory;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * DelhiveryShipping ShippingLabel Model
 *
 * @method \Webkul\DelhiveryShipping\Model\ResourceModel\Manageawb _getResource()
 */
class ShippingLabel extends \Magento\Sales\Model\Order\Pdf\Shipment
{
    const API_URL = "http://api.html2pdfrocket.com/pdf";
    const API_KEY = "e866ccc9-2508-4990-8c01-6fbd466fdb69";
    /**
     * Y coordinate
     *
     * @var int
     */
    public $y;

    /**
     * Zend PDF object
     *
     * @var Zend_Pdf
     */
    protected $_pdf;

    /**
     * Generate Shipment Label Content for each Waybill
     *
     * @param Zend_Pdf_Page $page
     * @param null $store
     */
    public function __construct(
        Session $customerSession,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Sales\Model\Order\Pdf\Config $pdfConfig,
        \Magento\Sales\Model\Order\Pdf\Total\Factory $pdfTotalFactory,
        \Magento\Sales\Model\Order\Pdf\ItemsFactory $pdfItemsFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Sales\Model\Order\Address\Renderer $addressRenderer,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Locale\ResolverInterface $localeResolver,
        \Magento\Shipping\Model\Shipping\LabelGenerator $labelGenerator,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Webkul\DelhiveryShipping\Helper\Data $delhiveryHelper,
        \Magento\Store\Model\App\Emulation $appEmulation,
        DateTime $date,
        array $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->_objectManager = $objectManager;
        $this->_string = $string;
        $this->_labelGenerator = $labelGenerator;
        $this->_fileFactory = $fileFactory;
        $this->_storeManager = $storeManager;
        $this->_delhiveryHelper = $delhiveryHelper;
        $this->_date = $date;
        parent::__construct(
            $paymentData,
            $string,
            $scopeConfig,
            $filesystem,
            $pdfConfig,
            $pdfTotalFactory,
            $pdfItemsFactory,
            $localeDate,
            $inlineTranslation,
            $addressRenderer,
            $storeManager,
            $appEmulation,
            $data
        );
    }

    public function getPdfData($result)
    {
        $delhLogoHtml = '';
        $sellerLogoHtml = '';
        $store = $this->_delhiveryHelper->getStoreId();
        $delhiveryLogo = $this->_scopeConfig
            ->getValue(
                'carriers/delhivery/delhivery_logo',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $store
            );
        $delhiveriLogoPath = 'delhivery/logo/'.$delhiveryLogo;
        if ($this->_mediaDirectory->isFile($delhiveriLogoPath)) {
               $delhiLogoUrl =  $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).$delhiveriLogoPath;
               $delhLogoHtml = '<div style="width:49%; height:100%;float:left;">
                                    <img style="width:250px;height:45px;margin:5px;" src="'.$delhiLogoUrl.'">
                                </div>';
        }

        $sellerImage = $this->_scopeConfig
        ->getValue(
            'sales/identity/logo',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );

        if ($sellerImage) {
            $sellerImagePath = '/sales/store/logo/'.$sellerImage;
            $sellerLogoUrl =  $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).$sellerImagePath;
            $sellerLogoHtml = '<div style="width:49%; height:100%;float:left;border-right:1px solid">
                                        <img style="width:250px;height:45px;margin:5px;" src="'.$sellerLogoUrl.'">
                                    </div>';
        }
        $html='';
        foreach ($result->packages as $key => $package) {
            $date = date('d/m/y', strtotime($package->cd));
            $shipAdd = $package->address.','.$package->destination_city;
            $sellerAdd = $package->radd.','.$package->rcty.','.$package->rst;
            $priceHelper = $this->_objectManager->create('Magento\Framework\Pricing\Helper\Data');
            $formattedPrice = $priceHelper->currency($package->rs, true, false);
            $mpscount = $package->mpscount ?? 1;
            for ($i=0; $i < $mpscount; $i++) {
                $mpSeq = $mpscount == 1 ? '' : ($i+1).'/'.$mpscount;
                $html .= '<div style="width:600px;height:auto;border:1px solid">
                        <div style="width:100%;height:60px;border-bottom:1px solid;">
                            '.$sellerLogoHtml.'
                            '.$delhLogoHtml.'
                        </div>
                        <div style="width:100%;height:150px;border-bottom:1px solid;">
                            <div style="width:65%; height:100%;float:left;">
                                <img style="width:250px;height:80px;margin:35px;" src="'.$package->barcode.'">
                            </div>
                            <div style="width:30%; height:100%;float:left;">
                                <div style="width:100%;height:50%;float:left;">
                                    <span style="text-align:right"><h4>'.$package->pin.'</h4><span>
                                </div>
                                <div style="width:100%;height:100%;float:left;">
                                    <span style="text-align:right"><h1>'.$package->sort_code.'</h1><span>
                                </div>
                            </div>
                        </div>
                        <div style="width:100%;height:200px;border-bottom:1px solid;">
                            <div style="width:65%; height:100%;float:left;border-right:1px solid;">
                                <div style="padding:5px;">
                                    <span><strong>'.__('Shipping Address :-').'</strong></span>
                                    '. /*<strong>'.__('Phone No. :-').''.$package->rph.'</strong><br>*/'
                                    <h2>'.$package->name.'</h2>
                                    <p>'.$shipAdd.'</p><br>
                                    <strong>'.__('PinCode:-').''.$package->pin.'</strong>
                                </div>
                            </div>
                            <div style="width:30%; height:100%;float:left;">
                                <div style="width:100%;float:left;text-align:center;">
                                    <span><h1>'.$package->pt.'</h1></span>
                                    <h4>'.$formattedPrice.'</h4>
                                </div>
                                <div style="width:100%;float:left;text-align:center;">
                                    <h1>'.$mpSeq.'</h1>
                                </div>
                            </div>
                        </div>
                        <div style="width:100%;height:150px;border-bottom:1px solid;">
                            <div style="width:60%; height:100%;float:left;border-right:1px solid;">
                                <div style="padding:5px;">
                                    <span><strong>'.__('Seller :-').''.$package->snm.'</strong></span><br>
                                    <span><strong>'.__('Address :-').'</strong></span>'.$sellerAdd.','.__('Pincode-').$package->rpin.','.__('Cell No.-').$package->contact.'
                                </div>
                            </div>
                            <div style="width:30%; height:100%;float:left;">
                                <div style="width:100%;float:left;padding:5px;"">
                                    <span style="line-height:24px;"><strong>'.__('Tin:').'</strong>'.$package->tin.'</span><br>
                                    <span style="line-height:24px;"><strong>'.__('CST:').'</strong>'.$package->cst.'</span><br>
                                    <span style="line-height:24px;"><strong>'.__('INVOICE NO.:').'</strong></span><br>
                                    <span style="line-height:24px;"><strong>'.__('DT.:').'</strong>'.$date.'</span><br>
                                </div>
                            </div>
                        </div>
                        <div style="width:100%;height:150px;border-bottom:1px solid;">
                            <div style="float:left;width:60%;height:20px;border-bottom:1px solid;border-right:1px solid;">
                                <span>'.__('Product Name').'</span>
                            </div>
                            <div style="float:left;width:19.5%;height:20px;text-align:center;border-bottom:1px solid;">
                                <span>'.__('Price').'</span>
                            </div>
                            <div style="float:left;width:19.5%;height:20px;text-align:center;border-bottom:1px solid;border-left:1px solid;">
                                <span>'.__('Total').'</span>
                            </div>
                            <div style="float:left;width:60%;height:93px;border-bottom:1px solid;border-right:1px solid;">
                                <span style="line-height:85px;">'.$package->prd.'</span>
                            </div>
                            <div style="float:left;width:19.5%;text-align:center;height:93px;border-bottom:1px solid;">
                                <span style="line-height:85px;">'.$formattedPrice.'</span>
                            </div>
                            <div style="float:left;width:19.5%;height:93px;text-align:center;border-bottom:1px solid;border-left:1px solid;">
                                <span style="line-height:85px;">'.$formattedPrice.'</span>
                            </div>
                            <div style="float:left;width:60%;height:35px;border-bottom:1px solid;border-right:1px solid;">
                                <span>'.__('Total').'</span>
                            </div>
                            <div style="float:left;width:19.5%;height:35px;text-align:center;border-bottom:1px solid;">
                                <span>'.$formattedPrice.'</span>
                            </div>
                            <div style="float:left;width:19.5%;height:35px;text-align:center;border-bottom:1px solid;border-left:1px solid;">
                                <span>'.$formattedPrice.'</span>
                            </div>
                        </div>
                        <div style="width:100%;height:100;">
                            <div style="width:35%; height:100%;float:left;">
                                <img style="width:150px;height:50px;margin:22px;" src="'.$package->oid_barcode.'">
                            </div>
                            <div style="width:60%; height:100%;float:left;">
                                <div style="width:100%;height:100%;float:left;margin:2px;">
                                    <span>'.__('Return Address:').$sellerAdd.','.__('Pincode-').$package->rpin.','.__('Cell No.-').$package->contact.'
                                    <span>
                                </div>
                            </div>
                        </div>
                    </div></br></br>
                    </br></br>';
                }
        }

        $apiUrl = self::API_URL;
        $postdata = http_build_query(
            [
                'apikey' => self::API_KEY,
                'value' => $html,
                'MarginTop' => '10',
                'MarginLeft' => '30',

            ]
        );

        $opts = [
            'http' =>
                [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                ]
            ];

        $context  = stream_context_create($opts);

        // Convert the HTML string to a PDF using those parameters
        $result = file_get_contents($apiUrl, false, $context);

        $this->_fileFactory->create(
            'DelhiveryShippingLabels.pdf',
            $result,
            Directory::VAR_DIR,
            'application/pdf'
        );
    }
}
