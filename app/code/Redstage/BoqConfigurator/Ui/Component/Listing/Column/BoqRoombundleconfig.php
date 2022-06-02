<?php
namespace Redstage\BoqConfigurator\Ui\Component\Listing\Column;

class BoqRoombundleconfig extends \Magento\Ui\Component\Listing\Columns\Column {

    protected $collectionFactory;
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Redstage\BoqConfigurator\Model\BoqRoomtypeFactory $collectionFactory,
        array $components = [],
        array $data = []
    ){
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
           
            foreach ($dataSource['data']['items'] as & $item) {
                 $roomTypeConfig = json_decode($item['room_type_config'],TRUE);
                 $item['room_type_config'] =  $this->getBundleConfigName($roomTypeConfig);
               
            }            
        }       
        return $dataSource;
    }
     public function getBundleConfigName($roomTypeConfig){

            $room = $this->collectionFactory->create();
            $collection = $room->getCollection();
            $range = [];
            foreach($collection as $itemdata){                   
                if(isset($roomTypeConfig[$itemdata->getId()]) && !empty($roomTypeConfig[$itemdata->getId()])){
                   $range []=  $itemdata->getName().":".$roomTypeConfig[$itemdata->getId()];
                }
                
             }
             return $range;
        }   
}