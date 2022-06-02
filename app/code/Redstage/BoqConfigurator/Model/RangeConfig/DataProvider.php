<?php

namespace Redstage\BoqConfigurator\Model\RangeConfig;

use Redstage\BoqConfigurator\Model\ResourceModel\RangeConfig\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Redstage\BoqConfigurator\Model\RangeConfig\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\BoqConfigurator\Model\ResourceModel\RangeConfig\Collection
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
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
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
        /** @var \Redstage\BoqConfigurator\Model\RangeConfig $RangeConfig */
        foreach ($items as $RangeConfig) {
            $this->loadedData[$RangeConfig->getId()] = $RangeConfig->getData();
        }

        // Used from the Save action
        $data = $this->dataPersistor->get('RangeConfig');
        
        if (!empty($data)) {
            $RangeConfig = $this->collection->getNewEmptyItem();
            $RangeConfig->setData($data);
            $this->loadedData[$RangeConfig->getId()] = $RangeConfig->getData();
            $this->dataPersistor->clear('RangeConfig');
        }
        return $this->loadedData;
    }
    
}
