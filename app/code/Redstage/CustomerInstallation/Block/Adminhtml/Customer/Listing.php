<?php

/**
 * Redstage CustomerInstallation module purpose admin user can export customer data predifined CSV.
 *
 * @category: PHP
 * @package: Redstage/CustomerInstallation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_CustomerInstallation
 */

namespace Redstage\CustomerInstallation\Block\Adminhtml\Customer;

class Listing extends \Magento\Backend\Block\Widget\Grid\Container {

    /**
     * @return void
     */
    protected function _construct() {
        $this->_controller = 'adminhtml_customer_listing';
        $this->_blockGroup = 'Redstage_CustomerInstallation';
        $this->_headerText = __('Customer Export');
        $this->_addButtonLabel = __('Add Customer');
        parent::_construct();
        $this->buttonList->remove('add'); //to remove add button
    }

}
