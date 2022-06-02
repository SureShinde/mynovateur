<?php
namespace Redstage\BoqConfigurator\Ui\Component\Form;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Form\FieldFactory;
class FieldsetProductGroup extends \Magento\Ui\Component\Form\Fieldset
{
    protected $fieldFactory;

    public function __construct(
    
        ContextInterface $context,
        array $components = [],
        array $data = [],
        \Magento\Framework\Registry $coreRegistry,
        \Redstage\BoqConfigurator\Model\BoqProductgroupFactory $productgroupcollectionFactory,
        \Redstage\BoqConfigurator\Model\BoqRoombundleFactory $roombundlecollectionFactory,
        \Redstage\BoqConfigurator\Model\BoqRoomtypeFactory $roomcollectionFactory,
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
        $model = $this->_coreRegistry->registry('BoqGrouproomlink');    
        $productGroupConfig = json_decode($model->getProductGroupConfig(),TRUE);
           

            foreach($collection as $item){       
                if(!empty($productGroupConfig)){
                    if( $item->getId() == $productGroupConfig['name']){               
                        $options = [
                       'label' => $item->getName(),
                       'value' => $item->getId(),       
                       ];            
            }
            
        }
        
                $options = [
                'label' => $item->getName(),
                'value' => $item->getId(),       
                ];
            
    }

    
    
        $fields = [
            [
                'label' => __('Room Type'),
                'options' => $options,
                'formElement' => 'select',
            ],
        ];
        foreach ($fields as $key => $field) {
            $fieldInstance = $this->fieldFactory->create();
            $name = 'dynamic_fieldset' . $key;
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