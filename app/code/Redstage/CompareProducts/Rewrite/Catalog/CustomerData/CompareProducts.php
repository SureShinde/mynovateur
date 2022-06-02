<?php
declare(strict_types=1);

namespace Redstage\CompareProducts\Rewrite\Catalog\CustomerData;

class CompareProducts extends \Magento\Catalog\CustomerData\CompareProducts
{
  /**
   * @inheritdoc
   */
  public function getSectionData()
  {
      $count = $this->helper->getItemCount();
      return [
          'count' => $count,
          'countCaption' => $count == 1 ? __('1') : __('%1', $count),
          'listUrl' => $this->helper->getListUrl(),
          'items' => $count ? $this->getItems() : [],
      ];
  }
}
