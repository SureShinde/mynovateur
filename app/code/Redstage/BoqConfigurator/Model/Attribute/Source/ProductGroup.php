<?php
namespace Redstage\BoqConfigurator\Model\Attribute\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;
class ProductGroup extends AbstractSource implements OptionSourceInterface
{
    
    public function getAllOptions()
    {
       
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $eavConfig = $objectManager->get('\Magento\Eav\Model\Config');
        $attribute = $eavConfig->getAttribute('catalog_product', 'product_group');
        $options = $attribute->getSource()->getAllOptions();
        $value = '';
        foreach($options as $option) {            
             $value = $option['value'];            
        }

        return $options;
    }
}
