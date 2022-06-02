<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
* @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\Model;
use Redstage\LayeredNavigation\Model\ResourceModel\LayeredNavigation\CollectionFactory;
use Magento\Framework\Serialize\SerializerInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    // @codingStandardsIgnoreStart
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $layerednavigationCollectionFactory,
        SerializerInterface $serializer,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $layerednavigationCollectionFactory->create();
        $this->serializer = $serializer;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    // @codingStandardsIgnoreEnd
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $layerednavigation) {
            $_data = $layerednavigation->getData();
            if ($_data['application_attributes']):
                $applicationAttribute = $this->unserializeData($_data['application_attributes']);
                $_data['application_attributes'] = $applicationAttribute;
            endif;
            //echo '<pre>';print_r($data);die;
            $layerednavigation->setData($_data);
            $this->loadedData[$layerednavigation->getId()] = $layerednavigation->getData();
        }
        return $this->loadedData;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function unserializeData($string)
    {
        $result = json_decode($string, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            if ($this->serializer->unserialize($string)!==false) {
                return $this->serializer->unserialize($string);
            }
            throw new \InvalidArgumentException('Unable to unserialize value.');
        }
        return $result;
    }
}
