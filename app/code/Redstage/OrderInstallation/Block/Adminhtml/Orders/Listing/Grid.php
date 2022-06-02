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

namespace Redstage\OrderInstallation\Block\Adminhtml\Orders\Listing;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Framework\Registry;
use Redstage\OrderInstallation\Model\ResourceModel\Installation\Collection;


class Grid extends Extended {
    /**
     * @var \Magento\Framework\Registry
    */
    protected $registry;

    /**
     * @var Redstage\OrderInstallation\Model\ResourceModel\Installation\Collection
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
                'origin', [
                'header' => 'Origin',
                'type' => 'text',
                'index' => 'origin',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\Origin',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'shipment_customer_id', [
            'header' => __('WebCustref no'),
            'type' => 'text',
            'index' => 'shipment_customer_id',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'supplythrough', [
                'header' => 'Supply through',
                'type' => 'text',
                'index' => 'supplythrough',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\SupplyThrough',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'firstname', [
            'header' => __('Customer Name'),
            'type' => 'text',
            'index' => 'firstname',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'street1', [
                'header' => 'Address 1',
                'type' => 'text',
                'index' => 'street1',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address\Firstline',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'street2', [
                'header' => 'Address 2',
                'type' => 'text',
                'index' => 'street2',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address\Secondline',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'street3', [
                'header' => 'Address 3',
                'type' => 'text',
                'index' => 'street3',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address\Threeline',
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
            'postcode', [
            'header' => __('Pincode'),
            'type' => 'text',
            'index' => 'postcode',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'region', [
            'header' => __('State'),
            'type' => 'text',
            'index' => 'region',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'email', [
            'header' => __('Email'),
            'type' => 'text',
            'index' => 'email',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'sfogroupid', [
                'header' => 'Customer Category',
                'type' => 'text',
                'index' => 'sfogroupid',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\GroupId',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'shipping_contactname', [
                'header' => 'Contact Name',
                'type' => 'text',
                'index' => 'shipping_contactname',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\ContactName',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'shipping_contactnumber', [
                'header' => 'Contact Number',
                'type' => 'text',
                'index' => 'shipping_contactnumber',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\ContactNumber',
                'filter' => false
                    ]
        );
        $this->addColumn(
            'sfoincrement', [
            'header' => __('Order Number'),
            'type' => 'text',
            'index' => 'sfoincrement',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'sfocreated', [
                'header' => 'Order Date',
                'type' => 'date',
                'index' => 'sfocreated',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\DateFormat'
                    ]
        );

        $this->addColumn(
            'sinincrement', [
            'header' => __('Invoice Number'),
            'type' => 'text',
            'index' => 'sinincrement',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );

        $this->addColumn(
                'sincreated', [
                'header' => 'Invoice Date',
                'type' => 'date',
                'index' => 'sincreated',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\DateFormat'
                    ]
        );

        $this->addColumn(
            'product_sku', [
            'header' => __('Product Sku'),
            'type' => 'text',
            'index' => 'product_sku',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
            'product_name', [
            'header' => __('Product'),
            'type' => 'text',
            'index' => 'product_name',
            'class' => '',
            'width' => '200px',
            'filter' => false
                ]
        );
        $this->addColumn(
                'product_desc', [
                'header' => 'Product details',
                'type' => 'text',
                'index' => 'product_desc',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\ProductDesc',
                'filter' => false
                    ]
        );
        $this->addColumn(
                'shipment_created_at', [
                'header' => 'Delivery Date',
                'type' => 'date',
                'index' => 'shipment_created_at',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'renderer' => 'Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\DateFormat'
                    ]
        );

        $this->addExportType('*/*/exportCsv', __('CSV'));
        return parent::_prepareColumns();
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/', ['_current' => true]);
    }

}
