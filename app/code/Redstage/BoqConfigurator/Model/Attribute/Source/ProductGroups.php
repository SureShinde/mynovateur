<?php
namespace Redstage\BoqConfigurator\Model\Attribute\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;
class ProductGroups extends AbstractSource implements OptionSourceInterface
{
    /**
     * Get all options
     * @return array
     */
      protected $collectionFactory;

    public function __construct(
        \Redstage\BoqConfigurator\Model\BoqProductgroupFactory $collectionFactory
    ) {
                $this->collectionFactory = $collectionFactory;
    }

    public function getAllOptions()
    {

        $room = $this->collectionFactory->create();
        $collection = $room->getCollection();
        
       if(!empty($collection->getData())) {
        
        if (!$this->_options) {
            foreach($collection as $item){
           $this->_options[] = ['label' => __($item->getName()), 'value' => $item->getId()];
                           
            }
        }
        return $this->_options;
      }
        
        $this->_options[] = ['label' => __(" "), 'value' => " "];
        return $this->_options;
        
    }
}
