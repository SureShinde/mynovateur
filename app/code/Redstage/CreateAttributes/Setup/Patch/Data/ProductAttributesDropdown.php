<?php
namespace Redstage\CreateAttributes\Setup\Patch\Data;;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class ProductAttributesDropdown implements DataPatchInterface
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
            "mechanism" => [
                "label" => "Mechanism / Accessories",
                "values" => [ 
                    "Mechanism",
                    "Accessories"
                ]
            ],
            "product_material" => [
                "label" => "Product material",
                "values" => [ 
                    "Polycarbonate"
                ]
            ],
            "warranty" => [
                "label" => "Warranty",
                "values" => [ 
                    "10 years warranty provided by the manufacturer from date of purchase",
                    "2 years warranty provided by the manufacturer from date of purchase"
                ]
            ],
            "in_the_box" => [
                "label" => "What is in the box?",
                "values" => [ 
                    "Audiovideo Connectors",
                    "Bell Push",
                    "Bell Push Switch",
                    "Blank Plate",
                    "Bluetooth Unit",
                    "Buzzer",
                    "Cable Outlet",
                    "Dimmer",
                    "DND MMR",
                    "Emergency Light",
                    "Fan Regulator",
                    "Indictor Unit",
                    "Key Card",
                    "Key Fob",
                    "MCB",
                    "Motor Starter",
                    "Plate",
                    "Push Button",
                    "Reading Light",
                    "Remote",
                    "Remote Unit",
                    "RJ11",
                    "RJ45",
                    "Sensor",
                    "Skirting Light",
                    "Socket",
                    "Sound (Volume controller)",
                    "Speaker",
                    "Switch",
                    "TV Socket",
                    "USB",
                    "Voltage Surge Protector"
                ]
            ],
            "module_size" => [
                "label" => "Module Size",
                "values" => [ 
                    "1",
                    "2",
                    "3",
                    "4",
                    "6",
                    "8",
                    "9",
                    "12",
                    "16",
                    "18",
                    "8(H)",
                    "8(V)"
                ]
            ],
            "indicator" => [
                "label" => "Indicator",
                "values" => [ 
                    "With Indicator",
                    "Without Indicator"
                ]
            ],
            "way" => [
                "label" => "Way",
                "values" => [ 
                    "1",
                    "2"
                ]
            ],
            "battery_tech_spec" => [
                "label" => "Battery tech specifications",
                "values" => [ 
                    "3.6V80mAh"
                ]
            ],
            "rating" => [
                "label" => "Rating",
                "values" => [ 
                    "6A",
                    "10A",
                    "13A",
                    "16A",
                    "20A",
                    "23A",
                    "25A",
                    "32A",
                    "6A",
                    "20VA",
                    "6/16",
                    "6/16A",
                    "4mA",
                    "230V",
                    "0.5",
                    "120/240VA",
                    "70W",
                    "100W",
                    "120W",
                    "300",
                    "400",
                    "500",
                    "400W"
                ]
            ],
            "function" => [
                "label" => "Function",
                "values" => [ 
                    "Bell Indicator",
                    "Bell Push",
                    "Blanking Plate",
                    "Bluetooth Unit",
                    "Buzzer Module",
                    "Cable Outlet",
                    "Ceiling Speaker",
                    "Cover Plate",
                    "Data & Voice",
                    "Dimmer Module",
                    "DND & MMR",
                    "Emergency Light",
                    "Fan Marking",
                    "Fan Regulator",
                    "Induction Charger",
                    "Infrared Sensor",
                    "Key Fob",
                    "Label Indicator",
                    "LED Indicator",
                    "Light Dimmer",
                    "Light Marking",
                    "MCB Module",
                    "Motor Starter",
                    "Push Button",
                    "Reading Light",
                    "Remote Control",
                    "Remote Control Unit",
                    "Skirting Light",
                    "Socket Module",
                    "SWITCHED SOCKET",
                    "Telephone Module",
                    "Touch Switch",
                    "TV SOCKET",
                    "USB Charger",
                    "Voltage Surge Protector",
                    "Volume Controller"
                ]
            ],
            "pole" => [
                "label" => "Pole",
                "values" => [ 
                    "DP",
                    "SP",
                    "SINGLE"
                ]
            ],    
            "type" => [
                "label" => "Type",
                "values" => [ 
                    "EURO US",
                    "MULTISTANDARD",
                    "Shaver Socket",
                    "UNIVERSAL",
                    "HDMI",
                    "RCA",
                    "RJ11",
                    "RJ45",
                    "VGA",
                    "LED"
                ]
            ],        
            "stero" => [
                "label" => "Stero",
                "values" => [ 
                    "2*1.5W"
                ]
            ],         
            "usb_type" => [
                "label" => "USB Type",
                "values" => [ 
                    "TYPE A",
                    "TYPE A+C",
                    "TYPE C",
                    "WIRELESS"
                ]
            ], 
            "output_current" => [
                "label" => "Output Current",
                "values" => [ 
                    "1000mA",
                    "1500mA",
                    "2400mA",
                    "3000mA"
                ]
            ],   
            "watt" => [
                "label" => "Watt",
                "values" => [ 
                    "1",
                    "50",
                    "70",
                    "100",
                    "120",
                    "300",
                    "400",
                    "500",
                    "400W"
                ]
            ],         
            "dimmer_type" => [
                "label" => "DIMMER TYPE",
                "values" => [ 
                    "LED",
                    "UNIVERSAL",
                ]
            ],
            "location" => [
                "label" => "Location",
                "values" => [ 
                    "EXTERNAL",
                    "INTERNAL",
                ]
            ],
            "no_of_step" => [
                "label" => "No. of step",
                "values" => [ 
                    "4",
                    "5",
                    "11 + OFF"
                ]
            ],
            "no_of_button" => [
                "label" => "No. of Button",
                "values" => [ 
                    "9"
                ]
            ],
            "battery_type" => [
                "label" => "Battery Type",
                "values" => [ 
                    "CR-2025 3V"
                ]
            ],
            "sensor_type" => [
                "label" => "Sensor Type",
                "values" => [ 
                    "INFRARED"
                ]
            ],
            "led_color" => [
                "label" => "LED Color",
                "values" => [ 
                    "3000K"
                ]
            ],
            "control" => [
                "label" => "Control",
                "values" => [ 
                    "4 LIGHTS + 1 FAN"
                ]
            ],
            "ohms" => [
                "label" => "Ohms",
                "values" => [ 
                    "8"
                ]
            ],
            "mounting" => [
                "label" => "Mounting",
                "values" => [ 
                    "CEILING"
                ]
            ],
            "voltage" => [
                "label" => "VOLTAGE",
                "values" => [ 
                    "230V"
                ]
            ],
            "output" => [
                "label" => "Output",
                "values" => [ 
                    "3W",
                    "10W"
                ]
            ]
        ];

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        
        // Create user define from attributes
        $i = 700;
        $defaultGroup = [
            "module_size",
            "indicator"
        ];
        foreach ($addUserDefineAttributesValue as $key => $value) {
            $attriuteSet = 'lyncus';
            $attriuteGroup = 'lyncus';
            if (in_array($key, $defaultGroup)){
                $attriuteSet = 'Default';
                $attriuteGroup = 'General';
            }
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