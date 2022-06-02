<?php
/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */
  
namespace Redstage\ServiceTicket\Block\Adminhtml\Form\Field;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
 
class MultipleFields extends AbstractFieldArray
{
    protected function _prepareToRender()
    {
        $this->addColumn('serviceticket_requesttype', ['label' => __('Service Request Text Field'), 'class' => 'required-entry']);      
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add New');
    }
}