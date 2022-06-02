<?php

namespace Redstage\BoqConfigurator\Model\BoqRoombundle;

use Redstage\BoqConfigurator\Model\ResourceModel\BoqRoombundle\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Redstage\BoqConfigurator\Model\BoqRoombundle\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\BoqConfigurator\Model\ResourceModel\BoqRoombundle\Collection
     */
    
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var Filesystem
     */
    private $fileInfo;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $boqRoombundleCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $boqRoombundleCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $boqRoombundleCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
    
        /** @var \Redstage\BoqConfigurator\Model\BoqRoombundle $boqRoombundle */
        foreach ($items as $boqRoombundle) {
            $this->loadedData[$boqRoombundle->getId()] = $boqRoombundle->getData();
        }
         


        // Used from the Save action
        $data = $this->dataPersistor->get('BoqRoombundle');
        
        if (!empty($data)) {
            $boqRoombundle = $this->collection->getNewEmptyItem();
            $boqRoombundle->setData($data);
            $this->loadedData[$boqRoombundle->getId()] = $boqRoombundle->getData();
            $this->dataPersistor->clear('BoqRoombundle');
        }
         //var_dump($this->loadedData);exit;  
        return $this->loadedData;
    }
    
}
