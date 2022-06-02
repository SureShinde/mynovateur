<?php
namespace Redstage\LayeredNavigation\Model\Category;

class DataProvider extends \Magento\Catalog\Model\Category\DataProvider
{
	protected function getFieldsMap()
	{
    	  $fields = parent::getFieldsMap();
        $fields['content'][] = 'layer_image'; // layer image field
    	return $fields;
	}
}
