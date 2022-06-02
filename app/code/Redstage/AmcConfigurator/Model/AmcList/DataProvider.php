<?php
namespace Redstage\AmcConfigurator\Model\AmcList;

use Redstage\AmcConfigurator\Model\ResourceModel\AmcList\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Redstage\AmcConfigurator\Model\AmcList\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\AmcConfigurator\Model\ResourceModel\AmcList\Collection
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
     * @param CollectionFactory $amcCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $amcCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $amcCollectionFactory->create();
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

        /** @var \Redstage\AmcConfigurator\Model\AmcList $amcList */
        foreach ($items as $amcList) {
            $this->loadedData[$amcList->getId()] = $amcList->getData();
        }



        // Used from the Save action
        $data = $this->dataPersistor->get('AmcList');

        if (!empty($data)) {
            $amcList = $this->collection->getNewEmptyItem();
            $amcList->setData($data);
            $this->loadedData[$amcList->getId()] = $amcList->getData();
            $this->dataPersistor->clear('AmcList');
        }
         //var_dump($this->loadedData);exit;
        return $this->loadedData;
    }

}
