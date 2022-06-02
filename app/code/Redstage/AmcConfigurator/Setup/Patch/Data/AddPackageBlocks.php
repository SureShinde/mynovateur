<?php
/**
 * @author Redstage
 * @package Redstage_AmcConfigurator
 */
namespace Redstage\AmcConfigurator\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

/**
 * Class AddPackageBlocks
 * @package Redstage\AmcConfigurator\Setup\Patch\Data
 */

class AddPackageBlocks implements DataPatchInterface
{
    /**
    * @var ModuleDataSetupInterface
    */
    private $moduleDataSetup;
    /**
    * @var BlockFactory
    */
    private $blockFactory;
    /**
    * AddAccessViolationPageAndAssignB2CCustomers constructor.
    * @param ModuleDataSetupInterface $moduleDataSetup
    * @param PageFactory $blockFactory
    */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }

    /**
    * {@inheritdoc}
    */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $blocks = ['amc-silver-package'=>'AMC Silver Package Block', 'amc-gold-package'=>'AMC Gold Package Block'];
        foreach ($blocks as $identifier => $title) {
            $amcPackageBlock = [
                'title' => $title,
                'identifier' => $identifier,
                'content' => '<ul>
                                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
                              </ul>',
                'is_active' => 1,
                'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
            ];
            /** @var \Magento\Cms\Model\Block $block */
            $block = $this->blockFactory->create();
            $block->setData($amcPackageBlock)->save();
        }
        $this->moduleDataSetup->endSetup();
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