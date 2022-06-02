<?php

/**
 * Redstage Services Ticket module use for create service form in magento side save and send data to SF
 *
 * @category: PHP
 * @package: Redstage/ServiceTicket
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_ServiceTicket
 */

namespace Redstage\ServiceTicket\Block\Listing;

use Redstage\ServiceTicket\Model\ResourceModel\ServiceTicket\CollectionFactory;
use Redstage\ServiceTicket\Helper\Data;

class Index extends \Magento\Framework\View\Element\Template {

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var \Redstage\ServiceTicket\Model\ResourceModel\ServiceTicket\Collection
     */
    protected $tickets;

    /**
    * @var Data
    */
    protected $dataHelper;


    /**
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param CollectionFactory $tickets
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Magento\Customer\Model\Session $customerSession,
            CollectionFactory $tickets,
            Data $dataHelper,
            array $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->tickets = $tickets;
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->pageConfig->getTitle()->set(__('My Tickets'));
    }

    public function getTickets() {

        if (!($this->customerId = $this->_customerSession->getCustomerId())) {
            return false;
        }
        $collection = $this->tickets->create()->addFieldToSelect('*')->addFieldToFilter('customer_id', $this->customerId)->addFieldToFilter('store_id', $this->currentStoreId());
        //echo '<pre>';print_r($collection->getData());die;
        return $collection;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout() {
        parent::_prepareLayout();
        if ($this->getTickets()) {
            $pager = $this->getLayout()->createBlock(
                            \Magento\Theme\Block\Html\Pager::class,
                            'serviceticket.item.history.pager'
                    )->setCollection(
                    $this->getTickets()
            );
            $this->setChild('pager', $pager);
            $this->getTickets()->load();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml() {
        return $this->getChildHtml('pager');
    }

    /**
     * @return string
     */
    public function getBackUrl() {
        return $this->getUrl('customer/account/');
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
