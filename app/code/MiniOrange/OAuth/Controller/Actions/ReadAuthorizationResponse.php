<?php


namespace MiniOrange\OAuth\Controller\Actions;

include dirname(__FILE__) . "\x2f\56\x2e\x2f\x2e\56\57\x48\145\154\x70\x65\162\x2f\x52\x53\101\125\x74\x69\154\x73\57\122\123\101\x2e\160\x68\x70";
include dirname(__FILE__) . "\x2f\x2e\56\57\56\56\57\110\x65\x6c\160\x65\162\57\122\x53\x41\125\x74\151\x6c\x73\57\115\x61\164\x68\57\102\151\x67\x49\x6e\x74\145\147\x65\x72\x2e\160\x68\x70";
use Exception;
use Magento\Framework\App\Action\Context;
use MiniOrange\OAuth\Helper\OAuthConstants;
use MiniOrange\OAuth\Helper\OAuth\AccessTokenRequest;
use MiniOrange\OAuth\Helper\OAuth\AccessTokenRequestBody;
use MiniOrange\OAuth\Helper\Curl;
use MiniOrange\OAuth\Helper\Crypt_RSA;
use MiniOrange\OAuth\Helper\Math_BigInteger;
use MiniOrange\OAuth\Helper\OAuthUtility;
class ReadAuthorizationResponse extends BaseAction
{
    private $REQUEST;
    private $POST;
    private $processResponseAction;
    public function __construct(Context $Dp, OAuthUtility $GQ, ProcessResponseAction $sE)
    {
        $this->processResponseAction = $sE;
        parent::__construct($Dp, $GQ);
    }
    public function execute()
    {
        $this->oauthUtility->log_debug("\122\145\x61\144\101\x75\x74\150\x6f\162\151\x7a\x61\164\151\x6f\156\x52\x65\163\x70\157\156\x73\145\x3a\40\x65\170\x65\143\x75\164\145");
        $Ru = $this->getRequest()->getParams();
        $this->oauthUtility->log_debug("\122\x65\141\144\101\165\x74\150\157\x72\151\x7a\x61\x74\151\x6f\x6e\x52\145\x73\x70\x6f\x6e\x73\145\x3a\x20\x70\x61\x72\x61\x6d\x73", $Ru);
        if (isset($Ru["\x63\x6f\144\145"])) {
            goto hA;
        }
        $this->oauthUtility->log_debug("\122\145\141\144\101\x75\x74\x68\157\x72\151\172\141\x74\151\x6f\156\x52\145\163\160\x6f\156\x73\x65\72\40\160\141\162\141\x6d\x73\133\x27\143\x6f\x64\145\x27\135\40\x6e\x6f\x74\40\163\145\x74");
        if (!isset($Ru["\x65\x72\162\x6f\162"])) {
            goto bF;
        }
        return $this->sendHTTPRedirectRequest("\77\x65\162\162\157\x72\x3d" . urlencode($Ru["\x65\162\162\x6f\162"]), $this->oauthUtility->getBaseUrl());
        bF:
        return $this->sendHTTPRedirectRequest("\77\x65\162\162\x6f\162\75\x63\x6f\x64\x65\x2b\x6e\x6f\164\53\x72\145\x63\145\151\166\145\x64", $this->oauthUtility->getBaseUrl());
        hA:
        $IG = $Ru["\x63\x6f\144\145"];
        $pQ = $Ru["\x73\x74\x61\x74\x65"];
        $this->oauthUtility->log_debug("\x52\145\x61\144\x41\x75\x74\x68\x6f\162\x69\x7a\x61\x74\x69\x6f\x6e\122\145\163\160\157\x6e\x73\x65\x3a\40\141\x75\164\x68\x6f\x72\151\172\x61\164\x69\x6f\x6e\x43\157\144\x65", $IG);
        $this->oauthUtility->log_debug("\x52\145\x61\144\101\x75\x74\150\x6f\162\151\172\141\164\x69\157\x6e\122\145\x73\160\x6f\156\163\x65\x3a\x20\x72\x65\x6c\141\171\123\x74\x61\x74\x65", $pQ);
        $AP = $this->oauthUtility->getStoreConfig(OAuthConstants::CLIENT_ID);
        $GA = $this->oauthUtility->getStoreConfig(OAuthConstants::CLIENT_SECRET);
        $OU = OAuthConstants::GRANT_TYPE;
        $YX = $this->oauthUtility->getStoreConfig(OAuthConstants::ACCESSTOKEN_URL);
        $D4 = $this->oauthUtility->getCallBackUrl();
        $this->oauthUtility->log_debug("\x52\x65\x61\x64\x41\165\x74\150\157\162\x69\172\x61\x74\151\x6f\156\122\x65\x73\x70\157\x6e\163\x65\72\40\143\x6c\x69\145\156\x74\111\104", $AP);
        $this->oauthUtility->log_debug("\x52\x65\x61\x64\101\165\164\150\157\x72\x69\172\x61\x74\151\157\156\122\x65\163\x70\157\156\163\x65\72\40\x63\154\x69\145\156\164\x53\x65\143\x72\145\164", $GA);
        $this->oauthUtility->log_debug("\x52\145\141\144\x41\165\164\x68\157\x72\x69\172\x61\x74\x69\157\x6e\x52\145\x73\160\157\156\163\145\72\x20\147\x72\x61\156\164\124\x79\x70\145", $OU);
        $this->oauthUtility->log_debug("\x52\145\x61\144\x41\x75\164\x68\x6f\162\151\x7a\x61\x74\151\x6f\x6e\122\145\163\160\x6f\156\163\x65\x3a\x20\x72\x65\144\151\162\x65\x63\164\x55\x52\x4c", $D4);
        $this->oauthUtility->log_debug("\122\145\141\144\x41\165\164\150\157\x72\151\x7a\x61\x74\151\x6f\156\x52\x65\x73\160\x6f\x6e\x73\145\72\40\141\143\x63\145\163\x73\x54\157\x6b\x65\x6e\125\x52\114", $YX);
        $Vs = $this->oauthUtility->getStoreConfig(OAuthConstants::SEND_HEADER);
        $sV = $this->oauthUtility->getStoreConfig(OAuthConstants::SEND_BODY);
        $this->oauthUtility->log_debug("\122\145\x61\144\101\165\164\x68\x6f\x72\x69\x7a\141\x74\151\x6f\156\x52\145\x73\x70\x6f\x6e\x73\x65\72\x20\x68\145\x61\144\x65\162", $Vs);
        $this->oauthUtility->log_debug("\x52\x65\141\x64\101\x75\164\x68\x6f\x72\151\172\141\x74\x69\157\x6e\x52\x65\x73\x70\157\x6e\x73\145\x3a\40\142\157\144\x79", $sV);
        if ($Vs == 1 && $sV == 0) {
            goto RL;
        }
        $fF = (new AccessTokenRequest($AP, $GA, $OU, $D4, $IG))->build();
        goto tT;
        RL:
        $fF = (new AccessTokenRequestBody($OU, $D4, $IG))->build();
        tT:
        $this->oauthUtility->log_debug("\x52\x65\x61\x64\x41\x75\x74\150\157\x72\x69\172\141\164\151\x6f\x6e\x52\x65\163\x70\157\156\163\145\x3a\40\x61\143\143\145\x73\x73\x54\x6f\153\145\x6e\x52\x65\x71\165\145\x73\164", $fF);
        $oV = Curl::mo_send_access_token_request($fF, $YX, $AP, $GA);
        $this->oauthUtility->log_debug("\x52\145\141\144\101\165\x74\150\x6f\x72\151\x7a\141\164\x69\x6f\156\122\x65\x73\160\157\156\x73\145\x3a\x20\141\x63\143\x65\163\x73\x54\157\153\145\156\122\145\x73\160\157\156\x73\145", $oV);
        $N2 = json_decode($oV, "\164\x72\x75\145");
        $this->oauthUtility->log_debug("\x52\145\141\x64\x41\x75\164\x68\x6f\x72\x69\172\x61\x74\151\x6f\156\x52\x65\x73\160\157\x6e\163\145\72\40\x61\143\143\x65\x73\x73\x54\157\x6b\145\156\122\x65\x73\160\x6f\x6e\163\145\104\x61\164\x61", $N2);
        if (isset($N2["\151\x64\x5f\x74\x6f\153\145\x6e"])) {
            goto x4;
        }
        if (isset($N2["\141\143\x63\145\x73\x73\137\x74\157\x6b\x65\156"])) {
            goto Nr;
        }
        error_log(print_r($N2, true));
        return $this->getResponse()->setBody("\x49\x6e\x76\141\154\151\144\x20\x72\x65\163\x70\x6f\156\x73\x65\56\x20\x50\154\x65\x61\163\145\40\x74\162\x79\x20\141\147\141\x69\x6e\x2e\174\115\60\x30\x32");
        goto P8;
        x4:
        $this->oauthUtility->log_debug("\x52\145\x61\144\x41\x75\164\150\157\162\x69\172\x61\x74\151\x6f\x6e\122\x65\x73\160\x6f\156\x73\x65\x3a\40\x69\x66\40\x61\x63\143\145\163\x73\x54\x6f\x6b\145\156\122\145\163\160\157\x6e\x73\x65\x44\x61\x74\x61\133\47\x69\x64\x5f\164\157\x6b\145\156\x27\x5d\x20");
        $GE = $N2["\x69\x64\x5f\164\157\153\x65\156"];
        $this->oauthUtility->log_debug("\x52\x65\x61\144\x41\165\x74\x68\157\162\x69\172\x61\164\x69\x6f\156\x52\x65\163\x70\x6f\x6e\163\145\x3a\x20\x69\144\x54\157\153\145\x6e", $GE);
        if (empty($GE)) {
            goto Nt;
        }
        $Be = $this->oauthUtility->getStoreConfig(OAuthConstants::X509CERT);
        $SG = explode("\56", $GE);
        $this->oauthUtility->log_debug("\x52\x65\x61\x64\x41\x75\x74\150\x6f\162\151\x7a\x61\x74\x69\x6f\x6e\122\145\163\160\x6f\156\163\145\x3a\x20\170\x35\x30\x39\137\x63\145\162\164", $Be);
        $this->oauthUtility->log_debug("\122\145\141\x64\x41\x75\x74\x68\x6f\x72\151\172\x61\164\151\157\156\122\145\x73\x70\x6f\156\x73\x65\72\x20\151\x64\124\157\153\145\x6e\101\x72\x72\141\x79", $SG);
        if (sizeof($SG) > 2) {
            goto KH;
        }
        error_log(print_r($SG, true));
        return $this->getResponse()->setBody("\111\156\x76\x61\154\151\x64\40\162\x65\163\160\157\x6e\163\x65\x2e\40\x50\154\145\x61\163\x65\x20\164\x72\x79\40\141\147\x61\x69\156\56\x7c\x4d\x30\60\x31");
        goto kW;
        KH:
        $pF = trim($Be);
        $Cz = json_decode(file_get_contents($pF))->keys[0];
        $GW = $this->decodeJWT($GE);
        $this->oauthUtility->log_debug("\x52\x65\141\x64\101\x75\164\x68\x6f\x72\x69\x7a\x61\164\151\157\156\122\x65\163\160\x6f\x6e\163\x65\x3a\x20\152\167\x6b\x73\137\x75\162\x69", $pF);
        $this->oauthUtility->log_debug("\122\145\141\x64\101\165\x74\x68\x6f\162\x69\172\141\x74\151\157\156\122\145\163\x70\x6f\156\x73\x65\x3a\40\x6a\x77\153\x65\x79\163", $Cz);
        $this->oauthUtility->log_debug("\x52\145\141\x64\x41\x75\x74\x68\x6f\162\x69\172\141\x74\x69\157\156\122\x65\x73\x70\157\x6e\x73\x65\72\x20\x4a\x57\x54\x43\x6f\155\160\157\156\145\x6e\164\x73", $GW);
        if ($this->verifySign($GW, $Cz)) {
            goto aN;
        }
        return $this->getResponse()->setBody("\x49\156\x76\x61\x6c\x69\144\x20\163\x69\147\x6e\x61\164\x75\x72\x65\40\x72\x65\x63\145\x69\166\x65\x64\x2e");
        aN:
        $BY = $SG[1];
        $BY = (array) json_decode(base64_decode($BY));
        $this->oauthUtility->log_debug("\x52\145\141\144\x41\165\x74\x68\x6f\162\151\x7a\x61\164\151\157\156\x52\145\163\160\157\x6e\x73\x65\72\40\x75\163\145\x72\x49\156\x66\157\122\145\163\160\157\x6e\x73\145\x44\141\164\141", $BY);
        kW:
        Nt:
        goto P8;
        Nr:
        $this->oauthUtility->log_debug("\122\x65\x61\144\x41\165\164\150\x6f\x72\x69\172\x61\x74\151\x6f\x6e\x52\145\163\160\x6f\156\163\145\72\40\x61\x63\143\x65\x73\163\124\x6f\x6b\145\156\122\145\x73\160\x6f\156\163\x65\x44\x61\x74\x61\133\x27\141\x63\143\x65\163\163\137\x74\157\x6b\x65\156\x27\x5d\x20\151\x73\x20\163\145\x74");
        $Q_ = $N2["\141\143\143\x65\x73\x73\x5f\x74\x6f\153\145\x6e"];
        $d5 = $this->oauthUtility->getStoreConfig(OAuthConstants::GETUSERINFO_URL);
        $this->oauthUtility->log_debug("\x52\145\141\144\x41\165\164\x68\x6f\x72\151\x7a\141\x74\x69\157\156\122\x65\163\160\157\x6e\163\145\x3a\40\141\x63\x63\145\163\x73\124\x6f\x6b\x65\x6e", $Q_);
        $this->oauthUtility->log_debug("\122\x65\141\144\101\165\164\x68\x6f\162\x69\172\141\164\151\x6f\156\122\145\x73\x70\x6f\x6e\x73\145\72\40\x75\163\145\x72\111\156\x66\157\x55\x52\x4c", $d5);
        $Vs = "\x42\145\x61\x72\145\x72\40" . $Q_;
        $Es = ["\x41\165\x74\150\157\162\x69\x7a\141\164\151\157\x6e\x3a\40{$Vs}"];
        $D7 = Curl::mo_send_user_info_request($d5, $Es);
        $BY = json_decode($D7, "\x74\162\165\x65");
        $this->oauthUtility->log_debug("\x52\145\x61\144\101\165\164\150\157\x72\x69\x7a\141\x74\151\x6f\156\122\x65\x73\160\157\x6e\x73\x65\72\40\165\163\x65\x72\111\156\146\x6f\122\145\x73\160\157\x6e\163\x65", $D7);
        $this->oauthUtility->log_debug("\122\145\x61\x64\x41\165\164\x68\157\x72\151\x7a\x61\x74\x69\157\156\122\x65\163\x70\157\x6e\x73\145\x3a\40\x75\163\145\162\111\x6e\x66\x6f\x52\x65\163\160\157\156\x73\x65\104\x61\164\141", $BY);
        P8:
        if (!empty($BY)) {
            goto yw;
        }
        return $this->getResponse()->setBody("\111\x6e\x76\141\x6c\151\144\40\162\145\163\x70\157\156\163\x65\56\40\120\154\x65\x61\x73\x65\40\164\x72\171\40\141\147\x61\x69\156\56\174\x4d\60\x30\x33");
        yw:
        $BY["\162\x65\x6c\x61\171\x53\x74\141\164\145"] = $pQ;
        $this->processResponseAction->setUserInfoResponse($BY)->execute();
    }
    public function setRequestParam($ge)
    {
        $this->REQUEST = $ge;
        return $this;
    }
    public function setPostParam($post)
    {
        $this->POST = $post;
        return $this;
    }
    public function verifySign($GW, $Cz)
    {
        $this->oauthUtility->log_debug("\x52\145\x61\x64\101\165\164\150\157\162\x69\x7a\x61\164\151\157\156\122\145\163\x70\x6f\x6e\x73\x65\x3a\x20\x69\x6e\163\151\144\x65\x20\x76\x65\162\151\146\x79\123\151\x67\156");
        $kx = new Crypt_RSA();
        $this->oauthUtility->log_debug("\122\145\141\x64\101\165\164\x68\157\162\x69\172\141\x74\x69\x6f\156\x52\x65\163\x70\157\x6e\x73\x65\x3a\40\142\145\x66\x6f\x72\x65\40\x6c\x6f\x61\x64\x69\x6e\x67\x20\153\145\x79");
        $kx->loadKey(["\156" => new Math_BigInteger($this->get_base64_from_url($Cz->n), 256), "\145" => new Math_BigInteger($this->get_base64_from_url($Cz->e), 256)]);
        $kx->setHash("\x73\150\141\62\x35\66");
        $kx->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
        return $kx->verify($GW["\x64\141\x74\x61"], $GW["\163\x69\147\156"]) ? true : false;
    }
    public function get_base64_from_url($aB)
    {
        return base64_decode(str_replace(["\x2d", "\x5f"], ["\x2b", "\x2f"], $aB));
    }
    public function decodeJWT($ZB)
    {
        $this->oauthUtility->log_debug("\122\145\141\x64\x41\165\164\x68\157\x72\x69\x7a\x61\x74\151\157\x6e\x52\x65\163\x70\x6f\x6e\x73\145\x3a\x20\151\x6e\x73\x69\144\x65\40\x64\145\143\157\x64\x65\x4a\x57\124");
        $j2 = explode("\x2e", $ZB);
        $Vs = json_decode($this->get_base64_from_url($j2[0]));
        $fX = json_decode($this->get_base64_from_url($j2[1]));
        $aG = $this->get_base64_from_url($j2[2]);
        return ["\x68\x65\x61\144\145\162" => $Vs, "\x70\x61\x79\154\x6f\141\x64" => $fX, "\163\151\147\156" => $aG, "\x64\x61\164\x61" => $j2[0] . "\56" . $j2[1]];
    }
}
