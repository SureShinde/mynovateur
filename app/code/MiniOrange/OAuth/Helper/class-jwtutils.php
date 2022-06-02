<?php


namespace MiniOrange\OAuth\Helper;

use MoOauthClient\GrantTypes\JWSVerify;
use MoOauthClient\GrantTypes\Crypt_RSA;
use MoOauthClient\GrantTypes\Math_BigInteger;
class JWTUtils
{
    const HEADER = "\110\105\x41\104\105\122";
    const PAYLOAD = "\x50\x41\131\x4c\x4f\101\104";
    const SIGN = "\123\111\x47\116";
    private $jwt;
    private $decoded_jwt;
    public function __construct($TD)
    {
        $TD = \explode("\56", $TD);
        if (!(3 > count($TD))) {
            goto sL;
        }
        return new WP_Error("\151\x6e\x76\141\154\x69\144\x5f\152\167\164", __("\112\127\124\x20\x52\x65\143\145\151\166\145\x64\x20\151\x73\x20\156\157\x74\40\141\x20\x76\141\x6c\x69\144\x20\112\x57\124"));
        sL:
        $this->jwt = $TD;
        $Vs = $this->get_jwt_claim('', self::HEADER);
        $fX = $this->get_jwt_claim('', self::PAYLOAD);
        $this->decoded_jwt = array("\x68\145\x61\x64\145\x72" => $Vs, "\x70\x61\171\154\157\x61\144" => $fX);
    }
    private function get_jwt_claim($gL = '', $hO = '')
    {
        $Ov = '';
        switch ($hO) {
            case self::HEADER:
                $Ov = $this->jwt[0];
                goto A8;
            case self::PAYLOAD:
                $Ov = $this->jwt[1];
                goto A8;
            case self::SIGN:
                return $this->jwt[2];
            default:
                wp_die(wp_kses("\103\x61\x6e\156\x6f\164\40\x46\151\156\x64\40" . $hO . "\x20\151\x6e\40\164\150\145\x20\x4a\127\x54", \get_valid_html()));
        }
        v_:
        A8:
        $Ov = json_decode(base64_decode($Ov), true);
        if (!(!$Ov || empty($Ov))) {
            goto ZN;
        }
        return null;
        ZN:
        return empty($gL) ? $Ov : (isset($Ov[$gL]) ? $Ov[$gL] : null);
    }
    public function check_algo($Ym = '')
    {
        $xd = $this->get_jwt_claim("\141\154\147", self::HEADER);
        $xd = explode("\x53", $xd);
        if (isset($xd[0])) {
            goto H8;
        }
        wp_die(wp_kses("\x49\156\x76\141\x6c\151\144\40\x52\x65\x73\x70\157\x6e\163\145\x20\x52\145\x63\x65\151\x76\x65\144\40\146\x72\157\155\x20\117\x41\165\x74\150\x2f\x4f\x70\145\156\111\x44\x20\x50\162\157\166\151\144\145\162\x2e", \get_valid_html()));
        H8:
        switch ($xd[0]) {
            case "\110":
                return "\x48\123\x41" === $Ym;
            case "\x52":
                return "\x52\123\101" === $Ym;
            default:
                return false;
        }
        GZ:
        sf:
    }
    public function verify($cD = '')
    {
        if (!empty($cD)) {
            goto vR;
        }
        return false;
        vR:
        $FJ = $this->get_jwt_claim("\x65\x78\160", self::PAYLOAD);
        if (!(is_null($FJ) || time() > $FJ)) {
            goto bK;
        }
        wp_die(wp_kses("\112\127\x54\x20\x68\x61\163\x20\142\145\145\156\x20\x65\170\160\x69\x72\x65\x64\56\x20\x50\154\x65\141\163\x65\x20\x74\162\x79\x20\x4c\157\147\147\x69\x6e\x67\x20\x69\156\40\141\x67\141\x69\156\56", \get_valid_html()));
        bK:
        $v7 = $this->get_jwt_claim("\156\x62\146", self::PAYLOAD);
        if (!(!is_null($v7) || time() < $v7)) {
            goto Vo;
        }
        wp_die(wp_kses("\x49\164\40\x69\163\40\x74\x6f\x6f\x20\145\141\x72\154\x79\x20\164\157\x20\x75\x73\x65\40\164\x68\x69\163\40\x4a\127\x54\x2e\40\x50\x6c\x65\141\x73\x65\40\164\162\x79\x20\x4c\x6f\147\147\151\x6e\147\x20\x69\x6e\x20\x61\x67\x61\x69\156\x2e", \get_valid_html()));
        Vo:
        $YD = new JWSVerify($this->get_jwt_claim("\x61\154\x67", self::HEADER));
        $NT = $this->get_header() . "\x2e" . $this->get_payload();
        return $YD->verify(\utf8_decode($NT), $cD, base64_decode(strtr($this->get_jwt_claim(false, self::SIGN), "\x2d\137", "\x2b\x2f")));
    }
    public function verify_from_jwks($pF = '', $xd = "\x52\123\x32\x35\x36")
    {
        global $H5;
        $DC = wp_remote_get($pF);
        if (!is_wp_error($DC)) {
            goto Po;
        }
        return false;
        Po:
        $DC = json_decode($DC["\142\x6f\144\x79"], true);
        $ro = false;
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto bL;
        }
        return $ro;
        bL:
        foreach ($DC["\153\x65\171\163"] as $mx => $Vw) {
            if (!(!isset($Vw["\153\164\x79"]) || "\x52\123\x41" !== $Vw["\x6b\164\171"] || !isset($Vw["\145"]) || !isset($Vw["\x6e"]))) {
                goto W5;
            }
            goto QG;
            W5:
            $ro = $ro || $this->verify($this->jwks_to_pem(["\x6e" => new Math_BigInteger($H5->base64url_decode($Vw["\156"]), 256), "\x65" => new Math_BigInteger($H5->base64url_decode($Vw["\x65"]), 256)]));
            if (!(true === $ro)) {
                goto qj;
            }
            goto ta;
            qj:
            QG:
        }
        ta:
        return $ro;
    }
    private function jwks_to_pem($l0 = array())
    {
        $kx = new Crypt_RSA();
        $kx->loadKey($l0);
        return $kx->getPublicKey();
    }
    public function get_decoded_header()
    {
        return $this->decoded_jwt["\150\x65\x61\144\145\x72"];
    }
    public function get_decoded_payload()
    {
        return $this->decoded_jwt["\160\141\x79\154\x6f\x61\144"];
    }
    public function get_header()
    {
        return $this->jwt[0];
    }
    public function get_payload()
    {
        return $this->jwt[1];
    }
}
