<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Anjulata Gupta
 */
namespace Redstage\BoqConfigurator\Setup\Patch\Data;
use Magento\Eav\Setup\EavSetup;
use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\Patch\PatchVersionInterface;


class UpdateProductAttr implements DataPatchInterface
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
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->updateAttribute(Product::ENTITY, 'product_group', ['source_model' => 'Redstage\BoqConfigurator\Model\BoqProductgroup\Attribute\Source\Options']);


        $groupName = 'Product Details';
        $entityTypeId = $eavSetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);
        $attributeSetId = $eavSetup->getAttributeSetId($entityTypeId, 'Default');
        
        $productGroupAttribute = $eavSetup->getAttribute($entityTypeId, 'product_group');
        if ($productGroupAttribute) {
            $eavSetup->addAttributeToGroup(
                $entityTypeId,
                $attributeSetId,
                $groupName,
                $productGroupAttribute['attribute_id'],
                130
            );
        }

        $productRangeAttribute = $eavSetup->getAttribute($entityTypeId, 'product_range');
        if ($productRangeAttribute) {
            $eavSetup->addAttributeToGroup(
                $entityTypeId,
                $attributeSetId,
                $groupName,
                $productRangeAttribute['attribute_id'],
                120
            );
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
}