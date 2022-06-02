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
namespace Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address;
use Magento\Framework\DataObject;

class Threeline extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
    public function _getValue(DataObject $row)
    {
        $value = parent::_getValue($row);
        $lines = explode("\n", $value);
        if(isset($lines[2])){
            return $lines[2];
        }
        return '';
    }
}