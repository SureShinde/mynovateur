<?php

declare(strict_types = 1);

namespace Amasty\MegaMenu\Ui\DataProvider\Form\Category\Modifier;

use Amasty\MegaMenu\Api\Data\Menu\ItemInterface;
use Amasty\MegaMenu\Model\Menu\Subcategory;
use Amasty\MegaMenu\Model\Provider\FieldsToHideProvider;
use Magento\Catalog\Model\Category;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;

class HideItems implements ModifierInterface
{
    /**
     * @var Category
     */
    private $entity;

    /**
     * @var int
     */
    private $parentId;

    /**
     * @var FieldsToHideProvider
     */
    private $fieldsToHideProvider;

    public function __construct(
        RequestInterface $request,
        FieldsToHideProvider $fieldsToHideProvider
    ) {
        $this->parentId = (int) $request->getParam('parent', 0);
        $this->fieldsToHideProvider = $fieldsToHideProvider;
    }

    /**
     * @inheritdoc
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function modifyMeta(array $meta)
    {
        return $this->modifyLevel($meta);
    }

    private function modifyLevel(array $meta): array
    {
        switch ($this->getCategoryLevel() <=> Subcategory::TOP_LEVEL) {
            case -1:
                $itemsToHide = $this->fieldsToHideProvider->getRootCategoryFields();
                $this->updateRootSwitcherConfig($meta['am_mega_menu_fieldset']['children']);
                break;
            case 0:
                $itemsToHide = $this->fieldsToHideProvider->getMainCategoryFields();
                break;
            case 1:
                $itemsToHide = $this->fieldsToHideProvider->getSubcategoryFields($this->entity->getParentCategory());
                break;
        }
        $this->updateItemsToHide($itemsToHide);

        return $this->hideFields($meta, array_unique($itemsToHide));
    }

    private function updateRootSwitcherConfig(?array &$meta): void
    {
        $meta[ItemInterface::HIDE_CONTENT]['arguments']['data']['config']['switcherConfig']['enabled'] = false;
    }

    private function getCategoryLevel(): int
    {
        if ($this->parentId && $this->entity->isObjectNew()) {
            $level = $this->entity->setParentId($this->parentId)->getParentCategory()->getLevel() + 1;
        } else {
            $level = $this->entity->getLevel();
        }

        return (int) $level;
    }

    private function updateItemsToHide(array &$itemsToHide)
    {
        if (!$this->entity->hasChildren()) {
            $itemsToHide[] = ItemInterface::SUBCATEGORIES_POSITION;
            $itemsToHide[] = ItemInterface::SUBMENU_TYPE;
        }

        if ($this->entity->isObjectNew()) {
            $itemsToHide[] = ItemInterface::SUBMENU_TYPE;
        }
    }

    private function hideFields(array $meta, array $fieldsToHide): array
    {
        foreach ($fieldsToHide as $field) {
            $meta['am_mega_menu_fieldset']['children'][$field]['arguments']['data']['config']['hidden'] = true;
            $meta['am_mega_menu_fieldset']['children'][$field]['arguments']['data']['config']['visible'] = false;
        }

        return $meta;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->entity = $category;

        return $this;
    }

    public function isNeedCategory(): bool
    {
        return true;
    }
}
