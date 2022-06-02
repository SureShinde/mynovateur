<?php
namespace Redstage\LayeredNavigation\Model\Config\Source;
use Redstage\LayeredNavigation\Helper\Data;
class Application implements \Magento\Framework\Option\ArrayInterface
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
        $applicationType = $this->helper->getValueFromApplication();
        $applicationOption = array();
        foreach($applicationType as $option){
            $applicationOption[$option['application']] = $option['application'];
        }
        return $applicationOption;
    }
}
