<?php

declare(strict_types=1);

namespace Amasty\MegaMenu\Model\OptionSource\Widget\Products;

use Magento\Framework\Data\OptionSourceInterface;

class BlockLayout implements OptionSourceInterface
{
    const GRID = 'grid';

    const SLIDER = 'slider';

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::GRID, 'label' => __('Grid')],
            ['value' => self::SLIDER, 'label' => __('Slider')]
        ];
    }
}
