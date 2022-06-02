<?php
    namespace Redstage\BoqConfigurator\Ui\Component\Listing\Column;

    use Magento\Framework\View\Element\UiComponent\ContextInterface;
    use Magento\Framework\View\Element\UiComponentFactory;
    use Magento\Ui\Component\Listing\Columns\Column;
    

    class Rangeconfigname extends \Magento\Ui\Component\Listing\Columns\Column
    {
        protected $_eavConfig;
        
        public function __construct(
            ContextInterface $context, 
            UiComponentFactory $uiComponentFactory, 
            \Magento\Eav\Model\Config $eavConfig,
            array $components=[], 
            array $data=[]
        )
        {           
            $this->_eavConfig = $eavConfig;
            parent::__construct($context, $uiComponentFactory, $components, $data);
        }

        public function prepareDataSource(array $dataSource)
        {
            if(isset($dataSource['data']['items'])) {
                foreach($dataSource['data']['items'] as &$item)
                {
                    $item['range_config'] =  $this->getRangeConfigName($item['range_config']); 
                }
            }
            
            return $dataSource;
        }

        public function getRangeConfigName($rangeConig){

            $attributeCode = "product_range";
            $attribute = $this->_eavConfig->getAttribute('catalog_product', $attributeCode);
            $options = $attribute->getSource()->getAllOptions();
            $range = (explode(",",$rangeConig));
            $val = [];
            for($i=0;$i<count($range);$i++){
                foreach($options as $option){
                    if($option['value']==$range[$i]){
                        $val[] = $option['label'];
                    }
                }
            }      
            return $val; 
        }   
     }