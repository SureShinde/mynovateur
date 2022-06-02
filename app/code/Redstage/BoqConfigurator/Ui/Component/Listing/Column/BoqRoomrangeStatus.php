<?php
    namespace Redstage\BoqConfigurator\Ui\Component\Listing\Column;

    use Magento\Framework\View\Element\UiComponent\ContextInterface;
    use Magento\Framework\View\Element\UiComponentFactory;
    use Magento\Ui\Component\Listing\Columns\Column;

    class BoqRoomrangeStatus extends \Magento\Ui\Component\Listing\Columns\Column
    {

        public function __construct(
            ContextInterface $context, 
            UiComponentFactory $uiComponentFactory, 
            array $components=[], 
            array $data=[]
        )
        {
            parent::__construct($context, $uiComponentFactory, $components, $data);
        }

        public function prepareDataSource(array $dataSource)
        {
            $statusArr = [
                '1' => 'Enabled',
                '2' => 'Disabled',
                
            ];

            if(isset($dataSource['data']['items'])) {
                foreach($dataSource['data']['items'] as &$item)
                {
                    if($item['is_active'] == "1") {
                        $item['is_active'] = "Enabled";
                    }

                    if($item['is_active'] == "2") {
                        $item['is_active'] = "Disabled";
                    }

            
                }
            }

            return $dataSource;
        }
    }