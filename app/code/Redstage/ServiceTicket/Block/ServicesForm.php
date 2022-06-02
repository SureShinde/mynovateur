<?php
/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */
 
namespace Redstage\ServiceTicket\Block;

use Magento\Framework\View\Element\Template;
use Redstage\ServiceTicket\Helper\Data;

class ServicesForm extends Template
{
    /**
    * @var Data
    */
    protected $dataHelper;

    /**
     * @param Template\Context $context
     * @param array $data
     * @param Data $dataHelper
     */
    public function __construct(
        Template\Context $context,
        Data $dataHelper, 
        array $data = []
    )
    {
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Returns action url for Service form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('serviceticket/index/post', ['_secure' => true]);
    }
    
    /**
     * Returns Call Type values for Service form
     *
     * @return array
     */
    public function getValueFromMultipleFields() {
        return $this->dataHelper->getValueFromMultipleFields();
    }

    /**
     * Returned customer id
     *
     * @return int
     */
    public function isCustoemrId() {
        return $this->dataHelper->isCustoemrId();
    }

    /**
     * Returned customer name
     *
     * @return string
     */
    public function getCustomerName() {
        return $this->dataHelper->getCustoemrData()->getCustomer()->getName();
    }

    /**
     * Returned customer email
     *
     * @return string
     */
    public function getCustomerEmail() {
        return $this->dataHelper->getCustoemrData()->getCustomer()->getEmail();
    }

    /**
     * Returned store id
     *
     * @return int
     */
    public function currentStoreId() {
        return $this->dataHelper->getCurrentStoreId();
    }
}
