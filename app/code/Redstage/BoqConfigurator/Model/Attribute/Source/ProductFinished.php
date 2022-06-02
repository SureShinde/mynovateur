<?php
namespace Redstage\BoqConfigurator\Model\Attribute\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;
class ProductFinished extends AbstractSource implements OptionSourceInterface
{
    protected $_eavConfig;
   
    public function __construct(
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->_eavConfig = $eavConfig;
    }

    public function getAllOptions()
    {
        
        $attributeCode = "product_finished";
        $attribute = $this->_eavConfig->getAttribute('catalog_product', $attributeCode);
        $options = $attribute->getSource()->getAllOptions();
        
         return $options;
    }
    
}

