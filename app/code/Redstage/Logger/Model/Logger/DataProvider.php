<?php
/**
 * Redstage Logger module to log all incoming and outgoing request and responses to and from Magento
 *
 * @category: PHP
 * @package: Redstage/Logger
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Logger
 */

namespace Redstage\Logger\Model\Logger;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Redstage\Logger\Model\ResourceModel\Logger\Collection;
use Redstage\Logger\Model\ResourceModel\Logger\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 * @package Redstage\Logger\Model\Logger
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @var CollectionFactory
     */
    protected $collection;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * DataProvider constructor.
     *
     * @param CollectionFactory $collection
     * @param DataPersistorInterface $dataPersistor
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collection,
        DataPersistorInterface $dataPersistor,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collection = $collection->create();
        $this->dataPersistor = $dataPersistor;
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
        /** @var Collection $items */
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $this->loadedData[$item->getId()]['logger'] = $item->getData();
        }
        return $this->loadedData;
    }
}
