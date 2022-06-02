<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Redstage\BoqConfigurator\Controller\Product;

class PriceSymbol extends \Magento\Framework\App\Action\Action 
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

   /**
     * PriceSymbol action
     *
    */
   public function execute()
   {
        $qty = $this->getRequest()->getParam('qty');
        $price = $this->getRequest()->getParam('price');
        echo $this->getCurrencySymbol($price * $qty);
   }

   public function getCurrencySymbol($price){
      return $this->pricingHelper->currency($price, true, false);
   }
}