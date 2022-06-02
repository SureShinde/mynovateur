<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Redstage\BoqConfigurator\Controller\Product;

use Magento\Framework\App\Action\Context;

class Finished extends \Magento\Framework\App\Action\Action
{
    /**
    * @var \Magento\Eav\Model\Config $_eavConfig
    */
    protected $_eavConfig;

    /**
    * @var \Redstage\BoqConfigurator\Model\RangeConfigFactory $rangeConfig
    */
   protected $_rangeConfig; 
   
   /**
    * @param \Magento\Eav\Model\Config $eavConfig
    * @param \Redstage\BoqConfigurator\Model\RangeConfigFactory $rangeConfig
    */
    public function __construct(
        Context $context,
        \Magento\Eav\Model\Config $eavConfig,
        \Redstage\BoqConfigurator\Model\RangeConfigFactory $rangeConfig
    ) {
        $this->_eavConfig = $eavConfig;
        $this->_rangeConfig = $rangeConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        $rangeID = $this->getRequest()->getParam('rangeId');
        $colorId = $this->getRequest()->getParam('colorId');
        $rangeConfigData = $this->_rangeConfig->create();
        $collection = $rangeConfigData->getCollection()->addFieldToFilter('range', $rangeID)->getData();
        $colorIds = explode(',',$collection[0]['color']);
        $finishedIds = explode(',',$collection[0]['finished']);
        //print_r($colorIds);
        //print_r($collection);
        $result = [];
        if(in_array($colorId, $colorIds) && !empty($finishedIds)){
            $attributeCode = "product_finished";
            $attribute = $this->_eavConfig->getAttribute('catalog_product', $attributeCode);
            $options = $attribute->getSource()->getAllOptions();
            //print_r($options);
            
            foreach ($options as $option) { //print_r($option);
                if ($option['value'] > 0 && in_array($option['value'], $finishedIds) ) {
                    $result[$option['value']] = $option['label'];
                }
            }
        }
        
        echo json_encode($result);exit;

        
    }

}