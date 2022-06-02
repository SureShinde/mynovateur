<?php
namespace Redstage\ProductSliders\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Authorization\Model\UserContextInterface;

class Data extends AbstractHelper
{
	/**
     * @var Magento\Authorization\Model\UserContextInterface
     */
    protected $userContext;    

    /**
     * Data constructor.
     * @param Context $context,
     * @param \Magento\Catalog\CustomerData\CompareProducts $compareProducts
     * @param UserContextInterface $userContext
     */
	public function __construct(
		Context $context,
    	\Magento\Catalog\CustomerData\CompareProducts $compareProducts,
    	UserContextInterface $userContext
	){
	    $this->compareProducts = $compareProducts;
	    $this->userContext = $userContext;
        parent::__construct($context);
	}

	/*
    * Get current compare product list
    */
	public function getCompareList()
	{
	    return $this->compareProducts->getSectionData();
	}

	/**
     * Get logged in customer id
     * @return int
     */
    public function getLoginCustomerId()
    {
        $customerId = $this->userContext->getUserId();
        return $customerId;
    }
}
?>