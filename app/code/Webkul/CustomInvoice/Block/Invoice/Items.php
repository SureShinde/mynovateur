<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomInvoice
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\CustomInvoice\Block\Invoice;

class Items extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        \Webkul\Marketplace\Model\SaleslistFactory $saleslistFactory,
        \Webkul\CustomInvoice\Model\SellerInvoiceFactory $sellerInvoiceFactory,
        array $data = []
    ) {
        $this->httpContext = $httpContext;
        $this->saleslistFactory = $saleslistFactory;
        $this->sellerInvoiceFactory = $sellerInvoiceFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get Invoice Items
     *
     * @return array
     */
     public function getInvoiceItems()
     {
         $orderId = $this->getRequest()->getParam('id');
         $sellerId = $this->httpContext->getValue('customer_id');
         $catProName = $this->saleslistFactory->create()->getCollection()
                            ->getConnection()->getTableName('catalog_product_entity');
         $itemList = $this->saleslistFactory->create()->getCollection()
                                ->addFieldToFilter('order_id', $orderId)
                                ->addFieldToFilter('seller_id', $sellerId);
         $itemList->getSelect()->join(
            ['pro' => $catProName],
            'pro.entity_id= main_table.mageproduct_id',
            ['sku' => 'pro.sku']
        );
        return $itemList;
     }

     /**
      * Get Custom Invoice record
      *
      * @return \Webkul\CustomInvoice\Model\SellerInvoice
      */
      public function getCustomInvoiceRecord()
      {
          $orderId = $this->getRequest()->getParam('id');
          $sellerId = $this->httpContext->getValue('customer_id');
          $customInvoiceData = $this->sellerInvoiceFactory->create()->getCollection()
                                     ->addFieldToFilter('order_id', $orderId)
                                     ->addFieldToFilter('seller_id', $sellerId)
                                     ->setPageSize(1)->setCurPage(1)->getFirstItem();
         return $customInvoiceData;
      }
}
