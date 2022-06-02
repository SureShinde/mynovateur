<?php
namespace Redstage\AmcConfigurator\Block\Adminhtml;

class Import extends \Magento\Backend\Block\Widget\Form\Container
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

        $this->buttonList->update('save', 'label', __('Start'));
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
       $this->addChild('form', \Redstage\AmcConfigurator\Block\Adminhtml\Form::class);
       return parent::_prepareLayout();
    }

}
