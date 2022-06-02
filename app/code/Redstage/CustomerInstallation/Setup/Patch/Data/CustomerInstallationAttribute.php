<?php
declare(strict_types=1);
 
namespace Redstage\CustomerInstallation\Setup\Patch\Data;
 
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Psr\Log\LoggerInterface;
 
class CustomerInstallationAttribute implements DataPatchInterface
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
        return [];
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
        
        // Update customer attributes
        $addUserDefineAttributes = [
            "sap_customer_code" => "SAP Customer code",
            "company_code" => "Company Code",
            "division" => "Division",
            "short" => "Short",
            "city2" => "District",
            "numeric_region" => "REGION",
            "transportation_zone" => "Transportation zone",
            "language_key" => "Language Key",
            "mobile_telephone_number" => "Mobile Telephone No",
            "customer_type" => "Customer Type",
            "ecc_number" => "Ecc Number",
            "excise_registration_number" => "Excise Registration Number",
            "excise_range" => "Excise Range",
            "excise_division" => "Excise Division",
            "excise_commissionerate" => "Excise Commissionerate",
            "excise_tax_indicator" => "Excise tax indicator for customer",
            "central_sales_tax_no" => "Central Sales Tax Number",
            "local_sales_tax_no" => "Local Sales Tax Number",
            "tax_number2" => "Tax Number2",
            "name1" => "Name1",
            "term_of_payment_key" => "Term of Payment key",
            "order_perobability_item" => "Order probability of the item",
            "sales_office" => "Sales Office",
            "sales_group" => "Sales Group",
            "customer_account_group" => "Customer Account Group",
            "currency" => "Currency",
            "pricing" => "Pricing",
            "customer_stats_group" => "Customer statistics group",
            "delivery_priority" => "Delivery Priority",
            "order_combination_indicator" => "Order combination indicator",
            "shipping_conditions" => "Shipping conditions",
            "complete_delivery_sales_order" => "Complete delivery defined for
each sales order?",
            "partial_delivery_item" => "Partial delivery at item level",
            "account_assignment_group" => "Account assignment group for
this customer",
            "web_ref_no" => "Web Ref. customer no",
            "reseved1" => "Reserved 1",
            "reseved2" => "Reserved 2",
            "gstin" => "GSTIN",
            "pan" => "PAN"
        ];
        
        // Create user define from attributes
        $i = 500;
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

        // Create customer attributes options
        $addUserDefineAttributesOption = [
            "sales_organization" => [
                "label" => "Sales Organization",
                "class" => "Redstage\CustomerInstallation\Model\Config\SalesOrganization"
            ],
            "distribution_channel" => [
                "label" => "Distribution Channel",
                "class" => "Redstage\CustomerInstallation\Model\Config\DistributionChannel"
            ],
            "customer_account_group" => [
                "label" => "Customer Account Group",
                "class" => "Redstage\CustomerInstallation\Model\Config\CustomerAccountGroup"
            ],
            "title_text" => [
                "label" => "Title Text",
                "class" => "Redstage\CustomerInstallation\Model\Config\TitleText"
            ],
            "reconciliation_account" => [
                "label" => "Reconciliation Account",
                "class" => "Redstage\CustomerInstallation\Model\Config\ReconciliationAccount"
            ],
            "numbric_customer_group" => [
                "label" => "Customer Group",
                "class" => "Redstage\CustomerInstallation\Model\Config\NumericCustomerGroup"
            ],
            "tax_clssification1" => [
                "label" => "Tax Classification 1",
                "class" => "Redstage\CustomerInstallation\Model\Config\TaxClassification"
            ],
            "tax_clssification2" => [
                "label" => "Tax Classification 2",
                "class" => "Redstage\CustomerInstallation\Model\Config\TaxClassification"
            ],
            "tax_clssification3" => [
                "label" => "Tax Classification 3",
                "class" => "Redstage\CustomerInstallation\Model\Config\TaxClassification"
            ],
            "funded" => [
                "label" => "Funded by PUBLIC / PRIVATE",
                "class" => "Redstage\CustomerInstallation\Model\Config\Funded"
            ]
        ];
        
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