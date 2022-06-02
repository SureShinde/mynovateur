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

class Product extends \Webkul\Marketplace\Block\Adminhtml\Customer\Edit\Tab\Grid\Product
{
    /**
     * @return Extended
     */
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addColumn(
            'seller_price',
            [
                'header' => __('Product Seller Price'),
                'index' => 'price',
                'type' => 'currency',
                'currency_code' => (string)$this->_scopeConfig->getValue(
                    \Magento\Directory\Model\Currency::XML_PATH_CURRENCY_BASE,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            ]
        );
        $this->addColumn(
            'qty',
            [
                'header' => __('qty'),
                'index' => 'qty',
                'type' => 'input'
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * Apply various selection filters to prepare the sales order grid collection.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        $this->setDefaultFilter(['in_adminassign' => 1]);
        $paramData = $this->getRequest()->getParams();
        // $allOtherSellerProductIds = $this->getAllOtherSellerAssignedProducts();

        $collection = $this->_productFactory->create()->getCollection()
        ->addAttributeToSelect(
            'name'
        )->addAttributeToSelect(
            'sku'
        )->addAttributeToSelect(
            'price'
        );
        $collection->setVisibility($this->productVisibility->getVisibleInSiteIds());
        $sellerAssPro = $collection->getResource()->getTable('marketplace_assignproduct_items');
        $collection->getSelect()->join(
                    $sellerAssPro.' as mai',
                    'e.entity_id = mai.product_id'
                )->where(
                    'mai.seller_id = 1'
                );
        //echo json_encode($collection->getData());
        //die;
        $this->setCollection($collection);

        if (!isset($paramData['filter'])) {
            $productIds = $this->getSellerAssignedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            $this->getCollection()->addFieldToFilter('entity_id', ['in' => $productIds]);
        }
        return parent::_prepareCollection();
    }
}
