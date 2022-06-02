<?php


namespace MiniOrange\OAuth\Controller\Adminhtml\Upgrade;

use Magento\Backend\App\Action\Context;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
use Magento\Framework\App\Action\HttpGetActionInterface;
class Index extends BaseAdminAction implements HttpGetActionInterface
{
    public function execute()
    {
        try {
        } catch (\Exception $P0) {
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
        $bC = $this->resultPageFactory->create();
        $bC->setActiveMenu(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_BASE);
        $bC->addBreadcrumb(__("\x55\160\147\162\x61\144\x65\40\120\x6c\x61\156\163"), __("\125\x70\147\x72\141\144\145\x20\120\154\141\156\x73"));
        $bC->getConfig()->getTitle()->prepend(__(OAuthConstants::MODULE_TITLE));
        return $bC;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_UPGRADE);
    }
}
