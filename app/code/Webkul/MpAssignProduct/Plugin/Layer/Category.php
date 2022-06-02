<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webkul\MpAssignProduct\Plugin\Layer;

use Magento\Catalog\Model\Layer\Filter\AbstractFilter;
use Magento\Catalog\Model\Layer\Filter\DataProvider\Category as CategoryDataProvider;

/**
 * Layer category filter
 */
class Category extends \Magento\Catalog\Model\Layer\Filter\Category
{
    
    /**
     * Get filter name
     *
     * @return \Magento\Framework\Phrase
     */
    // public function getName()
    // {
    //     return __('Category');
    // }
}
