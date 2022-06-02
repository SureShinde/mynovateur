<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Redstage\Contact\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Provides the user data to fill the form.
 */
class CityState implements ArgumentInterface
{
    /**
     * @var
     */
    protected $connection;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\ResourceConnection $resourceConnection
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->connection = $resourceConnection->getConnection();
    }

    /**
     * get city and state
     * @return array
     */
    public function getCityState()
    {
        $select = $this->connection->select()
            ->from('redstage_state_city')
            ->columns(['city','state']);
        $cities = $this->connection->fetchAll($select);
        $states = [];

        foreach ($cities as $city){
            $states[$city['state']][] = $city['city'];
        }
        return $states;
    }

    /**
     * get site key for goole recaptcha
     * @return mixed
     */
    public function getSiteKey()
    {
        return $this->scopeConfig->getValue(
            'google_recaptcha/config/site_key',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
