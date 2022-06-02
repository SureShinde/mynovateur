<?php
namespace Redstage\Carousel\Model\Adminhtml\System\Config\Source\Dots;
 
class Position implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'bottom-left', 'label' => __('Bottom left')],
            ['value' => 'bottom-center', 'label' => __('Bottom center')],
            ['value' => 'bottom-right', 'label' => __('Bottom right')]
        ];
    }
}