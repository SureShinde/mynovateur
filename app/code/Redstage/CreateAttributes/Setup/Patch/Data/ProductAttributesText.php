<?php
namespace Redstage\CreateAttributes\Setup\Patch\Data;;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class ProductAttributesText implements DataPatchInterface
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
        "cat_no" => "Cat No.",
        "ean_no" => "EAN No.",
        "revised_name" => "Revised Name",
        "product_category" => "Product Category",
        "product_feature" => "Product features",
        "height" => "Product Height",
        "width" => "Product Width",
        "depth" => "Product Depth",
        "product_technical_specifications" => "Product Technical specifications",
        "available_in_package" => "Available in pack",
        "dimension_of_pack" => "Dimension of pack H x W x D",
        "manufacturer_entity" => "Manufacturer (Entity Name)",
        "manufacturer_address" => "Manufacturer Address",
        "packer_entity_name" => "Packer (Entity Name)",
        "packer_address" => "Packer Address",
        "pep_data_link" => "PEP data/ link",
        "brochure_data_link" => "Brochure data/ link",
        "catalogue_data_link" => "Catalogue data/ link",
        "test_charts" => "Test charts",
        "best_suited_for" => "Best suited for",
        "equivalent_sku" => "Equivalent SKU",
        "faq" => "FAQs",
        "frequently_searched_words" => "Frequently searched words",
        "hsn_code" => "HSN Code",
        "pep_data_link" => "PEP data/ link",
        "brochure_data_link" => "Brochure data/ link",
        "catalogue_data_link" => "Catalogue data/ link",
        ];

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        
        // Create user define from attributes
        $i = 500;
        $textArea = [
            "product_feature",
            "product_technical_specifications",
            "manufacturer_address",
            "packer_address",
            "frequently_searched_words"
        ];
        foreach ($addUserDefineAttributes as $key => $value) {
            $attributeType = 'varchar';
            $attributeInput = 'text';
            if (in_array($key, $textArea)){
                $attributeType = 'text';
                $attributeInput = 'textarea';
            }
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                $key,
                [
                    'attribute_set' => 'lyncus',
                    'group' => 'lyncus',
                    'type' => $attributeType,
                    'label' => $value,
                    'input' => $attributeInput,               
                    'required' => false,
                    'sort_order' => $i,
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