<?php
namespace Redstage\LayeredNavigation\Model\Config\Source;
use Redstage\LayeredNavigation\Helper\Data;
use Redstage\LayeredNavigation\Model\ResourceModel\LayeredNavigation\CollectionFactory;
class ApplicationDropdown implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * application constructor.
     * @param Data $helper
     */
    public function __construct(
        CollectionFactory $layerednavigationCollectionFactory
    )
    {
        $this->collection = $layerednavigationCollectionFactory->create();
    }

    public function toOptionArray()
    {
        $result = [];
        $items = $this->collection->getItems();
        $result[] = [
                 'value' => '',
                 'label' => '-',
             ];
        foreach ($items as $layerednavigation) {
            $result[] = [
                 'value' => $layerednavigation->getId(),
                 'label' => $layerednavigation->getTitle(),
             ];
        }
        return $result;
    }
}
