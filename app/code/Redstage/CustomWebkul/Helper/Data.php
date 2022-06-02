<?php
/**
 * @category  Redstage
 * @package   Redstage_CustomWebkul
 * @copyright Copyright (c) Redstage - 2022
 */

namespace Redstage\CustomWebkul\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Stdlib\CookieManagerInterface as CookieManager;
use Webkul\MpAssignProduct\Model\AssociatesFactory as AssociatesFactory;
use Webkul\MpAssignProduct\Model\ItemsFactory as ItemsFactory;

/**
 * Product minimum price data helper.
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(
        Context $context,
        CookieManager $cookieManager,
        ItemsFactory $itemsFactory,
        AssociatesFactory $associatesFactory

    ) {
        $this->cookieManager = $cookieManager;
        $this->itemsFactory = $itemsFactory;
        $this->associatesFactory = $associatesFactory;
        parent::__construct($context);
    }
    /**
     * Get MinPriceSellerOfProduct
     */
    public function getMinPriceSellerOfProduct($product)
    {
        //echo "asdadsasd"; die;
        $customerZipCode = $this->cookieManager->getCookie('zip_data');
        $productType = $product->getTypeId();
        if ($productType == 'simple') {
            $collection = $this->itemsFactory->create()->getCollection()
                ->addFieldToFilter('main_table.product_id', ['eq' => $product->getId()])
                ->addFieldToFilter('main_table.qty', ['gt' => 0])
                ->setOrder('main_table.price', 'ASC');
        } else {
            $parentIds = $this->associatesFactory->create()->getCollection()
                ->addFieldToFilter('main_table.parent_product_id', ['eq' => $product->getId()])
                ->addFieldToFilter('main_table.qty', ['gt' => 0])
                ->getColumnValues('parent_id');
            $parentIds = !empty($parentIds) ? array_unique($parentIds) : [0];
            $collection = $this->itemsFactory->create()->getCollection()
                ->addFieldToFilter('main_table.id', ['in' => $parentIds])
                ->addFieldToFilter('main_table.product_id', ['eq' => $product->getId()])
                ->setOrder('main_table.price', 'ASC');
        }
        $connection = $collection->getConnection();
        $sellerTable = $connection->getTableName('marketplace_userdata');
        $collection->getSelect()->join(
            $sellerTable . ' as st',
            'main_table.seller_id = st.seller_id AND st.is_seller = 1',
            [
                'price' => 'main_table.price',
                'seller_id' => 'dpsm.seller_id',
                'product_id' => 'main_table.product_id',
                'assigned_id' => 'main_table.id',
            ]
        );
        $collection->setOrder('main_table.id', 'ASC');
        $sellerPostalRecord = $connection->getTableName('wk_delhivery_pincode_seller_map');
        $collection->getSelect()->join(
            $sellerPostalRecord . ' as dpsm',
            'main_table.seller_id = dpsm.seller_id'
        )->where(
            'dpsm.pincode = ' . $customerZipCode
        );
        $productInfo = $collection->setPageSize(1)->setCurPage(1)->getFirstItem()->getData();
        return empty($productInfo) ? false : $productInfo;
    }
}
