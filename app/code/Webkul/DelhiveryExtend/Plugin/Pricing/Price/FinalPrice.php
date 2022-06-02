<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @author    Webkul DelhiveryExtend
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

 namespace Webkul\DelhiveryExtend\Plugin\Pricing\Price;

 /**
  * Final price model
  */
 class FinalPrice
 {
     /**
      * @param \Webkul\DelhiveryExtend\Block\Product\Products $products
      */
     public function __construct(
         \Webkul\DelhiveryExtend\Block\Product\Products $products
     ) {
         $this->products = $products;
     }

     /**
      * arounndGetValue
      */
     public function aroundGetValue(\Magento\Catalog\Pricing\Price\FinalPrice $subject, callable $proceed)
     {
         $lowestSellerPrice = $this->products->getAssignedProducts();
         if ($lowestSellerPrice) {
             $lowestSellerPrice = $lowestSellerPrice->setPageSize(1)->setCurPage(1)->getFirstItem()->getData();
         }
         $productId = $subject->getProduct()->getEntityId();
         return !empty($lowestSellerPrice) && $lowestSellerPrice['product_id'] == $productId ? max(0, $lowestSellerPrice['price']) : $proceed();
     }
 }
?>
