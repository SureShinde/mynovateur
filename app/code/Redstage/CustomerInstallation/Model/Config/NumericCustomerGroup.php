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

class NumericCustomerGroup extends AbstractSource
{

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label'=>__('Industry'),'value'=>'70'],
            ['label'=>__('Data Centres'),'value'=>'71'],
            ['label'=>__('IT & ITES'),'value'=>'72'],
            ['label'=>__('BFSI'),'value'=>'73'],
            ['label'=>__('Education'),'value'=>'74'],
            ['label'=>__('Healthcare'),'value'=>'75'],
            ['label'=>__('Power, Oil & Gas'),'value'=>'76'],
            ['label'=>__('Residential & SOHO'),'value'=>'77'],
            ['label'=>__('Office'),'value'=>'78'],
            ['label'=>__('Hotels'),'value'=>'79'],
            ['label'=>__('Retail'),'value'=>'80'],
            ['label'=>__('Infrastructure'),'value'=>'81'],
            ['label'=>__('Others'),'value'=>'82']
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