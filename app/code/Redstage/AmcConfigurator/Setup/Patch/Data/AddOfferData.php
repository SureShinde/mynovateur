<?php
namespace Redstage\AmcConfigurator\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddOfferData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
       ModuleDataSetupInterface $moduleDataSetup

    ) {

        $this->moduleDataSetup = $moduleDataSetup;

    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $setup = $this->moduleDataSetup;

        $data = [
          ['sales_org'=>'1001','meterial_group_1'=>'1','offer1_price_per_year'=>'3000','offer2_price_per_year'=>'3150'],
          ['sales_org'=>'1001','meterial_group_1'=>'2','offer1_price_per_year'=>'5000','offer2_price_per_year'=>'5250'],
          ['sales_org'=>'1001','meterial_group_1'=>'3','offer1_price_per_year'=>'7000','offer2_price_per_year'=>'7350'],
          ['sales_org'=>'1001','meterial_group_1'=>'5','offer1_price_per_year'=>'12000','offer2_price_per_year'=>'12600'],
          ['sales_org'=>'1001','meterial_group_1'=>'6','offer1_price_per_year'=>'13000','offer2_price_per_year'=>'13650'],
          ['sales_org'=>'1001','meterial_group_1'=>'7.5','offer1_price_per_year'=>'14000','offer2_price_per_year'=>'14700'],
          ['sales_org'=>'1001','meterial_group_1'=>'10','offer1_price_per_year'=>'16000','offer2_price_per_year'=>'16800'],
          ['sales_org'=>'1001','meterial_group_1'=>'15','offer1_price_per_year'=>'22500','offer2_price_per_year'=>'23625'],
          ['sales_org'=>'1001','meterial_group_1'=>'20','offer1_price_per_year'=>'27500','offer2_price_per_year'=>'28875'],
          ['sales_org'=>'1001','meterial_group_1'=>'30','offer1_price_per_year'=>'40000','offer2_price_per_year'=>'42000'],
          ['sales_org'=>'1001','meterial_group_1'=>'40','offer1_price_per_year'=>'52000','offer2_price_per_year'=>'54600'],
          ['sales_org'=>'1001','meterial_group_1'=>'50','offer1_price_per_year'=>'62500','offer2_price_per_year'=>'65625'],
          ['sales_org'=>'1001','meterial_group_1'=>'60','offer1_price_per_year'=>'72000','offer2_price_per_year'=>'75600'],
          ['sales_org'=>'1009','meterial_group_1'=>'10','offer1_price_per_year'=>'17500','offer2_price_per_year'=>'18375'],
          ['sales_org'=>'1009','meterial_group_1'=>'15','offer1_price_per_year'=>'25000','offer2_price_per_year'=>'26250'],
          ['sales_org'=>'1009','meterial_group_1'=>'20','offer1_price_per_year'=>'30000','offer2_price_per_year'=>'31500'],
          ['sales_org'=>'1009','meterial_group_1'=>'25','offer1_price_per_year'=>'35000','offer2_price_per_year'=>'36750'],
          ['sales_org'=>'1009','meterial_group_1'=>'30','offer1_price_per_year'=>'42000','offer2_price_per_year'=>'44100'],
          ['sales_org'=>'1009','meterial_group_1'=>'40','offer1_price_per_year'=>'56000','offer2_price_per_year'=>'58800'],
          ['sales_org'=>'1009','meterial_group_1'=>'50','offer1_price_per_year'=>'64000','offer2_price_per_year'=>'67200'],
          ['sales_org'=>'1009','meterial_group_1'=>'60','offer1_price_per_year'=>'76000','offer2_price_per_year'=>'79800'],
          ['sales_org'=>'1009','meterial_group_1'=>'80','offer1_price_per_year'=>'96000','offer2_price_per_year'=>'100800'],
          ['sales_org'=>'1009','meterial_group_1'=>'100','offer1_price_per_year'=>'120000','offer2_price_per_year'=>'126000'],
          ['sales_org'=>'1009','meterial_group_1'=>'120','offer1_price_per_year'=>'132000','offer2_price_per_year'=>'138600'],
          ['sales_org'=>'1009','meterial_group_1'=>'150','offer1_price_per_year'=>'165000','offer2_price_per_year'=>'173250'],
          ['sales_org'=>'1009','meterial_group_1'=>'200','offer1_price_per_year'=>'220000','offer2_price_per_year'=>'231000'],
          ['sales_org'=>'1009','meterial_group_1'=>'220','offer1_price_per_year'=>'242000','offer2_price_per_year'=>'254100'],
          ['sales_org'=>'1009','meterial_group_1'=>'250','offer1_price_per_year'=>'275000','offer2_price_per_year'=>'288750'],
          ['sales_org'=>'1009','meterial_group_1'=>'300','offer1_price_per_year'=>'330000','offer2_price_per_year'=>'346500'],
          ['sales_org'=>'1009','meterial_group_1'=>'400','offer1_price_per_year'=>'440000','offer2_price_per_year'=>'462000'],
          ['sales_org'=>'1002','meterial_group_1'=>'0.6','offer1_price_per_year'=>'800','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'0.8','offer1_price_per_year'=>'1000','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'1','offer1_price_per_year'=>'1200','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'1.5','offer1_price_per_year'=>'1500','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'2','offer1_price_per_year'=>'2000','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'2.5','offer1_price_per_year'=>'2200','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'3','offer1_price_per_year'=>'4000','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'3.5','offer1_price_per_year'=>'4200','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'4','offer1_price_per_year'=>'5000','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'5','offer1_price_per_year'=>'6000','offer2_price_per_year'=>''],
          ['sales_org'=>'1002','meterial_group_1'=>'5','offer1_price_per_year'=>'7500','offer2_price_per_year'=>'8000'],
          ['sales_org'=>'1002','meterial_group_1'=>'10','offer1_price_per_year'=>'9000','offer2_price_per_year'=>'9900'],
          ['sales_org'=>'1002','meterial_group_1'=>'15','offer1_price_per_year'=>'12000','offer2_price_per_year'=>'13200'],
          ['sales_org'=>'1002','meterial_group_1'=>'20','offer1_price_per_year'=>'16000','offer2_price_per_year'=>'17600'],
          ['sales_org'=>'1002','meterial_group_1'=>'25','offer1_price_per_year'=>'18000','offer2_price_per_year'=>'19800'],
          ['sales_org'=>'1002','meterial_group_1'=>'40','offer1_price_per_year'=>'25000','offer2_price_per_year'=>'27500'],
          ['sales_org'=>'1002','meterial_group_1'=>'50','offer1_price_per_year'=>'35000','offer2_price_per_year'=>'38500'],
          ['sales_org'=>'1002','meterial_group_1'=>'60','offer1_price_per_year'=>'45000','offer2_price_per_year'=>'49500'],
          ['sales_org'=>'1002','meterial_group_1'=>'80','offer1_price_per_year'=>'60000','offer2_price_per_year'=>'66000'],
          ['sales_org'=>'1002','meterial_group_1'=>'100','offer1_price_per_year'=>'75000','offer2_price_per_year'=>'82500']
        ];

        $this->moduleDataSetup->getConnection()->insertMultiple('amc_material_offer_price',$data); 
        $this->moduleDataSetup->endSetup();
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
