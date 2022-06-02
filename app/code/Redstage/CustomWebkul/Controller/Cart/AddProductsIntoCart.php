<?php

/**
 * Redstage CustomWebkul Add Product into Cart
 *
 * @category    Redstage
 * @package     Redstage_CustomWebkul
 * @author      Redstage
 *
 */

namespace Redstage\CustomWebkul\Controller\Cart;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Controller\ResultFactory;

class AddProductsIntoCart extends Action
{
	protected $formKey;
	protected $cart;
	public function __construct(
		Context $context,
		ProductFactory $productloader,
		Cart $cart
	) {
		$this->productloader = $productloader;
		$this->cart = $cart;
		parent::__construct($context);
	}

	public function execute()
	{
		$productId = $this->getRequest()->getParam('product');
		$qty = $this->getRequest()->getParam('qty');
		$formKey = $this->getRequest()->getParam('form_key');
		$qty = $qty > 0 ? $qty : 1;
		$params = array(
			'form_key' => $formKey,
			'product_id' => $productId,
			'qty'  => $qty
		);
		$product = $this->productloader->create()->load($productId);
		$this->cart->addProduct($product, $params);
		$this->cart->save();
		$this->messageManager->addSuccess(__("Product %1 added in cart successfully.", $product->getName()));
		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
		$resultRedirect->setPath($this->_redirect->getRefererUrl());
		return $resultRedirect;
	}
}
