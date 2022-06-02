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

class Pricing extends AbstractSource
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
            ['value' => '1', 'label' => 'Standard'],
            ['value' => '8', 'label' => 'Equipment Lease'],

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
