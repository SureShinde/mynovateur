<?php
namespace Redstage\BoqConfigurator\Block\Adminhtml\BoqGrouproomqty\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->_isAllowedAction('Redstage_BoqConfigurator::boqgrouproomqty_create') || $this->_isAllowedAction('Redstage_BoqConfigurator::boqgrouproomqty_update')) {
            $data = [
                'label' => __('Save Group Room-Qty'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save']],
                    'form-role' => 'save',
                ],
                'sort_order' => 90,
            ];
        }
        return $data;
    }
}

