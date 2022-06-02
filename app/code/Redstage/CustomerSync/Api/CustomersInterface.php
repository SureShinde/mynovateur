<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Redstage\CustomerSync\Api;

/**
 * @api
 * @since 100.0.2
 */
interface CustomersInterface
{
    /**
     * Provide the number of customer count
     *
     * @return json
     */
    public function sendCustomersToSF();
}