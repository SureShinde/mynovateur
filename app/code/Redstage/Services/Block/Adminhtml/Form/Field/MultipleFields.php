<?php
/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Services
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Services
 */
  
namespace Redstage\Services\Block\Adminhtml\Form\Field;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
 
class MultipleFields extends AbstractFieldArray
{
    protected function _prepareToRender()
    {
        $this->addColumn('service_calltype', ['label' => __('CallType Text Field'), 'class' => 'required-entry']);      
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add New');
    }
}