<?php

namespace MiniOrange\SP\Controller\Actions;

use Magento\Framework\UrlInterface;
use Magento\Framework\DataObject;


/**
 * This class is called to log the customer user in. RelayState and
 * user are set separately. This is a simple class.
 */
class CustomerLoginAction extends BaseAction
{
    private $relayState;
	private $user;
	private $customerSession;
	private $responseFactory;
	private $customerId;
	private $accountId;

    public function __construct(\Magento\Backend\App\Action\Context $context,
                                \MiniOrange\SP\Helper\SPUtility $spUtility,
								\Magento\Customer\Model\Session $customerSession,
								\Magento\Framework\App\ResponseFactory $responseFactory)
	{
        //You can use dependency injection to get any class this observer may need.
		$this->customerSession = $customerSession;
		$this->responseFactory = $responseFactory;
		parent::__construct($context,$spUtility);
	}

	/**
	 * Execute function to execute the classes function.
	 */
	public function execute()
	{
        $this->spUtility->log_debug("CustomerLoginAction : execute: relaystate: ".$this->relayState);
        $this->customerSession->setCustomerAsLoggedIn($this->user);
        $customer = $this->spUtility->getCustomer($this->customerId);

        //$store = $this->spUtility->getStoreById($customer->getStoreId());

        // $customerData = new DataObject(['ax_company_id' => $this->accountId, 'customer_id' => $this->customerId]);
        // $this->_eventManager->dispatch('sp_customer_login', ['customer_data' =>$customerData]);
        // $this->spUtility->log_debug("CustomerLoginAction : execute():  Event Dispatched");

        $redirectUrl = $this->spUtility->isBlank($this->relayState) ? '': $this->relayState;

       if($this->spUtility->isBlank($this->relayState)){
            $this->relayState = 'customer/account';
            $this->spUtility->log_debug("CustomerLoginAction : execute(): RelayState changed to: ".$this->relayState);
       }

        $this->spUtility->messageManager->addSuccess('You are logged in Successfully.');
        $this->responseFactory->create()
			->setRedirect($this->spUtility->getUrl($this->relayState))
			->sendResponse();
        exit;


	}

	/** Setter for the user Parameter */
    public function setUser($user)
    {
        $this->user = $user;
        $this->spUtility->log_debug("setting User: ");
        return $this;
    }

    /** Setter for the customerId Parameter */
    public function setCustomerId($id)
    {
        $this->customerId = $id;
        $this->spUtility->log_debug("setting customerId: ".$id);
        return $this;
    }

    /** Setter for the RelayState Parameter */
    public function setRelayState($relayState)
    {
        $this->relayState = $relayState;
        return $this;
    }

    public function setAxCompanyId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

}
