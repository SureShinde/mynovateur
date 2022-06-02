<?php
namespace Redstage\BoqConfigurator\Ui\Component\Form;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Form\FieldFactory;
class FieldsetProductGroups extends \Magento\Ui\Component\Form\Fieldset
{
    protected $fieldFactory;
    
    public function __construct(
        \Redstage\BoqConfigurator\Model\BoqProductgroupFactory $productgroupcollectionFactory,
        \Redstage\BoqConfigurator\Model\BoqRoombundleFactory $roombundlecollectionFactory,
        \Redstage\BoqConfigurator\Model\BoqRoomtypeFactory $roomcollectionFactory,
        ContextInterface $context,
        array $components = [],
        array $data = [],
        \Magento\Framework\Registry $coreRegistry,
        FieldFactory $fieldFactory)
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->roomcollectionFactory = $roomcollectionFactory;
        $this->productgroupcollectionFactory = $productgroupcollectionFactory;
        $this->roombundlecollectionFactory = $roombundlecollectionFactory;
    }
    public function getChildComponents()
    {
        $room = $this->roomcollectionFactory->create();
        $collection = $room->getCollection();

        $productgroup = $this->productgroupcollectionFactory->create();
        $productgroupcollection = $productgroup->getCollection();

        $roombundle = $this->roombundlecollectionFactory->create();
        $roombundlecollection = $roombundle->getCollection();
        $model = $this->_coreRegistry->registry('BoqGrouproomlink');
        
        $productGroupId = $model->getProductGroupId();


        $productGroupConfig = json_decode($model->getProductGroupConfig(),TRUE);
        $qty = "";
        foreach($collection as $item){
             $roomoptions[] = ['label' => __($item->getName()), 'value' => $item->getId()];
        }
        
        foreach($productgroupcollection as $item){
            
            $productgroupoptions[] = ['label' => __($item->getName()), 'value' => $item->getId()];
        
        }
        foreach($roombundlecollection as $item){
        
           $roombundleoptions[] = ['label' => __($item->getName()), 'value' => $item->getId()];
           $qty = (isset($productGroupConfig['qty']))?$productGroupConfig['qty']:'';
        
        }
       
        $fields = [
            [
                'label' => __('Product Group'),
                'options' => $productgroupoptions,
                'formElement' => 'select',
                'default' => $productGroupId,
            ],
            [
                'label' => __('Room Type'),
                'options' => $roomoptions,
                'formElement' => 'select',
                'default' => (isset($productGroupConfig['room_type_id']))?$productGroupConfig['room_type_id']:'',
            ],
          [
                'label' => __('Bundle Type'),
                'options' => $roombundleoptions,
                'formElement' => 'select',
                'default' => (isset($productGroupConfig['bundle_type_id']))?$productGroupConfig['bundle_type_id']:'',
            ],
            [
                'label' => __('Quantity'),
                'value' => $qty,
                'formElement' => 'input',
            ],
        ];
        foreach ($fields as $key => $field) {
            $fieldInstance = $this->fieldFactory->create();
            $name = $key;
            $fieldInstance->setData(
                [
                    'config' => $field,
                    'name' => $name
                ]
            );
            $fieldInstance->prepare();
            $this->addComponent($name, $fieldInstance);
        }
        return parent::getChildComponents();
    }
}