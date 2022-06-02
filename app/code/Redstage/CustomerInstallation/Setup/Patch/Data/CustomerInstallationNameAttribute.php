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
 
class CustomerInstallationNameAttribute implements DataPatchInterface
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
        
        // Create user define from name attributes
            $eavSetup->addAttribute(
                'customer',
                'name2',
                [
                    'type' => 'varchar',
                    'label' => 'Name 2',
                    'input' => 'text',
                    'source' => '',
                    'required' => false,
                    'visible' => true,
                    'user_defined' => true,
                    'system' => false,
                    'global' => true,
                    'backend' => ''
                ]
            );
            $customAttribute = $this->eavConfig->getAttribute('customer', 'name2');

            $customAttribute->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit']
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