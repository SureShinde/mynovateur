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
	use Redstage\CustomWebkul\Helper\Data;

	class Cartafter implements ObserverInterface
	{
	    protected $_redirect;
	    protected $_request;
	    protected $_url;
	    protected $customHelper;
	    public function __construct(
	        \Magento\Framework\UrlInterface $url,
	        \Magento\Framework\App\Response\Http $redirect,
	        \Magento\Catalog\Model\ProductFactory $productloader,
	        \Redstage\AmcConfigurator\Model\AmcListFactory $amcListFactory,
	        \Redstage\AmcConfigurator\Model\AmcOfferFactory $amcOfferFactory,
	        Data $customWebkulHelper,
	        \Magento\Framework\App\RequestInterface $request
	    ) {

	        $this->_url = $url;
	        $this->_redirect = $redirect;
	        $this->_productloader = $productloader;
	        $this->amcListFactory = $amcListFactory;
	        $this->amcOfferFactory = $amcOfferFactory;
	        $this->customHelper = $customWebkulHelper; 
	        $this->_request = $request;

	    }
	    public function execute(Observer $observer) 
	    {
	    	$params = $this->_request->getParams();
	    	$item = $observer->getEvent()->getData('quote_item');

			
			//code to hide battery product start here
			if(isset($params['is_visible'])) 
			{
				$item->setIsVisible(1);
			}
			/*if(isset($params['parent_item_id'])) 
			{
				$item->setParentItemId($params['parent_item_id']);
			}*/

	    	if (isset($params['is_amc']) && $params['is_amc']=="1") {
	    		$this->calculateAmc($observer, $params);
	    	}

	    	if (isset($params['is_boq']) && $params['is_boq']=="1") {
	    		$this->calculateBoq($observer, $params);
	    	}

	    	if (isset($params['is_gst_split']) && $params['is_gst_split']=="1") {
	    		$this->calculateGSTSplit($observer, $params);
	    	}
    	}

    	protected function calculateAmc($observer, $params)
    	{
    		$amc_id = $params['id'];
	        $amcCustomer = $this->amcListFactory->create()->load($amc_id);
	        $amcRenew = $amcCustomer->getData();
	        $sales_org = $amcRenew['sales_org'];
	        $product_meterial_group_1 = $amcRenew['product_meterial_group_1'];
	        $numeric_meterial = filter_var($product_meterial_group_1, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    		$amcOffer = $this->amcOfferFactory->create();
	        $offer_collection = $amcOffer->getCollection()->addFieldToFilter('sales_org', $sales_org)->addFieldToFilter('meterial_group_1', $numeric_meterial)->getFirstItem()->getData();
	        //print_r($offer_collection);die('hhh');

	        if ($params['package'] == "2") {
	        	$offer_price = $offer_collection['offer2_price_per_year'];
	        } else {
	        	$offer_price = $offer_collection['offer1_price_per_year'];
	        }
    		$item = $observer->getEvent()->getData('quote_item');
    		$item->setCustomPrice($offer_price);
            $item->setOriginalCustomPrice($offer_price);
			$item->getProduct()->setIsSuperMode(true);
    	}

    	protected function calculateBoq($observer, $params)
    	{
    		//BOQ Add To Cart
    	}

    	protected function calculateGSTSplit($observer, $params)
    	{
    		$item = $observer->getEvent()->getData('quote_item');
    		$main_product_id = $item->getProductId();
			$_productloader = $this->_productloader->create();
			$main_product = $_productloader->load($main_product_id);
			$main_product_sku = $main_product->getSku();

			$buyRequest = $item->getBuyRequest()->getData();
			
			//code to hide battery product start here
			if(isset($params['is_visible'])) 
			{
				$item->setIsVisible(1);
			}
			if(isset($params['parent_item_id'])) 
			{
				$item->setParentItemId($params['parent_item_id']);
			}
			//code to hide battery product end here
			$main_product_price = $main_product->getPrice();
			$main_item_qty = $item->getQty();
			$options = '';
			if (isset($buyRequest['options']) && !empty($buyRequest['options'])) {
				$options = $buyRequest['options'];
			}
			if ($options != '' && count($options)>0) {
				$main_productInfo = $this->customHelper->getMinPriceSellerOfProduct($main_product);
				$parentId = $item->getItemId();

				$op_prodPrice = 0;
				foreach ($options as $key => $value) {
				    $optionData = $item->getProduct()->getOptionById($key);
			        foreach ($optionData->getValues() as $v) {
			            if ($v['option_type_id'] == $value) {
			                $if_option = 1;
			                $op_productloader = $this->_productloader->create();
			                $productId = $op_productloader->getIdBySku($v->getSku());
			                $op_product = $op_productloader->load($productId);
			                $op_productInfo = $this->customHelper->getMinPriceSellerOfProduct($op_product);
                        	if(!empty($op_productInfo) && $op_productInfo['price']){
                        		$op_prodPrice = (floatval($op_prodPrice) + floatval($op_productInfo['price']));
                        	}else{
                        		$op_prodPrice = (floatval($op_prodPrice) + floatval($op_product->getPrice()));
                        	}  
			            }
			        }
				}
				$displayPrice = (floatval($main_productInfo['price']) + floatval($op_prodPrice));
				$item->setDisplayPrice($displayPrice);
				$item->setCustomPrice($main_productInfo['price']);
	            $item->setOriginalCustomPrice($main_productInfo['price']);
				$item->getProduct()->setIsSuperMode(true);
				return $this;
			}
    	}
	}