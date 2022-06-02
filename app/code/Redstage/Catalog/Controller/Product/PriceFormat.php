<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Redstage\Catalog\Controller\Product;

class PriceFormat extends \Magento\Framework\App\Action\Action 
{
   /**
     * @var Magento\Framework\Pricing\Helper\Data
     */
    private $pricingHelper;

   /**
    * @param \Magento\Framework\App\Action\Context $context
    * @param \Magento\Framework\Pricing\Helper\Data $pricingHelper 
    */
   public function __construct(
      \Magento\Framework\App\Action\Context $context,      
      \Magento\Framework\Pricing\Helper\Data $pricingHelper        
   )
   {
      $this->pricingHelper = $pricingHelper;
      return parent::__construct($context);
   }

   public function execute()
   {
      $price = $this->getRequest()->getParam('totalPrice');

      echo $this->getCurrencySymbol($price);
   }

   public function getCurrencySymbol($price){
      return $this->pricingHelper->currency($price, true, false);
   }
}