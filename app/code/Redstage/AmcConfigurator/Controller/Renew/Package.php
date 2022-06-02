<?php

namespace Redstage\AmcConfigurator\Controller\Renew;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Option;
use Redstage\AmcConfigurator\Helper\Data;
use Magento\Checkout\Model\Cart;

class Package extends \Magento\Framework\App\Action\Action
{

    public function __construct(

        Context $context,
        Session $customerSession, 
        ProductFactory $productFactory,       
        ProductRepositoryInterface $ProductRepositoryInterface,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Redstage\AmcConfigurator\Model\AmcListFactory $amcListFactory,
        \Redstage\AmcConfigurator\Model\AmcOfferFactory $amcOfferFactory,
        Option $option,
        \Redstage\CustomWebkul\Helper\Data $customWebkulHelper,
        Cart $cart,
        Data $amcHelper
    ) {

        $this->customerSession = $customerSession;
        $this->productFactory = $productFactory;
        $this->ProductRepositoryInterface = $ProductRepositoryInterface;
        $this->serializer = $serializer;
        $this->amcListFactory = $amcListFactory;
        $this->amcOfferFactory = $amcOfferFactory;
        $this->option = $option;
        $this->customHelper = $customWebkulHelper;
        $this->cart = $cart;
        $this->amcHelper = $amcHelper;
        return parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $amc_id = $params['id'];
        $package = ($params['package'] == "2") ? "Gold" : "Silver";
        $amcCustomer = $this->amcListFactory->create()->load($amc_id);
        $amcRenew = $amcCustomer->getData();
        $asset_name = $amcRenew['asset_name'];
        $warranty_start_date = $amcRenew['warranty_start_date'];
        $warranty_end_date = $amcRenew['warranty_end_date'];
        $amc_start_date = $amcRenew['amc_start_date'];
        $amc_end_date = $amcRenew['amc_end_date'];
        $sales_org = $amcRenew['sales_org'];
        $product_meterial_group_1 = $amcRenew['product_meterial_group_1'];

        if (isset($amcRenew['amc_end_date']) && !empty($amcRenew['amc_end_date'])) {
            $offerStartDate = date('d/m/Y', strtotime("1 day", strtotime($amc_end_date)));
            $offerEndDate = date('d/m/Y', strtotime("+1 years +1 day", strtotime($amc_end_date)));
        } else {
            $offerStartDate = date('d/m/Y', strtotime("1 day", strtotime($warranty_end_date)));
            $offerEndDate = date('d/m/Y', strtotime("+1 years +1 day", strtotime($warranty_end_date)));
        }
        $offer_range = $offerStartDate . " - " . $offerEndDate;

        $sku = "amc_renew";
        $product = $this->ProductRepositoryInterface->get($sku);
        $productId = $product->getId();
        $product->setName($asset_name);
        //$product->setPrice($offer_price);

        $additionalOptions['amc_asset'] = [
            'label' => 'Asset Name',
            'value' => $asset_name
        ];

        $additionalOptions['amc_package'] = [
            'label' => 'Package',
            'value' => $package
        ];

        $additionalOptions['amc_range'] = [
            'label' => 'Range',
            'value' => $offer_range
        ];

        $productInfo = $this->customHelper->getMinPriceSellerOfProduct($product);

        $params = array(
            'product' => $productId,
            'qty' => 1
        );

        if(!empty($productInfo) && $productInfo['assigned_id']){
            $params['assigned_id'] = $productInfo['assigned_id'];
        }
        
        if(!empty($productInfo) && $productInfo['pincode']){
            $params['pincode'] = $productInfo['pincode'];
        }

        try {
            $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));
            $cart = $this->cart;
            $cart->addProduct($product, $params);
            $cart->save();
            $this->messageManager->addSuccessMessage(__($asset_name.'-'.$package.' has been added to cart'));
            return $this->resultRedirectFactory->create()->setPath('checkout/cart/');
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->resultRedirectFactory->create()->setUrl($this->_redirect->getRefererUrl());
        }
    }
}
