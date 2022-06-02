<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Redstage\BoqConfigurator\Controller\Product;

use Magento\Framework\App\Action\Context;

class Color extends \Magento\Framework\App\Action\Action
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
        $rangeConfigData = $this->_rangeConfig->create();
        $collection = $rangeConfigData->getCollection()->addFieldToFilter('range', $rangeID)->getData();
        //print_r($collection);
        $colorIds = explode(',',$collection[0]['color']);
        //print_r($colorIds);
        

        $attributeCode = "color";
        $attribute = $this->_eavConfig->getAttribute('catalog_product', $attributeCode);
        $options = $attribute->getSource()->getAllOptions();
        //print_r($options);
        $result = [];
        foreach ($options as $option) { //print_r($option);
            if ($option['value'] > 0 && in_array($option['value'], $colorIds) ) {
                $result[$option['value']] = $option['label'];
            }
        }
        
        echo json_encode($result);exit;

        
    }

}