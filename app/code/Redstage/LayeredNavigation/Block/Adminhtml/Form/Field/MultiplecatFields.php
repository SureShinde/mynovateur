<?php
/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */
  
namespace Redstage\LayeredNavigation\Block\Adminhtml\Form\Field;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
 
class MultiplecatFields extends AbstractFieldArray
{
    protected function _prepareToRender()
    {
        $this->addColumn('category_apply', ['label' => __('Category Apply'), 'class' => 'required-entry']);      
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add New');
    }
}