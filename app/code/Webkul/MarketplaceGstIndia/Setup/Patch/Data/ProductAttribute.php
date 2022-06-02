<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Model\Config as EavConfig;
use Magento\Catalog\Model\Product\Attribute\Backend\Price;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class ProductAttribute implements DataPatchInterface
{
    /**
     * GSTIN Attribute Code
     */
    public const GSTIN_CODE = 'gstin';

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     *
     * @var EavConfig
     */
    private $eavConfig;

    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * @param EavSetupFactory $eavSetupFactory
     * @param EavConfig $eavConfig
     * @param CustomerSetupFactory $customerSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        EavConfig $eavConfig,
        CustomerSetupFactory $customerSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        /* Create GSTIN Attribute */
        $eavSetup->addAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::GSTIN_CODE,
            [
                'label' => 'GSTIN',
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'position' => 200,
                'sort_order' => 200,
                'system' => false
            ]
        );

        $gstAttribute = $this->eavConfig->getAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::GSTIN_CODE
        );

        $gstAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address']
        );
        $gstAttribute->save();

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'gst_percent',
            [
                'type' => 'varchar',
                'backend' => '',
                'frontend' => '',
                'label' => 'GST Rate (in Percentage)',
                'input' => 'text',
                'class' => 'gstRate',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,virtual,downloadable',
                'group' => 'Product Details',
                'frontend_class' => 'validate-number'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'gst_min_price',
            [
                'type' => 'decimal',
                'backend' => Price::class,
                'frontend' => '',
                'label' => 'Minimum Price to Apply Different GST',
                'input' => 'price',
                'class' => '',
                'frontend_class' => 'validate-number',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,virtual,downloadable',
                'group' => 'Product Details'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'gst_percent_max',
            [
                'type' => 'varchar',
                'backend' => '',
                'frontend' => '',
                'label' => 'GST Rate to Apply Below Minimum Price (in Percentage)',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,virtual,downloadable',
                'group' => 'Product Details',
                'frontend_class' => 'validate-number'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'hsn_code',
            [
                'type' => 'varchar',
                'backend' => '',
                'frontend' => '',
                'label' => 'HSN Code',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,virtual,downloadable',
                'group' => 'Product Details',
                'frontend_class' => 'validate-number'
            ]
        );

        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
        /** @var $attributeSet AttributeSet */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $attributeCodes = [
            ['value' => 'seller_gstin', 'label' => 'Seller GSTIN'],
            ['value' => 'seller_production_state', 'label' => 'Seller Production State']
        ];
        foreach ($attributeCodes as $code) {
            $frontendClass = '';
            $customerSetup->addAttribute(
                Customer::ENTITY,
                $code['value'],
                [
                    'type' => 'varchar',
                    'label' => $code['label'],
                    'input' => 'text',
                    'frontend_class' => $frontendClass,
                    'required' => false,
                    'visible' => false,
                    'user_defined' => true,
                    'sort_order' => 1000,
                    'position' => 1000,
                    'system' => 0,
                ]
            );

            $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, $code['value'])
            ->addData(
                [
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' => [],
                ]
            );

            $attribute->save();
        }
    }

    /**
     * Inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
