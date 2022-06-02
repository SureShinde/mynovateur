<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Redstage\Catalog\Controller\Product;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

/**
 * Responsible for loading page content.
 *
 * This is a basic controller that only loads the corresponding layout file. It may duplicate other such
 * controllers, and thus it is considered tech debt. This code duplication will be resolved in future releases.
 */
class AddToCartMultipleProducts extends \Magento\Framework\App\Action\Action
{

    protected $formKey;   
    protected $cart;
    protected $product;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\ProductFactory $product,
        array $data = []
    ) {
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->product = $product;      
        parent::__construct($context);
    }

    public function execute()
    { 
       $selectedItems = $this->getRequest()->getParam('productData');   
        try{
        foreach ($selectedItems as $key => $selectedItem) {

            $params = array(
                'form_key' => $this->formKey->getFormKey(),
                'product_id' => $selectedItem['id'], //product Id
                'qty'   => $selectedItem['qty'] //quantity of product                
            );
            $_product = $this->product->create()->load($selectedItem['id']);       
            $this->cart->addProduct($_product, $params);
        }
            $this->cart->save();
            echo "1";
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addException($e,__('%1', $e->getMessage()));
            echo "0";
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('error.'));
            echo "0";
        }
        
    }
}