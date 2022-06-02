<?php

namespace Redstage\AmcConfigurator\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\ProductFactory;

class Data extends AbstractHelper
{
    private $cart;
    private $productFactory;
    
    public function __construct(
        Context $context, 
        Cart $cart, 
        ProductFactory $productFactory,
        \Redstage\AmcConfigurator\Model\AmcOfferFactory $amcOfferFactory
    )
    {
        $this->cart = $cart;
        $this->productFactory = $productFactory;
        $this->amcOfferFactory = $amcOfferFactory;
        parent::__construct($context);

    }

    public function getAMCOfferPrices($sales_org, $meterial)
    {
        $amcOffer = $this->amcOfferFactory->create();
        $collection = $amcOffer->getCollection()->addFieldToFilter('sales_org', $sales_org)->addFieldToFilter('meterial_group_1', $meterial)->getFirstItem();
        return $collection->getData();
    }

    public function getAddCustomProduct($productId)
    {
        $productId = "451";
        $product = $this->productFactory->create()->load($productId);

        $cart = $this->cart;

        $params = array();
        $options = array();
        $params['qty'] = 1;
        $params['product'] = $productId;
        foreach ($product->getOptions() as $o) {
            foreach ($o->getValues() as $value) {
                $options[$value['option_id']] = $value['option_type_id'];
            }
        }


        $additionalOptions['print_style'] = [
            'label' => 'Print Style',
            'value' => 'Test'
        ];

        $params = array(
                'product' => $productId,
                'qty' => 1
            );
        $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));

        //$params['options'] = $options;
        $cart->addProduct($product, $params);
        $cart->save();
    }
}