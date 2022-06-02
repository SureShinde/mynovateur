<?php
namespace Redstage\BoqConfigurator\Ui\Component\Form;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Form\FieldFactory;
class Fieldset extends \Magento\Ui\Component\Form\Fieldset
{
    protected $fieldFactory;
    public function __construct(
        ContextInterface $context,
        array $components = [],
        array $data = [],
        FieldFactory $fieldFactory)
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
    }
    public function getChildComponents()
    {
        

        $options = [
            0 => ['label' => 'Living Room','value' => '1'],
            1 => ['label' => 'Bedroom','value' => '2'],
            2 => ['label' => 'Kitchen','value' => '3'],
            3 => ['label' => 'Bathroom','value' => '4'],
            4 => ['label' => 'Passage', 'value' => '5'],
        ];
        
      $productRangeOptions = [
            0 => ['label' => 'ARTEOR with Automation', 'value' => '1'],
            1 => ['label' => 'ARTEOR without Automation', 'value' => '2'],
            2 => ['label' => 'MYRIUS NEXTGEN', 'value' => '3'],
            3 => ['label' => 'MYRIUS', 'value' => '4'],
            4 => ['label' => 'MYLINC', 'value' => '5'],
        ];
        $fields = [
            [
                'label' => __('Product Group'),
                'options' => $options,
                'formElement' => 'select',
            ],
          [
                'label' => __('Product Range'),
                'options' => $productRangeOptions,
                'formElement' => 'multiselect',
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