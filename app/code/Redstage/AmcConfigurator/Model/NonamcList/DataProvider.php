<?php
namespace Redstage\AmcConfigurator\Model\NonamcList;

use Redstage\AmcConfigurator\Model\ResourceModel\NonamcList\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Redstage\AmcConfigurator\Model\NonamcList\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\AmcConfigurator\Model\ResourceModel\NonamcList\Collection
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
     * @param CollectionFactory $nonAmcCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $nonAmcCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $nonAmcCollectionFactory->create();
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

        /** @var \Redstage\AmcConfigurator\Model\NonamcList $nonamcList */
        foreach ($items as $nonamcList) {
            $this->loadedData[$nonamcList->getId()] = $nonamcList->getData();
        }



        // Used from the Save action
        $data = $this->dataPersistor->get('NonamcList');

        if (!empty($data)) {
            $nonamcList = $this->collection->getNewEmptyItem();
            $nonamcList->setData($data);
            $this->loadedData[$nonamcList->getId()] = $nonamcList->getData();
            $this->dataPersistor->clear('NonamcList');
        }
         //var_dump($this->loadedData);exit;
        return $this->loadedData;
    }

}
