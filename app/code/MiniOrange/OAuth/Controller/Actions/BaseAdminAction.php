<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\Exception\NotRegisteredException;
use MiniOrange\OAuth\Helper\Exception\RequiredFieldsException;
use MiniOrange\OAuth\Helper\Exception\SupportQueryRequiredFieldsException;
abstract class BaseAdminAction extends \Magento\Backend\App\Action
{
    protected $oauthUtility;
    protected $context;
    protected $resultPageFactory;
    protected $messageManager;
    protected $logger;
    public function __construct(\Magento\Backend\App\Action\Context $Dp, \Magento\Framework\View\Result\PageFactory $nc, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \Magento\Framework\Message\ManagerInterface $mc, \Psr\Log\LoggerInterface $Za)
    {
        $this->oauthUtility = $GQ;
        $this->resultPageFactory = $nc;
        $this->messageManager = $mc;
        $this->logger = $Za;
        parent::__construct($Dp);
    }
    protected function isFormOptionBeingSaved($Ru)
    {
        return array_key_exists("\x6f\160\164\x69\x6f\156", $Ru);
    }
    protected function checkIfRequiredFieldsEmpty($jR)
    {
        foreach ($jR as $mx => $Vw) {
            if (!(is_array($Vw) && (!array_key_exists($mx, $Vw) || $this->oauthUtility->isBlank($Vw[$mx])) || $this->oauthUtility->isBlank($Vw))) {
                goto U1;
            }
            throw new RequiredFieldsException();
            U1:
            rw:
        }
        me:
    }
    public function checkIfSupportQueryFieldsEmpty($jR)
    {
        try {
            $this->checkIfRequiredFieldsEmpty($jR);
        } catch (RequiredFieldsException $P0) {
            throw new SupportQueryRequiredFieldsException();
        }
    }
    public abstract function execute();
    protected function checkIfValidPlugin()
    {
        if (!(!$this->spUtility->micr() || !$this->spUtility->mclv())) {
            goto aU;
        }
        throw new NotRegisteredException();
        aU:
    }
}
