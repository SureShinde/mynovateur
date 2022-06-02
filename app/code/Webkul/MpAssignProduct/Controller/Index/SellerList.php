<?php
namespace Webkul\MpAssignProduct\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;
use Webkul\MpAssignProduct\Model\AssociatesFactory;
use Webkul\MpAssignProduct\Model\ItemsFactory;
use Webkul\DelhiveryShipping\Model\Carrier;

class SellerList extends \Magento\Framework\App\Action\Action
{
    public const COOKIE_NAME = 'zip_data';

    public const XML_PATH_SHIPCOST_STATUS = 'carriers/delhivery/cost_on_page';

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param CookieManagerInterface $cookieManager
     * @param ScopeConfigInterface $scopeConfig,
     * @param AssociatesFactory $associatesFactory
     * @param ItemsFactory $itemsFactory
     * @param Carrier $carrier
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CookieManagerInterface $cookieManager,
        ScopeConfigInterface $scopeConfig,
        PriceHelper $priceHelper,
        AssociatesFactory $associatesFactory,
        ItemsFactory $itemsFactory,
        Carrier $carrier
    ) {
	    $this->jsonFactory = $jsonFactory;
        $this->cookieManager = $cookieManager;
        $this->scopeConfig = $scopeConfig;
        $this->priceHelper = $priceHelper;
        $this->associatesFactory = $associatesFactory;
        $this->itemsFactory = $itemsFactory;
        $this->carrier = $carrier;
        parent::__construct($context);
    }

    public function execute()
    {
        $jsonFactory = $this->jsonFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (isset($data['proId']) && $data['proId']) {
            $postalCode = $this->cookieManager->getCookie('zip_data');
            $associatesProColl = $this->associatesFactory->create()->getCollection()
                                ->addFieldToFilter('main_table.product_id', ['eq'=>$data['proId']])
                                ->addFieldToFilter('main_table.qty', ['gt'=>0]);
            $connection = $associatesProColl->getConnection();
            $itemTable = $connection->getTableName('marketplace_assignproduct_items');
            $associatesProColl->getSelect()->join(
                $itemTable.' as mai',
                'main_table.parent_id = mai.id',
                [
                    'seller_id' => 'mai.seller_id',
                    'assign_pro_id' => 'mai.id'
                ]
            );
            $sellerTable = $connection->getTableName('marketplace_userdata');
            $associatesProColl->getSelect()->join(
                $sellerTable.' as sud',
                'mai.seller_id = sud.seller_id AND sud.is_seller = 1',
                [
                    'seller_price' =>  'main_table.price',
                    'shop_url' => 'sud.shop_url'
                ]
            );
            $sellerOrigin = $connection->getTableName('marketplace_shipping_setting');
            $associatesProColl->getSelect()->join(
                $sellerOrigin.' as mss',
                'mai.seller_id = mss.seller_id',
                ['seller_origin' => 'mss.postal_code']
            );
            $sellerPostalRecord = $connection->getTableName('wk_delhivery_pincode_seller_map');
            $associatesProColl->getSelect()->join(
                $sellerPostalRecord.' as dpsm',
                'mai.seller_id = dpsm.seller_id',
                ['pincode' => 'dpsm.pincode']
            )->where(
                'dpsm.pincode = '.$postalCode
            );
            $associatesProColl->setOrder('main_table.price', 'ASC');
            $sellerInfo = $associatesProColl->getData();
            $sellerInfoList = [];
            foreach ($sellerInfo as $seller) {
                $shipStatus = $this->scopeConfig->getValue(self::XML_PATH_SHIPCOST_STATUS, ScopeInterface::SCOPE_STORE);
                $shipPrice = $shipStatus ? $this->carrier->getDeliveryShipingCost(
                    $seller['seller_origin'],
                    $postalCode,
                    $seller['product_id']
                ) : 0;
                $sellerInfoList[] = [
                    'seller_price' => $this->priceHelper->currency($seller['seller_price'], true, false),
                    'assign_pro_id' => $seller['assign_pro_id'],
                    'seller_store_url' => $this->_url->getUrl(
                        'marketplace/seller/profile',
                        ['shop' => $seller['shop_url']]
                    ),
                    'seller_price_base' => $seller['seller_price'],
                    'ship_price' => $this->priceHelper->currency($shipPrice, true, false),
                    'shop_url'=> $seller['shop_url']
                ];
            }
            $result = ['status'=> 1, 'sellerList' => $sellerInfoList];
        } else {
            $result = ['status'=> 0, 'msg' => __('No seller available.')];
        }
        return $jsonFactory->setData($result);
    }
}
