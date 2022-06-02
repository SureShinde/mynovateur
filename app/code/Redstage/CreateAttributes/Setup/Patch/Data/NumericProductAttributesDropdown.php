<?php
namespace Redstage\CreateAttributes\Setup\Patch\Data;;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class NumericProductAttributesDropdown implements DataPatchInterface
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

        $addUserDefineAttributesValue = [
            "product_type_ups" => [
                "label" => "Product Type",
                "values" => [ 
                    "LI",
                    "1 Phase",
                    "3 Phase",
                    "Line Interactive UPS",
                    "Online UPS"
                ]
            ],
            "model_name" => [
                "label" => "Model Name 1",
                "values" => [ 
                    "Daker Dk Plus",
                    "Digital 1000 HR V",
                    "HP i 33",
                    "Keor T EVO",
                    "Onfiniti",
                    "Premius",
                    "Trimod HE"
                ]
            ],
            "numeric_warranty" => [
                "label" => "Warranty",
                "values" => [ 
                    "2 years"
                ]
            ],
            "input_voltage" => [
                "label" => "(MIN-MAX V)- Input voltage",
                "values" => [ 
                    "110-300",
                    "140-300",
                    "160-280",
                    "160-300",
                    "320-460",
                    "320-476",
                    "320-480",
                    "340-476"
                ]
            ],
            "primary_frequency" => [
                "label" => "(MIN-MAX Hz)- Primary frequency",
                "values" => [ 
                    "50",
                    "40-70",
                    "45-55",
                    "45-65",
                    "50-60"
                ]
            ],
            "number_of_phases_primary" => [
                "label" => "Number of phases primary",
                "values" => [ 
                    "1",
                    "3"
                ]
            ],

            "output_voltage" => [
                "label" => "(MIN-MAX V)- Output voltage",
                "values" => [ 
                    "220-240",
                    "380-415",
                    "230 +/- 10%",
                    "230 +/- 1%"
                ]
            ],
            "secondary_frequency" => [
                "label" => "(MIN-MAX Hz)- Secondary frequency",
                "values" => [ 
                    "50",
                    "50-57",
                    "50-58",
                    "50-59",
                    "50-60"
                ]
            ],
            "output_effective_power" => [
                "label" => "(W)- Output effective power",
                "values" => [ 
                    "600",
                    "800",
                    "1000",
                    "1600",
                    "2000",
                    "2400",
                    "2700",
                    "3000",
                    "5000",
                    "8000",
                    "9000",
                    "10000",
                    "15000",
                    "20000",
                    "30000",
                    "40000"
                ]
            ],
            "output_apparent_power" => [
                "label" => "(VA)- Output apparent power",
                "values" => [ 
                    "1000",
                    "2000",
                    "3000",
                    "5000",
                    "9000",
                    "10000",
                    "13500",
                    "18000",
                    "20000",
                    "27000",
                    "30000",
                    "36000",
                    "40000"
                ]
            ],
            "number_of_phases_secondary" => [
                "label" => "Number of phases secondary",
                "values" => [ 
                    "1",
                    "3"
                ]
            ],    
            "voltage_type" => [
                "label" => "Voltage type",
                "values" => [ 
                    "AC"
                ]
            ],
            "run_time_at_full_load" => [
                "label" => "(min)- Run time at full load",
                "values" => [ 
                    "5",
                    "10",
                    "15",
                    "20",
                    "30",
                    "60",
                    "5 min",
                    "15 min",
                    "30 min",
                    "60 min"
                ]
            ],         
            "ups_construction_type" => [
                "label" => "UPS Construction type",
                "values" => [ 
                    "Tower",
                    "Rack Tower"
                ]
            ], 
            "modular" => [
                "label" => "Modular",
                "values" => [ 
                    "No",
                    "Yes",
                    "Conventional",
                    "Modular"
                ]
            ],  
            "max_voltage_distortion_output" => [
                "label" => "(%)- Max. voltage distortion output (linear load)",
                "values" => [ 
                    "1",
                    "3",
                    "10",
                    "<5"
                ]
            ], 
            "output_power_factor" => [
                "label" => "Output power factor",
                "values" => [ 
                    "0.6",
                    "0.8",
                    "0.9",
                    "1"
                ]
            ],  
            "overall_efficiency" => [
                "label" => "(%)- Overall efficiency",
                "values" => [ 
                    "72%",
                    "90",
                    "91",
                    "92",
                    "93",
                    "94",
                    "95",
                    "96"
                ]
            ],   
            "efficiency_in_eco_mode" => [
                "label" => "(%)- Efficiency in eco-mode",
                "values" => [ 
                    "97",
                    "98",
                    "99"
                ]
            ], 
            "potential_free_switch_contact" => [
                "label" => "Potential free switch contact",
                "values" => [ 
                    "Compatible",
                    "Comptible",
                    "No",
                    "Yes"
                ]
            ], 
            "auto_shut_down_function" => [
                "label" => "Auto shut down function",
                "values" => [ 
                    "Compatible",
                    "Comptible",
                    "No",
                    "Yes"
                ]
            ],
            "input_connection" => [
                "label" => "Input connection",
                "values" => [ 
                    "Fixed"
                ]
            ],
            "number_output_connections_c13" => [
                "label" => "Number of output connections C13",
                "values" => [ 
                    "2",
                    "6"
                ]
            ],
            "number_output_connections_c19" => [
                "label" => "Number of output connections C13",
                "values" => [ 
                    "1"
                ]
            ],
            "output_connections_protective" => [
                "label" => "Number of output connections with protective contact (INDIAN)",
                "values" => [ 
                    "1",
                    "2",
                    "4"
                ]
            ],
            "output_connections_fixed" => [
                "label" => "Number of output connections fixed connection",
                "values" => [ 
                    "Fixed"
                ]
            ],
            "degree_of_protection" => [
                "label" => "Degree of protection (IP)",
                "values" => [ 
                    "IP20",
                    "IP21"
                ]
            ],
            "operating_setting_temperature" => [
                "label" => "(MIN-MAX °C)- Operating / setting temperature",
                "values" => [ 
                    "0-40"
                ]
            ],
            "storage_temperature" => [
                "label" => "(MIN-MAX °C)- Storage temperature",
                "values" => [ 
                    "-10 - 30",
                    "-10-30",
                    "-10-60",
                    "-20-50"
                ]
            ],
            "sound_level" => [
                "label" => "(dB)- Sound level",
                "values" => [ 
                    "55",
                    "60",
                    "65",
                    "75",
                    "<58",
                    "<60"
                ]
            ],
            "battery_cell_type" => [
                "label" => "Battery Cell Type",
                "values" => [ 
                    "Lead Acid VRLA"
                ]
            ],
            "chemical_composition" => [
                "label" => "Choose the chemical composition of the battery cell",
                "values" => [ 
                    "100 AH",
                    "120 AH",
                    "150 AH",
                    "18 AH",
                    "18AH",
                    "28 AH",
                    "28AH",
                    "42 AH",
                    "42AH",
                    "65 AH",
                    "65AH",
                    "75 AH",
                    "84 AH",
                    "9AH"
                ]
            ],         
            "number_of_batteries_included" => [
                "label" => "Number of Batteries included",
                "values" => [ 
                    "1",
                    "3",
                    "6",
                    "8",
                    "20",
                    "32",
                    "60"
                ]
            ],
            "color_name" => [
                "label" => "Color Name",
                "values" => [ 
                    "RAL 9005",
                    "RAL7016",
                    "RAL9005"
                ]
            ],
            "phase" => [
                "label" => "Phase",
                "values" => [ 
                    "1-Phase",
                    "3-Phase",
                    "Line Interactive"
                ]
            ],
            "backuptime" => [
                "label" => "Backuptime",
                "values" => [ 
                    "5 Min",
                    "10 Min",
                    "15 Min",
                    "30 Min",
                    "60 Min"
                ]
            ],
            "numeric_rating" => [
                "label" => "Rating",
                "values" => [ 
                    "1 kVA",
                    "10 kVA",
                    "1000 VA",
                    "15 kVA",
                    "2 kVA",
                    "20 kVA",
                    "3 kVA",
                    "30 kVA",
                    "40 kVA",
                    "5 kVA"
                ]
            ],
            "numeric_watts" => [
                "label" => "Rating",
                "values" => [ 
                    "1000 W",
                    "10000 W",
                    "13500 W",
                    "1600 W",
                    "18000 W",
                    "2000 W",
                    "20000 W",
                    "2400 W",
                    "2700 W",
                    "27000 W",
                    "3000 W",
                    "30000 W",
                    "4000 W",
                    "40000 W",
                    "5000 W",
                    "600 W",
                    "800 W",
                    "8000 W",
                    "9000 W"
                ]
            ]
        ];

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        
        // Create user define from attributes
        $i = 700;
        foreach ($addUserDefineAttributesValue as $key => $value) {
            $attriuteSet = 'Numeric';
            $attriuteGroup = 'Numeric Attribute';
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                $key,
                [
                    'attribute_set' => $attriuteSet,
                    'group' => $attriuteGroup,
                    'type' => 'int',
                    'label' => $value['label'],
                    'input' => 'select',               
                    'required' => false,
                    'sort_order' => $i,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'visible' => true,
                    'is_html_allowed_on_front' => true,
                    'visible_on_front' => true,
                    'user_defined' => true,
                    'option' => [
                    'values' => $value['values']
                    ]
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