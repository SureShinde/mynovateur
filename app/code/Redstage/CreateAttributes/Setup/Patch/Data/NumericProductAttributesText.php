<?php
namespace Redstage\CreateAttributes\Setup\Patch\Data;;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class NumericProductAttributesText implements DataPatchInterface
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
        "dummy_cat_code" => "Dummy CAT CODE",
        "product_feature1" => "Product features 1",
        "product_feature2" => "Product features 2",
        "product_feature3" => "Product features 3",
        "product_feature4" => "Product features 4",
        "product_feature5" => "Product features 5",
        "product_feature6" => "Product features 6",
        "product_feature7" => "Product features 7",
        "product_feature8" => "Product features 8",
        "product_feature9" => "Product features 9",
        "product_feature10" => "Product features 10",
        "what_in_box" => "What is in the box?",
        "best_suited_application" => "Best suited for (Application)",
        "best_suited_segment" => "Best suited for (Segment)",
        "faqs" => "FAQs",
        "faq_search_word" => "Frequently searched words 1",
        "product_height" => "Product Height",
        "product_depth" => "Product Depth",
        "product_width" => "Product Width",
        "battery_cabinet_height" => "Battery Cabinet  Height (Only in millimeters)",
        "battery_cabinet_width" => "Battery Cabinet Width (Only in millimeters)",
        "battery_cabinet_depth" => "Battery Cabinet Depth (Only in millimeters)",
        "battery_cabinet_weight" => "Battery Cabinet Weight (in kilograms)",
        "mm_product_height" => "(mm)- Product Height",
        "mm_product_width" => "(mm)- Product Width",
        "mm_product_depth" => "(mm)- Product Depth",
        "weight_in_kgs" => "Product- Weight in Kgs",
        "output_connections_french" => "Number of output connections French standard",
        "load_type_controllable" => "Load type controllable",
        "fitted_with_socket" => "fitted with socket(s)",
        "battery_weight_in_grams" => "Battery Weight (in grams)",
        "numeric_product_category" => "Category",
        ];

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        
        // Create user define from attributes
        $i = 500;
        $textArea = [
            "product_feature1",
            "product_feature2",
            "product_feature3",
            "product_feature4",
            "product_feature5",
            "product_feature6",
            "product_feature7",
            "product_feature8",
            "product_feature9",
            "product_feature10"
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
                    'attribute_set' => 'Numeric',
                    'group' => 'Numeric Attribute',
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