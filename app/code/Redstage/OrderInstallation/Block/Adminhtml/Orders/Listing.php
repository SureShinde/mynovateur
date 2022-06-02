<?php
/**
 * Redstage OrderInstallation module purpose admin user can export order data predifined CSV only shipment created order data.
 *
 * @category: PHP
 * @package: Redstage/OrderInstallation
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Mohit Tyagi <mtyagi@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_OrderInstallation
 */

namespace Redstage\OrderInstallation\Block\Adminhtml\Orders;

class Listing extends \Magento\Backend\Block\Widget\Grid\Container {

    /**
     * @return void
     */
    protected function _construct() {
        $this->_controller = 'adminhtml_orders_listing';
        $this->_blockGroup = 'Redstage_OrderInstallation';
        $this->_headerText = __('Order Export1');
        $this->_addButtonLabel = __('Add Shipment');
        parent::_construct();
        $this->buttonList->remove('add'); //to remove add button
    }

}
