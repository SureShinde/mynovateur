<?php

namespace Redstage\BoqConfigurator\Model\Boqquote;

use Redstage\BoqConfigurator\Model\ResourceModel\Boqquote\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Redstage\BoqConfigurator\Model\Boqquote\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\BoqConfigurator\Model\ResourceModel\Boqquote\Collection
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
        /** @var \Redstage\BoqConfigurator\Model\Boqquote $Boqquote */
        foreach ($items as $Boqquote) {
            $this->loadedData[$Boqquote->getId()] = $Boqquote->getData();
        }

        // Used from the Save action
        $data = $this->dataPersistor->get('Boqquote');
        
        if (!empty($data)) {
            $Boqquote = $this->collection->getNewEmptyItem();
            $Boqquote->setData($data);
            $this->loadedData[$Boqquote->getId()] = $Boqquote->getData();
            $this->dataPersistor->clear('Boqquote');
        }

        return $this->loadedData;
    }
    
}
