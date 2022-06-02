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

class AttributeTypeChange implements DataPatchInterface
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
        $object_Manager = \Magento\Framework\App\ObjectManager::getInstance();
        $get_resource   = $object_Manager->get('Magento\Framework\App\ResourceConnection');
        $db_connection     = $get_resource->getConnection(); // get connection

        // gives table name with prefix
        $eav_attribute_table = $get_resource->getTableName('eav_attribute');
        // add your table Name

        // Update Data into table in Magento 2
        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'model_name'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value FROM catalog_product_entity_int pei LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id WHERE pei.value IS NOT NULL  AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'model_name') AND aov.store_id = 0 AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'model_name')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('model_name')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'model_name')";
        $db_connection->query($delete_sql_2);

        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'numeric_warranty'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'numeric_warranty')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'numeric_warranty')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('numeric_warranty')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'numeric_warranty')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'input_voltage'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'input_voltage')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'input_voltage')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('input_voltage')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'input_voltage')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'primary_frequency'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'primary_frequency')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'primary_frequency')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('primary_frequency')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'primary_frequency')";
        $db_connection->query($delete_sql_2);




        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'number_of_phases_primary'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_phases_primary')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_phases_primary')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('number_of_phases_primary')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_phases_primary')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'output_voltage'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_voltage')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_voltage')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('output_voltage')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_voltage')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'secondary_frequency'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'secondary_frequency')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'secondary_frequency')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('secondary_frequency')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'secondary_frequency')";
        $db_connection->query($delete_sql_2);




        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'output_effective_power'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_effective_power')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);
*/
        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_effective_power')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('output_effective_power')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_effective_power')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'output_apparent_power'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_apparent_power')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_apparent_power')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('output_apparent_power')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_apparent_power')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'number_of_phases_secondary'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_phases_secondary')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_phases_secondary')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('number_of_phases_secondary')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_phases_secondary')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'voltage_type'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'voltage_type')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'voltage_type')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('voltage_type')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'voltage_type')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'run_time_at_full_load'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'run_time_at_full_load')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'run_time_at_full_load')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('run_time_at_full_load')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'run_time_at_full_load')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'ups_construction_type'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'ups_construction_type')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'ups_construction_type')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('ups_construction_type')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'ups_construction_type')";
        $db_connection->query($delete_sql_2);




        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'modular'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'modular')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'modular')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('modular')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'modular')";
        $db_connection->query($delete_sql_2);




        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'max_voltage_distortion_output'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'max_voltage_distortion_output')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'max_voltage_distortion_output')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('max_voltage_distortion_output')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'max_voltage_distortion_output')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'output_power_factor'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_power_factor')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_power_factor')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('output_power_factor')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_power_factor')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'overall_efficiency'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'overall_efficiency')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'overall_efficiency')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('overall_efficiency')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'overall_efficiency')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'efficiency_in_eco_mode'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'efficiency_in_eco_mode')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'efficiency_in_eco_mode')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('efficiency_in_eco_mode')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'efficiency_in_eco_mode')";
        $db_connection->query($delete_sql_2);







        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'potential_free_switch_contact'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'potential_free_switch_contact')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'potential_free_switch_contact')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('potential_free_switch_contact')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'potential_free_switch_contact')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'auto_shut_down_function'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'auto_shut_down_function')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'auto_shut_down_function')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('auto_shut_down_function')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'auto_shut_down_function')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'input_connection'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'input_connection')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'input_connection')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('input_connection')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'input_connection')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'number_output_connections_c13'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_output_connections_c13')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_output_connections_c13')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('number_output_connections_c13')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_output_connections_c13')";
        $db_connection->query($delete_sql_2);









        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'number_output_connections_c19'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_output_connections_c19')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_output_connections_c19')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('number_output_connections_c19')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_output_connections_c19')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'output_connections_protective'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_connections_protective')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_connections_protective')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('output_connections_protective')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_connections_protective')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'output_connections_fixed'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_connections_fixed')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_connections_fixed')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('output_connections_fixed')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'output_connections_fixed')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'degree_of_protection'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'degree_of_protection')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'degree_of_protection')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('degree_of_protection')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'degree_of_protection')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'operating_setting_temperature'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'operating_setting_temperature')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'operating_setting_temperature')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('operating_setting_temperature')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'operating_setting_temperature')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'storage_temperature'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'storage_temperature')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'storage_temperature')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('storage_temperature')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'storage_temperature')";
        $db_connection->query($delete_sql_2);







        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'sound_level'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'sound_level')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'sound_level')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('sound_level')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'sound_level')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'battery_cell_type'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'battery_cell_type')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'battery_cell_type')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('battery_cell_type')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'battery_cell_type')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'chemical_composition'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'chemical_composition')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'chemical_composition')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('chemical_composition')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'chemical_composition')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'number_of_batteries_included'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_batteries_included')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_batteries_included')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('number_of_batteries_included')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'number_of_batteries_included')";
        $db_connection->query($delete_sql_2);





        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'color_name'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'color_name')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'color_name')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('color_name')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'color_name')";
        $db_connection->query($delete_sql_2);






        $update_sql = "Update " . $eav_attribute_table . " SET backend_type = 'varchar', frontend_input = 'text', source_model = '' WHERE attribute_code = 'phase'";
        $db_connection->query($update_sql);

        // Insert Data into table in Magento 2
        /*$insert_sql = "INSERT INTO catalog_product_entity_varchar
             SELECT null as value_id, pei.attribute_id, pei.store_id, aov.value as value
             FROM catalog_product_entity_int pei
             LEFT JOIN eav_attribute_option ao ON pei.attribute_id = ao.attribute_id
             LEFT JOIN eav_attribute_option_value aov ON ao.option_id = aov.option_id
             WHERE 
             pei.value IS NOT NULL
             AND pei.attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'phase')
             AND aov.store_id = 0
             AND pei.value = ao.option_id";
        $db_connection->query($insert_sql);*/

        // Delete Data from table in Magento 2
        $delete_sql = "DELETE FROM  catalog_product_entity_int WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'phase')";
        $db_connection->query($delete_sql);
        $delete_sql_1 = "DELETE s.* FROM eav_attribute_option_value s INNER JOIN eav_attribute_option o on o.option_id = s.option_id INNER JOIN eav_attribute a on a.attribute_id = o.attribute_id WHERE a.attribute_code IN ('phase')";
        $db_connection->query($delete_sql_1);
        $delete_sql_2 = "DELETE FROM  eav_attribute_option WHERE attribute_id = (SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'phase')";
        $db_connection->query($delete_sql_2);
    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies()
    {
        return [];
    }

}
