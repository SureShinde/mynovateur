<?php

declare(strict_types=1);

namespace Amasty\MegaMenu\Model\Menu;

use Amasty\MegaMenu\Api\Data\Menu\ItemInterface;
use Amasty\MegaMenu\Model\OptionSource\SubcategoriesPosition;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\DataObject;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class ContainerData
{
    const MAX_COLUMN_COUNT = 10;

    const DEFAULT_COLUMN_COUNT = 4;

    /**
     * @var SubcategoriesPosition
     */
    private $subcategoriesPosition;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        SubcategoriesPosition $subcategoriesPosition,
        StoreManagerInterface $storeManager
    ) {
        $this->subcategoriesPosition = $subcategoriesPosition;
        $this->storeManager = $storeManager;
    }

    public function setNodeDataToObject(Node $node, DataObject $object): void
    {
        $data = [
            ItemInterface::TYPE => $this->getNodeType($node),
            ItemInterface::SUBMENU_TYPE => (bool) $node->getData(ItemInterface::SUBMENU_TYPE),
            ItemInterface::WIDTH => (int) $node->getData(ItemInterface::WIDTH),
            ItemInterface::WIDTH_VALUE => (int) $node->getData(ItemInterface::WIDTH_VALUE),
            ItemInterface::COLUMN_COUNT => $this->getColumnCount($node),
            ItemInterface::HIDE_CONTENT => (bool) $node->getData(ItemInterface::HIDE_CONTENT)
        ];

        if ($node->getData(ItemInterface::ICON)) {
            $data[ItemInterface::ICON] = $this->getIcon($node);
        }
        $data = array_merge($data, $object->getData());
        if ($data[ItemInterface::HIDE_CONTENT]) {
            unset($data[ItemInterface::CONTENT]);
        }

        $object->setData($data);
    }

    public function getIcon(Node $node): string
    {
        $url = '';
        if ($node->getIcon()) {
            $url = $this->validateIconPath($node->getIcon());
            $url = $this->getMediaBaseUrl() . $url;
        }

        return $url;
    }

    private function getNodeType(Node $node): ?array
    {
        $options = $this->subcategoriesPosition->toOptionArray(true);
        $position = $node->getData(ItemInterface::SUBCATEGORIES_POSITION);
        if ($position === null) {
            $position = $this->getDefaultPosition((int) $node->getData('level'));
        }

        if (isset($options[$position]['label'])) {
            $type = $options[$position]['label']->getText();
            $type = [
                'value' => (int) $position,
                'label' => strtolower($type)
            ];
        }

        return $type ?? null;
    }

    private function getDefaultPosition(int $level): int
    {
        return $level === Subcategory::TOP_LEVEL ? SubcategoriesPosition::LEFT : SubcategoriesPosition::NOT_SHOW;
    }

    private function getMediaBaseUrl(): string
    {
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

    private function validateIconPath(string $path): string
    {
        //TODO make refactor not to save "media" in icon data
        $path = preg_replace(
            "/^\/media/",
            "",
            $path
        );
        $path = str_replace(' ', '%20', $path);
        $path = ltrim($path, '/');

        return $path;
    }

    public function getColumnCount(Node $node): int
    {
        $count = $node->getColumnCount() !== null ? (int)$node->getColumnCount() : self::DEFAULT_COLUMN_COUNT;

        return min($count, static::MAX_COLUMN_COUNT);
    }
}
