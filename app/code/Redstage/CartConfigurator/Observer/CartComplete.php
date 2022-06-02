<?php
/**
 * Redstage CartConfigurator Cartafter Observer
 *
 * @category    Redstage
 * @package     Redstage_CartConfigurator
 * @author      Redstage 
 *
 */
namespace Redstage\CartConfigurator\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class CartComplete implements ObserverInterface
{
    protected $_redirect;
    protected $_request;
    protected $_url;
    public function __construct(
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Response\Http $redirect,
        \Magento\Catalog\Model\ProductFactory $productloader,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Framework\App\RequestInterface $request
    ) {

        $this->_url = $url;
        $this->_redirect = $redirect;
        $this->_productloader = $productloader;
        $this->_request = $request;
        $this->cart = $cart;
    }
    public function execute(Observer $observer) 
    {
    	$cartItems = $this->cart->getQuote()->getAllItems();
        $max = 0;
        $lastItem = null;
        foreach ($cartItems as $item){
            if ($item->getId() > $max) {
                $max = $item->getId();
                //$lastItem = $item;

                $main_item_qty = $item->getQty();
                $buyRequest = $item->getBuyRequest()->getData();
                $options = '';
                if (isset($buyRequest['options']) && !empty($buyRequest['options'])) {
                    $options = $buyRequest['options'];
                }
                if ($options != '' && count($options)>0) {
                    $parentId = $item->getId();
                    $paramString = '?cache=false&is_visible=0&parent_item_id='.$parentId;
                    $counter = 0;
                    foreach ($options as $key => $value) {
                        $optionData = $item->getProduct()->getOptionById($key);
                        foreach ($optionData->getValues() as $v) {
                            if ($v['option_type_id'] == $value) {
                                if (strpos($v->getSku(), '::')) {
                                    $option_sku_val = explode('::', $v->getSku());
                                    $op_sku = $option_sku_val[0];
                                    $op_qty = $option_sku_val[1];
                                }else{
                                    $op_sku = $v->getSku();
                                    $op_qty = $main_item_qty;
                                }
                                $if_option = 1;
                                $_productloader = $this->_productloader->create();
                                $productId = $_productloader->getIdBySku($op_sku);

                                $paramString .= "&productData[{$counter}][id]=" . $productId;         
                                $paramString .= "&productData[{$counter}][qty]=" . $op_qty;

                                if (isset($buyRequest['assigned_id']) && !empty($buyRequest['assigned_id'])) {
                                    $paramString .= "&productData[{$counter}][assigned_id]=" . $buyRequest['assigned_id'];  
                                }
                                $counter++;     
                            }
                        }
                    }

                    $urlRedirect = 'boqconfigurator/product/AddToCart' . $paramString . '&cache=false';
                    $CustomRedirectionUrl = $this->_url->getUrl($urlRedirect);
                    $this->_redirect->setRedirect($CustomRedirectionUrl);
                }
            }
        }
                
	}
}