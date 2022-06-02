<?php
/**
 * Redstage customer sync module use to sync customer in bulk 
 *
 * @category: PHP
 * @package: Redstage/CustomerSync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_CustomerSync
 */

namespace Redstage\CustomerSync\Cron;
use Redstage\CustomerSync\Model\Customers;

class SendCustomers {

    /**
     * @var Customers
     */
    protected $customers;

     /**
     * 
     * @param Customers
     */
    public function __construct(
        Customers $customers
    ) {
        $this->customers = $customers;
    }

    public function execute() {
        $this->customers->sendCustomersToSF();
    }

}