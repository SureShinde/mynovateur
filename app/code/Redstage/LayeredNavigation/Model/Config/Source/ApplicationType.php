<?php
namespace Redstage\LayeredNavigation\Model\Config\Source;
use Redstage\LayeredNavigation\Helper\Data;
class ApplicationType implements \Magento\Framework\Option\ArrayInterface
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
        $applicationType = $this->helper->getValueFromApplicationType();
        $applicationOption = array();
        foreach($applicationType as $option){
            $applicationOption[$option['application_type']] = $option['application_type'];
        }
        return $applicationOption;
    }
}