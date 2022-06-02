<?php
namespace Redstage\CreateAttributes\Setup\Patch\Data;;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class ProductAttributesYesNo implements DataPatchInterface
{
    /** @var ModuleDataSetupInterface */
    private $moduleDataSetup;

    /** @var EavSetupFactory */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        
        // Update customer attributes
        $addUserDefineAttributes = [
        "comes_with_battery" => "Whether the product comes with battery?",
        "pep_profile" => "PEP profile",
        "product_brochure" => "Product Brochure",
        "certifications" => "Certifications",
        "installation_diagrams" => "Installation diagrams",
        "with_support_frame" => "With Support Frame",
        "battery" => "Battery",
        "adjustable" => "Adjustable",
        ];

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        
        // Create user define from attributes
        $i = 600;
        foreach ($addUserDefineAttributes as $key => $value) {
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                $key,
                [
                    'attribute_set' => 'lyncus',
                    'group' => 'lyncus',
                    'type' => 'int',
                    'label' => $value,
                    'input' => 'boolean',               
                    'required' => false,
                    'sort_order' => $i,
                    'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'visible' => true,
                    'is_html_allowed_on_front' => true,
                    'visible_on_front' => true,
                    'user_defined' => true
                ]
            );
            $i++;
        }
        
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
    public static function getVersion()
    {
        return '1.0.0';
    }
}