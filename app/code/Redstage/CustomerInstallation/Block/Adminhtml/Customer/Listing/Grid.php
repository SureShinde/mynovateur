<?php

/**
 * Redstage CustomerInstallation module purpose admin user can export customer data predifined CSV.
 *
 * @category: PHP
 * @package: Redstage/CustomerInstallation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_CustomerInstallation
 */

namespace Redstage\CustomerInstallation\Block\Adminhtml\Customer\Listing;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Framework\Registry;
use Redstage\CustomerInstallation\Model\ResourceModel\Customer\Grid\Collection;


class Grid extends Extended {
    /**
     * @var \Magento\Framework\Registry
    */
    protected $registry;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\Funded
    */
    protected $_customerCollection;


    public function __construct(
    Context $context,
    Data $backendHelper,
    Registry $registry,
    Collection $customerCollection,
    array $data = []
    ) {
        $this->registry = $registry;
        $this->_customerCollection = $customerCollection;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct() {
        parent::_construct();
        $this->setId('index');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare last paid price grid collection object
     *
     * @return $this
     */
    protected function _prepareCollection() {
        $collection = $this->_customerCollection->CustomerCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare last paid price grid columns
     *
     * @return $this
     */
    protected function _prepareColumns() {

        $this->addColumn(
            'created_at', [
            'header' => __('Created At'),
            'type' => 'date',
            'index' => 'created_at',
            'class' => '',
            'width' => '200px',
                ]
        );

        // Update customer attributes
        $addUserDefineAttributes = [
            "sap_customer_code" => "SAP Customer code",
            "company_code" => "Company Code",
            "sales_organization" => "Sales Organization",
            "distribution_channel" => "Distribution Channel",
            "division" => "Division",
            "customer_account_group" => "Customer Account Group",
            "title_text" => "Title Text",
            "firstname" => "Name 1",
            "name_2" => "Name 2",
            "short" => "Short",
        ];
        foreach ($addUserDefineAttributes as $key => $value) {
            $this->addColumn(
                $key, [
                'header' => $value,
                'type' => 'text',
                'index' => $key,
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'filter' => false
                    ]
            );
        }

        $this->addColumn(
                'billing_street_first_line', [
                'header' => 'Street',
                'type' => 'text',
                'index' => 'billing_street_line',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\CustomerInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address\Firstline',
                'filter' => false
                    ]
        );

        $this->addColumn(
                'billing_street_second_line', [
                'header' => 'Steet4',
                'type' => 'text',
                'index' => 'billing_street_line',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\CustomerInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address\Secondline',
                'filter' => false
                    ]
        );

        $this->addColumn(
                'billing_street_three_line', [
                'header' => 'Steet5',
                'type' => 'text',
                'index' => 'billing_street_line',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\CustomerInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address\Threeline',
                'filter' => false
                    ]
        );

        // Update customer attributes
        $addUserDefineAttributes = [
            "district" => "District",
            "citypostalcode" => "Citypostalcode",
            "city" => "City",
            "country_key" => "Country Key",
            "region" => "REGION",
            "transportation_zone" => "Transportation zone",
            "language_key" => "Language Key",
            "telephone_no" => "Telephone no",
            "mobile_telephone_no" => "Mobile Telephone No",
            "fax_number" => "FAX_NUMBER",
            "email_address" => "E-Mail Address",
            "customer_type" => "Customer Type",
            "ecc_number" => "Ecc Number",
            "excise_registration_number" => "Excise Registration Number",
            "excise_range" => "Excise Range",
            "excise_division" => "Excise Division",
            "excise_commissionerate" => "Excise Commissionerate",
            "excise_tax_indicator_for_customer" => "Excise tax indicator for customer",
            "central_sales_tax_number" => "Central Sales Tax Number",
            "local_sales_tax_number" => "Local Sales Tax Number",
            "tax_number_2" => "Tax Number 2",
            "name_1" => "Name 1",
            "reconciliation_account" => "Reconciliation Account",
            "terms_of_payment_key" => "Term of Payment key",
            "order_probability_of_the_item" => "Order probability of the item",
            "sales_office" => "Sales Office",
            "sales_group" => "Sales Group",
            "customer_group" => "Customer Group",
            "currency" => "Currency",
            "pricing" => "Pricing",
            "customer_statistics_group" => "Customer statistics group",
            "delivery_priority" => "Delivery Priority",
            "order_combination_indicator" => "Order combination indicator",
            "shipping_conditions" => "Shipping conditions",
            "complete_delivery_defined_for_each_sales_order" => "Complete delivery defined for
each sales order?",
            "partial_delivery_at_item_level" => "Partial delivery at item level",
            "account_assignment_group_for_this_customer" => "Account assignment group for
this customer",
            "tax_clssification" => "Tax Classification",
            "tax_clssification_1" => "Tax Classification",
            "tax_clssification_2" => "Tax Classification",
            "web_ref_customer_no" => "Web Ref. customer no",
            "reserved" => "Reserved",
            "reserved_2" => "Reserved",
            "funded_by_public_private" => "Funded by PUBLIC / PRIVATE",
            "gstin" => "GSTIN",
            "pan" => "PAN"
        ];
        foreach ($addUserDefineAttributes as $key => $value) {
            $this->addColumn(
                $key, [
                'header' => $value,
                'type' => 'text',
                'index' => $key,
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'filter' => false
                    ]
            );
        }

        $this->addExportType('*/*/exportCsv', __('CSV'));
        return parent::_prepareColumns();
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/', ['_current' => true]);
    }

}
