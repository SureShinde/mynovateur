<?php 

/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
 * @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\Controller\Index;

use Redstage\LayeredNavigation\Model\WattCalculation;
use Redstage\LayeredNavigation\Model\ResourceModel\WattCalculation\CollectionFactory;

class Options extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Session\SessionManager $sessionManager,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        WattCalculation $wattModel,
        CollectionFactory $collectionFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->wattModel = $wattModel;
        $this->customerSession = $customerSession;
        $this->_session = $sessionManager;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_collectionFactory = $collectionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = (array)$this->getRequest()->getPost();
        $collection = $this->_collectionFactory->create();
        if($this->customerSession->getCustomer()->getId()){
            $data['customer_id'] = $this->customerSession->getCustomer()->getId();
            $collection->addFieldToFilter('customer_id', $data['customer_id']);
            $collection->addFieldToFilter('category_id', $data['category_id']);
        }else{
            $data['session_id'] = $this->_session->getSessionId();
            $collection->addFieldToFilter('session_id', $data['session_id']);
            $collection->addFieldToFilter('category_id', $data['category_id']);
        }

        $optionSelect = $collection->getFirstItem()->getOptionselect();
        $optionSelectArray = explode('#',$optionSelect);
        //echo '<pre>';print_r($optionSelectArray);
        $result = $this->resultJsonFactory->create();
        return $result->setData(['options' => $optionSelectArray]);
        //return json_encode($optionSelectArray);        
    }
}