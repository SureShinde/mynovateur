<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Exception\IncorrectUserInfoDataException;
use MiniOrange\OAuth\Helper\Exception\UserEmailNotFoundException;
use MiniOrange\OAuth\Helper\OAuthConstants;
class ProcessResponseAction extends BaseAction
{
    private $userInfoResponse;
    private $relayState;
    private $testAction;
    private $processUserAction;
    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \MiniOrange\OAuth\Controller\Actions\CheckAttributeMappingAction $sT)
    {
        $this->attrMappingAction = $sT;
        parent::__construct($Dp, $GQ);
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\x50\x72\157\x63\x65\x73\163\122\x65\x73\160\x6f\x6e\163\x65\101\x63\x74\151\157\x6e\x3a\40\145\x78\145\x63\165\x74\x65");
        $this->validateUserInfoData();
        $D7 = $this->userInfoResponse;
        $G1 = [];
        $G1 = $this->getflattenedArray('', $D7, $G1);
        $p6 = $this->findUserEmail($D7);
        $this->oauthUtility->log_debug("\120\162\x6f\143\x65\163\163\122\145\163\x70\157\156\163\x65\x41\x63\164\151\x6f\x6e\x3a\x20\x75\x73\145\162\x45\155\141\151\x6c", $p6);
        if (!empty($p6)) {
            goto eD;
        }
        return $this->getResponse()->setBody("\105\x6d\141\x69\154\x20\141\x64\x64\162\x65\163\163\x20\x6e\x6f\x74\40\x72\x65\143\x65\x69\x76\145\x64\x2e\40\x50\154\145\141\x73\145\40\x63\x68\x65\143\153\x20\x61\x74\x74\162\x69\x62\x75\164\x65\x20\x6d\141\x70\x70\151\156\x67\56");
        eD:
        $this->attrMappingAction->setUserInfoResponse($D7)->setFlattenedUserInfoResponse($G1)->setUserEmail($p6)->execute();
    }
    private function findUserEmail($ix)
    {
        $this->oauthUtility->log_debug("\120\162\x6f\x63\145\163\x73\x52\x65\x73\160\x6f\156\x73\145\101\x63\x74\151\157\x6e\x3a\x20\146\151\x6e\144\125\x73\x65\x72\x45\155\141\x69\154");
        if (!$ix) {
            goto iw;
        }
        foreach ($ix as $Vw) {
            if (is_array($Vw)) {
                goto rO;
            }
            if (!filter_var($Vw, FILTER_VALIDATE_EMAIL)) {
                goto U2;
            }
            return $Vw;
            U2:
            goto eo;
            rO:
            return $this->findUserEmail($Vw);
            eo:
            hd:
        }
        ci:
        iw:
    }
    private function getflattenedArray($Uu, $ix, &$Iz)
    {
        foreach ($ix as $mx => $D8) {
            if (is_array($D8) || is_object($D8)) {
                goto fL;
            }
            if (empty($Uu)) {
                goto FZ;
            }
            $mx = $Uu . "\56" . $mx;
            FZ:
            $Iz[$mx] = $D8;
            goto yC;
            fL:
            if (empty($Uu)) {
                goto WF;
            }
            $Uu .= "\x2e";
            WF:
            $this->getflattenedArray($Uu . $mx, $D8, $Iz);
            yC:
            lX:
        }
        xZ:
        return $Iz;
    }
    private function validateUserInfoData()
    {
        $this->oauthUtility->log_debug("\120\x72\x6f\143\145\x73\x73\122\145\163\160\157\156\x73\x65\101\143\164\151\157\x6e\72\x20\166\x61\x6c\x69\x64\x61\x74\145\x55\163\145\162\x49\156\x66\x6f\x44\x61\164\x61");
        $x8 = $this->userInfoResponse;
        if (!array_key_exists("\145\x72\162\157\162", $x8)) {
            goto ZJ;
        }
        throw new IncorrectUserInfoDataException();
        ZJ:
    }
    public function setUserInfoResponse($D7)
    {
        $this->oauthUtility->log_debug("\x50\162\x6f\143\x65\163\163\122\x65\x73\x70\157\x6e\163\145\x41\143\164\151\157\156\x3a\40\163\145\x74\x55\x73\145\162\x49\x6e\146\x6f\122\145\163\160\157\x6e\x73\145");
        $this->userInfoResponse = $D7;
        return $this;
    }
}
