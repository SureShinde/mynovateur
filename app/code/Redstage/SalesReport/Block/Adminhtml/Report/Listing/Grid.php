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

namespace Redstage\SalesReport\Block\Adminhtml\Report\Listing;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Framework\Registry;
use Redstage\SalesReport\Model\ResourceModel\Installation\Collection;


class Grid extends Extended {
    /**
     * @var \Magento\Framework\Registry
    */
    protected $registry;

    /**
     * @var Redstage\SalesReport\Model\ResourceModel\Installation\Collection
    */
    protected $_shipmentCollection;


    public function __construct(
    Context $context, 
    Data $backendHelper, 
    Registry $registry, 
    Collection $shipmentCollection,
    array $data = []
    ) {
        $this->registry = $registry;
        $this->_shipmentCollection = $shipmentCollection;
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
        $collection = $this->_shipmentCollection->ShipmentItemCollection();     
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
                'increment_id', [
                'header' => 'E market place Invoice No',
                'type' => 'text',
                'index' => 'increment_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'sfoincrement', [
                'header' => 'Order No',
                'type' => 'text',
                'index' => 'sfoincrement',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'order_date', [
            'header' => __('Order Date'),
            'type' => 'text',
            'index' => 'order_date',
            'class' => '',
            'width' => '200px',
            'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\DateFormat',
            'filter' => false
                ]
        );
        $this->addColumn(
                'order_date2', [
                'header' => 'Billing Date',
                'type' => 'text',
                'index' => 'order_date',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\DateFormat',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'partner_code', [
                'header' => 'Partner Code',
                'type' => 'text',
                'index' => 'customer_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\PartnerCode',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'business_partner_id', [
                'header' => 'Business Partner Id',
                'type' => 'text',
                'index' => 'customer_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\PartnerCode',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'full_name', [
            'header' => __('Partner Name'),
            'type' => 'text',
            'index' => 'full_name',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'gst_no', [
                'header' => 'GST Number',
                'type' => 'text',
                'index' => 'customer_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\GstNo',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'partner_pan_no', [
                'header' => 'PAN number of partner',
                'type' => 'text',
                'index' => 'customer_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\PartnerPanNo',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'cdataentity_id', [
                'header' => 'Customer/Account Id',
                'type' => 'text',
                'index' => 'cdataentity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'full_name2', [
            'header' => __('Customer Name'),
            'type' => 'text',
            'index' => 'full_name',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'customer_nature', [
            'header' => __('Nature of Customer'),
            'type' => 'text',
            'index' => 'customer_id',
            'class' => '',
            'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\CustomerNature',
            'filter' => false
                ]
        );
        $this->addColumn(
            'billing_type', [
            'header' => __('Billing Type'),
            'type' => 'text',
            'index' => 'billing_type',
            'class' => '',
            'width' => '200px',
            'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\BillingType',
            'filter' => false
                ]
        );
        $this->addColumn(
            'partner_state_billing', [
            'header' => __('Partner\'s state Billing'),
            'type' => 'text',
            'index' => 'partner_state_billing',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'city', [
            'header' => __('City'),
            'type' => 'text',
            'index' => 'city',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'entity_id', [
                'header' => 'Market Place Product Id',
                'type' => 'text',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                //'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\MarketPlaceProductId',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'sku', [
                'header' => 'Item Code',
                'type' => 'text',
                'index' => 'sku',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'item_description', [
                'header' => 'Item Description',
                'type' => 'text',
                'index' => 'product_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\ItemDescription',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'product_group', [
            'header' => __('Product Group'),
            'type' => 'text',
            'index' => 'product_id',
            'class' => '',
            'width' => '200px',
            'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\ProductGroup',
            'filter' => false
                ]
        );
        $this->addColumn(
                'sku8', [
                'header' => 'Product Sub Group',
                'type' => 'text',
                'index' => 'sku',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                //'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\ProductSubGroup'
                    ]
        );

        $this->addColumn(
            'unit_of_measure', [
            'header' => __('Unit of Measure'),
            'type' => 'text',
            'index' => 'product_id',
            'class' => '',
            'width' => '200px',
            'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\UnitOfMeasure',
            'filter' => false
                ]
        );

        $this->addColumn(
                'kva', [
                'header' => 'KVA',
                'type' => 'text',
                'index' => 'product_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\Kva'
                    ]
        );

        $this->addColumn(
            'billing_Quantity', [
            'header' => __('Billing Quantity'),
            'type' => 'text',
            'index' => 'qty',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'delivery_ref_doc', [
            'header' => __('Delivery / Ref. Doc'),
            'type' => 'text',
            'index' => 'delivery_ref_doc',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'name_of_logistics', [
                'header' => 'Name Of Logistics',
                'type' => 'text',
                'index' => 'name_of_logistics',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                //'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\NameOfLogistics',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'date_of_dispatch', [
                'header' => 'Date of Dispatch',
                'type' => 'date',
                'index' => 'date_of_dispatch',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\DateFormat'
                    ]
        );
        $this->addColumn(
                'date_of_delivery', [
                'header' => 'Date of Delivery',
                'type' => 'date',
                'index' => 'date_of_dispatch',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                //'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\DateOfDelivery',
                'renderer' => 'Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer\DateFormat',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'total_invoice_value', [
            'header' => __('Total Invoice Value'),
            'type' => 'text',
            'index' => 'total_invoice_value',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'basic_value', [
            'header' => __('Basic Value'),
            'type' => 'text',
            'index' => 'basic_value',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'taxes_cgst', [
            'header' => __('Taxes (CGST)'),
            'type' => 'text',
            'index' => 'taxes_cgst',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'taxes_sgst_by_ugst', [
            'header' => __('Taxes (SGST) / (UGST)'),
            'type' => 'text',
            'index' => 'taxes_utgst',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'taxes_igst', [
            'header' => __('Taxes (IGST)'),
            'type' => 'text',
            'index' => 'taxes_igst',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'taxes_gst', [
            'header' => __('GST TCS'),
            'type' => 'text',
            'index' => 'taxes_gst',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'packaging_forwording_charges', [
            'header' => __('Packing and Forwarding Charges'),
            'type' => 'text',
            'index' => 'packaging_forwording_charges',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'return_period_status', [
            'header' => __('Return Period Status'),
            'type' => 'text',
            'index' => 'return_period_status',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );

        return parent::_prepareColumns();
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/', ['_current' => true]);
    }

}
