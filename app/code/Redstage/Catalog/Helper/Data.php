<?php
namespace Redstage\Catalog\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
	public function __construct(
    	\Magento\Catalog\CustomerData\CompareProducts $compareProducts
	){
	    $this->compareProducts = $compareProducts;
	}

	/*
    * Get current compare product list
    */
	public function getCompareList()
	{
	    return $this->compareProducts->getSectionData();
	}
}
?>