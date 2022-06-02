<?php


namespace MiniOrange\OAuth\Controller\Adminhtml\Account;

use Magento\Backend\App\Action\Context;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthMessages;
use MiniOrange\OAuth\Controller\Actions\BaseAdminAction;
class Index extends BaseAdminAction
{
    private $options = array("\x72\145\147\x69\163\164\145\162\116\x65\167\x55\163\145\x72", "\166\141\154\x69\144\141\x74\145\x4e\145\x77\125\x73\x65\162", "\x72\145\163\145\156\x64\x4f\x54\120", "\163\x65\156\144\x4f\124\120\x50\x68\157\x6e\x65", "\154\x6f\x67\x69\156\x45\170\x69\x73\x74\x69\156\x67\125\x73\145\162", "\162\x65\x73\145\x74\120\x61\x73\x73\x77\157\162\144", "\x72\x65\x6d\157\166\145\x41\x63\x63\x6f\x75\x6e\x74", "\x76\145\162\x69\x66\171\x4c\x69\143\145\156\163\x65\113\145\x79");
    private $registerNewUserAction;
    private $validateOTPAction;
    private $resendOTPAction;
    private $sendOTPToPhone;
    private $loginExistingUserAction;
    private $forgotPasswordAction;
    private $lkAction;
    public function __construct(\Magento\Backend\App\Action\Context $Dp, \Magento\Framework\View\Result\PageFactory $nc, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Framework\Message\ManagerInterface $mc, \Psr\Log\LoggerInterface $Za, \MiniOrange\OAuth\Controller\Actions\RegisterNewUserAction $Ii, \MiniOrange\OAuth\Controller\Actions\ValidateOTPAction $fk, \MiniOrange\OAuth\Controller\Actions\ResendOTPAction $J4, \MiniOrange\OAuth\Controller\Actions\SendOTPToPhone $zi, \MiniOrange\OAuth\Controller\Actions\LoginExistingUserAction $Ny, \MiniOrange\OAuth\Controller\Actions\LKAction $ij, \MiniOrange\OAuth\Controller\Actions\ForgotPasswordAction $QS)
    {
        parent::__construct($Dp, $nc, $GQ, $mc, $Za);
        $this->registerNewUserAction = $Ii;
        $this->validateOTPAction = $fk;
        $this->resendOTPAction = $J4;
        $this->sendOTPToPhone = $zi;
        $this->loginExistingUserAction = $Ny;
        $this->forgotPasswordAction = $QS;
        $this->lkAction = $ij;
    }
    public function execute()
    {
        try {
            $Ru = $this->getRequest()->getParams();
            if (!$this->isFormOptionBeingSaved($Ru)) {
                goto yp;
            }
            $a1 = array_values($Ru);
            $lR = array_intersect($a1, $this->options);
            if (!(count($lR) > 0)) {
                goto c1;
            }
            $this->_route_data(array_values($lR)[0], $Ru);
            $this->oauthUtility->flushCache();
            c1:
            yp:
        } catch (\Exception $P0) {
            $this->messageManager->addErrorMessage($P0->getMessage());
            $this->logger->debug($P0->getMessage());
        }
        $bC = $this->resultPageFactory->create();
        $bC->setActiveMenu(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_BASE);
        $bC->addBreadcrumb(__("\x41\x63\143\x6f\165\x6e\164\40\123\x65\x74\x74\x69\x6e\147\163"), __("\101\x63\143\x6f\x75\156\164\x20\123\145\164\164\151\x6e\147\x73"));
        $bC->getConfig()->getTitle()->prepend(__(OAuthConstants::MODULE_TITLE));
        return $bC;
    }
    private function _route_data($ZL, $Ru)
    {
        switch ($ZL) {
            case $this->options[0]:
                $this->registerNewUserAction->setRequestParam($Ru)->execute();
                goto fl;
            case $this->options[1]:
                $this->validateOTPAction->setRequestParam($Ru)->execute();
                goto fl;
            case $this->options[2]:
                $this->resendOTPAction->setRequestParam($Ru)->execute();
                goto fl;
            case $this->options[3]:
                $this->sendOTPToPhone->setRequestParam($Ru)->execute();
                goto fl;
            case $this->options[4]:
                $this->loginExistingUserAction->setRequestParam($Ru)->execute();
                goto fl;
            case $this->options[5]:
                $this->forgotPasswordAction->setRequestParam($Ru)->execute();
                goto fl;
            case $this->options[6]:
                $this->lkAction->setRequestParam($Ru)->removeAccount();
                goto fl;
            case $this->options[7]:
                $this->lkAction->setRequestParam($Ru)->execute();
                goto fl;
        }
        zv:
        fl:
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(OAuthConstants::MODULE_DIR . OAuthConstants::MODULE_ACCOUNT);
    }
}
