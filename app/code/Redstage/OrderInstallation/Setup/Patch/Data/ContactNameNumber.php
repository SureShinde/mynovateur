<?php
/**
 * Redstage OrderInstallation module purpose admin user can export order data predifined CSV only shipment created order data.
 *
 * @category: PHP
 * @package: Redstage/OrderInstallation
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Mohit Tyagi <mtyagi@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_OrderInstallation
 */
 
declare(strict_types=1);
 
namespace Redstage\OrderInstallation\Setup\Patch\Data;
 
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Psr\Log\LoggerInterface;
 
class ContactNameNumber implements DataPatchInterface
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
 
        $customerEntity = $this->eavConfig->getEntityType('customer_address');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
 
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
        $eavSetup->addAttribute(
                'customer_address',
                'contact_name',
                [
                    'type' => 'varchar',
                    'label' => 'Contact Name',
                    'input' => 'text',
                    'source' => '',
                    'required' => false,
                    'visible' => true,
                    'user_defined' => true,
                    'system' => false,
                    'sort_order' => 1000,
                    'position' => 1000
                ]
            );
        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'contact_name')
        ->addData([
            'attribute_set_id' => $attributeSetId,
            'attribute_group_id' => $attributeGroupId,
            'used_in_forms' => ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'],
        ]);
        $customAttribute->save();
        
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
                'customer_address',
                'contact_number',
                [
                    'type' => 'varchar',
                    'label' => 'Contact Number',
                    'input' => 'text',
                    'source' => '',
                    'required' => false,
                    'visible' => true,
                    'user_defined' => true,
                    'system' => false,
                    'sort_order' => 1001,
                    'position' => 1001
                ]
            );
        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'contact_number')
        ->addData([
            'attribute_set_id' => $attributeSetId,
            'attribute_group_id' => $attributeGroupId,
            'used_in_forms' => ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'],
        ]);
        $customAttribute->save();

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