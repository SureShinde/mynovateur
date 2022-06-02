<?php


namespace MiniOrange\OAuth\Helper;

if (!function_exists("\143\x72\x79\160\x74\137\x72\x61\x6e\x64\157\x6d\137\x73\164\x72\151\156\x67")) {
    define("\x43\x52\x59\120\x54\137\122\x41\116\x44\x4f\115\x5f\x49\x53\137\x57\x49\x4e\x44\x4f\x57\x53", strtoupper(substr(PHP_OS, 0, 3)) === "\x57\x49\116");
    function crypt_random_string($MI)
    {
        if ($MI) {
            goto t4J;
        }
        return '';
        t4J:
        if (CRYPT_RANDOM_IS_WINDOWS) {
            goto sy3;
        }
        if (!(extension_loaded("\x6f\160\x65\156\x73\163\154") && version_compare(PHP_VERSION, "\65\x2e\63\56\60", "\76\x3d"))) {
            goto LjI;
        }
        return openssl_random_pseudo_bytes($MI);
        LjI:
        static $WC = true;
        if (!($WC === true)) {
            goto vL8;
        }
        $WC = @fopen("\x2f\x64\x65\166\x2f\165\x72\x61\156\x64\x6f\155", "\162\x62");
        vL8:
        if (!($WC !== true && $WC !== false)) {
            goto CYZ;
        }
        return fread($WC, $MI);
        CYZ:
        if (!extension_loaded("\x6d\x63\x72\171\160\164")) {
            goto fPh;
        }
        return @mcrypt_create_iv($MI, MCRYPT_DEV_URANDOM);
        fPh:
        goto KWt;
        sy3:
        if (!(extension_loaded("\x6d\143\x72\x79\x70\x74") && version_compare(PHP_VERSION, "\x35\x2e\x33\56\x30", "\76\75"))) {
            goto jeN;
        }
        return @mcrypt_create_iv($MI);
        jeN:
        if (!(extension_loaded("\x6f\160\x65\156\163\x73\154") && version_compare(PHP_VERSION, "\65\56\63\x2e\64", "\76\75"))) {
            goto EVw;
        }
        return openssl_random_pseudo_bytes($MI);
        EVw:
        KWt:
        static $NI = false, $sN;
        if (!($NI === false)) {
            goto eXi;
        }
        $U6 = session_id();
        $Gw = ini_get("\163\x65\163\x73\151\x6f\x6e\56\x75\163\x65\x5f\x63\157\x6f\153\151\145\163");
        $mG = session_cache_limiter();
        $nU = isset($_SESSION) ? $_SESSION : false;
        if (!($U6 != '')) {
            goto dF0;
        }
        session_write_close();
        dF0:
        session_id(1);
        ini_set("\x73\145\163\163\x69\x6f\156\56\x75\x73\145\x5f\x63\157\157\x6b\x69\x65\163", 0);
        session_cache_limiter('');
        session_start(["\162\145\x61\144\137\141\x6e\144\137\143\154\157\163\x65" => true]);
        $sN = $MO = $_SESSION["\163\145\x65\x64"] = pack("\110\52", sha1((isset($_SERVER) ? phpseclib_safe_serialize($_SERVER) : '') . (isset($_POST) ? phpseclib_safe_serialize($_POST) : '') . (isset($_GET) ? phpseclib_safe_serialize($_GET) : '') . (isset($_COOKIE) ? phpseclib_safe_serialize($_COOKIE) : '') . phpseclib_safe_serialize($GLOBALS) . phpseclib_safe_serialize($_SESSION) . phpseclib_safe_serialize($nU)));
        if (isset($_SESSION["\x63\157\x75\x6e\164"])) {
            goto wd_;
        }
        $_SESSION["\143\157\x75\156\x74"] = 0;
        wd_:
        $_SESSION["\x63\x6f\165\156\164"]++;
        session_write_close();
        if ($U6 != '') {
            goto llS;
        }
        if ($nU !== false) {
            goto egW;
        }
        unset($_SESSION);
        goto Zid;
        egW:
        $_SESSION = $nU;
        unset($nU);
        Zid:
        goto FOY;
        llS:
        session_id($U6);
        session_start(["\x72\145\x61\144\137\141\156\144\137\143\x6c\157\163\x65" => true]);
        ini_set("\x73\145\163\x73\151\157\x6e\x2e\x75\x73\145\137\143\x6f\x6f\x6b\x69\x65\x73", $Gw);
        session_cache_limiter($mG);
        FOY:
        $mx = pack("\110\x2a", sha1($MO . "\x41"));
        $au = pack("\x48\x2a", sha1($MO . "\x43"));
        switch (true) {
            case phpseclib_resolve_include_path("\x43\162\x79\160\164\57\101\105\123\x2e\160\150\x70"):
                if (class_exists("\103\x72\171\160\164\x5f\x41\105\123")) {
                    goto SGT;
                }
                include_once "\101\x45\x53\56\x70\150\x70";
                SGT:
                $NI = new Crypt_AES(CRYPT_AES_MODE_CTR);
                goto S_d;
            case phpseclib_resolve_include_path("\x43\162\x79\x70\164\x2f\124\x77\x6f\x66\151\163\150\56\160\150\160"):
                if (class_exists("\x43\x72\171\x70\x74\x5f\124\167\x6f\x66\x69\x73\x68")) {
                    goto dPn;
                }
                include_once "\x54\x77\x6f\x66\x69\x73\x68\x2e\x70\x68\160";
                dPn:
                $NI = new Crypt_Twofish(CRYPT_TWOFISH_MODE_CTR);
                goto S_d;
            case phpseclib_resolve_include_path("\103\x72\x79\160\164\x2f\x42\154\157\167\146\x69\x73\150\x2e\160\150\160"):
                if (class_exists("\103\x72\171\x70\164\137\x42\x6c\x6f\x77\146\151\163\x68")) {
                    goto p6s;
                }
                include_once "\102\154\157\167\x66\x69\163\x68\56\160\x68\x70";
                p6s:
                $NI = new Crypt_Blowfish(CRYPT_BLOWFISH_MODE_CTR);
                goto S_d;
            case phpseclib_resolve_include_path("\103\162\x79\x70\164\57\124\x72\x69\x70\x6c\145\x44\105\x53\56\160\150\x70"):
                if (class_exists("\x43\162\x79\160\x74\x5f\x54\x72\151\x70\154\x65\104\105\123")) {
                    goto K28;
                }
                include_once "\x54\x72\x69\x70\x6c\x65\x44\105\x53\x2e\x70\150\x70";
                K28:
                $NI = new Crypt_TripleDES(CRYPT_DES_MODE_CTR);
                goto S_d;
            case phpseclib_resolve_include_path("\x43\x72\x79\160\164\x2f\104\105\123\x2e\x70\x68\160"):
                if (class_exists("\103\x72\x79\x70\164\x5f\x44\105\x53")) {
                    goto y3w;
                }
                include_once "\104\x45\x53\x2e\x70\x68\160";
                y3w:
                $NI = new Crypt_DES(CRYPT_DES_MODE_CTR);
                goto S_d;
            case phpseclib_resolve_include_path("\103\x72\x79\160\164\57\x52\x43\x34\x2e\160\x68\160"):
                if (class_exists("\x43\x72\171\x70\164\137\x52\x43\64")) {
                    goto hMh;
                }
                include_once "\x52\103\64\x2e\x70\150\160";
                hMh:
                $NI = new Crypt_RC4();
                goto S_d;
            default:
                user_error("\143\162\x79\160\164\137\162\141\x6e\x64\x6f\155\137\163\x74\162\x69\x6e\147\x20\x72\x65\161\x75\151\162\145\163\x20\141\164\40\154\x65\x61\x73\164\40\157\x6e\145\x20\x73\171\155\155\x65\x74\x72\151\x63\x20\143\151\x70\150\145\162\40\x62\x65\x20\154\x6f\x61\x64\x65\x64");
                return false;
        }
        jke:
        S_d:
        $NI->setKey($mx);
        $NI->setIV($au);
        $NI->enableContinuousBuffer();
        eXi:
        $ga = '';
        eoC:
        if (!(strlen($ga) < $MI)) {
            goto PcY;
        }
        $vB = $NI->encrypt(microtime());
        $mv = $NI->encrypt($vB ^ $sN);
        $sN = $NI->encrypt($mv ^ $vB);
        $ga .= $mv;
        goto eoC;
        PcY:
        return substr($ga, 0, $MI);
    }
}
if (!function_exists("\160\x68\160\x73\x65\x63\154\x69\x62\x5f\163\141\x66\145\137\x73\145\x72\151\141\x6c\151\172\145")) {
    function phpseclib_safe_serialize(&$ix)
    {
        if (!is_object($ix)) {
            goto SdB;
        }
        return '';
        SdB:
        if (is_array($ix)) {
            goto EPD;
        }
        return serialize($ix);
        EPD:
        if (!isset($ix["\x5f\137\160\x68\160\x73\145\143\x6c\x69\x62\137\x6d\x61\162\x6b\x65\162"])) {
            goto REG;
        }
        return '';
        REG:
        $bu = array();
        $ix["\137\137\x70\x68\160\163\x65\143\154\151\x62\137\155\x61\x72\153\x65\x72"] = true;
        foreach (array_keys($ix) as $mx) {
            if (!($mx !== "\137\137\x70\150\x70\x73\145\143\x6c\x69\142\137\x6d\141\x72\x6b\x65\162")) {
                goto rhC;
            }
            $bu[$mx] = phpseclib_safe_serialize($ix[$mx]);
            rhC:
            XVL:
        }
        fro:
        unset($ix["\137\x5f\x70\x68\160\163\x65\143\x6c\151\142\137\x6d\141\162\x6b\x65\x72"]);
        return serialize($bu);
    }
}
if (!function_exists("\160\150\160\163\x65\143\x6c\151\142\137\162\145\163\157\x6c\x76\x65\x5f\151\156\x63\154\x75\144\145\x5f\x70\141\164\x68")) {
    function phpseclib_resolve_include_path($s8)
    {
        if (!function_exists("\163\164\162\145\x61\155\137\162\145\163\x6f\x6c\x76\x65\x5f\151\156\143\154\x75\x64\145\x5f\160\141\164\150")) {
            goto Xkz;
        }
        return stream_resolve_include_path($s8);
        Xkz:
        if (!file_exists($s8)) {
            goto mrn;
        }
        return realpath($s8);
        mrn:
        $JD = PATH_SEPARATOR == "\72" ? preg_split("\x23\50\77\x3c\x21\160\x68\x61\162\51\72\x23", get_include_path()) : explode(PATH_SEPARATOR, get_include_path());
        foreach ($JD as $Tq) {
            $E1 = substr($Tq, -1) == DIRECTORY_SEPARATOR ? '' : DIRECTORY_SEPARATOR;
            $dL = $Tq . $E1 . $s8;
            if (!file_exists($dL)) {
                goto Gc7;
            }
            return realpath($dL);
            Gc7:
            RaN:
        }
        s1C:
        return false;
    }
}
