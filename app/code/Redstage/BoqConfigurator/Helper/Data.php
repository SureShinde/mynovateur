<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Redstage\BoqConfigurator\Helper;
 
use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
 
class Data extends AbstractHelper
{
    const STORE_LOCATOR_URL = 'amlocator/locator/main_settings/';

    /**
     * @var Magento\Authorization\Model\UserContextInterface
     */
    protected $userContext;    

    /**
     * Data constructor.
     * @param Context $context
     * @param UserContextInterface $userContext
     */
    public function __construct(
        Context $context,
        UserContextInterface $userContext
    )
    {
        $this->userContext = $userContext;
        parent::__construct($context);
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

    /**
     * Get store locator url
     * @return string
     */
    public function getConfigValue($field, $storeId = null)
    {
       return $this->scopeConfig->getValue(
           $field, ScopeInterface::SCOPE_STORE, $storeId
       );
    }
    public function getStoreLocator($code, $storeId = null)
    {
       return $this->getConfigValue(self::STORE_LOCATOR_URL.$code, $storeId);
    }
}