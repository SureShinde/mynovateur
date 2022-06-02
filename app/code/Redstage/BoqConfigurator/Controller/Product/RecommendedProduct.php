<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Redstage\BoqConfigurator\Controller\Product;

class RecommendedProduct extends \Magento\Framework\App\Action\Action 
{
   /**
    * @var \Magento\Catalog\Model\ProductFactory $productFactory
    */
   protected $_productFactory; 

   /**
    * @var \Redstage\BoqConfigurator\Model\BoqGrouproomlinkFactory $_productGroupsLinks
    */
   protected $_productGroupsLinks; 

   /**
    * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $_productCollectionFactory
    */
   protected $_productCollectionFactory;

   /**
    * @var \Magento\Catalog\Api\ProductAttributeRepositoryInterface $_productAttributeRepository
    */
   protected $_productAttributeRepository;

   /**
    * @var \Redstage\BoqConfigurator\Model\BoqProductgroup\Attribute\Source\Options $options 
    */
   protected $_options;

   /**
     * @var Magento\Framework\Pricing\Helper\Data
     */
    private $pricingHelper;

   /**
    * @param \Magento\Framework\App\Action\Context $context    
    * @param \Redstage\BoqConfigurator\Model\BoqGrouproomlinkFactory $productGroupsLinks
    * @param \Magento\Catalog\Model\ProductFactory $productFactory
    * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    * @param \Magento\Catalog\Api\ProductAttributeRepositoryInterface $productAttributeRepository
    * @param \Redstage\BoqConfigurator\Model\BoqProductgroup\Attribute\Source\Options $options
    * @param \Magento\Framework\Pricing\Helper\Data $pricingHelper 
    */
   public function __construct(
      \Magento\Framework\App\Action\Context $context,
      \Redstage\BoqConfigurator\Model\BoqGrouproomlinkFactory $productGroupsLinks,
      \Magento\Catalog\Model\ProductFactory $productFactory, 
      \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
      \Magento\Catalog\Api\ProductAttributeRepositoryInterface $productAttributeRepository,
      \Redstage\BoqConfigurator\Model\BoqProductgroup\Attribute\Source\Options $options,
      \Magento\Framework\Pricing\Helper\Data $pricingHelper        
   )
   {
      $this->_productFactory = $productFactory;
      $this->_productGroupsLinks = $productGroupsLinks;
      $this->_productCollectionFactory = $productCollectionFactory; 
      $this->_productAttributeRepository = $productAttributeRepository;
      $this->_options = $options;
      $this->pricingHelper = $pricingHelper;
      return parent::__construct($context);
   }
   /**
     * ProductGroup action
     *
    */
   public function execute()
   {
      $roomTypeId = $this->getRequest()->getParam('roomTypeId');
      $rangeId = $this->getRequest()->getParam('rangeId');
      $colorOptionId = $this->getRequest()->getParam('colorOptionId');
      $finishedOptionId = $this->getRequest()->getParam('finishedOptionId');
      $preferableSpace = $this->getRequest()->getParam('preferableSpace');
      $productGroups = $this->getProductGroupCollection($roomTypeId);      
      $optionIds = [];
      foreach($productGroups as $productGroup){
         $optionIds[] = $productGroup['product_group_id']; 
      }   
      
      $productCollection = $this->_productCollectionFactory->create()
            ->addAttributeToSelect('*')            
            ->addAttributeToFilter(
                'product_preferable_space',
                ['in' => $preferableSpace]
            )->addAttributeToFilter(
                'product_group',
                ['in' => $optionIds]
            )->addAttributeToFilter(
                'product_range',
                ['in' => $rangeId]
            )->addAttributeToFilter(
                'color',
                ['in' => $colorOptionId]
            )->addAttributeToFilter(
                'product_recommended',
                ['eq' => 1]
            )->addUrlRewrite();

      if($finishedOptionId != 0){
         $productCollection->addAttributeToFilter('product_finished',['in' => $finishedOptionId]);
      }
      $productCollection->addAttributeToFilter(
          array(
              array('attribute'=> 'product_plates_and_frames','null' => true),
              array('attribute'=> 'product_plates_and_frames','neq' => '1'),
              array('attribute'=> 'product_plates_and_frames','eq' => '0'),
          )
      );
      $productCollection->addWebsiteNamesToResult()
            ->addCategoryIds()
            ->addOptionsToResult();
      $result = array();
     // print_r($productCollection->getData());exit;
      if(!empty($productCollection->getData())){         
         foreach($productCollection->getData() as $key => $product){
            $id = $product['entity_id'];
            $productData = array();
            $productData = $this->_productFactory->create();
            $productData->load($id);
            $result[$key]['id'] = $id;
            $productimages = $productData->getMediaGalleryImages();
            foreach($productimages as $productimage)
            {
             $result[$key]['image'] = $productimage['url'];
            }
            $result[$key]['room_type_id'] = $roomTypeId; 
            $result[$key]['sku'] = $productData->getSku(); 
            $result[$key]['product_name'] = $productData->getName();
            $keyForDescription = array_search($product['product_group'], array_column($productGroups, 'product_group_id'));    
            $result[$key]['description'] = $productGroups[$keyForDescription]['name']; 
            $keyForQty = array_search($product['product_group'], array_column($productGroups, 'product_group_id'));
            $productGroupConfig = json_decode($productGroups[$keyForQty]['product_group_config'],TRUE);
             
            $result[$key]['qty'] = $productGroupConfig['qty'];
            //$result[$key]['qty'] = $productGroups[$keyForQty]['qty']; 
            $result[$key]['value'] = $this->getCurrencySymbol($productData->getPrice());
            $result[$key]['total_value'] = $this->getCurrencySymbol($productData->getPrice() * $productGroupConfig['qty']);
            $result[$key]['plain_value'] = $productData->getPrice();
         }
      }
      
      echo json_encode($result);exit; 

      
   }

   public function getProductGroupCollection($roomTypeId){

      $productGroupData = $this->_productGroupsLinks->create();
      $collection = $productGroupData->getCollection()
                                     ->addFieldToFilter('room_type_id', $roomTypeId)
                                     ->addFieldToFilter('is_active', 1);

      $joinConditions = 'main_table.product_group_id = boq_product_group.id';
      
      $collection->getSelect()->join(
                   ['boq_product_group'],
                   $joinConditions,
                   []
                  )->columns("boq_product_group.name");
      
      return $collection->getData();
   }

   public function getCurrencySymbol($price){
      return $this->pricingHelper->currency($price, true, false);
   }
}
