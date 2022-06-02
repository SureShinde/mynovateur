<?php
/**
 * Webkul Software.
 *
 * @category  Webkul_DelhiveryExtend
 *
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryExtend\Observer;

use Magento\Framework\Event\ObserverInterface;

class PricecalculationsAfterAddtoCart implements ObserverInterface
{
    /**
     * @param \Magento\Framework\App\ResponseFactory $responseFactory
     * @param \Webkul\MpAssignProduct\Helper\Data $helper
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory
     * @param \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     * @param \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger
     */
    public function __construct(
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Webkul\MpAssignProduct\Helper\Data $helper,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Webkul\DelhiveryExtend\Logger\Logger $delhiVeryLogger
    ) {
        $this->messageManager = $messageManager;
        $this->helper = $helper;
        $this->responseFactory = $responseFactory;
        $this->delhiVeryLogger = $delhiVeryLogger;
        $this->itemsFactory = $itemsFactory;
        $this->associatesFactory = $associatesFactory;
        $this->cookieManager = $cookieManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $quoteItem = $observer->getEvent()->getQuoteItem();
            $buyRequest = $quoteItem->getBuyRequest()->getData();
            if (isset($buyRequest['assigned_id']) && $buyRequest['assigned_id']) {
                $productType = $quoteItem->getProductType();
                $productInfo = $this->itemsFactory->create()->load($buyRequest['assigned_id']);
                $sellerId = $productInfo->getSellerId();
                $this->delhiVeryLogger->addError($productType.$sellerId);
                switch ($productType) {
                    case 'configurable':
                        $childItem = $quoteItem->getChildren();
                        $childItemId = 0;
                        foreach ($childItem as $key => $value) {
                            $childItemId = $value->getProductId();
                        }
                        $assProInfo = $this->associatesFactory->create()->getCollection();
                        $assItemTable = $assProInfo->getTable('marketplace_assignproduct_items');
                        $condition = 'ait.seller_id = '.$sellerId.' AND main_table.parent_id ='
                                    .$buyRequest['assigned_id'].' AND main_table.product_id = '.$childItemId;
                        $assProInfo->getSelect()->join(
                            $assItemTable.' as ait',
                            'main_table.parent_product_id = ait.product_id',
                            ['price' => 'main_table.price']
                        )->where($condition);
                        $productInfo = $assProInfo->setPageSize(1)->setCurPage(1)->getFirstItem();
                        break;
                }
                if ($productInfo && $productInfo->getId()) {
                    $options = $quoteItem->getProduct()->getTypeInstance(true)->getOrderOptions($quoteItem->getProduct());
                    $optionCost = 0;
                    if (isset($options['options'])) {
                        $optionsColl = $quoteItem->getProduct()->getProductOptionsCollection();
                        foreach ($options['options'] as $opt) {
                            $optionObj = $optionsColl->getItemById($opt['option_id']);
                            $optionCost += $optionObj->getPrice() == null ?
                                $optionObj->getValues()[$opt['option_value']]->getPrice() : $optionObj->getPrice();
                        }

                    }
                    $price = $productInfo->getPrice() + $optionCost;
                    $quoteItem->setCustomPrice($price);
                    $quoteItem->setOriginalCustomPrice($price);
                    $buyRequest['seller_id'] = $sellerId;
                    $buyRequest['postal_code'] = $this->cookieManager->getCookie('zip_data');

                    $quoteItem->addOption([
                        'product_id' => $quoteItem->getProductId(),
                        'code' => 'info_buyRequest',
                        'value' => json_encode($buyRequest)
                    ]);
                } else {
                    $this->messageManager->addNotice(__('Seller have no item for your location.'));
                    $quoteItem->delete();
                }
            }
        } catch (\Exception $e) {
            $this->delhiVeryLogger->addError($e->getMessage().json_encode($options));
        }
    }
}
