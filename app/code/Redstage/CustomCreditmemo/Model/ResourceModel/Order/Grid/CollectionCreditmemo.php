<?php 
namespace Redstage\CustomCreditmemo\Model\ResourceModel\Order\Grid; 
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\Grid\Collection as OriginalCollection;
 
/**
* Order grid extended collection
*/
class CollectionCreditmemo extends OriginalCollection{
 
    protected function _construct(){
 
        $this->addFilterToMap('entity_id', 'main_table.entity_id');
   
        parent::_construct();
 
    }
 
    protected function _renderFiltersBefore(){
 
        $this->getSelect()->joinLeft(
            ["so" => "sales_creditmemo"],
            'main_table.entity_id = so.entity_id',
            array('pay_reference_id')
        )
        ->distinct(); 
        
        parent::_renderFiltersBefore();
    }
}