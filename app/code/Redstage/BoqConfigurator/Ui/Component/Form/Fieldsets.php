<?php
namespace Redstage\BoqConfigurator\Ui\Component\Form;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Form\FieldFactory;
class Fieldsets extends \Magento\Ui\Component\Form\Fieldset
{
    protected $fieldFactory;
    protected $collectionFactory;
    public function __construct(
        \Redstage\BoqConfigurator\Model\BoqRoomtypeFactory $collectionFactory,
        ContextInterface $context,
        array $components = [],
        array $data = [],
        \Magento\Framework\Registry $coreRegistry,
        FieldFactory $fieldFactory)
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->collectionFactory = $collectionFactory;
    }
    public function getChildComponents()
    {
        $room = $this->collectionFactory->create();
        $collection = $room->getCollection();
        $model = $this->_coreRegistry->registry('BoqRoombundle');
        $name = $model->getName();
        $roomTypeConfig = json_decode($model->getRoomTypeConfig(),TRUE);

        
        $options[] = 
            [
                'label' => __('Name'),
                'value' => $name,
                'formElement' => 'input',
                'data-id'=> 0,
                'validation' => ['required-entry' => true,'validate-alphanum-with-spaces' => true],
            ];
        

        foreach($collection as $item){      
          
            if(!empty($roomTypeConfig[$item->getId()])){
            
                $options[] = [
                'label' => $item->getName(),
                'value' => $roomTypeConfig[$item->getId()] ,
                'formElement' => 'input',
                'data-id' => $item->getId(),

                ];
            }
            else{
                $options[] = [
                    'label' => $item->getName(),
                    'value' => __(),
                    'formElement' => 'input',
                    'data-id' => $item->getId(),

                ];
            }
       }
      
        foreach ($options as $key => $field) {
            $fieldInstance = $this->fieldFactory->create();
            $name = $field['data-id']."";
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