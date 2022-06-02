<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Redstage\BoqConfigurator\Controller\Product;

use Magento\Framework\App\Action\Context;

class Control extends \Magento\Framework\App\Action\Action
{
    protected $eavConfig;
   
    public function __construct(
        Context $context,
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->_eavConfig = $eavConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParam('ids');
        //print_r(explode(',',$data));exit;
        $rangeIds = explode(',',$data);
        $attributeCode = "product_range";
        $attribute = $this->_eavConfig->getAttribute('catalog_product', $attributeCode);
        $options = $attribute->getSource()->getAllOptions();
        $result = [];
        foreach ($options as $option) { //print_r($option);
            if ($option['value'] > 0 && in_array($option['value'], $rangeIds) ) {
                $result[$option['value']] = $option['label'];
            }
        }
        
        echo json_encode($result);exit;
    }


}