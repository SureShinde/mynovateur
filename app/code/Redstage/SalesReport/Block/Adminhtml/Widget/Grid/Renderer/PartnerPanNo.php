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

class PartnerPanNo extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
    /**
     * @var AttributeRepositoryInterface
     */
    protected $_customerFactory;
 
    public function __construct(
        Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        array $data = []
    )
    {
        $this->_customerFactory = $customerFactory;
        parent::__construct($context, $data);
    }

    public function _getValue(DataObject $row)
    {
        $value = parent::_getValue($row);
        if($value){
            $partnerPanNo = $this->_customerFactory->create()->load($value);            
            return $partnerPanNo->getPan();
        } 
        return '';
    }
}