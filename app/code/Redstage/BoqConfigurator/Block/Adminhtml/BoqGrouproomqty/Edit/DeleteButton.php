<?php
namespace Redstage\BoqConfigurator\Block\Adminhtml\BoqGrouproomqty\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getContactId() && $this->_isAllowedAction('Redstage_BoqConfigurator::boqgrouproomqty_delete')) {
            $data = [
                'label' => __('Delete Product Group Room qty'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/boqgrouproomqty/delete', ['link_id' => $this->getContactId()]);
    }
}
