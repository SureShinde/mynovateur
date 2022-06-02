<?php
namespace Redstage\BoqConfigurator\Ui\Component\Listing\Column;

class Productgroupconfig extends \Magento\Ui\Component\Listing\Columns\Column {

    
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Redstage\BoqConfigurator\Model\BoqProductgroupFactory $productgroupcollectionFactory,
        \Redstage\BoqConfigurator\Model\BoqRoombundleFactory $roombundlecollectionFactory,
        \Redstage\BoqConfigurator\Model\BoqRoomtypeFactory $roomcollectionFactory,
        array $components = [],
        array $data = []
    ){
         $this->roomcollectionFactory = $roomcollectionFactory;
        $this->roombundlecollectionFactory = $roombundlecollectionFactory;
        $this->productgroupcollectionFactory = $productgroupcollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
           
            foreach ($dataSource['data']['items'] as & $item) {
                 $item['product_group_id'] = $this->getProductgroupname($item['product_group_id']);
                 $productGroupConfig = json_decode($item['product_group_config'],TRUE);
                 $item['product_group_config'] =  $this->getProductgroupconfigname($productGroupConfig);
               
            }            
        }       
        return $dataSource;
    }
    public function getProductgroupname($productGroupName){
        
            $room = $this->roomcollectionFactory->create();
            $collection = $room->getCollection();

            $name="";
            
            foreach($collection as $itemdata){                   
                if($productGroupName==$itemdata->getId()){
                   $name=  $itemdata->getName();
                }
                
             }
             return $name;
    }
     public function getProductgroupconfigname($productGroupConfig){

            $room = $this->roomcollectionFactory->create();
            $collection = $room->getCollection();

        
            $roombundle = $this->roombundlecollectionFactory->create();
            $roombundlecollection = $roombundle->getCollection();
        
            $range = [];
            
            foreach($collection as $itemdata){                   
                if(isset($productGroupConfig['room_type_id']) && $productGroupConfig['room_type_id']==$itemdata->getId()){
                   $range []=  $itemdata->getName();
                }
                
             }
             
             foreach($roombundlecollection as $itemdata){                   
                if(isset($productGroupConfig['bundle_type_id']) && $productGroupConfig['bundle_type_id']==$itemdata->getId()){
                   $range []=  $itemdata->getName().":".$productGroupConfig['qty'];
                }
                
             }
             return $range;
        }   
}