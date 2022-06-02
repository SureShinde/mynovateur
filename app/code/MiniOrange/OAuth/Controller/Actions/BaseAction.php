<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\Exception\NotRegisteredException;
use MiniOrange\OAuth\Helper\Exception\RequiredFieldsException;
use MiniOrange\OAuth\Helper\Data;
abstract class BaseAction extends \Magento\Framework\App\Action\Action
{
    protected $oauthUtility;
    protected $context;
    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ)
    {
        $this->oauthUtility = $GQ;
        parent::__construct($Dp);
    }
    protected function checkIfRequiredFieldsEmpty($jR)
    {
        foreach ($jR as $mx => $Vw) {
            if (!(is_array($Vw) && (!array_key_exists($mx, $Vw) || $this->oauthUtility->isBlank($Vw[$mx])) || $this->oauthUtility->isBlank($Vw))) {
                goto Nn;
            }
            throw new RequiredFieldsException();
            Nn:
            Mc:
        }
        A6:
    }
    protected function sendHTTPRedirectRequest($h7, $JZ)
    {
        $h7 = $JZ . $h7;
        return $this->resultRedirectFactory->create()->setUrl($h7);
    }
    public abstract function execute();
    protected function checkIfValidPlugin()
    {
        if (!(!$this->oauthUtility->micr() || !$this->oauthUtility->mclv())) {
            goto Gt;
        }
        throw new NotRegisteredException();
        Gt:
    }
}
