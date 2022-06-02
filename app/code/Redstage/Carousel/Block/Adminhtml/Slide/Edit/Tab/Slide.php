<?php
namespace Redstage\Carousel\Block\Adminhtml\Slide\Edit\Tab;

class Slide extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Boolean options
     * 
     * @var \Magento\Config\Model\Config\Source\Yesno
     */
    protected $_booleanOptions;
    /**
     * @var \Magento\Store\Model\System\Store
     */

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
    */
    protected $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Config\Model\Config\Source\Yesno $booleanOptions,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    )
    {   
        $this->_storeManager = $storeManager;
        $this->_booleanOptions           = $booleanOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
       
        $slide = $this->_coreRegistry->registry('redstage_carousel_slide');
      
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('slide_');
        $form->setFieldNameSuffix('slide');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Slide Information'),
                'class'  => 'fieldset-wide'
            ]
        );
       
        if ($slide->getId()) {
            $fieldset->addField(
                'slide_id',
                'hidden',
                ['name' => 'slide_id']
            );
        }
        $fieldset->addField(
            'active',
            'select',
            [
                'name'  => 'active',
                'label' => __('Active'),
                'title' => __('Active'),
                'required' => true,
                'values' => $this->_booleanOptions->toOptionArray(),
                'note' => __('Add slide to carousel.') 
            ]
        );
        $fieldset->addField(
            'sort_order',
            'text',
            [
                'name'  => 'sort_order',
                'label' => __('Sort Order'),
                'title' => __('Sort Order'),
                'required' => true,
                'note'     => __('Order of the slide in the collection (larger numbers push the slide to the right).'),
            ]
        );

        $websites = $this->_storeManager->getWebsites();
        $allgroups =  $this->_storeManager->getStores();
        $groups = array();
        foreach ($websites as $website) {
            $values = array();
            foreach ($allgroups as $group) {
                if ($group->getWebsiteId() == $website->getId()) {
                    $values[] = array('label'=>$group->getName(),'value'=>$group->getId());
                }
            }
            $groups[] = array('label'=>$website->getName(),'value'=>$values);
        } 

        $field = $fieldset->addField(
            'store_id',
            'select',
            [
                'name'      => 'store_id',
                'label'     => __('Store View'),
                'title'     => __('Store View'),
                'required'  => true,
                'values'    => $groups,
                'note' => __('Select the store.'),
            ]
        );

        $fieldset->addField(
            'name',
            'text',
            [
                'name'  => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
                'note'     => __('Internal name of the slide.'),
            ]
        );
        $fieldset->addField(
            'image',
            'image',
            [
                'name'  => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
                'required' => true,
                'note' => __('Main image for the slide (will also be resized for the thumbnail).'),
            ]
        );
        $fieldset->addField(
            'caption',
            'text',
            [
                'name'  => 'caption',
                'label' => __('Caption'),
                'title' => __('Caption'),
                'note'     => __('Caption of the slide.'),
            ]
        );
        $fieldset->addField(
            'enable_caption',
            'select',
            [
                'name'  => 'enable_caption',
                'label' => __('Enable Caption'),
                'title' => __('Enable Caption'),
                'values' => $this->_booleanOptions->toOptionArray(),
                'note' => __('Enable Caption yes/no') 
            ]
        );
         $fieldset->addField(
            'cta_label',
            'text',
            [
                'name'  => 'cta_label',
                'label' => __('CTA Button Label'),
                'title' => __('CTA Button Label'),
                'note'     => __('Label of CTA Button'),
            ]
        );
        $fieldset->addField(
            'enable_cta',
            'select',
            [
                'name'  => 'enable_cta',
                'label' => __('Enable CTA'),
                'title' => __('Enable CTA'),
                'values' => $this->_booleanOptions->toOptionArray(),
                'note' => __('Enable CTA yes/no. if enabled, Link field will be used as href') 
            ]
        );
        $fieldset->addField(
            'link',
            'text',
            [
                'name'  => 'link',
                'label' => __('Link'),
                'title' => __('Link'),
                'note'     => __('URL for the link button.'),
            ]
        );
        $fieldset->addField(
            'enable_slide_link',
            'select',
            [
                'name'  => 'enable_slide_link',
                'label' => __('Enable Slide Link'),
                'title' => __('Enable Slide Link'),
                'values' => $this->_booleanOptions->toOptionArray(),
                'note' => __('Enable Slide Link yes/no. if enabled, Link field will be used as href') 
            ]
        );
        $slideData = $this->_session->getData('redstage_carousel_slide_data', true);


        if ($slideData) {
            $slide->addData($slideData);
        } else {
            if (!$slide->getId()) {
                $slide->addData($slide->getDefaultValues());
            }
        }
        $form->addValues($slide->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('Slide');
    }

    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
