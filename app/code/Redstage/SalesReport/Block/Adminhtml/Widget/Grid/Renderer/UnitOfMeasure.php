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

namespace Redstage\SalesReport\Block\Adminhtml\Widget\Grid\Renderer;
use Magento\Framework\DataObject;
use Magento\Backend\Block\Context;
use Redstage\SalesReport\Helper\Data;

class UnitOfMeasure extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
    /**
     * @var AttributeRepositoryInterface
     */
    protected $_productFactory;

    /**
     * @var Helper
     */
    protected $_helper;
 
    public function __construct(
        Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        Data $helper,
        array $data = []
    )
    {
        $this->_productFactory = $productFactory;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }

    public function _getValue(DataObject $row)
    {
        $value = parent::_getValue($row);
        if($value){
            $productData = $this->_productFactory->create()->load($value);
            return $this->_helper->getWeightUnit();
            //return $productData->getUOM();
        } 
        return '';
    }
}