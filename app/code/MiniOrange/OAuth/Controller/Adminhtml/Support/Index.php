<?php


namespace MiniOrange\OAuth\Controller\Adminhtml\Support;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\OAuth\SAML2Utilities;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
use Magento\Framework\App\Action\HttpPostActionInterface;
class Index extends BaseAdminAction implements HttpPostActionInterface, HttpGetActionInterface
{
    public function execute()
    {
        try {
            $Ru = $this->getRequest()->getParams();
            if (!$this->isFormOptionBeingSaved($Ru)) {
                goto nh;
            }
            $this->checkIfSupportQueryFieldsEmpty(["\145\x6d\141\151\x6c" => $Ru, "\x71\165\145\x72\171" => $Ru]);
            $Pg = $Ru["\x65\155\141\x69\154"];
            $ZW = $Ru["\160\x68\x6f\156\145"];
            $nS = $Ru["\161\x75\145\x72\171"];
            $FI = $Ru["\x66\151\x72\163\x74\116\x61\155\x65"];
            $KO = $Ru["\x6c\141\163\x74\116\141\x6d\x65"];
            $Ya = $this->oauthUtility->getBaseUrl();
            Curl::submit_contact_us($Pg, $ZW, $nS, $FI, $KO, $Ya);
            $this->messageManager->addSuccessMessage(OAuthMessages::QUERY_SENT);
            nh:
        } catch (\Exception $P0) {
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
        $bC = $this->resultPageFactory->create();
        $bC->setActiveMenu(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_BASE);
        $bC->addBreadcrumb(__("\123\165\160\160\x6f\162\x74"), __("\123\x75\160\x70\157\x72\164"));
        $bC->getConfig()->getTitle()->prepend(__(OAuthConstants::MODULE_TITLE));
        return $bC;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_SUPPORT);
    }
}
