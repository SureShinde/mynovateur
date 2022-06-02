<?php

namespace Redstage\BoqConfigurator\Model\BoqConfigurator;

use Redstage\BoqConfigurator\Model\ResourceModel\BoqConfigurator\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Redstage\BoqConfigurator\Model\BoqConfigurator\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\BoqConfigurator\Model\ResourceModel\BoqConfigurator\Collection
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
     * @param CollectionFactory $bannerCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $bannerCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $bannerCollectionFactory->create();
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
        /** @var \Redstage\BoqConfigurator\Model\BoqConfigurator $BoqConfigurator */
        foreach ($items as $boqconfigurator) {
            $this->loadedData[$boqconfigurator->getId()] = $boqconfigurator->getData();
        }

        // Used from the Save action
        $data = $this->dataPersistor->get('BoqConfigurator');
        
        if (!empty($data)) {
            $boqconfigurator = $this->collection->getNewEmptyItem();
            $boqconfigurator->setData($data);
            $this->loadedData[$boqconfigurator->getId()] = $boqconfigurator->getData();
            $this->dataPersistor->clear('BoqConfigurator');
        }

        return $this->loadedData;
    }
    
}
