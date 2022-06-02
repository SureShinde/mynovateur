<?php


namespace MiniOrange\OAuth\Controller\Actions;

use MiniOrange\OAuth\Helper\Exception\MissingAttributesException;
use MiniOrange\OAuth\Helper\OAuthConstants;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Store\Model\StoreManagerInterface;
class CheckAttributeMappingAction extends BaseAction implements HttpPostActionInterface
{
    const TEST_VALIDATE_RELAYSTATE = OAuthConstants::TEST_RELAYSTATE;
    private $userInfoResponse;
    private $flattenedUserInfoResponse;
    private $relayState;
    private $userEmail;
    protected $storeManager;
    private $emailAttribute;
    private $usernameAttribute;
    private $firstName;
    private $lastName;
    private $checkIfMatchBy;
    private $groupName;
    private $testAction;
    private $processUserAction;
    public function __construct(\Magento\Framework\App\Action\Context $Dp, \MiniOrange\OAuth\Helper\OAuthUtility $GQ, \MiniOrange\OAuth\Controller\Actions\ShowTestResultsAction $jF, \MiniOrange\OAuth\Controller\Actions\ProcessUserAction $B0, StoreManagerInterface $W6)
    {
        $this->emailAttribute = $GQ->getStoreConfig(OAuthConstants::MAP_EMAIL);
        $this->emailAttribute = $GQ->isBlank($this->emailAttribute) ? OAuthConstants::DEFAULT_MAP_EMAIL : $this->emailAttribute;
        $this->usernameAttribute = $GQ->getStoreConfig(OAuthConstants::MAP_USERNAME);
        $this->usernameAttribute = $GQ->isBlank($this->usernameAttribute) ? OAuthConstants::DEFAULT_MAP_USERN : $this->usernameAttribute;
        $this->firstName = $GQ->getStoreConfig(OAuthConstants::MAP_FIRSTNAME);
        $this->firstName = $GQ->isBlank($this->firstName) ? OAuthConstants::DEFAULT_MAP_FN : $this->firstName;
        $this->lastName = $GQ->getStoreConfig(OAuthConstants::MAP_LASTNAME);
        $this->checkIfMatchBy = $GQ->getStoreConfig(OAuthConstants::MAP_MAP_BY);
        $this->testAction = $jF;
        $this->storeManager = $W6;
        $this->processUserAction = $B0;
        parent::__construct($Dp, $GQ);
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\103\150\145\x63\153\101\164\164\162\151\x62\165\164\x65\x4d\141\x70\x70\151\x6e\x67\x41\x63\164\151\157\x6e\x3a\x20\x65\x78\x65\143\x75\164\145");
        $HX = $this->userInfoResponse;
        $Jw = $this->flattenedUserInfoResponse;
        $p6 = $this->userEmail;
        $this->oauthUtility->log_debug("\x43\x68\145\x63\153\101\164\164\162\x69\142\165\164\145\x4d\141\x70\160\x69\x6e\x67\101\143\164\151\x6f\x6e\x3a\40\x75\163\x65\162\105\x6d\141\151\x6c", $p6);
        $this->moOAuthCheckMapping($HX, $Jw, $p6);
    }
    private function moOAuthCheckMapping($HX, $Jw, $p6)
    {
        $this->oauthUtility->log_debug("\103\x68\145\143\x6b\x41\164\164\162\x69\142\x75\x74\145\115\141\x70\x70\151\156\147\101\x63\164\x69\x6f\x6e\72\40\155\157\117\x41\165\x74\x68\x43\150\x65\x63\x6b\x4d\x61\160\x70\x69\156\x67");
        if (!empty($HX)) {
            goto FU;
        }
        throw new MissingAttributesException();
        FU:
        $this->checkIfMatchBy = OAuthConstants::DEFAULT_MAP_BY;
        $this->processFirstName($Jw);
        $this->processLastName($Jw);
        $this->processUserName($Jw);
        $this->processEmail($Jw);
        $this->processGroupName($Jw);
        $this->processResult($HX, $Jw, $p6);
    }
    private function processResult($HX, $ct, $Pg)
    {
        $this->oauthUtility->log_debug("\x43\x68\145\143\153\x41\164\164\162\151\x62\x75\164\145\115\x61\160\160\151\156\x67\101\x63\x74\x69\157\x6e\x3a\x20\160\x72\157\x63\145\x73\x73\x52\x65\163\x75\154\x74");
        $jE = $this->oauthUtility->getStoreConfig(OAuthConstants::IS_TEST);
        if ($jE == true) {
            goto Yq;
        }
        $this->processUserAction->setFlattenedAttrs($ct)->setAttrs($HX)->setUserEmail($Pg)->execute();
        goto uX;
        Yq:
        $this->oauthUtility->setStoreConfig(OAuthConstants::IS_TEST, false);
        $this->oauthUtility->flushCache();
        $this->testAction->setAttrs($ct)->setUserEmail($Pg)->execute();
        uX:
    }
    private function processFirstName(&$HX)
    {
        if (array_key_exists($this->firstName, $HX)) {
            goto h2;
        }
        $EM = explode("\x40", $this->userEmail);
        $nX = $EM[0];
        $HX[$this->firstName] = $nX;
        $this->oauthUtility->log_debug("\x43\x68\x65\x63\x6b\x41\x74\x74\162\151\142\x75\x74\145\x4d\x61\x70\160\151\156\147\101\x63\164\x69\x6f\x6e\x3a\40\160\162\157\143\x65\x73\x73\x46\151\162\163\x74\116\141\155\x65", $HX[$this->firstName]);
        h2:
    }
    private function processLastName(&$HX)
    {
        if (array_key_exists($this->lastName, $HX)) {
            goto gG;
        }
        $EM = explode("\x40", $this->userEmail);
        $nX = $EM[1];
        $HX[$this->lastName] = $nX;
        $this->oauthUtility->log_debug("\x43\150\x65\x63\153\101\164\164\x72\x69\x62\x75\x74\x65\x4d\141\x70\x70\151\156\x67\x41\143\164\x69\157\x6e\x3a\x20\x70\162\157\x63\x65\x73\x73\114\141\x73\164\x4e\141\155\145", $HX[$this->lastName]);
        gG:
    }
    private function processUserName(&$HX)
    {
        if (array_key_exists($this->usernameAttribute, $HX)) {
            goto Q8;
        }
        $HX[$this->usernameAttribute] = $this->userEmail;
        $this->oauthUtility->log_debug("\103\x68\x65\143\153\x41\x74\x74\162\x69\x62\x75\x74\x65\x4d\141\160\x70\151\x6e\x67\101\143\x74\x69\157\156\72\x20\160\x72\x6f\x63\145\163\163\125\163\145\162\x4e\x61\x6d\145", $HX[$this->usernameAttribute]);
        Q8:
    }
    private function processEmail(&$HX)
    {
        if (array_key_exists($this->emailAttribute, $HX)) {
            goto D1;
        }
        $HX[$this->emailAttribute] = $this->userEmail;
        $this->oauthUtility->log_debug("\103\x68\145\143\153\101\164\164\162\x69\142\165\164\145\x4d\x61\160\160\151\156\147\x41\x63\x74\x69\157\x6e\x3a\40\x70\162\157\143\145\x73\x73\x45\155\x61\x69\154", $HX[$this->emailAttribute]);
        D1:
    }
    private function processGroupName(&$HX)
    {
        if (array_key_exists($this->groupName, $HX)) {
            goto xe;
        }
        $this->groupName = [];
        xe:
    }
    public function setUserInfoResponse($D7)
    {
        $this->userInfoResponse = $D7;
        return $this;
    }
    public function setFlattenedUserInfoResponse($G1)
    {
        $this->flattenedUserInfoResponse = $G1;
        return $this;
    }
    public function setUserEmail($p6)
    {
        $this->userEmail = $p6;
        return $this;
    }
    public function setRelayState($pQ)
    {
        $this->relayState = $pQ;
        return $this;
    }
}
