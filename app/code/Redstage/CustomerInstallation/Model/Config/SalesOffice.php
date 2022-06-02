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

class SalesOffice extends AbstractSource
{

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['value' => '', 'label' =>	'Please Select'],
            ['value' => 'AHS', 'label' => 'AHMEDABAD'],
            ['value' => 'BBS', 'label' => 'BHUBANESHWAR'],
            ['value' => 'BHS', 'label' => 'BHOPAL'],
            ['value' => 'BLS', 'label' => 'BANGALORE'],
            ['value' => 'CBS', 'label' => 'COIMBATORE'],
            ['value' => 'CHS', 'label' => 'CHENNAI'],
            ['value' => 'HYS', 'label' => 'HYDERABAD'],
            ['value' => 'KOS', 'label' => 'COCHIN'],
            ['value' => 'KTS', 'label' => 'KOLKATA'],
            ['value' => 'LKS', 'label' => 'LUCKNOW'],
            ['value' => 'MDU', 'label' => 'MADURAI'],
            ['value' => 'MUS', 'label' => 'MUMBAI'],
            ['value' => 'NDS', 'label' => 'NEW DELHI'],

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
      return $this->getAllOptions();
    }
}
