<?php
/**
 * Redstage create service ticket module use to create service ticket in bulk 
 *
 * @category: PHP
 * @package: Redstage/ServiceTicketsync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_CustomerSync
 */

namespace Redstage\ServiceTicketsync\Cron;
use Redstage\ServiceTicketsync\Model\Createtickets;

class SendTickets {

    /**
     * @var Createtickets
     */
    protected $tickets;

     /**
     * 
     * @param Customers
     */
    public function __construct(
        Createtickets $createtickets
    ) {
        $this->tickets = $createtickets;
    }

    public function execute() {
        $this->tickets->sendServiceTicketsToSF();
    }

}