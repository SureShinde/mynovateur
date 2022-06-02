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
namespace Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer;
use Magento\Framework\DataObject;
use Magento\Backend\Block\Context;

class ContactName extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
    /**
     * @var AttributeRepositoryInterface
     */
    protected $_addressFactory;
 
    public function __construct(
        Context $context,
        \Magento\Customer\Model\AddressFactory $addressFactory,
        array $data = []
    )
    {
        $this->_addressFactory = $addressFactory;
        parent::__construct($context, $data);
    }

    public function _getValue(DataObject $row)
    {
        $value = parent::_getValue($row);
        if($value){
            $shippingAddress = $this->_addressFactory->create()->load($value);
            return $shippingAddress->getContactName();
        } 
        return '';
    }
}