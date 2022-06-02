<?php
/**
 * Redstage SalesReport module purpose admin user can view sales report.
 *
 * @category: PHP
 * @package: Redstage/SalesReport
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Anjulata Gupta <agupta@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_SalesReport
 */

namespace Redstage\SalesReport\Block\Adminhtml\Report;

class Listing extends \Magento\Backend\Block\Widget\Grid\Container {

    /**
     * @return void
     */
    protected function _construct() {
        $this->_controller = 'adminhtml_report_listing';
        $this->_blockGroup = 'Redstage_SalesReport';
        $this->_headerText = __('Sales Report1S');
        $this->_addButtonLabel = __('Add Shipment');
        parent::_construct();
        $this->buttonList->remove('add'); //to remove add button
    }

}
