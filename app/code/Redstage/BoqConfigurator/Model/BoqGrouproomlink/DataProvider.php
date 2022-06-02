<?php

namespace Redstage\BoqConfigurator\Model\BoqGrouproomlink;

use Redstage\BoqConfigurator\Model\ResourceModel\BoqGrouproomlink\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Redstage\BoqConfigurator\Model\BoqGrouproomlink\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\BoqConfigurator\Model\ResourceModel\BoqGrouproomlink\Collection
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
        /** @var \Redstage\BoqConfigurator\Model\BoqGrouproomlink $BoqGrouproomlink */
        foreach ($items as $BoqGrouproomlink) {
            $this->loadedData[$BoqGrouproomlink->getLinkId()] = $BoqGrouproomlink->getData();
        }

        // Used from the Save action
        $data = $this->dataPersistor->get('BoqGrouproomlink');
        
        if (!empty($data)) {
            $BoqGrouproomlink = $this->collection->getNewEmptyItem();
            $BoqGrouproomlink->setData($data);
            $this->loadedData[$BoqGrouproomlink->getLinkId()] = $BoqGrouproomlink->getData();
            $this->dataPersistor->clear('BoqGrouproomlink');
        }

        return $this->loadedData;
    }
    
}
