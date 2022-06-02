<?php

/**
 * Redstage Warranty module use for create warranty form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Warranty
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Warranty
 */
namespace Redstage\CustomerInstallation\Model\ResourceModel\Customer\Grid;

use Magento\Customer\Model\CustomerFactory;
use Magento\Store\Api\WebsiteRepositoryInterface; 
use Psr\Log\LoggerInterface;  


class Collection{

    /**
     * @var \Magento\Customer\Model\CustomerFactory
    */
    protected $_customerFactory;

    /**
     * @var WebsiteRepositoryInterface
     */
    public $websiteRepository;

    /**
     * @var LoggerInterface
     */
    public $logger;

    public function __construct(
    CustomerFactory $customerFactory,
    WebsiteRepositoryInterface $websiteRepository,
    LoggerInterface $logger
    ) {
        $this->_customerFactory = $customerFactory;
        $this->websiteRepository = $websiteRepository;
        $this->logger = $logger;
    }

    public function CustomerCollection(){
        try {
            $websiteId = $this->getWebsiteId('base');
            $collection = $this->_customerFactory->create()->getCollection()
                    ->addAttributeToSelect("*")
                    ->addAttributeToFilter("website_id", array("eq" => $websiteId))
                    ->joinAttribute('billing_postcode', 'customer_address/postcode', 'default_billing', null, 'left')
            ->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')
            ->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
            ->joinAttribute('billing_region', 'customer_address/region', 'default_billing', null, 'left')
            ->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left')  
            ->joinAttribute('billing_fax', 'customer_address/fax', 'default_billing', null, 'left')  
            ->joinAttribute('billing_street_line', 'customer_address/street', 'default_billing', null, 'left');
                    //->load();
            return $collection;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }

    /**
     * get website id
     *
     * @param string $code
     * @return int|null
     */
    public function getWebsiteId(string $code): ?int
    {
        $websiteId = null;
        try {
            $website = $this->websiteRepository->get($code);
            $websiteId = (int)$website->getId();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
        return $websiteId;
    }

}