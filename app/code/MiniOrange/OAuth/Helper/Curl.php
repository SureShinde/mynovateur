<?php


namespace MiniOrange\OAuth\Helper;

use MiniOrange\OAuth\Helper\OAuthConstants;
class Curl
{
    public static function create_customer($Pg, $jM, $OQ, $ZW = '', $K5 = '', $wA = '')
    {
        $kg = OAuthConstants::HOSTNAME . "\57\x6d\x6f\141\x73\x2f\x72\145\x73\x74\x2f\143\x75\163\x74\157\155\145\162\x2f\x61\144\x64";
        $ZD = OAuthConstants::DEFAULT_CUSTOMER_KEY;
        $dr = OAuthConstants::DEFAULT_API_KEY;
        $Y7 = ["\x63\157\155\x70\x61\156\171\116\141\155\x65" => $jM, "\x61\x72\x65\x61\x4f\146\111\x6e\164\145\162\145\163\164" => OAuthConstants::AREA_OF_INTEREST, "\146\x69\x72\x73\x74\156\x61\155\145" => $K5, "\154\x61\163\164\x6e\x61\x6d\x65" => $wA, "\145\x6d\x61\151\x6c" => $Pg, "\160\150\x6f\x6e\x65" => $ZW, "\160\141\163\x73\167\x6f\162\144" => $OQ];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function get_customer_key($Pg, $OQ)
    {
        $kg = OAuthConstants::HOSTNAME . "\57\155\157\141\163\x2f\x72\x65\x73\164\57\143\165\x73\164\x6f\x6d\145\162\x2f\153\x65\171";
        $ZD = OAuthConstants::DEFAULT_CUSTOMER_KEY;
        $dr = OAuthConstants::DEFAULT_API_KEY;
        $Y7 = ["\x65\x6d\141\151\x6c" => $Pg, "\160\141\163\x73\x77\157\x72\x64" => $OQ];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function check_customer($Pg)
    {
        $kg = OAuthConstants::HOSTNAME . "\x2f\x6d\157\141\163\x2f\162\x65\163\164\57\143\165\163\164\x6f\x6d\x65\162\57\143\150\x65\143\x6b\55\x69\x66\55\145\x78\151\163\x74\x73";
        $ZD = OAuthConstants::DEFAULT_CUSTOMER_KEY;
        $dr = OAuthConstants::DEFAULT_API_KEY;
        $Y7 = ["\145\x6d\141\151\154" => $Pg];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function mo_send_otp_token($LU, $Pg = '', $ZW = '')
    {
        $kg = OAuthConstants::HOSTNAME . "\x2f\155\157\141\x73\x2f\141\x70\x69\x2f\141\165\x74\x68\57\143\x68\141\x6c\x6c\145\x6e\147\x65";
        $ZD = OAuthConstants::DEFAULT_CUSTOMER_KEY;
        $dr = OAuthConstants::DEFAULT_API_KEY;
        $Y7 = ["\x63\x75\x73\x74\157\x6d\145\x72\x4b\145\x79" => $ZD, "\145\x6d\141\151\x6c" => $Pg, "\160\x68\157\156\145" => $ZW, "\x61\165\x74\150\x54\x79\160\x65" => $LU, "\x74\162\141\156\x73\141\x63\164\151\157\156\116\x61\x6d\x65" => OAuthConstants::AREA_OF_INTEREST];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function mo_send_access_token_request($Kz, $kg, $AP, $GA)
    {
        $Es = ["\x43\157\x6e\x74\x65\156\x74\x2d\124\x79\160\145\72\x20\x61\160\x70\x6c\151\x63\141\164\x69\157\x6e\57\x78\x2d\x77\167\x77\55\146\x6f\x72\155\55\165\162\154\145\x6e\143\157\144\x65\x64", "\101\x75\x74\x68\157\x72\x69\x7a\x61\164\x69\x6f\x6e\72\40\102\141\163\x69\x63\x20" . base64_encode($AP . "\x3a" . $GA)];
        $zV = self::callAPI($kg, $Kz, $Es);
        return $zV;
    }
    public static function mo_send_user_info_request($kg, $xv)
    {
        $zV = self::callAPI($kg, [], $xv);
        return $zV;
    }
    public static function validate_otp_token($GK, $it)
    {
        $kg = OAuthConstants::HOSTNAME . "\x2f\x6d\157\x61\x73\x2f\x61\x70\151\57\x61\165\164\x68\x2f\166\x61\x6c\151\144\x61\x74\145";
        $ZD = OAuthConstants::DEFAULT_CUSTOMER_KEY;
        $dr = OAuthConstants::DEFAULT_API_KEY;
        $Y7 = ["\164\x78\111\x64" => $GK, "\164\157\153\x65\x6e" => $it];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function submit_contact_us($vi, $Nz, $nS, $K5, $wA, $Ya)
    {
        $kg = OAuthConstants::HOSTNAME . "\x2f\155\x6f\x61\163\x2f\x72\x65\163\x74\57\143\x75\163\x74\x6f\155\x65\162\x2f\x63\x6f\x6e\x74\141\x63\x74\55\165\x73";
        $nS = "\133" . OAuthConstants::AREA_OF_INTEREST . "\135\x3a\40" . $nS;
        $ZD = OAuthConstants::DEFAULT_CUSTOMER_KEY;
        $dr = OAuthConstants::DEFAULT_API_KEY;
        $Y7 = ["\x66\x69\162\x73\x74\x4e\x61\155\x65" => $K5, "\x6c\x61\x73\164\116\x61\155\x65" => $wA, "\143\157\x6d\x70\x61\x6e\x79" => $Ya, "\145\x6d\141\x69\154" => $vi, "\x70\x68\157\156\x65" => $Nz, "\x71\165\145\162\171" => $nS, "\143\143\x45\x6d\x61\151\x6c" => "\157\x61\x75\x74\x68\x73\165\160\x70\x6f\x72\x74\x40\170\x65\143\x75\162\151\146\171\x2e\143\x6f\155"];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return true;
    }
    public static function forgot_password($Pg, $ZD, $dr)
    {
        $kg = OAuthConstants::HOSTNAME . "\57\x6d\x6f\141\x73\57\162\x65\163\164\x2f\143\x75\163\x74\x6f\x6d\x65\162\x2f\x70\141\x73\x73\167\x6f\x72\x64\55\162\x65\x73\145\164";
        $Y7 = ["\x65\155\141\x69\154" => $Pg];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function check_customer_ln($ZD, $dr)
    {
        $kg = OAuthConstants::HOSTNAME . "\57\155\x6f\x61\x73\57\x72\145\x73\x74\57\x63\x75\163\x74\x6f\x6d\145\162\x2f\x6c\x69\143\145\156\163\x65";
        $Y7 = ["\x63\x75\163\x74\157\155\x65\162\111\x64" => $ZD, "\141\160\x70\154\x69\143\141\164\x69\x6f\156\x4e\141\155\x65" => OAuthConstants::APPLICATION_NAME, "\154\151\x63\x65\156\163\145\x54\171\160\145" => !MoUtility::micr() ? "\104\x45\x4d\x4f" : "\x50\122\x45\115\111\x55\115"];
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    private static function createAuthHeader($ZD, $dr)
    {
        $DY = round(microtime(true) * 1000);
        $DY = number_format($DY, 0, '', '');
        $m7 = $ZD . $DY . $dr;
        $Es = hash("\163\x68\x61\65\61\62", $m7);
        $Vs = ["\103\x6f\156\x74\145\156\164\x2d\x54\171\x70\145\x3a\x20\141\x70\160\154\x69\143\141\x74\151\x6f\x6e\57\152\x73\x6f\x6e", "\x43\165\163\164\x6f\x6d\x65\162\55\x4b\x65\x79\x3a\x20{$ZD}", "\124\151\x6d\145\163\164\x61\155\x70\72\40{$DY}", "\101\x75\x74\150\x6f\x72\x69\x7a\x61\164\151\157\156\72\x20{$Es}"];
        return $Vs;
    }
    private static function callAPI($kg, $Dv = array(), $xv = array("\x43\x6f\156\x74\x65\156\x74\x2d\x54\x79\x70\x65\72\x20\x61\x70\x70\154\151\143\x61\164\x69\157\x6e\x2f\152\x73\x6f\x6e"))
    {
        $ob = new MoCurl();
        $Od = ["\x43\125\x52\x4c\117\x50\124\137\x46\117\114\114\x4f\x57\x4c\117\103\101\124\x49\x4f\x4e" => true, "\103\x55\122\114\117\120\124\x5f\x45\116\x43\x4f\x44\111\x4e\x47" => '', "\x43\x55\122\114\x4f\120\124\137\122\105\x54\125\x52\116\x54\122\101\116\x53\x46\x45\122" => true, "\x43\x55\x52\x4c\117\x50\124\x5f\x41\125\124\117\122\x45\x46\x45\x52\105\122" => true, "\x43\125\122\114\x4f\x50\x54\x5f\x54\111\x4d\105\117\x55\x54" => 0, "\103\125\122\x4c\117\x50\124\x5f\x4d\x41\130\x52\x45\x44\x49\x52\x53" => 10];
        $b2 = in_array("\103\x6f\x6e\x74\145\156\x74\55\x54\x79\x70\145\72\40\x61\160\160\154\x69\143\x61\x74\151\157\156\x2f\x78\55\167\167\167\55\x66\157\162\x6d\x2d\165\162\154\x65\x6e\143\157\x64\x65\x64", $xv) ? !empty($Dv) ? http_build_query($Dv) : '' : (!empty($Dv) ? json_encode($Dv) : '');
        $Js = !empty($b2) ? "\120\117\x53\124" : "\x47\x45\x54";
        $ob->setConfig($Od);
        $ob->write($Js, $kg, "\x31\56\61", $xv, $b2);
        $uF = $ob->read();
        $ob->close();
        return $uF;
    }
    public static function mius($ZD, $dr, $XG)
    {
        $kg = OAuthConstants::HOSTNAME . "\x2f\155\x6f\141\x73\57\x61\160\x69\x2f\x62\141\143\153\x75\x70\x63\x6f\144\145\57\165\x70\144\141\x74\145\x73\164\x61\x74\x75\x73";
        $Y7 = array("\x63\157\x64\145" => $XG, "\143\x75\x73\x74\157\155\145\162\113\x65\171" => $ZD);
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function vml($ZD, $dr, $XG, $f1)
    {
        $kg = OAuthConstants::HOSTNAME . "\x2f\155\157\x61\163\x2f\141\160\151\57\142\x61\x63\153\165\160\x63\x6f\x64\145\x2f\166\145\162\x69\146\x79";
        $Y7 = array("\x63\157\144\145" => $XG, "\x63\x75\x73\x74\157\x6d\x65\x72\x4b\145\x79" => $ZD, "\x61\144\144\x69\164\151\157\156\x61\154\106\151\145\x6c\x64\163" => array("\146\x69\x65\x6c\x64\x31" => $f1));
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
    public static function ccl($ZD, $dr)
    {
        $kg = OAuthConstants::HOSTNAME . "\x2f\x6d\157\x61\163\x2f\162\145\163\x74\x2f\143\x75\x73\x74\x6f\155\145\162\57\x6c\151\x63\x65\x6e\163\145";
        $Y7 = array("\143\165\x73\x74\157\x6d\x65\162\x49\144" => $ZD, "\x61\160\160\154\x69\x63\x61\x74\x69\x6f\x6e\116\141\155\x65" => "\155\141\147\145\x6e\x74\157\x5f\163\x61\155\154\x5f\160\x72\145\155\x69\165\155\x5f\160\x6c\x61\x6e");
        $Es = self::createAuthHeader($ZD, $dr);
        $zV = self::callAPI($kg, $Y7, $Es);
        return $zV;
    }
}
