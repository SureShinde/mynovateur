<?php
namespace Redstage\Carousel\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('redstage_carousel_slide')) {
            $table = $installer->getConnection()->newTable($installer->getTable('redstage_carousel_slide'))
            ->addColumn(
                'slide_id',
                 \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                 null,
                ['identity' => true,'nullable' => false,'primary'  => true,'unsigned' => true,],
                'Slide ID'
            )
            ->addColumn(
                'active',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'default' => 0 ],
                'Slide Status'
            )
            ->addColumn(
                'sort_order',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => 0 ],
                'Slide Order'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Slide Name'
            )
            ->addColumn(
                'image',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Slide Image'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => 0],
                'Slide Image'
            )
            ->addColumn(
                'caption',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => false],
                'Slide Caption'
            )
            ->addColumn(
                'enable_caption',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'default' => 0 ],
                'Enable Caption'
            )
            ->addColumn(
                'cta_label',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => false],
                'CTA Label'
            )
            ->addColumn(
                'enable_cta',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'default' => 0 ],
                'Enable Caption'
            )
            ->addColumn(
                'link',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Slide Link'
            )
            ->addColumn(
                'enable_slide_link',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'default' => 0 ],
                'Enable Slide Link'
            )
            ->setComment('Redstage Carousel Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}