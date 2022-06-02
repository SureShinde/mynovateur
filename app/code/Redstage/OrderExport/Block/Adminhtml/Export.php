<?php
namespace Redstage\OrderExport\Block\Adminhtml;

class Export extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->buttonList->update('save', 'label', __('Export'));
        $this->buttonList->remove('reset');
        $this->buttonList->remove('back');
    }

    /**
     * Create form block
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
       $this->addChild('form', \Redstage\OrderExport\Block\Adminhtml\Form::class);
       return parent::_prepareLayout();
    }

}
