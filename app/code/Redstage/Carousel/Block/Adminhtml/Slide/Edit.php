<?php
namespace Redstage\Carousel\Block\Adminhtml\Slide;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
   
    protected $_coreRegistry;

    /**
     * constructor
     * 
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    
    protected function _construct()
    {
        $this->_objectId = 'slide_id';
        $this->_blockGroup = 'Redstage_Carousel';
        $this->_controller = 'adminhtml_slide';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Slide'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Slide'));
    }
    
    public function getHeaderText()
    {
        
        $slide = $this->_coreRegistry->registry('redstage_carousel_slide');
        if ($slide->getId()) {
            return __("Edit Slide '%1'", $this->escapeHtml($slide->getName()));
        }
        return __('New Slide');
    }
}
