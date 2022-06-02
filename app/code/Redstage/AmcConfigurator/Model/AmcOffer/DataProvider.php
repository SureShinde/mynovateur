<?php
namespace Redstage\AmcConfigurator\Model\AmcOffer;

use Redstage\AmcConfigurator\Model\ResourceModel\AmcOffer\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Redstage\AmcConfigurator\Model\AmcOffer\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\AmcConfigurator\Model\ResourceModel\AmcOffer\Collection
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

        /** @var \Redstage\AmcConfigurator\Model\AmcOffer $amcOffer */
        foreach ($items as $amcOffer) {
            $this->loadedData[$amcOffer->getId()] = $amcOffer->getData();
        }



        // Used from the Save action
        $data = $this->dataPersistor->get('AmcOffer');

        if (!empty($data)) {
            $amcOffer = $this->collection->getNewEmptyItem();
            $amcOffer->setData($data);
            $this->loadedData[$amcOffer->getId()] = $amcOffer->getData();
            $this->dataPersistor->clear('AmcOffer');
        }
         //var_dump($this->loadedData);exit;
        return $this->loadedData;
    }

}
