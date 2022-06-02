<?php
namespace Redstage\LayeredNavigation\Model\Config\Source;
use Redstage\LayeredNavigation\Helper\Data;
class CategoryApply implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * application constructor.
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    )
    {
        $this->helper = $helper;
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
        $categoryApply = $this->helper->getValueFromCategoryApply();
        $categoryOption = array();
        foreach($categoryApply as $option){
            $catApply = explode('-',$option['category_apply']);
            $categoryOption[$catApply[0]] = $catApply[1];
        }
        return $categoryOption;
    }
}