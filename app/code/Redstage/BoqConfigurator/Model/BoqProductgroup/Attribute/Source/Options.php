<?php


namespace Redstage\BoqConfigurator\Model\BoqProductgroup\Attribute\Source;

use Redstage\BoqConfigurator\Model\ResourceModel\BoqProductgroup\CollectionFactory;
/**
 * Class Color
 *
 * @package Vendor\Module\Model\Product\Attribute\Source
 */
class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    /**
     * Constructor
     *
     * @param CollectionFactory $productGroupCollectionFactory
     */
    public function __construct(
        CollectionFactory $productGroupCollectionFactory
    ){
        $this->collection = $productGroupCollectionFactory->create();
    }

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $items = $this->collection->getItems();
        
        /** @var \Redstage\BoqConfigurator\Model\BoqProductgroup $BoqProductgroup */
        $this->_options[0] = ['label'=>'Select Options', 'value'=>''];
        foreach ($items as $index => $BoqProductgroup) {           
            $this->_options[] = ['label'=> $BoqProductgroup->getData('name'), 'value'=> $BoqProductgroup->getId()];            
        }
        
        return $this->_options;
    }

    /**
     * @return array
     */
    public function getFlatColumns()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        return [
        $attributeCode => [
        'unsigned' => false,
        'default' => null,
        'extra' => null,
        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        'length' => 255,
        'nullable' => true,
        'comment' => $attributeCode . ' column',
        ],
        ];
    }

    /**
     * @return array
     */
    public function getFlatIndexes()
    {
        $indexes = [];
        
        $index = 'IDX_' . strtoupper($this->getAttribute()->getAttributeCode());
        $indexes[$index] = ['type' => 'index', 'fields' => [$this->getAttribute()->getAttributeCode()]];
        
        return $indexes;
    }

    /**
     * @param int $store
     * @return \Magento\Framework\DB\Select|null
     */
    public function getFlatUpdateSelect($store)
    {
        return $this->eavAttrEntity->create()->getFlatUpdateSelect($this->getAttribute(), $store);
    }
}