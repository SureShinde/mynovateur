<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Redstage\BoqConfigurator\Controller\Product;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Redstage\CustomWebkul\Helper\Data;
use Psr\Log\LoggerInterface;

/**
 * Responsible for loading page content.
 *
 * This is a basic controller that only loads the corresponding layout file. It may duplicate other such
 * controllers, and thus it is considered tech debt. This code duplication will be resolved in future releases.
 */
class AddToCart extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $formKey;   

    /**
     * @var \Magento\Checkout\Model\Cart
     */
    protected $cart;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $product;

    /**
     * @var Data
     */
    protected $customHelper;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param \Magento\Checkout\Model\Cart $cart
     * @param \Magento\Catalog\Model\ProductFactory $product
     * @param Data $customWebkulHelper
     * @param LoggerInterface $logger
     * @param $data
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\ProductFactory $product,
        Data $customWebkulHelper,
        LoggerInterface $logger,
        \Webkul\MpAssignProduct\Model\QuoteFactory $assignedQuoteFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        array $data = []
    ) {
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->product = $product; 
        $this->customHelper = $customWebkulHelper;  
        $this->logger = $logger;  
        $this->assignedQuoteFactory = $assignedQuoteFactory;
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context);
    }

    public function execute()
    { 
       $allParams = $this->getRequest()->getParams();
       $selectedItems = $allParams['productData'];
       $dataToAssignSeller = array();
       $counter = 0;
        try{
            foreach ($selectedItems as $key => $selectedItem) {

                $_product = $this->product->create()->load($selectedItem['id']);  

                $productInfo = $this->customHelper->getMinPriceSellerOfProduct($_product);  
                 
                $params = array(
                    'form_key' => $this->formKey->getFormKey(),
                    'product_id' => $selectedItem['id'], //product Id
                    'qty'   => $selectedItem['qty'] //quantity of product          
                );

               
                if (isset($allParams['is_visible'])) {
                    $params['is_visible'] = $allParams['is_visible'];
                }

                if (isset($allParams['parent_item_id'])) {
                    $params['parent_item_id'] = $allParams['parent_item_id'];
                }

                if(!empty($productInfo) && $productInfo['assigned_id']){
                    $params['assigned_id'] = $productInfo['assigned_id'];
                }
                
                if(!empty($productInfo) && $productInfo['pincode']){
                    $params['pincode'] = $productInfo['pincode'];
                }
                $this->cart->addProduct($_product, $params);

                $cartItems = $this->cart->getQuote()->getAllItems();
                $max = 0;
                $lastItem = null;
                foreach ($cartItems as $item){
                    if ($item->getId() > $max) {
                        $max = $item->getId();
                        $lastItem = $item;
                    }
                }
                if ($lastItem && !empty($productInfo) && $productInfo['assigned_id'] && $productInfo['seller_id']){
                    $dataToAssignSeller[$counter]['product'] = $_product;
                    $dataToAssignSeller[$counter]['seller_id'] = $productInfo['seller_id'];
                    $dataToAssignSeller[$counter]['id'] = $selectedItem['id'];
                    $dataToAssignSeller[$counter]['parent_item_id'] = $max;
                    $dataToAssignSeller[$counter]['quote_id'] = $lastItem->getQuoteId();
                    $dataToAssignSeller[$counter]['qty'] = $selectedItem['qty'];
                    $dataToAssignSeller[$counter]['assigned_id'] = $productInfo['assigned_id'];
                    $counter++;
                }
            }
            $this->cart->save();
            $this->assignSellersToItems($dataToAssignSeller);
            echo "1";
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addException($e,__('%1', $e->getMessage()));
            echo "0";
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('error.'));
            echo "0";
        }
        
    }

    public function assignSellersToItems($data)
    {
        //code to store the added product to seller table marketplace_assignproduct_quote so seller appear on checkout cart page and seller is assigned to cart item; Ref app/code/Webkul/MpAssignProduct/Rewrite/Controller/Cart/Add.php
        //starts here

        if (!empty($data)) {
            foreach($data as $productInfo) {
                $item = $this->_checkoutSession->getQuote()->getItemByProduct($productInfo['product']);

                $sellerId = $productInfo['seller_id'];
                $productId = $productInfo['id'];
                $itemId = $item->getId();
                $parentItemId = $productInfo['parent_item_id'];
                $quoteId = $productInfo['quote_id'];
                $assignedItemId = $productInfo['assigned_id'];
                $qty = $productInfo['qty'];
                $assignedAssociateItemId = 0;
                $model = $this->assignedQuoteFactory->create();
                $model->setData('seller_id', $sellerId)
                    ->setData('item_id', $itemId)
                    ->setData('parent_item_id', $parentItemId)
                    ->setData('quote_id', $quoteId)
                    ->setData('product_id', $productId)
                    ->setData('assign_id', $assignedItemId)
                    ->setData('child_assign_id', $assignedAssociateItemId)
                    ->setData('qty', $qty);
                $model->save();
            }
        }
    }
}