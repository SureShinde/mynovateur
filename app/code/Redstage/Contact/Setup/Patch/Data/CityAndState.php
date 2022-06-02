<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Redstage\Contact\Setup\Patch\Data;

use Magento\Framework\Module\Dir;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


/**
 * Create stores and websites. Actually stores and websites are part of schema as
 * other modules schema relies on store and website presence.
 * @package Magento\Store\Setup\Patch\Schema
 */
class CityAndState implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var Dir
     */
    protected $moduleDir;

    /**
     * PatchInitial constructor.
     * @param SchemaSetupInterface $schemaSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Dir $moduleDir
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->moduleDir =$moduleDir;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $connection = $this->moduleDataSetup->getConnection();
        $tableName = $this->moduleDataSetup->getTable('redstage_state_city');
        $select = $connection->select()
            ->from($tableName);
        if ($connection->fetchOne($select) === false) {
            $path = $this->moduleDir->getDir('Redstage_Contact', Dir::MODULE_SETUP_DIR);
            $cityDataBase = json_decode(file_get_contents($path.'/state-city.json'));
            foreach ($cityDataBase as $state => $cities){
                foreach ($cities as $city){
                    $connection->insertForce(
                        $tableName,
                        [
                            'city' => $city,
                            'state' => $state
                        ]
                    );
                }
            }
            $this->moduleDataSetup->endSetup();
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
    public static function getVersion()
    {
        return '1.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
