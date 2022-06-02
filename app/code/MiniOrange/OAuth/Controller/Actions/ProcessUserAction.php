<?php


namespace MiniOrange\OAuth\Controller\Actions;

use Magento\Authorization\Model\ResourceModel\Role\Collection;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\Math\Random;
use Magento\Store\Model\StoreManagerInterface;
use Magento\User\Model\User;
use Magento\User\Model\UserFactory;
use MiniOrange\OAuth\Helper\Exception\MissingAttributesException;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuthUtility;
use Magento\Customer\Model\AddressFactory;
class ProcessUserAction extends BaseAction
{
    private $attrs;
    private $flattenedattrs;
    private $userEmail;
    private $checkIfMatchBy;
    private $defaultRole;
    private $emailAttribute;
    private $usernameAttribute;
    private $firstNameKey;
    private $lastNameKey;
    private $groupNameKey;
    private $doNotAutoCreateUsers;
    private $userGroupModel;
    private $adminRoleModel;
    private $adminUserModel;
    private $customerModel;
    private $customerLoginAction;
    private $responseFactory;
    private $customerFactory;
    private $userFactory;
    private $randomUtility;
    private $dontAllowUnlistedUserRole;
    private $dontCreateUserIfRoleNotMapped;
    public function __construct(Context $Dp, OAuthUtility $GQ, \Magento\Customer\Model\ResourceModel\Group\Collection $HQ, Collection $LR, User $P4, Customer $kD, StoreManagerInterface $W6, ResponseFactory $Ub, CustomerLoginAction $yZ, CustomerFactory $fi, UserFactory $pm, Random $R2, AddressFactory $f6)
    {
        $this->emailAttribute = $GQ->getStoreConfig(OAuthConstants::MAP_EMAIL);
        $this->doNotAutoCreateUsers = $GQ->getStoreConfig(OAuthConstants::DO_NOT_AUTO_CREATE_USERS);
        $this->emailAttribute = $GQ->isBlank($this->emailAttribute) ? OAuthConstants::DEFAULT_MAP_EMAIL : $this->emailAttribute;
        $this->usernameAttribute = $GQ->getStoreConfig(OAuthConstants::MAP_USERNAME);
        $this->usernameAttribute = $GQ->isBlank($this->usernameAttribute) ? OAuthConstants::DEFAULT_MAP_USERN : $this->usernameAttribute;
        $this->firstNameKey = $GQ->getStoreConfig(OAuthConstants::MAP_FIRSTNAME);
        $this->firstNameKey = $GQ->isBlank($this->firstNameKey) ? OAuthConstants::DEFAULT_MAP_FN : $this->firstNameKey;
        $this->lastNameKey = $GQ->getStoreConfig(OAuthConstants::MAP_LASTNAME);
        $this->defaultRole = $GQ->getStoreConfig(OAuthConstants::MAP_DEFAULT_ROLE);
        $this->checkIfMatchBy = $GQ->getStoreConfig(OAuthConstants::MAP_MAP_BY);
        $this->groupNameKey = $GQ->getStoreConfig(OAuthConstants::MAP_GROUP);
        $this->userGroupModel = $HQ;
        $this->adminRoleModel = $LR;
        $this->adminUserModel = $P4;
        $this->customerModel = $kD;
        $this->storeManager = $W6;
        $this->checkIfMatchBy = $GQ->getStoreConfig(OAuthConstants::MAP_MAP_BY);
        $this->responseFactory = $Ub;
        $this->customerLoginAction = $yZ;
        $this->customerFactory = $fi;
        $this->userFactory = $pm;
        $this->randomUtility = $R2;
        $this->dataAddressFactory = $f6;
        $this->dontAllowUnlistedUserRole = $GQ->getStoreConfig(OAuthConstants::UNLISTED_ROLE);
        $this->dontCreateUserIfRoleNotMapped = $GQ->getStoreConfig(OAuthConstants::CREATEIFNOTMAP);
        parent::__construct($Dp, $GQ);
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\x50\x72\157\143\x65\x73\163\125\x73\145\162\101\143\x74\151\157\x6e\x3a\40\145\x78\x65\143\x75\164\x65");
        if (!empty($this->attrs)) {
            goto LI;
        }
        $this->oauthUtility->log_debug("\116\157\x20\101\164\x74\x72\151\x62\x75\x74\x65\x73\x20\x52\x65\x63\145\151\x76\x65\144\40\x3a\x20");
        throw new MissingAttributesException();
        LI:
        $FI = array_key_exists($this->firstNameKey, $this->flattenedattrs) ? $this->flattenedattrs[$this->firstNameKey] : null;
        $KO = array_key_exists($this->lastNameKey, $this->flattenedattrs) ? $this->flattenedattrs[$this->lastNameKey] : null;
        $C1 = array_key_exists($this->usernameAttribute, $this->flattenedattrs) ? $this->flattenedattrs[$this->usernameAttribute] : null;
        $this->userEmail = array_key_exists($this->emailAttribute, $this->flattenedattrs) ? $this->flattenedattrs[$this->emailAttribute] : $this->userEmail;
        $Aw = array_key_exists($this->groupNameKey, $this->attrs) ? $this->attrs[$this->groupNameKey] : null;
        $Pk = $this->oauthUtility->isBlank(json_decode($Aw)) ? $Aw : json_decode($Aw)[0];
        if (!$this->oauthUtility->isBlank($this->defaultRole)) {
            goto Qo;
        }
        $this->defaultRole = OAuthConstants::DEFAULT_ROLE;
        Qo:
        if (!$this->oauthUtility->isBlank($this->checkIfMatchBy)) {
            goto MK;
        }
        $this->checkIfMatchBy = OAuthConstants::DEFAULT_MAP_BY;
        MK:
        $this->processUserAction($this->userEmail, $FI, $KO, $C1, $this->defaultRole, $Pk, $this->checkIfMatchBy);
    }
    private function processUserAction($Jt, $FI, $KO, $C1, $uK, $Pk, $BD)
    {
        $this->oauthUtility->log_debug("\x50\162\157\143\x65\x73\x73\125\163\145\162\101\x63\164\151\157\156\x3a\x20\160\162\157\143\145\163\x73\125\145\162\101\143\164\151\157\156");
        $rn = false;
        $user = $this->getAdminUserFromAttributes($Jt);
        $rn = is_a($user, "\134\115\x61\x67\145\x6e\164\157\x5c\125\163\145\162\134\x4d\157\x64\145\x6c\x5c\x55\x73\x65\x72") ? true : false;
        if ($user) {
            goto hy;
        }
        $this->oauthUtility->log_debug("\x75\163\x65\162\40\x6e\x6f\x74\x20\146\157\165\x6e\x64\40\141\163\x20\141\144\155\x69\x6e\56\x2e\40\x73\145\x61\x72\x63\x68\151\156\147\40\x69\x6e\40\x63\165\163\164\157\155\x65\162\163");
        $user = $this->getCustomerFromAttributes($Jt);
        hy:
        if ($user) {
            goto fM;
        }
        $this->oauthUtility->log_debug("\165\x73\x65\162\x20\x64\x6f\145\x73\x20\x6e\157\164\x20\x65\170\151\163\164");
        if ($this->doNotAutoCreateUsers) {
            goto kH;
        }
        $this->oauthUtility->log_debug("\x63\x72\x65\141\164\x69\156\x67\x20\x6e\145\x77\40\x75\x73\145\x72");
        $user = $this->createNewUser($Jt, $FI, $KO, $C1, $user, $rn, $uK, $Pk);
        goto mM;
        kH:
        $tI = "\x59\157\165\x20\x61\x72\145\x20\x6e\157\x74\x20\141\x6c\154\x6f\x77\x65\144\40\164\157\x20\154\157\147\151\156\56\x20\x50\154\x65\x61\163\x65\40\x63\157\x6e\164\x61\x63\x74\x20\171\157\x75\162\x20\x61\144\155\x69\156\151\x73\164\162\x61\x74\157\x72\56";
        $this->oauthUtility->log_debug($C1 . "\40\x2d\x20\125\x73\x65\x72\40\x41\165\x74\x6f\x20\103\162\x65\141\164\x69\157\156\40\151\x73\x20\144\x69\163\x61\x62\154\x65\144\40\x66\157\162\40\156\x65\x77\x20\x75\163\145\x72\x2e\x20\122\145\x64\151\x72\145\143\164\151\x6e\147\x20\x74\157\40\114\157\x67\151\x6e\x20\x50\x61\147\x65");
        return $this->getResponse()->setBody($tI);
        mM:
        fM:
        if (!($user && !$rn)) {
            goto m8;
        }
        $this->updateUserAttributes($FI, $KO, $uK, $C1, $user, $rn, $Pk);
        m8:
        if ($rn) {
            goto BT;
        }
        $this->customerLoginAction->setUser($user)->setRelayState($this->attrs["\162\x65\x6c\141\x79\123\164\141\x74\x65"])->execute();
        goto vJ;
        BT:
        $this->redirectToBackendAndLogin($user->getId());
        vJ:
    }
    private function redirectToBackendAndLogin($ms)
    {
        $this->oauthUtility->log_debug("\x50\162\157\x63\x65\x73\x73\125\163\145\162\101\x63\x74\151\x6f\x6e\x3a\40\162\145\144\151\x72\145\143\x74\124\157\102\x61\x63\x6b\x65\x6e\x41\156\x64\x4c\157\147\x69\156");
        $F1 = ["\157\x70\x74\x69\157\x6e" => OAuthConstants::LOGIN_ADMIN_OPT, "\165\163\x65\162\x69\x64" => $ms];
        $kg = $this->oauthUtility->getAdminUrl("\x61\144\155\151\156\x68\x74\x6d\x6c", $F1);
        return $this->getResponse()->setRedirect($kg)->sendResponse();
    }
    private function generateEmail($C1)
    {
        $this->oauthUtility->log_debug("\120\162\157\x63\145\x73\163\x55\163\145\x72\101\143\164\151\157\x6e\x3a\40\x67\145\156\x65\x72\x61\164\x65\105\x6d\x61\151\154");
        $lI = $this->oauthUtility->getBaseUrl();
        $lI = substr($lI, strpos($lI, "\x2f\57"), strlen($lI) - 1);
        return $C1 . "\x40" . $lI;
    }
    private function createNewUser($Jt, $FI, $KO, $C1, $user, &$rn, $uK, $Pk)
    {
        $this->oauthUtility->log_debug("\x50\162\x6f\143\x65\x73\x73\x55\x73\145\162\x41\x63\164\151\157\156\72\x20\143\x72\145\141\164\145\x4e\145\x77\x55\x73\145\162");
        $Me = $this->randomUtility->getRandomString(8);
        $C1 = !$this->oauthUtility->isBlank($C1) ? $C1 : $Jt;
        $FI = !$this->oauthUtility->isBlank($FI) ? $FI : $C1;
        $KO = !$this->oauthUtility->isBlank($KO) ? $KO : $C1;
        $BT = $this->oauthUtility->getStoreConfig(OAuthConstants::ROLES_MAPPED);
        $Mb = $this->oauthUtility->getStoreConfig(OAuthConstants::GROUPS_MAPPED);
        $VY = is_array($BT) && $rn ? $BT : array();
        $VY = is_array($Mb) && !$rn ? array_merge($VY, $Mb) : $VY;
        if (!(strcasecmp($this->dontCreateUserIfRoleNotMapped, "\x63\x68\145\x63\x6b\x65\144") === 0)) {
            goto MR;
        }
        if ($this->isRoleMappingConfiguredForUser($VY, $Pk)) {
            goto Kc;
        }
        return NULL;
        Kc:
        MR:
        $Fv = $this->processRoles($uK, $rn, $VY, $Pk);
        if ($rn) {
            goto yI;
        }
        $user = $this->createCustomer($C1, $Jt, $FI, $KO, $Me, $uK);
        goto DM;
        yI:
        $user = $this->createAdminUser($C1, $Jt, $FI, $KO, $Me, $uK);
        DM:
        return $user;
    }
    private function isRoleMappingConfiguredForUser($VY, $Pk)
    {
        if (!(empty($Pk) || empty($VY))) {
            goto Rw;
        }
        return FALSE;
        Rw:
        foreach ($VY as $va => $UN) {
            $sL = explode("\73", $UN);
            foreach ($sL as $n7) {
                if (!in_array($n7, $Pk)) {
                    goto Gm;
                }
                return TRUE;
                Gm:
                C6:
            }
            KC:
            BA:
        }
        M2:
    }
    private function updateUserAttributes($FI, $KO, $uK, $C1, $user, &$rn, $Pk)
    {
        $this->oauthUtility->log_debug("\120\x72\157\x63\x65\163\x73\125\163\145\162\101\143\x74\151\x6f\156\x3a\40\x75\x70\x64\141\x74\145\x55\x73\145\x72\x41\x74\x74\162\x69\142\165\164\145\x73");
        $ms = $user->getId();
        if ($this->oauthUtility->isBlank($FI)) {
            goto Tg;
        }
        $this->oauthUtility->saveConfig(OAuthConstants::DB_FIRSTNAME, $FI, $ms, $rn);
        Tg:
        if ($this->oauthUtility->isBlank($KO)) {
            goto vl;
        }
        $this->oauthUtility->saveConfig(OAuthConstants::DB_LASTNAME, $KO, $ms, $rn);
        vl:
        if ($this->oauthUtility->isBlank($C1)) {
            goto oD;
        }
        $this->oauthUtility->saveConfig(OAuthConstants::USER_NAME, $C1, $ms, $rn);
        oD:
        $BT = unserialize($this->oauthUtility->getStoreConfig(OAuthConstants::ROLES_MAPPED));
        $Mb = unserialize($this->oauthUtility->getStoreConfig(OAuthConstants::GROUPS_MAPPED));
        $VY = is_array($BT) && $rn ? $BT : array();
        $VY = is_array($Mb) && !$rn ? array_replace($VY, $Mb) : $VY;
        $Fv = $this->processRoles($uK, $rn, $VY, $Pk);
        if (!(!empty($Fv) && !empty($this->dontAllowUnlistedUserRole) && $this->dontAllowUnlistedUserRole == "\143\x68\145\143\x6b\145\x64")) {
            goto zy;
        }
        return;
        zy:
        if ($rn) {
            goto I_;
        }
        $user->setData("\x67\162\157\165\160\137\151\x64", $Fv);
        $user->save();
        $this->updateCustomAttributes($user);
        I_:
    }
    private function createCustomer($C1, $Pg, $FI, $KO, $Me, $AH)
    {
        $this->oauthUtility->log_debug("\120\162\x6f\x63\x65\x73\x73\x55\x73\x65\162\x41\143\164\x69\157\x6e\x3a\x20\x63\x72\x65\x61\x74\x65\x43\x75\163\x74\157\155\145\x72");
        $rF = $this->storeManager->getWebsite()->getWebsiteId();
        $dM = $this->storeManager->getStore();
        $h_ = $dM->getStoreId();
        $i3 = $this->customerFactory->create()->setWebsiteId($rF)->setEmail($Pg)->setFirstname($FI)->setLastname($KO)->setPassword($Me)->setGroupId($AH)->save();
        $this->oauthUtility->log_debug("\141\x73\x73\151\x67\x6e\x69\156\147\40\147\x72\157\x75\x70\40\164\x6f\40\x6e\x65\x77\40\165\163\x65\162\72\40" . $AH);
        $this->updateCustomAttributes($i3);
        return $i3;
    }
    private function updateCustomAttributes(&$i3)
    {
        $am = ["\101\x66\147\150\141\x6e\x69\163\164\x61\x6e" => "\x41\x46", "\303\x85\154\x61\156\x64\40\111\163\154\141\x6e\144\x73" => "\x41\x58", "\x41\154\142\x61\x6e\x69\141" => "\x41\114", "\x41\x6c\147\145\162\151\x61" => "\x44\x5a", "\101\x6d\145\162\151\143\141\x6e\40\123\x61\x6d\x6f\141" => "\x41\x53", "\x41\156\144\x6f\x72\x72\x61" => "\x41\104", "\101\156\x67\157\x6c\141" => "\x41\117", "\101\x6e\147\x75\151\154\x6c\141" => "\x41\111", "\101\156\164\x61\x72\143\164\151\x63\x61" => "\101\121", "\x41\156\x74\x69\147\165\141\x20\141\156\144\40\102\x61\162\142\x75\x64\x61" => "\101\x47", "\x41\x72\147\145\x6e\164\151\x6e\141" => "\101\122", "\x41\x72\x6d\x65\156\x69\x61" => "\x41\x4d", "\x41\162\x75\x62\141" => "\x41\127", "\101\165\x73\x74\162\141\x6c\151\141" => "\x41\125", "\101\x75\163\x74\x72\x69\141" => "\101\124", "\101\172\x65\162\x62\141\x69\x6a\141\156" => "\x41\x5a", "\102\141\150\x61\155\x61\163" => "\x42\123", "\x42\x61\150\162\x61\x69\x6e" => "\102\110", "\102\x61\156\147\x6c\x61\144\145\163\150" => "\x42\x44", "\x42\x61\x72\142\141\144\x6f\163" => "\x42\102", "\x42\145\154\141\162\165\163" => "\102\x59", "\x42\x65\154\147\151\x75\x6d" => "\102\x45", "\x42\145\154\x69\172\x65" => "\102\x5a", "\102\145\x6e\151\156" => "\102\x4a", "\102\x65\x72\155\165\144\141" => "\x42\115", "\102\150\x75\164\141\x6e" => "\102\x54", "\x42\157\x6c\151\166\151\x61" => "\102\x4f", "\x42\x6f\x73\x6e\151\x61\x20\x61\x6e\144\x20\x48\x65\162\x7a\x65\x67\x6f\x76\151\156\x61" => "\102\101", "\102\157\164\x73\x77\x61\156\141" => "\102\x57", "\x42\x6f\x75\166\x65\x74\40\x49\x73\x6c\141\x6e\144" => "\102\126", "\102\162\x61\172\151\x6c" => "\102\122", "\x42\x72\x69\164\x69\163\150\x20\111\156\144\x69\x61\156\40\x4f\x63\x65\141\x6e\40\x54\x65\162\x72\151\164\x6f\162\171" => "\111\x4f", "\x42\x72\x69\164\151\163\150\x20\x56\x69\162\x67\x69\156\40\x49\x73\154\x61\156\144\163" => "\126\x47", "\x42\162\165\156\x65\151" => "\x42\116", "\x42\165\154\147\141\x72\151\141" => "\x42\107", "\102\165\x72\153\x69\156\141\x20\x46\141\x73\x6f" => "\x42\x46", "\x42\165\x72\165\x6e\x64\x69" => "\102\x49", "\x43\x61\x6d\142\157\x64\x69\141" => "\x4b\x48", "\103\141\155\145\162\157\x6f\156" => "\x43\115", "\103\141\156\x61\x64\x61" => "\103\x41", "\103\141\160\145\x20\126\x65\162\x64\145" => "\x43\126", "\103\x61\162\151\142\142\145\x61\156\40\116\x65\164\x68\145\162\154\x61\156\144\x73" => "\x42\121", "\103\x61\x79\155\x61\x6e\x20\111\163\x6c\x61\156\x64\x73" => "\113\131", "\x43\145\x6e\164\162\x61\x6c\x20\101\x66\162\x69\x63\x61\156\x20\x52\x65\160\x75\x62\154\151\x63" => "\x43\106", "\x43\x68\x61\144" => "\124\x44", "\x43\x68\x69\154\x65" => "\x43\114", "\x43\x68\151\x6e\x61" => "\103\x4e", "\x43\150\x72\151\163\164\x6d\141\163\x20\x49\163\154\x61\156\144" => "\x43\130", "\103\157\143\x6f\163\x20\x5b\113\145\145\154\x69\x6e\147\x5d\40\x49\163\154\x61\156\144\163" => "\x43\103", "\x43\157\x6c\157\x6d\x62\151\141" => "\x43\117", "\x43\x6f\155\157\162\157\x73" => "\x4b\x4d", "\x43\157\156\147\157\40\55\40\x42\x72\141\172\x7a\x61\166\151\154\154\x65" => "\103\x47", "\x43\157\x6e\x67\157\40\x2d\x20\113\x69\156\163\x68\141\x73\x61" => "\103\x44", "\103\x6f\x6f\153\40\x49\x73\x6c\x61\x6e\144\163" => "\x43\113", "\103\x6f\x73\164\141\x20\122\151\x63\141" => "\x43\122", "\x43\xc3\264\164\x65\x20\x64\342\x80\x99\111\166\x6f\151\162\145" => "\103\111", "\x43\x72\x6f\x61\x74\151\141" => "\x48\122", "\103\165\x62\141" => "\103\125", "\x43\165\x72\141\303\247\x61\157" => "\x43\x57", "\x43\171\x70\162\165\x73" => "\103\x59", "\x43\x7a\x65\143\150\40\122\x65\160\165\142\x6c\x69\x63" => "\x43\x5a", "\104\145\x6e\x6d\141\162\153" => "\x44\113", "\x44\152\x69\x62\x6f\x75\x74\151" => "\x44\112", "\x44\x6f\155\151\x6e\x69\x63\141" => "\x44\x4d", "\104\x6f\155\151\x6e\151\x63\x61\x6e\40\x52\x65\160\165\x62\154\151\143" => "\x44\117", "\105\x63\x75\141\144\157\162" => "\x45\103", "\105\147\x79\x70\164" => "\x45\x47", "\x45\154\40\x53\141\154\166\141\x64\157\162" => "\123\x56", "\x45\x71\165\141\x74\x6f\x72\151\x61\154\x20\107\165\151\156\145\x61" => "\107\x51", "\x45\162\x69\164\162\x65\141" => "\x45\x52", "\105\163\164\x6f\156\x69\141" => "\x45\x45", "\x45\164\150\x69\157\x70\151\x61" => "\x45\x54", "\x46\141\x6c\x6b\154\141\x6e\x64\40\x49\163\x6c\x61\x6e\144\x73" => "\x46\113", "\106\141\x72\x6f\145\40\x49\x73\154\x61\156\x64\163" => "\106\117", "\x46\x69\x6a\x69" => "\106\x4a", "\106\x69\156\154\x61\156\144" => "\106\x49", "\x46\162\x61\156\x63\145" => "\x46\122", "\106\x72\145\156\x63\x68\40\107\165\x69\141\x6e\141" => "\107\x46", "\x46\162\145\156\x63\x68\x20\x50\x6f\x6c\x79\x6e\x65\x73\x69\141" => "\120\106", "\x46\162\145\156\143\x68\40\x53\x6f\165\x74\x68\145\x72\156\40\x54\x65\x72\x72\x69\164\157\x72\x69\145\163" => "\124\x46", "\107\x61\142\x6f\x6e" => "\x47\101", "\x47\x61\155\142\x69\141" => "\107\115", "\x47\145\x6f\162\x67\x69\x61" => "\107\x45", "\x47\145\162\155\141\x6e\171" => "\x44\105", "\107\x68\x61\x6e\141" => "\107\110", "\107\x69\142\x72\141\154\164\x61\x72" => "\x47\111", "\x47\x72\145\145\x63\x65" => "\x47\x52", "\x47\x72\x65\x65\156\154\141\156\x64" => "\x47\114", "\x47\x72\x65\156\x61\x64\x61" => "\x47\x44", "\x47\x75\x61\144\145\x6c\157\x75\160\x65" => "\107\120", "\x47\x75\141\x6d" => "\107\x55", "\107\x75\x61\x74\x65\155\x61\154\x61" => "\107\124", "\x47\165\x65\x72\x6e\x73\x65\x79" => "\x47\x47", "\x47\165\151\x6e\145\141" => "\x47\116", "\x47\165\x69\x6e\x65\141\x2d\102\x69\163\163\141\165" => "\x47\x57", "\x47\x75\171\x61\x6e\141" => "\107\x59", "\110\141\x69\164\151" => "\x48\124", "\110\x65\141\162\x64\x20\111\163\154\x61\x6e\144\x20\141\x6e\x64\x20\x4d\x63\104\157\156\141\x6c\x64\x20\x49\x73\x6c\x61\156\x64\163" => "\x48\x4d", "\x48\157\156\x64\165\x72\141\x73" => "\x48\x4e", "\x48\157\x6e\x67\40\x4b\x6f\156\147\40\x53\101\x52\40\103\150\x69\x6e\141" => "\110\113", "\x48\x75\x6e\x67\141\162\x79" => "\110\x55", "\111\x63\x65\154\x61\156\x64" => "\x49\123", "\x49\156\144\151\x61" => "\x49\116", "\x49\156\x64\157\x6e\145\163\151\141" => "\111\x44", "\111\162\141\156" => "\111\x52", "\111\x72\141\x71" => "\x49\121", "\x49\162\x65\154\141\156\x64" => "\x49\105", "\111\163\154\145\40\x6f\x66\40\115\x61\156" => "\111\x4d", "\111\163\162\x61\145\x6c" => "\x49\x4c", "\111\x74\x61\x6c\171" => "\x49\124", "\x4a\141\155\x61\x69\x63\141" => "\112\x4d", "\x4a\141\x70\x61\156" => "\112\x50", "\x4a\x65\162\163\x65\x79" => "\x4a\x45", "\x4a\157\x72\x64\x61\156" => "\x4a\x4f", "\113\x61\172\141\x6b\x68\x73\x74\141\x6e" => "\x4b\x5a", "\113\x65\156\171\x61" => "\x4b\x45", "\x4b\x69\162\x69\x62\x61\164\x69" => "\113\111", "\113\165\167\x61\x69\164" => "\x4b\x57", "\113\x79\162\x67\171\172\x73\x74\141\x6e" => "\x4b\x47", "\x4c\141\157\163" => "\114\101", "\x4c\x61\x74\x76\151\x61" => "\114\126", "\x4c\x65\142\141\156\x6f\156" => "\114\x42", "\x4c\x65\163\157\164\150\x6f" => "\114\x53", "\x4c\x69\142\145\162\151\x61" => "\x4c\x52", "\x4c\151\x62\171\x61" => "\114\131", "\x4c\151\145\x63\150\x74\145\156\x73\x74\145\151\156" => "\114\111", "\114\151\x74\150\165\141\x6e\x69\x61" => "\x4c\124", "\114\165\170\145\155\x62\x6f\x75\162\x67" => "\114\125", "\x4d\x61\143\141\x75\40\x53\101\x52\40\103\x68\x69\x6e\141" => "\x4d\117", "\115\x61\143\x65\x64\x6f\156\x69\141" => "\115\113", "\x4d\141\x64\141\x67\x61\x73\x63\141\162" => "\x4d\107", "\115\141\154\141\x77\151" => "\115\x57", "\x4d\x61\154\141\x79\163\x69\141" => "\115\x59", "\115\x61\154\144\151\166\145\163" => "\x4d\x56", "\x4d\x61\154\151" => "\115\114", "\115\141\x6c\164\141" => "\115\124", "\115\x61\162\x73\x68\x61\x6c\154\x20\x49\x73\x6c\x61\x6e\144\x73" => "\115\110", "\x4d\x61\162\x74\x69\x6e\x69\161\x75\x65" => "\115\x51", "\x4d\x61\165\162\151\164\x61\156\x69\141" => "\x4d\x52", "\x4d\141\165\162\x69\164\151\x75\163" => "\x4d\125", "\x4d\x61\171\157\164\164\145" => "\131\x54", "\x4d\x65\x78\x69\143\157" => "\115\130", "\x4d\151\143\162\157\x6e\145\163\x69\x61" => "\x46\115", "\x4d\x6f\154\x64\157\166\x61" => "\x4d\104", "\115\157\x6e\x61\143\x6f" => "\x4d\103", "\115\x6f\156\x67\x6f\x6c\151\141" => "\115\x4e", "\x4d\157\x6e\164\145\156\145\147\x72\157" => "\x4d\105", "\x4d\157\x6e\164\163\x65\x72\162\x61\164" => "\115\123", "\x4d\x6f\x72\x6f\x63\x63\x6f" => "\x4d\101", "\x4d\157\172\141\x6d\x62\x69\161\x75\x65" => "\115\x5a", "\x4d\x79\141\x6e\x6d\141\162\x20\x5b\102\165\x72\x6d\x61\x5d" => "\x4d\x4d", "\116\141\x6d\x69\142\x69\141" => "\x4e\x41", "\116\x61\165\x72\x75" => "\x4e\122", "\x4e\x65\x70\141\154" => "\x4e\x50", "\116\145\x74\150\x65\x72\x6c\141\x6e\144\x73" => "\x4e\x4c", "\116\145\164\150\145\162\x6c\141\156\x64\163\40\x41\156\x74\151\154\154\x65\163" => "\x41\116", "\116\145\x77\x20\x43\x61\x6c\x65\x64\157\x6e\151\x61" => "\x4e\103", "\x4e\x65\x77\x20\x5a\x65\141\154\141\156\144" => "\x4e\x5a", "\116\151\x63\x61\x72\141\x67\x75\141" => "\116\111", "\x4e\x69\x67\x65\x72" => "\x4e\x45", "\116\x69\147\x65\162\x69\x61" => "\x4e\x47", "\x4e\x69\x75\x65" => "\x4e\125", "\x4e\x6f\162\x66\x6f\x6c\x6b\40\111\163\154\141\156\x64" => "\116\106", "\x4e\157\x72\164\150\145\x72\156\40\x4d\141\162\151\141\x6e\141\x20\x49\163\x6c\x61\156\x64\163" => "\115\x50", "\x4e\x6f\x72\x74\150\40\x4b\x6f\x72\145\141" => "\113\x50", "\x4e\157\x72\x77\x61\171" => "\116\117", "\117\x6d\x61\x6e" => "\x4f\x4d", "\120\141\153\151\x73\x74\141\156" => "\x50\113", "\x50\x61\x6c\141\x75" => "\120\127", "\x50\141\x6c\145\163\x74\151\x6e\151\141\x6e\x20\124\x65\162\162\151\x74\157\162\151\x65\163" => "\120\x53", "\120\141\x6e\x61\155\x61" => "\x50\101", "\x50\141\160\x75\x61\40\116\145\x77\40\107\165\x69\x6e\145\x61" => "\120\107", "\120\x61\162\x61\147\x75\141\171" => "\120\x59", "\120\x65\162\x75" => "\x50\x45", "\x50\x68\151\x6c\x69\x70\160\x69\x6e\145\163" => "\x50\110", "\120\x69\164\x63\141\x69\x72\156\40\x49\163\x6c\141\156\x64\x73" => "\x50\116", "\120\157\x6c\x61\156\144" => "\x50\114", "\x50\157\x72\x74\165\x67\141\154" => "\120\x54", "\x51\141\164\x61\x72" => "\121\x41", "\x52\303\251\x75\156\151\157\x6e" => "\x52\x45", "\x52\x6f\x6d\x61\156\x69\141" => "\122\x4f", "\x52\x75\163\x73\151\141" => "\x52\125", "\122\x77\x61\156\x64\x61" => "\122\x57", "\x53\x61\151\x6e\164\40\x42\141\x72\164\150\xc3\251\154\145\155\x79" => "\102\114", "\123\141\151\156\164\x20\110\x65\154\145\x6e\141" => "\123\110", "\x53\141\151\156\x74\x20\x4b\151\164\x74\x73\40\x61\156\x64\40\116\x65\x76\x69\x73" => "\113\116", "\123\141\x69\x6e\164\x20\114\165\143\151\x61" => "\114\103", "\x53\141\151\x6e\164\x20\x4d\x61\x72\x74\x69\x6e" => "\115\106", "\123\x61\x69\x6e\164\x20\120\151\145\162\x72\x65\x20\x61\156\144\40\115\x69\x71\x75\x65\x6c\x6f\156" => "\120\115", "\x53\141\x69\156\x74\40\x56\x69\156\x63\145\156\x74\40\x61\156\x64\40\x74\x68\x65\x20\x47\162\x65\156\x61\x64\151\x6e\145\x73" => "\126\103", "\123\x61\x6d\x6f\141" => "\x57\x53", "\x53\141\156\x20\x4d\x61\162\151\156\157" => "\123\x4d", "\123\xc3\xa3\x6f\40\124\157\x6d\303\251\40\141\x6e\144\x20\120\x72\303\255\156\143\151\160\145" => "\123\x54", "\x53\141\x75\144\x69\x20\x41\162\x61\142\151\x61" => "\123\x41", "\x53\145\156\x65\147\x61\x6c" => "\123\x4e", "\123\x65\162\142\151\x61" => "\x52\123", "\x53\x65\171\143\x68\145\154\154\x65\x73" => "\123\103", "\123\151\x65\x72\162\141\x20\114\x65\x6f\156\x65" => "\123\114", "\x53\151\156\x67\x61\160\x6f\162\145" => "\123\x47", "\123\x69\156\x74\40\x4d\x61\x61\x72\x74\x65\156" => "\x53\130", "\x53\x6c\157\x76\x61\153\x69\141" => "\x53\x4b", "\123\154\x6f\166\x65\x6e\x69\x61" => "\123\111", "\123\x6f\154\x6f\155\x6f\156\40\x49\x73\x6c\x61\x6e\144\x73" => "\123\x42", "\123\157\155\141\x6c\151\x61" => "\x53\117", "\x53\x6f\x75\x74\150\x20\101\146\162\x69\x63\141" => "\x5a\x41", "\123\157\x75\x74\150\40\x47\145\157\162\x67\x69\141\40\141\x6e\144\40\x74\150\145\40\x53\x6f\165\x74\x68\x20\123\x61\x6e\x64\167\151\143\x68\x20\x49\x73\x6c\141\156\144\163" => "\107\123", "\123\157\165\x74\x68\x20\x4b\157\162\x65\141" => "\113\x52", "\x53\160\141\151\156" => "\105\123", "\123\x72\151\x20\x4c\x61\x6e\153\141" => "\x4c\x4b", "\123\165\144\x61\x6e" => "\x53\104", "\123\x75\162\151\x6e\x61\x6d\145" => "\123\122", "\123\x76\141\154\x62\x61\x72\144\x20\x61\156\144\x20\112\x61\156\x20\115\x61\x79\x65\156" => "\123\x4a", "\x53\x77\141\x7a\x69\154\141\156\144" => "\x53\132", "\123\x77\145\x64\x65\x6e" => "\123\105", "\123\x77\x69\x74\172\145\162\x6c\x61\156\x64" => "\103\x48", "\x53\171\162\151\x61" => "\x53\x59", "\x54\141\x69\x77\141\156\x2c\x20\120\x72\157\x76\x69\x6e\x63\145\40\157\146\40\103\150\151\156\x61" => "\124\x57", "\124\x61\152\x69\153\x69\x73\164\141\x6e" => "\124\x4a", "\124\x61\156\x7a\x61\156\x69\141" => "\124\132", "\124\x68\141\x69\154\x61\x6e\144" => "\124\110", "\x54\x69\x6d\x6f\162\55\x4c\145\163\164\x65" => "\x54\x4c", "\x54\x6f\147\x6f" => "\x54\x47", "\x54\157\x6b\145\154\141\165" => "\124\113", "\124\x6f\156\147\x61" => "\124\117", "\124\162\x69\156\x69\144\x61\x64\x20\141\x6e\x64\40\124\x6f\142\141\x67\x6f" => "\124\x54", "\124\x75\156\151\163\151\141" => "\x54\x4e", "\124\165\x72\153\x65\x79" => "\x54\122", "\x54\165\162\153\x6d\145\x6e\x69\163\x74\141\156" => "\124\x4d", "\x54\x75\162\153\x73\40\141\x6e\144\40\103\141\151\143\x6f\163\40\x49\x73\x6c\141\x6e\144\163" => "\x54\103", "\124\165\166\x61\154\165" => "\x54\x56", "\125\147\141\156\144\x61" => "\x55\x47", "\x55\x6b\162\141\x69\156\145" => "\125\x41", "\x55\x6e\x69\x74\x65\144\x20\x41\x72\x61\142\40\x45\155\151\x72\141\x74\145\163" => "\x41\x45", "\125\x6e\151\164\x65\x64\x20\x4b\151\156\147\x64\157\155" => "\107\x42", "\x55\x6e\x69\x74\x65\x64\40\123\164\141\164\x65\163" => "\125\123", "\x55\162\x75\x67\165\141\x79" => "\x55\x59", "\125\56\x53\56\40\x4f\165\164\x6c\x79\151\x6e\x67\40\111\163\x6c\x61\156\144\x73" => "\x55\115", "\125\56\123\x2e\40\126\x69\x72\147\151\156\x20\x49\163\154\141\156\144\163" => "\126\111", "\125\172\x62\145\x6b\x69\163\164\x61\x6e" => "\125\x5a", "\126\x61\x6e\165\x61\164\x75" => "\x56\x55", "\126\141\164\151\143\141\x6e\40\103\x69\x74\171" => "\126\101", "\126\145\156\145\172\x75\145\154\141" => "\126\x45", "\126\x69\x65\x74\156\x61\155" => "\126\x4e", "\127\x61\x6c\154\151\163\40\141\156\144\x20\x46\x75\x74\165\x6e\x61" => "\127\x46", "\x57\x65\163\164\x65\162\x6e\x20\x53\141\150\141\x72\141" => "\x45\x48", "\131\145\155\x65\156" => "\x59\105", "\x5a\141\x6d\142\x69\141" => "\x5a\115", "\x5a\151\155\x62\x61\x62\167\145" => "\132\127"];
        $ZW = '';
        $kL[] = [];
        $WV[] = [];
        $u1 = '';
        $WX = '';
        $AE = '';
        if (!array_key_exists("\163\x68\151\x70\160\x69\156\147\137\141\144\144\162\x65\163\163", $this->attrs)) {
            goto r1;
        }
        $ZW = $this->attrs["\163\x68\151\160\160\151\x6e\147\x5f\x61\x64\x64\x72\145\163\x73"]["\x70\x68\x6f\x6e\145"];
        $kL[] = htmlspecialchars($this->formatStreetAddress($this->attrs["\x73\150\x69\x70\x70\151\x6e\x67\x5f\x61\x64\144\x72\145\x73\x73"]["\141\x64\144\x72\145\163\163"]["\x73\x74\162\x65\145\164\137\x61\x64\144\162\145\x73\x73"]));
        if (!$this->attrs["\x73\150\x69\x70\x70\151\x6e\147\x5f\141\x64\x64\162\145\163\x73"]["\141\x64\x64\162\145\x73\163"]["\162\x65\x67\151\x6f\156"]) {
            goto dx;
        }
        $kL[] = $this->attrs["\x73\x68\x69\x70\160\151\156\x67\x5f\x61\x64\144\162\x65\163\163"]["\141\144\x64\162\145\x73\163"]["\162\145\x67\151\157\x6e"];
        dx:
        $u1 = $this->attrs["\x73\150\x69\160\x70\151\x6e\x67\137\141\144\144\162\x65\x73\163"]["\x61\x64\x64\162\x65\163\x73"]["\160\157\163\164\141\x6c\x5f\143\157\x64\145"];
        $WX = $am[$this->attrs["\163\150\151\160\160\x69\156\147\137\x61\144\144\162\145\x73\163"]["\141\x64\144\x72\x65\163\163"]["\143\x6f\165\x6e\164\x72\171"]];
        $AE = $this->attrs["\163\150\151\x70\160\x69\x6e\147\x5f\x61\144\144\162\x65\x73\x73"]["\x61\144\144\x72\145\163\x73"]["\154\157\143\x61\154\x69\x74\171"];
        r1:
        $CC = '';
        if (!$this->oauthUtility->isBlank($ZW)) {
            goto H5;
        }
        $ZW = "\53\x31";
        H5:
        $this->createOrUpdateAddress($i3, $i3->getFirstname(), $i3->getLastname(), $ZW, $kL, $CC, $AE, $WX, $u1, "\x73\x68\x69\160\x70\x69\x6e\147");
        if (!array_key_exists("\x61\144\144\x72\x65\163\163", $this->attrs)) {
            goto DS;
        }
        $WV[] = htmlspecialchars($this->formatStreetAddress($this->attrs["\141\144\144\162\145\x73\163"]["\x73\x74\162\x65\145\164\x5f\x61\144\x64\162\145\163\x73"]));
        if (!$this->attrs["\x61\x64\144\x72\x65\163\163"]["\x72\x65\147\151\x6f\x6e"]) {
            goto mb;
        }
        $WV[] = $this->attrs["\141\x64\144\162\x65\163\x73"]["\x72\x65\x67\151\157\x6e"];
        mb:
        $u1 = $this->attrs["\141\x64\144\x72\x65\x73\163"]["\x70\x6f\x73\x74\141\154\137\143\157\x64\x65"];
        $WX = $am[$this->attrs["\141\144\x64\x72\x65\x73\163"]["\143\157\x75\156\x74\x72\x79"]];
        $AE = $this->attrs["\x61\144\144\x72\145\x73\x73"]["\154\157\x63\x61\x6c\151\164\x79"];
        DS:
        $CC = '';
        if (!$this->oauthUtility->isBlank($ZW)) {
            goto Ax;
        }
        $ZW = "\53\x31";
        Ax:
        $this->createOrUpdateAddress($i3, $i3->getFirstname(), $i3->getLastname(), $ZW, $WV, $CC, $AE, $WX, $u1, "\x62\151\154\x6c\151\x6e\147");
    }
    private function formatStreetAddress($om)
    {
        $om = preg_replace("\57\xd\xa\xd\12\x7c\15\15\174\xa\xa\57", "\54", $om);
        $om = preg_replace("\x2f\15\12\174\15\x7c\12\57", "\x2c", $om);
        return $om;
    }
    private function createOrUpdateAddress(&$i3, $FI, $KO, $ZW, $kL, $CC, $AE, $WX, $u1, $ka)
    {
        if (!$this->addressValidationCheck($kL, $u1, $WX)) {
            goto LO;
        }
        $rH = $this->dataAddressFactory->create();
        if ($ka == "\x62\x69\154\154\151\156\147" && $i3->getDefaultBilling()) {
            goto ep;
        }
        if ($ka == "\163\x68\151\x70\x70\151\x6e\x67" && $i3->getDefaultShipping()) {
            goto Yb;
        }
        if (!($ka == "\x62\157\x74\150" && $i3->getDefaultShipping())) {
            goto rd;
        }
        $rH->load($i3->getDefaultShipping());
        rd:
        goto j0;
        Yb:
        $rH->load($i3->getDefaultShipping());
        j0:
        goto D4;
        ep:
        $rH->load($i3->getDefaultBilling());
        D4:
        $rH->setFirstname($FI);
        $rH->setLastname($KO);
        $rH->setTelephone($ZW);
        $rH->setStreet($kL);
        $rH->setCity($AE);
        $rH->setCountryId($WX);
        $rH->setPostcode($u1);
        $rH->setRegionId($CC);
        $FV = $ka == "\142\151\154\154\x69\156\147" || $ka == "\142\x6f\164\150";
        $vo = $ka == "\163\150\x69\x70\x70\x69\156\147" || $ka == "\x62\x6f\x74\150";
        $rH->setIsDefaultShipping($vo);
        $rH->setIsDefaultBilling($FV);
        $rH->setCustomerId($i3->getId());
        try {
            $rH->save();
            $i3 = $rH->getCustomer();
        } catch (\Exception $cZ) {
            die("\101\156\x20\145\162\162\x6f\x72\x20\x6f\143\x63\x75\x72\162\145\x64\x20\167\150\x69\x6c\145\40\164\x72\171\x69\x6e\147\40\164\157\40\x73\145\164\x20\x61\x64\144\x72\145\163\163\x3a\40{$cZ->getMessage()}");
        }
        LO:
    }
    private function addressValidationCheck($kL, $u1, $WX)
    {
        return !$this->oauthUtility->isBlank($kL) && !$this->oauthUtility->isBlank($u1) && !$this->oauthUtility->isBlank($WX);
    }
    private function createAdminUser($C1, $FI, $KO, $Pg, $Me, $AH)
    {
        $this->oauthUtility->log_debug("\x50\162\157\143\145\x73\x73\x55\163\x65\162\101\x63\x74\151\157\x6e\x3a\x20\x63\x72\x65\141\x74\x65\x41\x64\x6d\x69\156\125\163\145\162");
        $uE = ["\x75\163\x65\x72\x6e\141\x6d\145" => $C1, "\146\151\162\163\164\156\x61\155\145" => $FI, "\154\x61\163\x74\156\141\x6d\x65" => $KO, "\145\155\x61\x69\x6c" => $Pg, "\160\141\163\163\167\157\x72\144" => $Me, "\151\156\x74\145\162\146\141\x63\145\137\154\157\143\141\x6c\x65" => "\145\x6e\x5f\125\123", "\x69\163\137\x61\143\x74\x69\x76\x65" => 1];
        $Lj = empty($AH) ? $AH : "\101\144\155\x69\x6e\151\x73\164\x72\x61\164\x6f\x72";
        $user = $this->userFactory->create();
        $user->setData($uE);
        $user->setRoleId($Lj);
        $this->oauthUtility->log_debug("\141\163\x73\x69\147\156\x69\156\x67\x20\147\x72\157\x75\160\40\x74\157\40\x6e\x65\167\x20\x41\144\x6d\x69\x6e\x3a\40" . $Lj);
        $user->save();
        return $user;
    }
    private function processRoles($uK, &$rn, $VY, $Pk)
    {
        $this->oauthUtility->log_debug("\x50\x72\x6f\x63\145\x73\163\x55\163\145\x72\x41\x63\164\151\x6f\156\x3a\x20\x70\x72\x6f\143\x65\163\x73\x52\157\x6c\145\163");
        $Yb = '';
        $uH = $this->processDefaultRole($rn, $uK);
        if (!(empty($Pk) || empty($VY))) {
            goto QF;
        }
        return $uH;
        QF:
        foreach ($VY as $va => $UN) {
            $sL = explode("\73", $UN);
            foreach ($sL as $n7) {
                if (!($n7 == $Pk)) {
                    goto EK;
                }
                $Yb = $va;
                goto Y2;
                EK:
                p_:
            }
            Y2:
            fz:
        }
        u7:
        return empty($Yb) ? $uH : $Yb;
    }
    private function getAdminUserFromAttributes($Jt)
    {
        $wz = false;
        $sb = $this->adminUserModel->getResource()->getConnection();
        $ao = $sb->select()->from($this->adminUserModel->getResource()->getMainTable())->where("\x65\x6d\141\x69\x6c\x3d\x3a\145\x6d\141\151\154");
        $hq = ["\x65\x6d\x61\x69\x6c" => $Jt];
        $wz = $sb->fetchRow($ao, $hq);
        $wz = is_array($wz) ? $this->adminUserModel->loadByUsername($wz["\x75\163\x65\162\x6e\x61\x6d\145"]) : $wz;
        return $wz;
    }
    private function processDefaultRole($rn, $uK)
    {
        $this->oauthUtility->log_debug("\x50\x72\157\x63\145\163\163\x55\163\145\162\x41\x63\164\x69\x6f\x6e\x3a\40\160\162\x6f\143\x65\x73\163\x44\145\146\141\x75\154\164\122\x6f\x6c\145\x73");
        if (!is_null($uK)) {
            goto Ik;
        }
        return;
        Ik:
        $sL = $this->userGroupModel->toOptionArray();
        $OZ = $this->adminRoleModel->toOptionArray();
        $uH = '';
        if ($rn) {
            goto NZ;
        }
        foreach ($sL as $n7) {
            $rn = $uK == $n7["\154\x61\x62\x65\x6c"] ? false : true;
            if ($rn) {
                goto li;
            }
            $uH = $n7["\166\141\154\x75\145"];
            goto cB;
            li:
            YD:
        }
        cB:
        goto TP;
        NZ:
        foreach ($OZ as $Yb) {
            $rn = $uK == $Yb["\154\141\142\145\154"] ? true : false;
            if (!$rn) {
                goto l9;
            }
            $uH = $Yb["\166\x61\154\165\145"];
            goto aa;
            l9:
            xj:
        }
        aa:
        TP:
        return $uH;
    }
    private function getCustomerFromAttributes($Jt)
    {
        $this->oauthUtility->log_debug("\120\162\157\143\145\163\x73\x55\163\x65\x72\101\x63\x74\151\x6f\156\72\40\x67\145\164\x43\165\x73\x74\x6f\155\x41\x74\x74\162\151\x62\x75\164\x65\163");
        $this->customerModel->setWebsiteId($this->storeManager->getStore()->getWebsiteId());
        $i3 = $this->customerModel->loadByEmail($Jt);
        return !is_null($i3->getId()) ? $i3 : false;
    }
    public function setAttrs($HX)
    {
        $this->attrs = $HX;
        return $this;
    }
    public function setFlattenedAttrs($ct)
    {
        $this->flattenedattrs = $ct;
        return $this;
    }
    public function setUserEmail($p6)
    {
        $this->userEmail = $p6;
        return $this;
    }
}
