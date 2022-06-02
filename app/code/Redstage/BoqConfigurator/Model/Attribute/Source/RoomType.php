<?php
namespace Redstage\BoqConfigurator\Model\Attribute\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;
class RoomType extends AbstractSource implements OptionSourceInterface
{
    /**
     * Get all options
     * @return array
     */
      protected $collectionFactory;

    public function __construct(
        \Redstage\BoqConfigurator\Model\BoqRoomtypeFactory $collectionFactory
    ) {
                $this->collectionFactory = $collectionFactory;
    }

    public function getAllOptions()
    {

        $room = $this->collectionFactory->create();
        $collection = $room->getCollection();
        
        if (!$this->_options) {
            foreach($collection as $item){
           $this->_options[] = ['label' => __($item->getName()), 'value' => $item->getName()];
                           
            }
        }
        return $this->_options;
        
    }
}
