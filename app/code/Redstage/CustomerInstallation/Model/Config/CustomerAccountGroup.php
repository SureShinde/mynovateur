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
namespace Redstage\CustomerInstallation\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CustomerAccountGroup extends AbstractSource
{

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label'=>__('N002 Sold To Party'),'value'=>'Z001'],
            ['label'=>__('N002 Ship To Party'),'value'=>'Z002'],
            ['label'=>__('N002 Payer To Party'),'value'=>'Z003'],
            ['label'=>__('N002 Bill To Party'),'value'=>'Z004'],
            ['label'=>__('N002 Sales partners'),'value'=>'Z007']
        ];

        return $this->_options;
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function getOptionArray()
    {
        $_options = array();
        foreach ($this->getAllOptions() as $option) {
            $_options[$option['value']] = $option['label'];
        }
        return $_options;
    }
}