<?php


namespace MiniOrange\OAuth\Controller\Account;

use Magento\Framework\Controller\Result\Redirect;
class Logout extends \Magento\Customer\Controller\Account\Logout
{
    public function execute()
    {
        parent::execute();
        $B7 = $this->resultRedirectFactory->create();
        $B7->setPath('');
        return $B7;
    }
}
