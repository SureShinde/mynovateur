<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Redstage\OrderExport\Block\Adminhtml;

/**
 * Adminhtml permissions user edit form
 *
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Order config
     *
     * @var \Magento\Sales\Model\Order\ConfigFactory
     */
    protected $_orderConfig;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Sales\Model\Order\ConfigFactory $orderConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Sales\Model\Order\ConfigFactory $orderConfig,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_orderConfig = $orderConfig;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getUrl("*/*/export"), 'method' => 'post']]
        );
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Filters')]);

        //$dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);

        $fieldset->addField(
            'from',
            'date',
            [
                'name' => 'from',
                'date_format' => 'yyyy-mm-dd',
                'label' => __('From'),
                'title' => __('From'),
                'required' => true,
                'css_class' => 'admin__field-small',
                'class' => 'admin__control-text'
            ]
        );

        $fieldset->addField(
            'to',
            'date',
            [
                'name' => 'to',
                'date_format' => 'yyyy-mm-dd',
                'label' => __('To'),
                'title' => __('To'),
                'required' => true,
                'css_class' => 'admin__field-small',
                'class' => 'admin__control-text'
            ]
        );

        $fieldset->addField(
            'store_id',
            'multiselect',
            [
                'name'     => 'store_id[]',
                'label'    => __('Store'),
                'title'    => __('Store'),
                'required' => true,
                'values'   => $this->_systemStore->getStoreValuesForForm(false, true),
            ]
        );

        $statuses = $this->_orderConfig->create()->getStatuses();
        $values = [];
        foreach ($statuses as $code => $label) {
            if (false === strpos($code, 'pending')) {
                $values[] = ['label' => __($label), 'value' => $code];
            }
        }

        $fieldset->addField(
            'order_statuses',
            'multiselect',
            [
                'name' => 'order_statuses',
                'label' => 'Order Status',
                'values' => $values,
                'display' => 'none'
            ]
        );

        $this->setForm($form);
        return parent::_prepareForm();
    }
}
