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

class Region extends AbstractSource
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
            ['value' => '01', 'label' =>	'ANDHRA PRADESH'],
            ['value' => '02', 'label' =>	'ARUNACHAL PRADESH'],
            ['value' => '03', 'label' =>	'ASSAM'],
            ['value' => '04', 'label' =>	'BIHAR'],
            ['value' => '05', 'label' =>	'GOA'],
            ['value' => '06', 'label' =>	'GUJARAT'],
            ['value' => '07', 'label' =>	'HARYANA'],
            ['value' => '08', 'label' =>	'HIMACHAL PRADESH'],
            ['value' => '09', 'label' =>	'JAMMU AND KASHMIR'],
            ['value' => '10', 'label' =>	'KARNATAKA'],
            ['value' => '11', 'label' =>	'KERALA'],
            ['value' => '12', 'label' =>	'MADHYA PRADESH'],
            ['value' => '13', 'label' =>	'MAHARASHTRA'],
            ['value' => '14', 'label' =>	'MANIPUR'],
            ['value' => '15', 'label' =>	'MEGALAYA'],
            ['value' => '16', 'label' =>	'MIZORAM'],
            ['value' => '17', 'label' =>	'NAGALAND'],
            ['value' => '18', 'label' =>	'ODISHA'],
            ['value' => '19', 'label' =>	'PUNJAB'],
            ['value' => '20', 'label' =>	'RAJASTHAN'],
            ['value' => '21', 'label' =>	'SIKKIM'],
            ['value' => '22', 'label' =>	'TAMIL NADU'],
            ['value' => '23', 'label' =>	'TRIPURA'],
            ['value' => '24', 'label' =>	'UTTAR PRADESH'],
            ['value' => '25', 'label' =>	'WEST BENGAL'],
            ['value' => '26', 'label' =>	'ANDAMAN AND NICO.IN.'],
            ['value' => '27', 'label' =>	'CHANDIGARH'],
            ['value' => '28', 'label' =>	'DADRA AND NAGAR HAV.'],
            ['value' => '29', 'label' =>	'DAMAN AND DIU'],
            ['value' => '30', 'label' =>	'DELHI'],
            ['value' => '31', 'label' =>	'LAKSHADWEEP'],
            ['value' => '32', 'label' =>	'PUDUCHERRY'],
            ['value' => '33', 'label' =>	'CHHAATTISGARG'],
            ['value' => '34', 'label' =>	'JHARKHAND'],
            ['value' => '35', 'label' =>	'UTTRAKHAND'],
            ['value' => '36', 'label' =>	'TELANGANA'],
            ['value' => '38', 'label' =>	'LADAKH'],

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
