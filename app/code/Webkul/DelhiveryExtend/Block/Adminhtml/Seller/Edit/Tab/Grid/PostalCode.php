<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryExtend\Block\Adminhtml\Seller\Edit\Tab\Grid;

use Magento\Customer\Controller\RegistryConstants;

class PostalCode extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Webkul\DelhiveryShipping\Model\ManagepincodeFactory
     */
    protected $pincodeFactory;

    /**
     * @var \Webkul\Marketplace\Model\ResourceModel\Product\Collection
     */
    protected $_sellerProduct;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * @param \Magento\Backend\Block\Template\Context                    $context
     * @param \Magento\Backend\Helper\Data                               $backendHelper
     * @param \Magento\Framework\Registry                                $coreRegistry
     * @param \Webkul\DelhiveryShipping\Model\ManagepincodeFactory       $productFactory
     * @param \Webkul\Marketplace\Model\ResourceModel\Product\Collection $sellerProduct
     * @param \Magento\Framework\Json\EncoderInterface                   $jsonEncoder
     * @param array                                                      $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Framework\Registry $coreRegistry,
        \Webkul\DelhiveryShipping\Model\ManagepincodeFactory $pincodeFactory,
        \Webkul\Marketplace\Model\ResourceModel\Product\Collection $sellerProduct,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Webkul\DelhiveryExtend\Model\PinSellerMapFactory $pinSellerMapFactory,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->pincodeFactory = $pincodeFactory;
        $this->_sellerProduct = $sellerProduct;
        $this->jsonEncoder = $jsonEncoder;
        $this->pinSellerMapFactory = $pinSellerMapFactory;
        $this->productVisibility = $productVisibility;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('seller_postalcode_grid');
        $this->setDefaultSort('entity_at');
        $this->setUseAjax(true);
    }

    /**
     * @param Column $column
     * @return $this
     */
    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in adminassign flag
        if ($column->getId() == 'in_adminassign_postal') {
            $postalCodeIds = $this->getSellerAssignedPostalCode();
            if (empty($postalCodeIds)) {
                $postalCodeIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('pin', ['in' => $postalCodeIds]);
            } elseif (!empty($postalCodeIds)) {
                $this->getCollection()->addFieldToFilter('pin', ['nin' => $postalCodeIds]);
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    /**
     * Apply various selection filters to prepare the sales order grid collection.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        $this->setDefaultFilter(['in_adminassign_postal' => 1]);
        $paramData = $this->getRequest()->getParams();
        $sellerId = (int)$this->getRequest()->getParam('id', 0);
        /*$alreadyAssigeedPin = $this->pinSellerMapFactory->create()->getCollection()
                                    ->addFieldToFilter('seller_id', ['neq' => $sellerId])
                                    ->getColumnValues('pincode');
        $alreadyAssigeedPin = empty($alreadyAssigeedPin) ? [0] : $alreadyAssigeedPin;
        $collection = $this->pincodeFactory->create()->getCollection()->addFieldToSelect('*')
                                    ->addFieldToFilter('pin', ['nin' => $alreadyAssigeedPin]);*/
        $collection = $this->pincodeFactory->create()->getCollection()->addFieldToSelect('*');
        $this->setCollection($collection);

        if (!isset($paramData['filter'])) {
            $postalCodeIds = $this->getSellerAssignedPostalCode();
            if (empty($postalCodeIds)) {
                $postalCodeIds = 0;
            }

            $this->getCollection()->addFieldToFilter('pin', ['in' => $postalCodeIds]);
        }

        return parent::_prepareCollection();
    }

    /**
     * @return Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'in_adminassign_postal',
            [
                'type' => 'checkbox',
                'name' => 'in_adminassign_postal',
                'index' => 'pincode_id',
                'data-form-part' => $this->getData('target_form'),
                'header_css_class' => 'col-select col-massaction',
                'column_css_class' => 'col-select col-massaction',
                'values' => $this->getSellerAssignedPostalCodeIds()
            ]
        );
        $this->addColumn(
            'pin',
            [
                'header' => __('Postal Code'),
                'index' => 'pin'
            ]
        );
        $this->addColumn(
            'district',
            [
                'header' => __('District'),
                'index' => 'district'
            ]
        );
        $this->addColumn(
            'pre_paid',
            [
                'header' => __('Pre Paid'),
                'index' => 'pre_paid'
            ]
        );
        $this->addColumn(
            'cash',
            [
                'header' => __('Cash'),
                'index' => 'cash'
            ]
        );
        $this->addColumn(
            'pickup',
            [
                'header' => __('Pickup'),
                'index' => 'pickup'
            ]
        );
        $this->addColumn(
            'cod',
            [
                'header' => __('COD'),
                'index' => 'cod'
            ]
        );
        $this->addColumn(
            'state_code',
            [
                'header' => __('State Code'),
                'index' => 'state_code'
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * Retrieve the Url for a specified sales order row.
     *
     * @param \Magento\Sales\Model\Order|\Magento\Framework\DataObject $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return "#";
    }

    /**
     * {@inheritdoc}
     */
    public function getGridUrl()
    {
        return $this->getUrl('delhiveryextend/seller/postalcode', ['_current' => true]);
    }

    /**
     * @return array
     */
    protected function getSellerAssignedPostalCode()
    {
        $pincodeCodes = $this->pinSellerMapFactory->create()->getCollection()
                            ->addFieldToFilter('seller_id', ['eq' => (int)$this->getRequest()->getParam('id', 0)])
                            ->getColumnValues('pincode');

        return $pincodeCodes;
    }

    /**
     * Get SellerAssignedPostalCodeIds
     *
     * @return array
     */
    protected function getSellerAssignedPostalCodeIds()
    {
        $pincodeCodes = $this->getSellerAssignedPostalCode();

        $pincodeIds = $this->pincodeFactory->create()->getCollection()
                                ->addFieldToFilter('pin', ['in' => $pincodeCodes])
                                ->getColumnValues('pincode_id');
        return !empty($pincodeIds) ? $pincodeIds : 0;
    }

    /**
     * @return array
     */
    /*protected function getAllOtherSellerAssignedProducts()
    {
        $products = $this->_sellerProduct->getAllAssignProducts(
            "`seller_id`!=".(int)$this->getRequest()->getParam('id', 0)
        );
        return $products;
    }*/

    /**
     * @return string
     */
    public function getSellerAssignedPostalCodeJson()
    {
        $products = $this->getSellerAssignedPostalCode();
        if (!empty($products)) {
            return $this->jsonEncoder->encode($products);
        }
        return '{}';
    }
}
