<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomInvoice
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\CustomInvoice\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Directory\Api\CountryInformationAcquirerInterface;

class CreateAttributes implements DataPatchInterface
{
    /**
     * country code if india
     */
    public const COUNTRYCODE = 'IN';

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param SetFactory $attributeSetFactory
     */
    public function __construct(
        CountryInformationAcquirerInterface $countryInformation,
        CustomerSetupFactory $customerSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup,
        SetFactory $attributeSetFactory
    ) {
        $this->countryInformation = $countryInformation;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
        /** @var $attributeSet AttributeSet */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $attributeCodes = [
            [
                'value' => 'pan',
                'label' => 'PAN Number',
                'note' => 'PAN Number of User.',
                'visible' => true,
                'used_in_forms' => ['customer_account_create','customer_account_edit','adminhtml_checkout']
            ],
            [
                'value' => 'cin',
                'label' => 'CIN Number',
                'note' => 'CIN Number of Vendor.',
                'visible' => false,
                'used_in_forms' => ['adminhtml_checkout']
            ]
        ];

        foreach ($attributeCodes as $key => $code) {
            $frontendClass = '';
            $customerSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                $code['value'],
                [
                    'type' => 'varchar',
                    'label' => $code['label'],
                    'input' => 'text',
                    'frontend_class' => $frontendClass,
                    'required' => false,
                    'visible' => $code['visible'],
                    'user_defined' => true,
                    'sort_order' => 100+$key,
                    'position' => 100+$key,
                    'system' => 0,
                    'note' => $code['note']
                ]
            );

            $attribute = $customerSetup->getEavConfig()
                            ->getAttribute(\Magento\Customer\Model\Customer::ENTITY, $code['value'])
                            ->addData(
                                [
                                    'attribute_set_id' => $attributeSetId,
                                    'attribute_group_id' => $attributeGroupId,
                                    'used_in_forms' => $code['used_in_forms']
                                ]
                            );

            $attribute->save();
        }

        $regionsDataList = [];
        $connection = $this->moduleDataSetup->getConnection();
        $country = $this->countryInformation->getCountryInfo(self::COUNTRYCODE);
        if (!empty($country)) {
            $regionsData = $country->getAvailableRegions();
            if (!empty($regionsData)) {
                foreach ($regionsData as $region) {
                    $regionsDataList[] = [
                        'state_code' => $region->getId(),
                        'country_code' => self::COUNTRYCODE
                    ];
                }
            }
        }

        $connection->insertMultiple($this->moduleDataSetup->getTable('wk_gst_state_code'), $regionsDataList);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
