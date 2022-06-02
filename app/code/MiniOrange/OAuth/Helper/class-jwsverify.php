<?php


namespace MiniOrange\OAuth\Helper;

class JWSVerify
{
    public $algo;
    public function __construct($A7 = '')
    {
        if (!empty($A7)) {
            goto nE;
        }
        return;
        nE:
        $A7 = explode("\x53", $A7);
        if (!(!is_array($A7) || 2 !== count($A7))) {
            goto XD;
        }
        return WP_Error("\151\156\x76\141\x6c\151\144\137\163\x69\147\156\141\164\165\x72\145", __("\124\x68\x65\x20\x53\x69\147\156\141\164\165\162\x65\40\163\145\x65\155\163\40\x74\157\40\142\145\x20\x69\x6e\166\x61\154\x69\144\40\x6f\162\x20\165\156\163\x75\160\160\157\162\164\145\144\56"));
        XD:
        if ("\x48" === $A7[0]) {
            goto Z4;
        }
        if ("\122" === $A7[0]) {
            goto E6;
        }
        return WP_Error("\x69\156\x76\x61\154\x69\x64\x5f\163\x69\147\156\x61\164\165\x72\x65", __("\124\150\x65\x20\163\x69\x67\x6e\141\164\x75\162\145\x20\x61\154\x67\x6f\x72\x69\164\x68\155\x20\x73\x65\145\x6d\163\x20\164\x6f\x20\142\x65\40\165\156\163\x75\160\x70\x6f\x72\164\x65\144\40\x6f\x72\40\x69\x6e\166\x61\154\151\x64\56"));
        goto nf;
        Z4:
        $this->algo["\x61\154\x67"] = "\110\x53\101";
        goto nf;
        E6:
        $this->algo["\x61\154\147"] = "\x52\123\x41";
        nf:
        $this->algo["\x73\x68\x61"] = $A7[1];
    }
    private function validate_hmac($NT = '', $cD = '', $aG = '')
    {
        if (!(empty($NT) || empty($aG))) {
            goto D_;
        }
        return false;
        D_:
        $sU = $this->algo["\x73\x68\141"];
        $sU = "\x73\x68\141" . $sU;
        $qO = \hash_hmac($sU, $NT, $cD, true);
        return hash_equals($qO, $aG);
    }
    private function validate_rsa($NT = '', $vA = '', $aG = '')
    {
        if (!(empty($NT) || empty($aG))) {
            goto uU;
        }
        return false;
        uU:
        $sU = $this->algo["\163\x68\141"];
        $SL = '';
        $EM = explode("\55\55\x2d\x2d\x2d", $vA);
        if (preg_match("\x2f\x5c\x72\134\x6e\174\x5c\162\x7c\x5c\156\x2f", $EM[2])) {
            goto fm;
        }
        $Uz = "\55\55\x2d\55\55" . $EM[1] . "\x2d\x2d\55\55\55\12";
        $hy = 0;
        mK:
        if (!($RQ = substr($EM[2], $hy, 64))) {
            goto mF;
        }
        $Uz .= $RQ . "\xa";
        $hy += 64;
        goto mK;
        mF:
        $Uz .= "\x2d\x2d\x2d\x2d\x2d" . $EM[3] . "\x2d\55\x2d\x2d\55\12";
        $SL = $Uz;
        goto GK;
        fm:
        $SL = $vA;
        GK:
        $ro = false;
        switch ($sU) {
            case "\62\x35\66":
                $ro = openssl_verify($NT, $aG, $SL, OPENSSL_ALGO_SHA256);
                goto MT;
            case "\63\x38\64":
                $ro = openssl_verify($NT, $aG, $SL, OPENSSL_ALGO_SHA384);
                goto MT;
            case "\x35\61\x32":
                $ro = openssl_verify($NT, $aG, $SL, OPENSSL_ALGO_SHA512);
                goto MT;
            default:
                $ro = false;
                goto MT;
        }
        pj:
        MT:
        return $ro;
    }
    public function verify($NT = '', $cD = '', $aG = '')
    {
        if (!(empty($NT) || empty($aG))) {
            goto z_;
        }
        return false;
        z_:
        $A7 = $this->algo["\141\x6c\147"];
        switch ($A7) {
            case "\110\123\x41":
                return $this->validate_hmac($NT, $cD, $aG);
            case "\122\x53\x41":
                return @$this->validate_rsa($NT, $cD, $aG);
            default:
                return false;
        }
        K_:
        Dg:
    }
}
