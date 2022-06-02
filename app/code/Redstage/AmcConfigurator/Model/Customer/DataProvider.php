<?php
namespace Redstage\AmcConfigurator\Model\Customer;

use Redstage\AmcConfigurator\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Redstage\AmcConfigurator\Model\Customer\FileInfo;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Redstage\AmcConfigurator\Model\ResourceModel\Customer\Collection
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
     * @param CollectionFactory $customeCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $customeCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $customeCollectionFactory->create();
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

        /** @var \Redstage\AmcConfigurator\Model\Customer $customerList */
        foreach ($items as $customerList) {
            $this->loadedData[$customerList->getId()] = $customerList->getData();
        }



        // Used from the Save action
        $data = $this->dataPersistor->get('customerList');

        if (!empty($data)) {
            $customerList = $this->collection->getNewEmptyItem();
            $customerList->setData($data);
            $this->loadedData[$customerList->getId()] = $customerList->getData();
            $this->dataPersistor->clear('customerList');
        }
         //var_dump($this->loadedData);exit;
        return $this->loadedData;
    }

}
