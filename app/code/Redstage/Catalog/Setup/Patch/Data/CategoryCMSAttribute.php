<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Navnit Viradiya
 */
declare (strict_types = 1);
namespace Redstage\Catalog\Setup\Patch\Data;

use Magento\Catalog\Model\Category\Attribute\Source\Page;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CategoryCMSAttribute implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
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
    public function apply() {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'landing_page_second', [
            'type' => 'int',
            'label' => 'CMS Block Second',
            'input' => 'select',
            'source' => Page::class,
            'required' => false,
            'sort_order' => 25,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'Display Settings',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'landing_page_third', [
            'type' => 'int',
            'label' => 'CMS Block Third',
            'input' => 'select',
            'source' => Page::class,
            'required' => false,
            'sort_order' => 25,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'Display Settings',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '2.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies() {
        return [];
    }
    /**
     * {@inheritdoc}
     */
    public function getAliases() {
        return [];
    }

}
