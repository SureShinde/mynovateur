<?php

namespace Redstage\AmcConfigurator\Block;

class AmcList extends \Magento\Framework\View\Element\Template
{

    /**
     * @var Magento\Framework\Pricing\Helper\Data
     */
    private $pricingHelper;

    /**
     * @param Context $context
     * @param \Redstage\AmcConfigurator\Model\AmcListFactory $amcListFactory
     * @param \Redstage\AmcConfigurator\Model\AmcOfferFactory $amcOfferFactory
     * @param \Magento\Framework\Pricing\Helper\Data $pricingHelper
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Redstage\AmcConfigurator\Model\AmcListFactory $amcListFactory,
        \Redstage\AmcConfigurator\Model\AmcOfferFactory $amcOfferFactory,
        \Magento\Framework\Pricing\Helper\Data $pricingHelper
    ) {

        parent::__construct($context);
        $this->amcListFactory = $amcListFactory;
        $this->amcOfferFactory = $amcOfferFactory;
        $this->pricingHelper = $pricingHelper;
    }

    /**
     * Get AmcList collection
     *
     * @return \Redstage\AmcConfigurator\Model\ResourceModel\AmcList\Collection
     */
    public function getAmcCollection()
    {
        $amcCustomer = $this->amcListFactory->create();
        $collection = $amcCustomer->getCollection();
        return $collection;
    }

    /**
     * Get AmcOffer collection
     *
     * @return \Redstage\AmcConfigurator\Model\ResourceModel\AmcOffer\Collection
     */
    public function getAmcOfferCollection()
    {
        $amcOffer = $this->amcOfferFactory->create();
        $collection = $amcOffer->getCollection();
        return $collection->getData();
    }

    public function getCurrencySymbol($price){
      return $this->pricingHelper->currency($price, true, false);
    }

    /**
     * Get AmcList collection
     *
     * @return \Redstage\AmcConfigurator\Model\ResourceModel\AmcList\Collection
     */
    public function getExpiredAmc()
    {
        $collection = $this->getAmcCollection();
        $collection->getSelect()
            ->reset(\Zend_Db_Select::COLUMNS)
            ->columns(['id'])
            ->columns(['sales_org'])
            ->columns(['product_meterial_group_1'])
            ->columns(['product_meterial_group_3'])
            ->columns(['account_account_name'])
            ->columns(['sold_to_account_name'])
            ->columns(['account_billing_street'])
            ->columns(['account_city1'])
            ->columns(['asset_name'])
            ->columns(['postal_code'])
            ->columns(['account_region'])
            ->columns(['warranty_start_date'])
            ->columns(['warranty_end_date'])
            ->columns(["DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) as aging_year"])
            ->columns(["amc_start_date"])
            ->columns(["amc_end_date"])
            ->columns(['customer_asset_status'])
            ->where("DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) <= CURDATE()");
        return $collection->getData();
    }

    /**
     * Get AmcList collection
     *
     * @return \Redstage\AmcConfigurator\Model\ResourceModel\AmcList\Collection
     */
    public function getCompleteCoveredAmc()
    {
        $amcCustomer = $this->amcListFactory->create();
        $collection = $amcCustomer->getCollection();
        $collection->getSelect()
            ->reset(\Zend_Db_Select::COLUMNS)
            ->columns(['id'])
            ->columns(['sales_org'])
            ->columns(['product_meterial_group_1'])
            ->columns(['product_meterial_group_3'])
            ->columns(['account_account_name'])
            ->columns(['sold_to_account_name'])
            ->columns(['account_billing_street'])
            ->columns(['account_city1'])
            ->columns(['asset_name'])
            ->columns(['postal_code'])
            ->columns(['account_region'])
            ->columns(['warranty_start_date'])
            ->columns(['warranty_end_date'])
            ->columns(["DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) as aging_year"])
            ->columns(["amc_start_date"])
            ->columns(["amc_end_date"])
            ->columns(['customer_asset_status'])
            ->where("year(DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR)) = year(`warranty_end_date`) AND month(DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR)) = month(`warranty_end_date`) OR year(DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR)) = year(`amc_end_date`) AND month(DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR)) = month(`amc_end_date`)");


        return $collection->getData();
    }

    /**
     * Get Renewal AMC collection
     *
     * @return \Redstage\AmcConfigurator\Model\ResourceModel\AmcList\Collection
     */
    public function getRenewalAmc()
    {
        $collection = $this->getAmcCollection();
        $collection->getSelect()
            ->reset(\Zend_Db_Select::COLUMNS)
            ->columns(['id'])
            ->columns(['sales_org'])
            ->columns(['product_meterial_group_1'])
            ->columns(['product_meterial_group_3'])
            ->columns(['account_account_name'])
            ->columns(['sold_to_account_name'])
            ->columns(['account_billing_street'])
            ->columns(['account_city1'])
            ->columns(['asset_name'])
            ->columns(['postal_code'])
            ->columns(['account_region'])
            ->columns(['warranty_start_date'])
            ->columns(['warranty_end_date'])
            ->columns(["DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) as aging_year"])
            ->columns(["amc_start_date"])
            ->columns(["amc_end_date"])
            ->columns(['customer_asset_status'])
            ->where("(DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) > warranty_end_date OR DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) > amc_end_date) AND (customer_asset_status IN ('CAMC', 'UW', 'NCAMC'))");
        return $collection->getData();
    }

    /**
     * Get Non AMC collection
     *
     * @return \Redstage\AmcConfigurator\Model\ResourceModel\AmcList\Collection
     */
    public function getNonAmc()
    {
        $collection = $this->getAmcCollection();
        $collection->getSelect()
            ->reset(\Zend_Db_Select::COLUMNS)
            ->columns(['id'])
            ->columns(['sales_org'])
            ->columns(['product_meterial_group_1'])
            ->columns(['product_meterial_group_3'])
            ->columns(['account_account_name'])
            ->columns(['sold_to_account_name'])
            ->columns(['account_billing_street'])
            ->columns(['account_city1'])
            ->columns(['asset_name'])
            ->columns(['postal_code'])
            ->columns(['account_region'])
            ->columns(['warranty_start_date'])
            ->columns(['warranty_end_date'])
            ->columns(["DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) as aging_year"])
            ->columns(["amc_start_date"])
            ->columns(["amc_end_date"])
            ->columns(['customer_asset_status'])
            ->where("(DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) > warranty_end_date OR DATE_ADD(`warranty_start_date`, INTERVAL 7 YEAR) > amc_end_date) AND (customer_asset_status IN ('PCB', 'UP'))");
        return $collection->getData();
    }
}
