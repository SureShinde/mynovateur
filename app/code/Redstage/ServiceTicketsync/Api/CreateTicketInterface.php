<?php
/**
 * Redstage Services Ticket sync module use for create service ticket in bulk 
 *
 * @category: PHP
 * @package: Redstage/ServiceTicketsync
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicketsync
 */
namespace Redstage\ServiceTicketsync\Api;

/**
 * Defines the service contract for some simple maths functions. The purpose is
 * to demonstrate the definition of a simple web service, not that these
 * functions are really useful in practice. The function prototypes were therefore
 * selected to demonstrate different parameter and return values, not as a good
 * calculator design.
 */
interface CreateTicketInterface
{

    /**
     * Updateticket function
     *
     * @api
     * @return string
     */
    public function sendServiceTicketsToSF();
}
