<?php

declare(strict_types = 1);

namespace Amasty\MegaMenu\Ui\DataProvider\Form\Category\Modifier;

use Amasty\MegaMenu\Model\Menu\Subcategory;
use Amasty\MegaMenu\Model\OptionSource\SubcategoriesPosition;
use Amasty\MegaMenuLite\Model\Provider\FieldsByStore;
use Magento\Catalog\Model\Category;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;

class Level implements ModifierInterface
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
     * @var SubcategoriesPosition
     */
    private $subcategoriesPosition;

    /**
     * @var Subcategory
     */
    private $subcategory;

    /**
     * @var FieldsByStore
     */
    private $fieldsByStore;

    public function __construct(
        RequestInterface $request,
        SubcategoriesPosition $subcategoriesPosition,
        Subcategory $subcategory,
        FieldsByStore $fieldsByStore
    ) {
        $this->parentId = (int) $request->getParam('parent', 0);
        $this->subcategoriesPosition = $subcategoriesPosition;
        $this->subcategory = $subcategory;
        $this->fieldsByStore = $fieldsByStore;
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
        $level = $this->getCategoryLevel();
        switch ($level <=> Subcategory::TOP_LEVEL) {
            case -1:
                $meta = $this->getRootCategoryMeta($meta);
                break;
            case 0:
                $meta = $this->getMainCategoryMeta($meta);
                break;
            case 1:
                $meta = $this->getSubcategoryMeta($meta);
                break;
        }
        $this->setLevel($meta['am_mega_menu_fieldset']['children'], $level);

        return $meta;
    }

    private function setLevel(?array &$meta, int $level): void
    {
        foreach ($this->fieldsByStore->getCategoryFields()['am_mega_menu_fieldset'] as $field) {
            $meta[$field]['arguments']['data']['config']['level'] = $level;
        }
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

    private function getRootCategoryMeta(array $meta): array
    {
        $options = $this->subcategoriesPosition->toOptionArray();
        $switcherConfig = false;

        return $this->updateMeta($meta, $switcherConfig, $options);
    }

    private function getMainCategoryMeta(array $meta): array
    {
        $options = $this->subcategoriesPosition->toOptionArray();
        $switcherConfig = true;

        if ($this->subcategory->isShowSubcategories($this->entity)) {
            $meta = $this->unsetContentNotice($meta);
        }

        return $this->updateMeta($meta, $switcherConfig, $options);
    }

    private function getSubcategoryMeta(array $meta): array
    {
        $options = $this->subcategoriesPosition->toOptionArray(true);
        $switcherConfig = false;

        $parentCategory = $this->entity->getParentCategory();
        if ($parentCategory && $this->subcategory->isShowSubcategories($parentCategory)) {
            $meta = $this->unsetContentNotice($meta);
        }

        return $this->updateMeta($meta, $switcherConfig, $options);
    }

    private function unsetContentNotice(array $meta): array
    {
        unset(
            $meta['am_mega_menu_fieldset']['children']['content']['arguments']['data']['config']['notice']
        );
        unset(
            $meta['am_mega_menu_fieldset']['children']['content']['arguments']['data']['config']['default']
        );

        return $meta;
    }

    private function updateMeta(array $meta, bool $switcherConfig, array $options): array
    {
        $fields = &$meta['am_mega_menu_fieldset']['children'];
        $fields['submenu_type']['arguments']['data']['config']['switcherConfig']['enabled'] = $switcherConfig;
        $fields['subcategories_position']['arguments']['data']['options'] = $options;

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
