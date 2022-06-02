<?php
/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */
 
namespace Redstage\ServiceTicket\Block\Html\Link;

use Magento\Framework\View\Element\Html\Link\Current;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\DefaultPathInterface;
use Redstage\ServiceTicket\Helper\Data;

class ServiceLink extends Current
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
        Context $context,
        DefaultPathInterface $defaultPath,
        Data $dataHelper
    ) 
    {
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $defaultPath, []);
    }

    /**
     * Returns action url for Service form
     *
     * @return string
     */
    public function isServiceEnable()
    {
        if(!$this->dataHelper->isModuleEnabled()){
            return $this->getLayout()->unsetElement('customer-account-navigation-service-ticket-link');
        }
    }
}
