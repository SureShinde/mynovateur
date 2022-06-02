<?php
/**
 * Redstage CustomerInstallation module purpose admin user can export customer data predifined CSV.
 *
 * @category: PHP
 * @package: Redstage/CustomerInstallation
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Mohit Tyagi <mtyagi@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_CustomerInstallation
 */
namespace Redstage\CustomerInstallation\Block\Adminhtml\Widget\Grid\Renderer\Address;
use Magento\Framework\DataObject;

class Secondline extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
    public function _getValue(DataObject $row)
    {
        $value = parent::_getValue($row);
        $lines = explode("\n", $value);
        if(isset($lines[1])){
            return $lines[1];
        }
        return '';
    }
}