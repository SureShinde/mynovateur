<?php
declare(strict_types=1);

namespace Redstage\AmcConfigurator\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Psr\Log\LoggerInterface;

class CustomerAmcAttribute implements DataPatchInterface
{

     /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AddressAttribute constructor.
     *
     * @param Config              $eavConfig
     * @param EavSetupFactory     $eavSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory,
        LoggerInterface $logger
    ) {
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [
            \Redstage\CustomerInstallation\Setup\Patch\Data\CustomerInstallationAttribute::class,
            \Redstage\CustomerInstallation\Setup\Patch\Data\CustomerInstallationNameAttribute::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function apply(): void
    {
        try {

        $eavSetup = $this->eavSetupFactory->create();

        $customerEntity = $this->eavConfig->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $deleteAttrbutes =  [
            'name1','name2','numeric_region','mobile_telephone_number',
            'excise_tax_indicator','central_sales_tax_no','local_sales_tax_no','tax_number2',
            'term_of_payment_key','order_perobability_item','numbric_customer_group','customer_type', 'sales_group', 'sales_office',
            'customer_stats_group','complete_delivery_sales_order','partial_delivery_item','account_assignment_group','tax_clssification1',
            'tax_clssification2','tax_clssification3','pricing','web_ref_no','reseved1','reseved2','funded'
        ];

        foreach ($deleteAttrbutes as $deleteAttrbute){
            $eavSetup->removeAttribute('customer', $deleteAttrbute);
        }

        // Update customer attributes
        $addUserDefineAttributes = [
            "name_1" => "Name 1",
            "name_2" => "Name 2",
            "street" => "Street",
            "street_4" => "Street 4",
            "street_5" => "Street 5",
            "district" => 'District',
            "citypostalcode" => "Citypostalcode",
            "city" => "City",
            "country_key" => "Country Key",
            "telephone_no" => "Telephone no",
            "mobile_telephone_no" => "Mobile Telephone No",
            "fax_number" => "FAX_NUMBER",
            "email_address" => "E-Mail Address",
            "excise_tax_indicator_for_customer" => "Excise tax indicator for customer",
            "central_sales_tax_number" => "Central Sales Tax Number",
            "local_sales_tax_number" => "Local Sales Tax Number",
            "tax_number_2" => "Tax Number 2",
            "name_1_1" => "Name 1",
            "terms_of_payment_key" => "Terms of payment key",
            "order_probability_of_the_item" => "Order probability of the item",
            "customer_statistics_group" => "Customer statistics group",
            "complete_delivery_defined_for_each_sales_order" => "Complete delivery defined for each sales order?",
            "partial_delivery_at_item_level" => "Partial delivery at item level",
            "web_ref_customer_no" => "Web Ref. customer no",
            "reserved" => "Reserved",
            "reserved_1" => "Reserved",
        ];

        $addUserDefineAttributesOption = [
            "region" => [
                "label" => "REGION",
                "class" => "Redstage\CustomerInstallation\Model\Config\Region"
            ],
            "customer_group" => [
                "label" => "Customer Group",
                "class" => "Redstage\CustomerInstallation\Model\Config\NumericCustomerGroup"
            ],
            "customer_type" => [
                "label" => "Customer Type",
                "class" => "Redstage\CustomerInstallation\Model\Config\CustomerType"
            ],
            "sales_group" => [
                "label" => "Sales Group",
                "class" => "Redstage\CustomerInstallation\Model\Config\SalesGroup"
            ],
            "sales_office" => [
                "label" => "Sales Office",
                "class" => "Redstage\CustomerInstallation\Model\Config\SalesOffice"
            ],
            "account_assignment_group_for_this_customer" => [
                "label" => "Account assignment group for this customer",
                "class" => "Redstage\CustomerInstallation\Model\Config\AccountAssignmentGroup"
            ],
            "tax_clssification" => [
                "label" => "Tax Classification",
                "class" => "Redstage\CustomerInstallation\Model\Config\TaxClassification"
            ],
            "tax_clssification_1" => [
                "label" => "Tax Classification",
                "class" => "Redstage\CustomerInstallation\Model\Config\TaxClassification"
            ],
            "tax_clssification_2" => [
                "label" => "Tax Classification",
                "class" => "Redstage\CustomerInstallation\Model\Config\TaxClassification"
            ],
            "pricing" => [
                "label" => "Pricing",
                "class" => "Redstage\CustomerInstallation\Model\Config\Pricing"
            ],
            "funded_by_public_private" => [
                "label" => "Funded by PUBLIC / PRIVATE",
                "class" => "Redstage\CustomerInstallation\Model\Config\Funded"
            ]
        ];

        // Create user define from attributes
        $i = 600;
        foreach ($addUserDefineAttributes as $key => $value) {
            $eavSetup->addAttribute(
                'customer',
                $key,
                [
                    'type' => 'varchar',
                    'label' => $value,
                    'input' => 'text',
                    'source' => '',
                    'required' => false,
                    'visible' => true,
                    'position' => $i,
                    'sort_order' => $i,
                    'user_defined' => true,
                    'system' => false,
                    'global' => true,
                    'backend' => ''
                ]
            );
            $i++;
            $customAttribute = $this->eavConfig->getAttribute('customer', $key);

            $customAttribute->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit']
            ]);
            $customAttribute->save();
        }

        $eavSetup = $this->eavSetupFactory->create();
        // Create user define from attributes
        foreach ($addUserDefineAttributesOption as $key => $attributeOption) {
            $eavSetup->addAttribute(
                'customer',
                $key,
                [
                'type' => 'text',
                'label' => $attributeOption['label'],
                'input' => 'select',
                'source' => $attributeOption['class'],
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'sort_order' => $i,
                'position' => $i,
                'system' => false,
                'global' => true
                ]
            );
            $customAttribute = $this->eavConfig->getAttribute('customer', $key);

            $customAttribute->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit']
            ]);
            $customAttribute->save();
            $i++;
        }


        $this->moduleDataSetup->getConnection()->endSetup();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
