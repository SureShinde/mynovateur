<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Redstage\AmcConfigurator\Block\Adminhtml;

/**
 * Adminhtml permissions user edit form
 *
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class OfferForm extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getUrl("*/*/save"), 'method' => 'post', 'enctype' => 'multipart/form-data']]
        );

        $form->setUseContainer(true);

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Import Offer')]);

        $fieldset->addField(
            'import_file',
            'file',
            [
                'name' => 'import_file',
                'label' => __('File'),
                'title' => __('File'),
                'required' => true,
                'css_class' => 'admin__field-small',
                'class' => 'admin__control-text'
            ]
        )->setAfterElementHtml("<span style='color: red; padding: 2px;'>Upload only CSV<span");

        $fieldset->addField(
            'sample_download',
            'link',
            [
                'name' => 'sample_download',
                'label' => __(''),
                'title' => __('Downalod Sample'),
                'value' => 'Download Sample',
                'href' => $this->getViewFileUrl('Redstage_AmcConfigurator::sample/amc_customer.csv'),
                'css_class' => 'admin__field-small',
                'class' => 'admin__control-text'
            ]
        );

        $this->setForm($form);
        return parent::_prepareForm();
    }
}
