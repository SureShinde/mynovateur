<?php
namespace Redstage\LayeredNavigation\Model\Config\Source;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection;
class ProductAttributes implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * attribute constructor.
     * @param Collection $collection
     */
    public function __construct(
        Collection $collection
    )
    {
        $this->collection = $collection;
    }

    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }

    public function getOptions()
    {
        $attributes = $this->collection->addFieldToFilter(\Magento\Eav\Model\Entity\Attribute\Set::KEY_ENTITY_TYPE_ID, 4);
        //echo '<pre>';print_r($attributes->getData());die;
        $applicationOption = array();
        foreach($attributes as $attribute){
            $applicationOption[$attribute->getAttributeCode()] = $attribute->getFrontendLabel();
        }
        return $applicationOption;
    }
}