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

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Session\SessionManager $sessionManager,
        WattCalculation $wattModel,
        CollectionFactory $collectionFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->wattModel = $wattModel;
        $this->customerSession = $customerSession;
        $this->_session = $sessionManager;
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
        $entity_id = $collection->getFirstItem()->getId();
        if ($entity_id) {
            $data['entity_id'] = $entity_id;
            //echo '<pre>';print_r($data);die;
            $this->wattModel->load($entity_id)->setData($data)->save();
        }else{
            $this->wattModel->setData($data)->save();
        }
        
    }
}