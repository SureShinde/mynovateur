<?php
namespace Redstage\BoqConfigurator\Block\Adminhtml\BoqRoombundle\Edit;

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
        if ($this->_isAllowedAction('Redstage_BoqConfigurator::boqroombundle_create') || $this->_isAllowedAction('Redstage_BoqConfigurator::boqroombundle_update')) {
            $data = [
                'label' => __('Save Room Bundle'),
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

