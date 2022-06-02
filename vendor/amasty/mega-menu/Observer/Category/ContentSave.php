<?php

declare(strict_types = 1);

namespace Amasty\MegaMenu\Observer\Category;

use Amasty\MegaMenuLite\Api\Data\Menu\ItemInterface;
use Amasty\MegaMenuLite\Api\ItemRepositoryInterface;
use Amasty\MegaMenu\Model\Menu\ItemFactory;
use Amasty\MegaMenuLite\Model\Provider\FieldsByStore;
use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Model\AbstractModel;

class ContentSave implements ObserverInterface
{
    /**
     * @var ItemFactory
     */
    private $itemFactory;

    /**
     * @var ItemRepositoryInterface
     */
    private $itemRepository;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var FieldsByStore
     */
    private $fieldsByStore;

    /**
     * @var MetadataPool
     */
    private $metadataPool;

    public function __construct(
        ItemFactory $itemFactory,
        ItemRepositoryInterface $itemRepository,
        RequestInterface $request,
        FieldsByStore $fieldsByStore,
        MetadataPool $metadataPool
    ) {
        $this->itemFactory = $itemFactory;
        $this->itemRepository = $itemRepository;
        $this->request = $request;
        $this->fieldsByStore = $fieldsByStore;
        $this->metadataPool = $metadataPool;
    }

    public function execute(Observer $observer): void
    {
        $entity = $observer->getEvent()->getEntity();
        if ($entity instanceof AbstractModel) {
            $storeId = $this->request->getParam('store_id', $entity->getStoreId());
            $useDefaults = $this->request->getParam(ItemInterface::USE_DEFAULT, []);
            $metadata = $this->metadataPool->getMetadata(CategoryInterface::class);
            $id = $entity->getData($metadata->getLinkField());
            $itemContent = $this->itemRepository->getByEntityId($id, $storeId, 'category');
            if (!$itemContent) {
                $itemContent = $this->itemFactory->create([
                    'data' => [
                        'store_id' => $storeId,
                        'type' => 'category',
                        'entity_id' => $id
                    ]
                ]);
            }

            foreach ($this->fieldsByStore->getCategoryFields() as $fieldSet) {
                foreach ($fieldSet as $field) {
                    $itemContent->setData($field, $entity->getData($field));
                }
            }
            $useDefaults = array_keys(array_diff($useDefaults, ['0']));
            $useDefaults = implode(ItemInterface::SEPARATOR, $useDefaults);
            $itemContent->setUseDefault($useDefaults);
            $itemContent->setName($entity->getName());
            $itemContent->setStatus($entity->getIsActive() && $entity->getIncludeInMenu());
            $itemContent->setCategoryId($entity->getId());

            $this->itemRepository->save($itemContent);
        }
    }
}
