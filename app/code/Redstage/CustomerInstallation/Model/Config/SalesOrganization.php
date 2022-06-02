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

class SalesOrganization extends AbstractSource
{

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label'=>__('Online Sales Org'),'value'=>'1001'],
            ['label'=>__('Offline Sales Org'),'value'=>'1002'],
            ['label'=>__('3Ph Sales Org'),'value'=>'1009']
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