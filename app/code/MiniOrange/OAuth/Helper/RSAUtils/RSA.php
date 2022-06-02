<?php


namespace MiniOrange\OAuth\Helper;

if (!function_exists("\x63\162\171\160\164\x5f\162\141\156\144\157\155\137\163\164\162\x69\156\147")) {
    include_once "\122\141\156\144\157\155\x2e\x70\150\160";
}
if (class_exists("\x43\x72\x79\x70\x74\137\110\x61\x73\x68")) {
    goto VKo;
}
include_once "\x48\141\x73\x68\x2e\x70\150\160";
VKo:
define("\103\x52\x59\120\x54\x5f\x52\x53\x41\137\x45\x4e\x43\122\131\x50\124\x49\x4f\x4e\x5f\x4f\101\x45\x50", 1);
define("\x43\x52\x59\x50\124\x5f\x52\x53\x41\137\x45\116\x43\122\x59\120\x54\x49\x4f\x4e\x5f\x50\113\103\123\x31", 2);
define("\x43\x52\131\x50\124\x5f\122\123\101\x5f\x45\116\x43\x52\131\x50\124\x49\x4f\116\x5f\116\x4f\116\x45", 3);
define("\103\122\x59\x50\124\x5f\122\x53\x41\x5f\123\111\107\x4e\101\124\x55\x52\x45\137\120\x53\123", 1);
define("\x43\x52\x59\x50\x54\137\122\123\x41\137\123\x49\107\116\101\124\x55\122\105\x5f\x50\x4b\103\x53\x31", 2);
define("\103\122\x59\x50\x54\x5f\x52\x53\x41\x5f\101\123\116\x31\x5f\111\116\x54\105\x47\x45\x52", 2);
define("\103\122\131\120\x54\137\x52\123\x41\137\x41\x53\116\x31\137\102\111\x54\x53\124\x52\111\x4e\107", 3);
define("\103\122\131\120\x54\x5f\x52\x53\x41\137\101\123\x4e\x31\137\117\103\x54\105\x54\123\x54\122\x49\x4e\x47", 4);
define("\x43\122\131\x50\124\137\x52\123\x41\137\x41\x53\x4e\x31\x5f\117\102\112\105\103\124", 6);
define("\103\122\x59\120\x54\x5f\x52\x53\101\x5f\x41\123\116\x31\x5f\x53\105\x51\x55\105\116\x43\105", 48);
define("\103\122\131\120\124\x5f\x52\x53\x41\137\x4d\x4f\104\105\x5f\111\116\x54\x45\x52\x4e\x41\x4c", 1);
define("\x43\x52\x59\120\x54\x5f\122\x53\x41\x5f\x4d\117\x44\105\137\x4f\120\x45\116\x53\123\114", 2);
define("\103\122\131\x50\x54\x5f\x52\x53\x41\x5f\x4f\x50\105\x4e\x53\123\x4c\137\x43\117\116\106\x49\x47", dirname(__FILE__) . "\x2f\x2e\x2e\x2f\157\x70\145\156\x73\x73\154\x2e\143\156\146");
define("\103\x52\x59\x50\124\x5f\x52\123\101\137\x50\x52\x49\x56\101\124\105\x5f\106\117\122\115\101\x54\137\120\x4b\x43\x53\61", 0);
define("\103\122\x59\x50\x54\x5f\x52\123\x41\x5f\120\x52\111\x56\x41\124\105\137\x46\117\x52\115\x41\x54\137\120\125\x54\x54\131", 1);
define("\103\122\131\x50\124\137\x52\x53\101\x5f\x50\x52\111\126\x41\x54\105\x5f\106\x4f\x52\x4d\101\124\137\x58\x4d\x4c", 2);
define("\103\122\131\x50\x54\137\122\x53\x41\137\120\x52\111\x56\x41\124\105\x5f\106\x4f\x52\115\101\124\137\120\x4b\x43\123\70", 8);
define("\103\122\x59\x50\x54\137\x52\x53\101\x5f\120\125\x42\x4c\x49\x43\137\106\x4f\x52\115\101\124\x5f\x52\x41\127", 3);
define("\103\x52\131\120\x54\137\x52\123\x41\x5f\120\125\102\114\111\103\137\x46\117\122\x4d\x41\124\x5f\120\x4b\103\x53\x31", 4);
define("\x43\122\x59\x50\124\137\122\x53\x41\x5f\120\x55\x42\x4c\111\x43\x5f\106\117\x52\x4d\101\x54\x5f\x50\x4b\x43\x53\x31\x5f\x52\101\x57", 4);
define("\103\122\131\x50\124\137\x52\123\101\137\x50\x55\x42\114\111\x43\137\106\117\x52\115\x41\124\x5f\x58\115\114", 5);
define("\x43\x52\x59\120\124\x5f\122\x53\101\x5f\120\125\102\x4c\111\x43\137\106\117\x52\x4d\101\124\x5f\117\120\x45\116\x53\x53\x48", 6);
define("\x43\x52\x59\120\x54\x5f\x52\123\101\x5f\x50\125\x42\114\x49\x43\137\x46\x4f\122\115\x41\x54\x5f\120\113\x43\123\70", 7);
class Crypt_RSA
{
    var $zero;
    var $one;
    var $privateKeyFormat = CRYPT_RSA_PRIVATE_FORMAT_PKCS1;
    var $publicKeyFormat = CRYPT_RSA_PUBLIC_FORMAT_PKCS8;
    var $modulus;
    var $k;
    var $exponent;
    var $primes;
    var $exponents;
    var $coefficients;
    var $hashName;
    var $hash;
    var $hLen;
    var $sLen;
    var $mgfHash;
    var $mgfHLen;
    var $encryptionMode = CRYPT_RSA_ENCRYPTION_OAEP;
    var $signatureMode = CRYPT_RSA_SIGNATURE_PSS;
    var $publicExponent = false;
    var $password = false;
    var $components = array();
    var $current;
    var $configFile;
    var $comment = "\160\150\x70\163\145\x63\154\151\142\55\x67\x65\x6e\x65\x72\141\164\145\144\55\x6b\145\171";
    function __construct()
    {
        if (class_exists("\x4d\x61\x74\x68\x5f\x42\x69\x67\111\156\x74\x65\x67\x65\x72")) {
            goto Riz;
        }
        include_once dirname(__FILE__) . "\57\115\x61\x74\x68\57\x42\x69\147\x49\156\164\x65\147\x65\x72\56\x70\x68\160";
        Riz:
        $this->configFile = CRYPT_RSA_OPENSSL_CONFIG;
        if (defined("\103\122\x59\120\124\137\x52\x53\101\137\x4d\x4f\104\x45")) {
            goto ppY;
        }
        switch (true) {
            case defined("\x4d\x41\x54\110\137\x42\111\107\x49\116\124\x45\x47\x45\x52\x5f\117\x50\x45\x4e\123\123\x4c\x5f\104\x49\123\101\x42\x4c\105"):
                define("\x43\122\x59\120\124\137\x52\123\101\137\115\117\104\x45", CRYPT_RSA_MODE_INTERNAL);
                goto vtM;
            case !function_exists("\x6f\160\145\156\x73\x73\x6c\137\x70\153\145\171\x5f\x67\x65\x74\x5f\144\145\164\x61\151\154\163"):
                define("\x43\122\x59\x50\124\137\122\123\101\x5f\x4d\x4f\104\105", CRYPT_RSA_MODE_INTERNAL);
                goto vtM;
            case extension_loaded("\x6f\160\145\156\163\163\154") && version_compare(PHP_VERSION, "\64\56\x32\56\x30", "\76\x3d") && file_exists($this->configFile):
                ob_start();
                @phpinfo();
                $uF = ob_get_contents();
                ob_end_clean();
                preg_match_all("\x23\117\160\145\x6e\123\123\114\x20\50\x48\145\141\144\x65\162\174\114\151\142\162\141\162\171\x29\x20\126\145\162\163\x69\157\156\50\x2e\52\51\43\151\155", $uF, $fR);
                $N3 = array();
                if (empty($fR[1])) {
                    goto HuP;
                }
                $vB = 0;
                gHs:
                if (!($vB < count($fR[1]))) {
                    goto PqT;
                }
                $WN = trim(str_replace("\75\x3e", '', strip_tags($fR[2][$vB])));
                if (!preg_match("\x2f\50\x5c\x64\53\134\x2e\x5c\x64\x2b\x5c\x2e\x5c\x64\x2b\51\x2f\151", $WN, $OM)) {
                    goto NeN;
                }
                $N3[$fR[1][$vB]] = $OM[0];
                goto BGG;
                NeN:
                $N3[$fR[1][$vB]] = $WN;
                BGG:
                iaJ:
                $vB++;
                goto gHs;
                PqT:
                HuP:
                switch (true) {
                    case !isset($N3["\110\x65\141\x64\x65\162"]):
                    case !isset($N3["\x4c\151\x62\x72\x61\x72\171"]):
                    case $N3["\x48\x65\x61\x64\x65\162"] == $N3["\x4c\151\142\162\x61\x72\x79"]:
                    case version_compare($N3["\x48\x65\x61\x64\145\x72"], "\x31\x2e\60\56\x30") >= 0 && version_compare($N3["\114\151\x62\x72\141\162\171"], "\61\x2e\60\x2e\x30") >= 0:
                        define("\x43\x52\131\x50\x54\x5f\x52\123\x41\137\115\x4f\x44\x45", CRYPT_RSA_MODE_OPENSSL);
                        goto t41;
                    default:
                        define("\x43\x52\x59\x50\124\x5f\122\x53\101\137\115\117\104\105", CRYPT_RSA_MODE_INTERNAL);
                        define("\x4d\101\124\110\x5f\x42\111\107\x49\x4e\x54\105\x47\105\x52\x5f\x4f\120\x45\116\123\123\x4c\x5f\x44\x49\123\101\102\x4c\x45", true);
                }
                Tep:
                t41:
                goto vtM;
            default:
                define("\103\122\131\x50\124\x5f\122\123\101\137\x4d\x4f\x44\x45", CRYPT_RSA_MODE_INTERNAL);
        }
        jw7:
        vtM:
        ppY:
        $this->zero = new Math_BigInteger();
        $this->one = new Math_BigInteger(1);
        $this->hash = new Crypt_Hash("\163\150\x61\x31");
        $this->hLen = $this->hash->getLength();
        $this->hashName = "\x73\150\x61\61";
        $this->mgfHash = new Crypt_Hash("\163\x68\x61\x31");
        $this->mgfHLen = $this->mgfHash->getLength();
    }
    function Crypt_RSA()
    {
        $this->__construct();
    }
    function createKey($ST = 1024, $Jy = false, $B3 = array())
    {
        if (defined("\103\122\131\x50\x54\137\x52\x53\x41\137\105\130\120\x4f\116\105\x4e\124")) {
            goto GYV;
        }
        define("\x43\122\x59\120\124\x5f\122\x53\101\137\105\x58\x50\117\x4e\x45\x4e\124", "\x36\65\x35\x33\67");
        GYV:
        if (defined("\103\x52\131\x50\x54\x5f\122\x53\101\x5f\x53\x4d\x41\114\114\105\x53\x54\137\x50\122\111\115\x45")) {
            goto bvC;
        }
        define("\103\x52\x59\x50\x54\x5f\x52\123\x41\x5f\123\x4d\x41\114\x4c\105\123\x54\x5f\x50\x52\x49\115\x45", 4096);
        bvC:
        if (!(CRYPT_RSA_MODE == CRYPT_RSA_MODE_OPENSSL && $ST >= 384 && CRYPT_RSA_EXPONENT == 65537)) {
            goto H2a;
        }
        $Pt = array();
        if (!isset($this->configFile)) {
            goto Swg;
        }
        $Pt["\143\x6f\x6e\146\x69\147"] = $this->configFile;
        Swg:
        $kx = openssl_pkey_new(array("\x70\162\151\x76\141\x74\145\137\153\145\171\137\142\x69\x74\163" => $ST) + $Pt);
        openssl_pkey_export($kx, $C2, null, $Pt);
        $eK = openssl_pkey_get_details($kx);
        $eK = $eK["\x6b\145\x79"];
        $C2 = call_user_func_array(array($this, "\x5f\x63\x6f\x6e\x76\x65\162\164\x50\162\151\x76\x61\164\145\x4b\145\x79"), array_values($this->_parseKey($C2, CRYPT_RSA_PRIVATE_FORMAT_PKCS1)));
        $eK = call_user_func_array(array($this, "\137\x63\157\156\x76\x65\x72\x74\120\x75\142\x6c\151\143\113\x65\x79"), array_values($this->_parseKey($eK, CRYPT_RSA_PUBLIC_FORMAT_PKCS1)));
        f_R:
        if (!(openssl_error_string() !== false)) {
            goto KJV;
        }
        goto f_R;
        KJV:
        return array("\x70\162\151\x76\141\164\145\x6b\145\171" => $C2, "\160\x75\x62\x6c\151\x63\x6b\x65\x79" => $eK, "\160\x61\x72\x74\x69\x61\x6c\x6b\x65\171" => false);
        H2a:
        static $P0;
        if (isset($P0)) {
            goto pXI;
        }
        $P0 = new Math_BigInteger(CRYPT_RSA_EXPONENT);
        pXI:
        extract($this->_generateMinMax($ST));
        $Mv = $lC;
        $DA = $ST >> 1;
        if ($DA > CRYPT_RSA_SMALLEST_PRIME) {
            goto K5L;
        }
        $ur = 2;
        goto cpT;
        K5L:
        $ur = floor($ST / CRYPT_RSA_SMALLEST_PRIME);
        $DA = CRYPT_RSA_SMALLEST_PRIME;
        cpT:
        extract($this->_generateMinMax($DA + $ST % $DA));
        $TM = $fu;
        extract($this->_generateMinMax($DA));
        $mu = new Math_BigInteger();
        $Td = $this->one->copy();
        if (!empty($B3)) {
            goto Jrq;
        }
        $kQ = $hP = $VT = array();
        $Lf = array("\164\157\160" => $this->one->copy(), "\142\x6f\164\164\x6f\x6d" => false);
        goto Hqt;
        Jrq:
        extract(unserialize($B3));
        Hqt:
        $kb = time();
        $to = count($VT) + 1;
        G6p:
        $vB = $to;
        tRm:
        if (!($vB <= $ur)) {
            goto gHW;
        }
        if (!($Jy !== false)) {
            goto clU;
        }
        $Jy -= time() - $kb;
        $kb = time();
        if (!($Jy <= 0)) {
            goto g0E;
        }
        return array("\x70\162\x69\166\141\164\x65\153\145\171" => '', "\160\x75\142\154\x69\x63\x6b\x65\171" => '', "\160\x61\162\164\x69\x61\x6c\x6b\x65\171" => serialize(array("\160\162\x69\x6d\145\163" => $VT, "\143\157\x65\x66\146\151\x63\151\145\x6e\x74\x73" => $hP, "\x6c\x63\x6d" => $Lf, "\x65\170\x70\157\x6e\145\156\164\163" => $kQ)));
        g0E:
        clU:
        if ($vB == $ur) {
            goto MS4;
        }
        $VT[$vB] = $mu->randomPrime($lC, $fu, $Jy);
        goto jbn;
        MS4:
        list($lC, $DA) = $Mv->divide($Td);
        if ($DA->equals($this->zero)) {
            goto Cks;
        }
        $lC = $lC->add($this->one);
        Cks:
        $VT[$vB] = $mu->randomPrime($lC, $TM, $Jy);
        jbn:
        if (!($VT[$vB] === false)) {
            goto MAz;
        }
        if (count($VT) > 1) {
            goto HPc;
        }
        array_pop($VT);
        $r4 = serialize(array("\x70\x72\151\155\145\163" => $VT, "\143\157\145\146\x66\x69\143\151\x65\156\x74\x73" => $hP, "\x6c\x63\x6d" => $Lf, "\x65\x78\160\x6f\x6e\x65\x6e\x74\x73" => $kQ));
        goto KBZ;
        HPc:
        $r4 = '';
        KBZ:
        return array("\x70\162\x69\x76\x61\x74\x65\x6b\145\171" => '', "\160\165\142\154\151\x63\x6b\145\x79" => '', "\160\x61\x72\164\x69\x61\x6c\153\x65\x79" => $r4);
        MAz:
        if (!($vB > 2)) {
            goto OfB;
        }
        $hP[$vB] = $Td->modInverse($VT[$vB]);
        OfB:
        $Td = $Td->multiply($VT[$vB]);
        $DA = $VT[$vB]->subtract($this->one);
        $Lf["\164\157\x70"] = $Lf["\164\157\160"]->multiply($DA);
        $Lf["\142\157\x74\164\157\x6d"] = $Lf["\x62\157\x74\164\157\155"] === false ? $DA : $Lf["\142\157\164\164\x6f\155"]->gcd($DA);
        $kQ[$vB] = $P0->modInverse($DA);
        JeD:
        $vB++;
        goto tRm;
        gHW:
        list($DA) = $Lf["\x74\157\160"]->divide($Lf["\x62\x6f\x74\x74\x6f\x6d"]);
        $Yv = $DA->gcd($P0);
        $to = 1;
        if (!$Yv->equals($this->one)) {
            goto G6p;
        }
        ADI:
        $zF = $P0->modInverse($DA);
        $hP[2] = $VT[2]->modInverse($VT[1]);
        return array("\x70\x72\x69\x76\x61\x74\145\x6b\x65\171" => $this->_convertPrivateKey($Td, $P0, $zF, $VT, $kQ, $hP), "\160\x75\142\154\x69\143\x6b\145\x79" => $this->_convertPublicKey($Td, $P0), "\160\141\x72\164\x69\141\154\x6b\145\x79" => false);
    }
    function _convertPrivateKey($Td, $P0, $zF, $VT, $kQ, $hP)
    {
        $HS = $this->privateKeyFormat != CRYPT_RSA_PRIVATE_FORMAT_XML;
        $ur = count($VT);
        $pk = array("\x76\x65\x72\x73\151\157\x6e" => $ur == 2 ? chr(0) : chr(1), "\155\157\144\165\154\165\163" => $Td->toBytes($HS), "\160\x75\142\154\151\143\105\x78\x70\157\x6e\145\156\x74" => $P0->toBytes($HS), "\160\162\151\x76\141\x74\x65\105\x78\160\x6f\x6e\x65\x6e\x74" => $zF->toBytes($HS), "\x70\x72\151\x6d\145\61" => $VT[1]->toBytes($HS), "\x70\x72\x69\x6d\x65\62" => $VT[2]->toBytes($HS), "\x65\170\160\x6f\156\x65\x6e\x74\61" => $kQ[1]->toBytes($HS), "\x65\170\160\157\156\x65\156\164\62" => $kQ[2]->toBytes($HS), "\143\x6f\x65\146\x66\x69\x63\151\x65\x6e\x74" => $hP[2]->toBytes($HS));
        switch ($this->privateKeyFormat) {
            case CRYPT_RSA_PRIVATE_FORMAT_XML:
                if (!($ur != 2)) {
                    goto DPa;
                }
                return false;
                DPa:
                return "\x3c\122\123\101\x4b\145\x79\x56\x61\x6c\x75\145\x3e\xd\xa" . "\x20\40\74\115\157\x64\165\x6c\x75\163\x3e" . base64_encode($pk["\155\157\144\165\154\x75\x73"]) . "\74\57\115\157\144\165\x6c\x75\163\x3e\xd\12" . "\x20\x20\x3c\x45\x78\x70\x6f\x6e\145\156\164\x3e" . base64_encode($pk["\x70\x75\142\x6c\x69\143\105\x78\x70\x6f\156\145\x6e\164"]) . "\x3c\x2f\105\170\160\x6f\x6e\145\x6e\164\x3e\xd\12" . "\x20\x20\74\x50\x3e" . base64_encode($pk["\160\x72\x69\x6d\x65\61"]) . "\74\x2f\120\x3e\15\12" . "\40\40\74\x51\x3e" . base64_encode($pk["\x70\x72\151\x6d\x65\x32"]) . "\x3c\57\x51\76\xd\xa" . "\x20\x20\x3c\104\x50\76" . base64_encode($pk["\145\170\160\157\x6e\145\156\x74\61"]) . "\x3c\x2f\104\x50\76\15\xa" . "\x20\x20\74\104\x51\x3e" . base64_encode($pk["\x65\170\x70\157\x6e\145\156\164\62"]) . "\74\x2f\104\x51\x3e\xd\xa" . "\x20\x20\x3c\x49\x6e\166\145\x72\163\145\x51\76" . base64_encode($pk["\143\157\145\146\x66\x69\143\x69\x65\x6e\164"]) . "\74\57\111\156\x76\145\162\x73\145\x51\x3e\xd\xa" . "\40\40\74\104\x3e" . base64_encode($pk["\x70\162\151\166\141\164\x65\105\170\160\x6f\x6e\145\156\x74"]) . "\74\x2f\104\76\15\xa" . "\x3c\x2f\x52\123\101\113\145\171\x56\x61\154\x75\145\x3e";
                goto LcB;
            case CRYPT_RSA_PRIVATE_FORMAT_PUTTY:
                if (!($ur != 2)) {
                    goto JbG;
                }
                return false;
                JbG:
                $mx = "\120\165\124\124\131\55\125\163\145\x72\55\x4b\145\171\x2d\x46\151\x6c\x65\55\62\72\x20\x73\163\x68\x2d\162\x73\x61\15\xa\x45\156\143\x72\171\x70\164\x69\157\x6e\72\40";
                $bd = !empty($this->password) || is_string($this->password) ? "\x61\x65\163\x32\x35\66\x2d\143\142\143" : "\156\157\x6e\x65";
                $mx .= $bd;
                $mx .= "\xd\12\103\157\x6d\x6d\x65\x6e\164\x3a\x20" . $this->comment . "\15\xa";
                $tl = pack("\x4e\x61\x2a\x4e\141\x2a\116\x61\x2a", strlen("\163\x73\x68\55\162\163\141"), "\x73\163\150\55\x72\163\141", strlen($pk["\160\x75\x62\154\x69\143\105\x78\160\x6f\x6e\145\156\164"]), $pk["\160\x75\142\x6c\x69\143\105\170\x70\x6f\156\145\156\x74"], strlen($pk["\x6d\157\144\165\x6c\165\163"]), $pk["\155\x6f\144\x75\154\165\163"]);
                $F0 = pack("\116\x61\52\116\x61\x2a\116\141\52\116\141\52", strlen("\163\x73\x68\55\162\x73\x61"), "\x73\163\150\55\x72\163\x61", strlen($bd), $bd, strlen($this->comment), $this->comment, strlen($tl), $tl);
                $tl = base64_encode($tl);
                $mx .= "\120\x75\x62\154\x69\143\55\114\x69\x6e\x65\163\x3a\40" . (strlen($tl) + 63 >> 6) . "\15\12";
                $mx .= chunk_split($tl, 64);
                $bo = pack("\x4e\141\x2a\116\141\x2a\116\141\x2a\116\x61\52", strlen($pk["\x70\162\x69\166\141\x74\x65\105\170\160\x6f\156\x65\156\x74"]), $pk["\x70\x72\151\x76\141\164\145\x45\x78\x70\157\156\145\156\164"], strlen($pk["\x70\162\x69\155\145\61"]), $pk["\160\162\151\155\145\x31"], strlen($pk["\x70\x72\x69\x6d\145\62"]), $pk["\x70\162\x69\x6d\145\62"], strlen($pk["\143\x6f\145\146\x66\x69\x63\x69\x65\x6e\x74"]), $pk["\143\157\x65\x66\146\151\143\151\145\156\164"]);
                if (empty($this->password) && !is_string($this->password)) {
                    goto yq7;
                }
                $bo .= crypt_random_string(16 - (strlen($bo) & 15));
                $F0 .= pack("\x4e\141\52", strlen($bo), $bo);
                if (class_exists("\103\162\x79\x70\x74\137\x41\x45\123")) {
                    goto j84;
                }
                include_once "\103\x72\x79\x70\164\x2f\101\105\123\56\x70\150\x70";
                j84:
                $sv = 0;
                $cM = '';
                G9N:
                if (!(strlen($cM) < 32)) {
                    goto Knc;
                }
                $DA = pack("\116\141\x2a", $sv++, $this->password);
                $cM .= pack("\x48\x2a", sha1($DA));
                goto G9N;
                Knc:
                $cM = substr($cM, 0, 32);
                $NI = new Crypt_AES();
                $NI->setKey($cM);
                $NI->disablePadding();
                $bo = $NI->encrypt($bo);
                $v6 = "\x70\x75\164\164\171\55\x70\162\151\x76\x61\x74\145\x2d\153\145\171\x2d\x66\x69\x6c\x65\55\155\x61\x63\55\x6b\145\171" . $this->password;
                goto qGT;
                yq7:
                $F0 .= pack("\116\x61\x2a", strlen($bo), $bo);
                $v6 = "\x70\x75\x74\x74\171\55\160\162\x69\x76\x61\164\x65\55\x6b\x65\171\55\x66\151\x6c\x65\55\155\x61\x63\x2d\153\x65\x79";
                qGT:
                $bo = base64_encode($bo);
                $mx .= "\x50\x72\x69\x76\x61\x74\145\x2d\x4c\151\156\145\163\x3a\x20" . (strlen($bo) + 63 >> 6) . "\xd\xa";
                $mx .= chunk_split($bo, 64);
                if (class_exists("\x43\x72\171\x70\164\x5f\x48\141\163\x68")) {
                    goto lZt;
                }
                include_once "\x43\162\x79\160\x74\57\x48\141\163\150\x2e\160\150\160";
                lZt:
                $mN = new Crypt_Hash("\x73\150\x61\61");
                $mN->setKey(pack("\x48\52", sha1($v6)));
                $mx .= "\120\162\x69\166\141\164\145\x2d\x4d\101\103\72\40" . bin2hex($mN->hash($F0)) . "\xd\xa";
                return $mx;
            default:
                $wM = array();
                foreach ($pk as $nX => $Vw) {
                    $wM[$nX] = pack("\103\141\x2a\x61\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($Vw)), $Vw);
                    EYY:
                }
                tFV:
                $y0 = implode('', $wM);
                if (!($ur > 2)) {
                    goto hEX;
                }
                $x3 = '';
                $vB = 3;
                WyW:
                if (!($vB <= $ur)) {
                    goto ydR;
                }
                $gT = pack("\x43\141\52\141\52", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($VT[$vB]->toBytes(true))), $VT[$vB]->toBytes(true));
                $gT .= pack("\x43\141\x2a\x61\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($kQ[$vB]->toBytes(true))), $kQ[$vB]->toBytes(true));
                $gT .= pack("\103\x61\52\141\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($hP[$vB]->toBytes(true))), $hP[$vB]->toBytes(true));
                $x3 .= pack("\103\141\52\141\x2a", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($gT)), $gT);
                mPa:
                $vB++;
                goto WyW;
                ydR:
                $y0 .= pack("\103\141\x2a\141\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($x3)), $x3);
                hEX:
                $y0 = pack("\x43\141\x2a\141\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($y0)), $y0);
                if (!($this->privateKeyFormat == CRYPT_RSA_PRIVATE_FORMAT_PKCS8)) {
                    goto r1a;
                }
                $Mw = pack("\x48\52", "\x33\x30\60\144\60\x36\60\71\x32\x61\70\66\x34\x38\x38\x36\146\x37\x30\144\60\61\x30\61\60\x31\x30\65\60\x30");
                $y0 = pack("\103\141\x2a\141\52\103\x61\52\141\x2a", CRYPT_RSA_ASN1_INTEGER, "\1\x0", $Mw, 4, $this->_encodeLength(strlen($y0)), $y0);
                $y0 = pack("\103\141\52\x61\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($y0)), $y0);
                if (!empty($this->password) || is_string($this->password)) {
                    goto tTd;
                }
                $y0 = "\55\x2d\55\55\55\102\105\107\111\x4e\x20\x50\x52\111\x56\x41\124\105\x20\x4b\x45\131\x2d\x2d\x2d\x2d\55\xd\xa" . chunk_split(base64_encode($y0), 64) . "\55\x2d\x2d\x2d\x2d\105\x4e\104\x20\120\x52\111\x56\x41\x54\105\x20\x4b\105\131\55\x2d\x2d\x2d\55";
                goto Ms7;
                tTd:
                $pW = crypt_random_string(8);
                $VI = 2048;
                if (class_exists("\103\x72\171\x70\164\137\x44\105\123")) {
                    goto ssG;
                }
                include_once "\103\x72\x79\x70\164\x2f\x44\x45\123\x2e\160\x68\x70";
                ssG:
                $NI = new Crypt_DES();
                $NI->setPassword($this->password, "\160\142\153\x64\x66\x31", "\x6d\144\65", $pW, $VI);
                $y0 = $NI->encrypt($y0);
                $i1 = pack("\103\141\x2a\141\52\103\141\x2a\116", CRYPT_RSA_ASN1_OCTETSTRING, $this->_encodeLength(strlen($pW)), $pW, CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(4), $VI);
                $BL = "\x2a\206\110\206\367\15\x1\x5\3";
                $Sv = pack("\x43\141\x2a\x61\52\x43\x61\x2a\x61\52", CRYPT_RSA_ASN1_OBJECT, $this->_encodeLength(strlen($BL)), $BL, CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($i1)), $i1);
                $y0 = pack("\103\141\x2a\x61\x2a\x43\141\52\x61\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($Sv)), $Sv, CRYPT_RSA_ASN1_OCTETSTRING, $this->_encodeLength(strlen($y0)), $y0);
                $y0 = pack("\103\x61\x2a\x61\x2a", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($y0)), $y0);
                $y0 = "\55\x2d\55\55\55\x42\x45\107\x49\116\40\x45\116\x43\x52\x59\120\124\105\104\40\120\x52\111\x56\x41\x54\105\x20\x4b\x45\131\55\x2d\55\55\55\xd\xa" . chunk_split(base64_encode($y0), 64) . "\55\x2d\x2d\x2d\55\x45\x4e\104\x20\x45\116\x43\x52\131\120\x54\x45\x44\40\120\x52\x49\126\x41\x54\x45\x20\x4b\x45\x59\55\x2d\55\x2d\x2d";
                Ms7:
                return $y0;
                r1a:
                if (!empty($this->password) || is_string($this->password)) {
                    goto cZZ;
                }
                $y0 = "\x2d\x2d\55\x2d\55\x42\x45\107\x49\x4e\40\122\x53\101\x20\120\122\x49\126\x41\124\x45\40\113\105\131\x2d\55\x2d\55\x2d\xd\xa" . chunk_split(base64_encode($y0), 64) . "\55\x2d\x2d\55\55\105\116\104\40\x52\123\101\x20\x50\122\111\x56\101\x54\x45\40\113\x45\x59\55\55\55\x2d\x2d";
                goto Mzp;
                cZZ:
                $au = crypt_random_string(8);
                $cM = pack("\x48\x2a", md5($this->password . $au));
                $cM .= substr(pack("\x48\52", md5($cM . $this->password . $au)), 0, 8);
                if (class_exists("\103\162\x79\x70\x74\137\124\162\151\x70\154\145\x44\105\x53")) {
                    goto kFi;
                }
                include_once "\103\x72\x79\x70\x74\x2f\x54\x72\x69\160\154\x65\x44\x45\123\x2e\x70\150\160";
                kFi:
                $zk = new Crypt_TripleDES();
                $zk->setKey($cM);
                $zk->setIV($au);
                $au = strtoupper(bin2hex($au));
                $y0 = "\x2d\55\55\55\x2d\x42\105\107\x49\116\x20\122\x53\x41\40\120\122\111\x56\101\124\x45\40\113\x45\x59\55\x2d\x2d\x2d\x2d\15\xa" . "\120\162\x6f\143\x2d\x54\x79\x70\145\x3a\40\64\x2c\x45\x4e\x43\x52\x59\120\x54\105\x44\xd\xa" . "\104\x45\113\55\111\x6e\x66\x6f\x3a\40\x44\105\x53\x2d\105\x44\105\63\55\103\x42\103\54{$au}\15\xa" . "\15\12" . chunk_split(base64_encode($zk->encrypt($y0)), 64) . "\x2d\x2d\55\55\x2d\x45\x4e\104\x20\x52\123\x41\x20\x50\122\x49\x56\x41\x54\105\40\x4b\105\131\55\55\55\55\x2d";
                Mzp:
                return $y0;
        }
        Jx5:
        LcB:
    }
    function _convertPublicKey($Td, $P0)
    {
        $HS = $this->publicKeyFormat != CRYPT_RSA_PUBLIC_FORMAT_XML;
        $XL = $Td->toBytes($HS);
        $D0 = $P0->toBytes($HS);
        switch ($this->publicKeyFormat) {
            case CRYPT_RSA_PUBLIC_FORMAT_RAW:
                return array("\145" => $P0->copy(), "\156" => $Td->copy());
            case CRYPT_RSA_PUBLIC_FORMAT_XML:
                return "\x3c\122\123\x41\x4b\145\x79\126\141\x6c\x75\x65\x3e\15\xa" . "\x20\x20\74\x4d\157\x64\x75\154\165\163\76" . base64_encode($XL) . "\74\x2f\x4d\x6f\144\165\x6c\165\163\x3e\xd\xa" . "\40\40\74\105\x78\160\157\156\145\156\x74\x3e" . base64_encode($D0) . "\74\57\105\170\160\x6f\x6e\x65\156\x74\76\xd\xa" . "\x3c\x2f\x52\x53\101\113\x65\x79\x56\x61\154\165\145\x3e";
                goto o5J;
            case CRYPT_RSA_PUBLIC_FORMAT_OPENSSH:
                $wr = pack("\116\x61\x2a\116\x61\x2a\116\141\x2a", strlen("\x73\x73\x68\x2d\162\163\x61"), "\x73\163\x68\55\x72\163\141", strlen($D0), $D0, strlen($XL), $XL);
                $wr = "\x73\163\150\55\x72\163\141\x20" . base64_encode($wr) . "\40" . $this->comment;
                return $wr;
            default:
                $wM = array("\155\157\x64\165\x6c\165\163" => pack("\103\x61\x2a\141\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($XL)), $XL), "\x70\165\142\x6c\151\143\105\170\160\x6f\x6e\145\x6e\164" => pack("\103\x61\52\141\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($D0)), $D0));
                $wr = pack("\x43\141\52\x61\x2a\141\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($wM["\x6d\157\144\165\x6c\165\x73"]) + strlen($wM["\x70\x75\x62\x6c\x69\143\x45\170\160\157\156\145\x6e\x74"])), $wM["\155\157\144\165\x6c\x75\163"], $wM["\x70\x75\142\154\151\x63\x45\170\160\157\156\145\x6e\x74"]);
                if ($this->publicKeyFormat == CRYPT_RSA_PUBLIC_FORMAT_PKCS1_RAW) {
                    goto MjM;
                }
                $Mw = pack("\110\x2a", "\63\x30\60\144\60\66\x30\71\62\x61\70\x36\64\x38\70\x36\146\67\x30\144\60\61\x30\x31\x30\61\60\65\x30\60");
                $wr = chr(0) . $wr;
                $wr = chr(3) . $this->_encodeLength(strlen($wr)) . $wr;
                $wr = pack("\103\141\52\141\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($Mw . $wr)), $Mw . $wr);
                $wr = "\x2d\x2d\55\55\x2d\x42\x45\x47\x49\x4e\40\x50\125\102\114\x49\x43\x20\113\x45\x59\x2d\x2d\55\x2d\x2d\15\12" . chunk_split(base64_encode($wr), 64) . "\55\55\55\55\x2d\105\x4e\104\40\x50\125\x42\x4c\x49\103\40\x4b\x45\x59\x2d\55\55\x2d\55";
                goto GG5;
                MjM:
                $wr = "\55\x2d\x2d\55\55\102\105\x47\x49\116\x20\x52\123\101\x20\x50\125\102\114\111\103\40\113\105\131\55\x2d\55\x2d\x2d\xd\xa" . chunk_split(base64_encode($wr), 64) . "\x2d\x2d\x2d\55\x2d\105\116\104\40\122\x53\x41\40\x50\x55\x42\x4c\x49\103\x20\x4b\105\131\x2d\55\55\55\x2d";
                GG5:
                return $wr;
        }
        y1i:
        o5J:
    }
    function _parseKey($mx, $n0)
    {
        if (!($n0 != CRYPT_RSA_PUBLIC_FORMAT_RAW && !is_string($mx))) {
            goto Pyc;
        }
        return false;
        Pyc:
        switch ($n0) {
            case CRYPT_RSA_PUBLIC_FORMAT_RAW:
                if (is_array($mx)) {
                    goto qvg;
                }
                return false;
                qvg:
                $wM = array();
                switch (true) {
                    case isset($mx["\x65"]):
                        $wM["\160\165\x62\154\x69\x63\x45\x78\x70\157\x6e\x65\x6e\164"] = $mx["\145"]->copy();
                        goto apE;
                    case isset($mx["\145\x78\x70\x6f\156\x65\x6e\164"]):
                        $wM["\160\x75\x62\x6c\151\143\105\x78\x70\x6f\156\145\156\164"] = $mx["\x65\x78\160\157\156\145\x6e\x74"]->copy();
                        goto apE;
                    case isset($mx["\x70\x75\x62\154\x69\143\x45\x78\160\x6f\156\x65\x6e\x74"]):
                        $wM["\x70\x75\142\154\151\143\x45\x78\160\x6f\x6e\x65\156\164"] = $mx["\x70\x75\142\x6c\151\143\x45\x78\x70\x6f\x6e\x65\x6e\164"]->copy();
                        goto apE;
                    case isset($mx[0]):
                        $wM["\x70\x75\142\x6c\151\143\x45\170\160\157\156\x65\x6e\x74"] = $mx[0]->copy();
                }
                uCg:
                apE:
                switch (true) {
                    case isset($mx["\x6e"]):
                        $wM["\155\x6f\x64\165\x6c\165\163"] = $mx["\x6e"]->copy();
                        goto DhP;
                    case isset($mx["\x6d\157\x64\165\154\x6f"]):
                        $wM["\x6d\x6f\x64\165\154\x75\163"] = $mx["\x6d\157\144\165\154\x6f"]->copy();
                        goto DhP;
                    case isset($mx["\x6d\157\144\x75\x6c\165\x73"]):
                        $wM["\x6d\x6f\x64\165\154\165\163"] = $mx["\x6d\x6f\x64\165\x6c\165\163"]->copy();
                        goto DhP;
                    case isset($mx[1]):
                        $wM["\x6d\x6f\144\x75\154\x75\163"] = $mx[1]->copy();
                }
                cGN:
                DhP:
                return isset($wM["\155\157\x64\x75\x6c\x75\x73"]) && isset($wM["\160\165\x62\154\x69\143\105\x78\x70\157\156\x65\156\164"]) ? $wM : false;
            case CRYPT_RSA_PRIVATE_FORMAT_PKCS1:
            case CRYPT_RSA_PRIVATE_FORMAT_PKCS8:
            case CRYPT_RSA_PUBLIC_FORMAT_PKCS1:
                if (preg_match("\43\104\105\x4b\55\x49\156\x66\x6f\72\x20\x28\x2e\x2b\51\x2c\x28\x2e\53\51\43", $mx, $fR)) {
                    goto a7h;
                }
                $O9 = $this->_extractBER($mx);
                goto CgO;
                a7h:
                $au = pack("\x48\x2a", trim($fR[2]));
                $cM = pack("\110\x2a", md5($this->password . substr($au, 0, 8)));
                $cM .= pack("\110\x2a", md5($cM . $this->password . substr($au, 0, 8)));
                $mx = preg_replace("\x23\136\x28\x3f\72\120\x72\157\x63\x2d\x54\x79\x70\145\174\104\105\113\x2d\111\156\146\x6f\x29\72\x20\56\x2a\x23\x6d", '', $mx);
                $ii = $this->_extractBER($mx);
                if (!($ii === false)) {
                    goto NtO;
                }
                $ii = $mx;
                NtO:
                switch ($fR[1]) {
                    case "\x41\105\123\x2d\62\x35\x36\55\x43\x42\x43":
                        if (class_exists("\x43\162\x79\160\164\137\x41\x45\123")) {
                            goto oJP;
                        }
                        include_once "\x43\x72\171\x70\x74\x2f\x41\x45\x53\x2e\160\150\160";
                        oJP:
                        $NI = new Crypt_AES();
                        goto zsI;
                    case "\x41\105\123\x2d\61\62\x38\x2d\x43\x42\x43":
                        if (class_exists("\103\162\171\160\164\x5f\101\x45\x53")) {
                            goto AqS;
                        }
                        include_once "\x43\x72\x79\160\x74\57\101\105\x53\56\160\x68\x70";
                        AqS:
                        $cM = substr($cM, 0, 16);
                        $NI = new Crypt_AES();
                        goto zsI;
                    case "\104\x45\x53\x2d\105\104\x45\x33\x2d\x43\x46\102":
                        if (class_exists("\x43\x72\171\x70\x74\137\124\x72\x69\160\x6c\x65\104\x45\x53")) {
                            goto cV_;
                        }
                        include_once "\x43\162\x79\160\x74\57\124\x72\151\160\x6c\x65\104\105\123\56\160\150\x70";
                        cV_:
                        $NI = new Crypt_TripleDES(CRYPT_DES_MODE_CFB);
                        goto zsI;
                    case "\104\x45\x53\55\105\x44\105\63\x2d\x43\102\x43":
                        if (class_exists("\x43\162\171\x70\x74\x5f\124\162\x69\x70\154\x65\104\105\x53")) {
                            goto Qry;
                        }
                        include_once "\103\162\x79\x70\164\57\x54\162\151\160\x6c\145\104\x45\x53\56\160\150\160";
                        Qry:
                        $cM = substr($cM, 0, 24);
                        $NI = new Crypt_TripleDES();
                        goto zsI;
                    case "\x44\x45\123\55\x43\102\103":
                        if (class_exists("\103\162\x79\160\x74\137\x44\105\123")) {
                            goto mPf;
                        }
                        include_once "\x43\x72\x79\160\164\x2f\x44\x45\123\56\x70\x68\160";
                        mPf:
                        $NI = new Crypt_DES();
                        goto zsI;
                    default:
                        return false;
                }
                ppU:
                zsI:
                $NI->setKey($cM);
                $NI->setIV($au);
                $O9 = $NI->decrypt($ii);
                CgO:
                if (!($O9 !== false)) {
                    goto c9r;
                }
                $mx = $O9;
                c9r:
                $wM = array();
                if (!(ord($this->_string_shift($mx)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto mzH;
                }
                return false;
                mzH:
                if (!($this->_decodeLength($mx) != strlen($mx))) {
                    goto R6m;
                }
                return false;
                R6m:
                $U5 = ord($this->_string_shift($mx));
                if (!($U5 == CRYPT_RSA_ASN1_INTEGER && substr($mx, 0, 3) == "\1\x0\60")) {
                    goto Uo_;
                }
                $this->_string_shift($mx, 3);
                $U5 = CRYPT_RSA_ASN1_SEQUENCE;
                Uo_:
                if (!($U5 == CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto Pkm;
                }
                $DA = $this->_string_shift($mx, $this->_decodeLength($mx));
                if (!(ord($this->_string_shift($DA)) != CRYPT_RSA_ASN1_OBJECT)) {
                    goto Ca_;
                }
                return false;
                Ca_:
                $MI = $this->_decodeLength($DA);
                switch ($this->_string_shift($DA, $MI)) {
                    case "\52\206\110\206\367\15\x1\x1\x1":
                        goto yfK;
                    case "\52\206\110\x86\367\xd\1\5\x3":
                        if (!(ord($this->_string_shift($DA)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                            goto v8G;
                        }
                        return false;
                        v8G:
                        if (!($this->_decodeLength($DA) != strlen($DA))) {
                            goto Tib;
                        }
                        return false;
                        Tib:
                        $this->_string_shift($DA);
                        $pW = $this->_string_shift($DA, $this->_decodeLength($DA));
                        if (!(ord($this->_string_shift($DA)) != CRYPT_RSA_ASN1_INTEGER)) {
                            goto Rjm;
                        }
                        return false;
                        Rjm:
                        $this->_decodeLength($DA);
                        list(, $VI) = unpack("\116", str_pad($DA, 4, chr(0), STR_PAD_LEFT));
                        $this->_string_shift($mx);
                        $MI = $this->_decodeLength($mx);
                        if (!(strlen($mx) != $MI)) {
                            goto Xz5;
                        }
                        return false;
                        Xz5:
                        if (class_exists("\x43\162\x79\x70\164\x5f\x44\105\x53")) {
                            goto ehY;
                        }
                        include_once "\x43\162\171\x70\164\x2f\104\105\x53\x2e\x70\x68\x70";
                        ehY:
                        $NI = new Crypt_DES();
                        $NI->setPassword($this->password, "\x70\x62\x6b\144\146\61", "\x6d\x64\x35", $pW, $VI);
                        $mx = $NI->decrypt($mx);
                        if (!($mx === false)) {
                            goto AAH;
                        }
                        return false;
                        AAH:
                        return $this->_parseKey($mx, CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
                    default:
                        return false;
                }
                bEA:
                yfK:
                $U5 = ord($this->_string_shift($mx));
                $this->_decodeLength($mx);
                if (!($U5 == CRYPT_RSA_ASN1_BITSTRING)) {
                    goto bM0;
                }
                $this->_string_shift($mx);
                bM0:
                if (!(ord($this->_string_shift($mx)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto wXQ;
                }
                return false;
                wXQ:
                if (!($this->_decodeLength($mx) != strlen($mx))) {
                    goto fAu;
                }
                return false;
                fAu:
                $U5 = ord($this->_string_shift($mx));
                Pkm:
                if (!($U5 != CRYPT_RSA_ASN1_INTEGER)) {
                    goto a31;
                }
                return false;
                a31:
                $MI = $this->_decodeLength($mx);
                $DA = $this->_string_shift($mx, $MI);
                if (!(strlen($DA) != 1 || ord($DA) > 2)) {
                    goto CNn;
                }
                $wM["\x6d\157\x64\165\x6c\165\163"] = new Math_BigInteger($DA, 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM[$n0 == CRYPT_RSA_PUBLIC_FORMAT_PKCS1 ? "\160\x75\142\154\151\x63\x45\170\x70\157\x6e\145\x6e\x74" : "\x70\x72\151\x76\141\164\x65\105\x78\x70\157\156\145\156\x74"] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                return $wM;
                CNn:
                if (!(ord($this->_string_shift($mx)) != CRYPT_RSA_ASN1_INTEGER)) {
                    goto ubv;
                }
                return false;
                ubv:
                $MI = $this->_decodeLength($mx);
                $wM["\155\157\x64\165\x6c\x75\x73"] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\160\165\x62\154\151\x63\105\x78\x70\x6f\x6e\x65\156\x74"] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\160\162\151\x76\x61\x74\x65\105\170\x70\x6f\x6e\x65\x6e\164"] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\160\162\x69\x6d\x65\163"] = array(1 => new Math_BigInteger($this->_string_shift($mx, $MI), 256));
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\x70\162\151\155\145\163"][] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\145\x78\x70\157\156\145\x6e\x74\163"] = array(1 => new Math_BigInteger($this->_string_shift($mx, $MI), 256));
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\145\170\x70\x6f\x6e\145\156\x74\x73"][] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\143\x6f\x65\146\146\151\x63\x69\145\x6e\x74\163"] = array(2 => new Math_BigInteger($this->_string_shift($mx, $MI), 256));
                if (empty($mx)) {
                    goto zxA;
                }
                if (!(ord($this->_string_shift($mx)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto dgc;
                }
                return false;
                dgc:
                $this->_decodeLength($mx);
                k3A:
                if (empty($mx)) {
                    goto AUh;
                }
                if (!(ord($this->_string_shift($mx)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto pLx;
                }
                return false;
                pLx:
                $this->_decodeLength($mx);
                $mx = substr($mx, 1);
                $MI = $this->_decodeLength($mx);
                $wM["\160\x72\151\155\x65\x73"][] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\x65\170\160\x6f\156\145\156\x74\163"][] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                $this->_string_shift($mx);
                $MI = $this->_decodeLength($mx);
                $wM["\143\157\x65\146\x66\151\143\151\x65\x6e\x74\163"][] = new Math_BigInteger($this->_string_shift($mx, $MI), 256);
                goto k3A;
                AUh:
                zxA:
                return $wM;
            case CRYPT_RSA_PUBLIC_FORMAT_OPENSSH:
                $EM = explode("\40", $mx, 3);
                $mx = isset($EM[1]) ? base64_decode($EM[1]) : false;
                if (!($mx === false)) {
                    goto NJ0;
                }
                return false;
                NJ0:
                $Sb = isset($EM[2]) ? $EM[2] : false;
                $CR = substr($mx, 0, 11) == "\x0\0\0\7\163\x73\x68\55\x72\163\141";
                if (!(strlen($mx) <= 4)) {
                    goto p72;
                }
                return false;
                p72:
                extract(unpack("\x4e\x6c\145\x6e\147\x74\150", $this->_string_shift($mx, 4)));
                $D0 = new Math_BigInteger($this->_string_shift($mx, $MI), -256);
                if (!(strlen($mx) <= 4)) {
                    goto uSS;
                }
                return false;
                uSS:
                extract(unpack("\x4e\154\145\x6e\147\x74\150", $this->_string_shift($mx, 4)));
                $XL = new Math_BigInteger($this->_string_shift($mx, $MI), -256);
                if ($CR && strlen($mx)) {
                    goto P2p;
                }
                return strlen($mx) ? false : array("\155\x6f\144\165\154\x75\x73" => $XL, "\x70\x75\x62\154\x69\143\x45\170\160\x6f\x6e\145\156\x74" => $D0, "\143\x6f\155\155\145\156\x74" => $Sb);
                goto Ebi;
                P2p:
                if (!(strlen($mx) <= 4)) {
                    goto Tsk;
                }
                return false;
                Tsk:
                extract(unpack("\x4e\154\x65\x6e\x67\x74\150", $this->_string_shift($mx, 4)));
                $fY = new Math_BigInteger($this->_string_shift($mx, $MI), -256);
                return strlen($mx) ? false : array("\155\157\x64\165\x6c\165\163" => $fY, "\x70\165\142\154\151\143\x45\x78\160\x6f\x6e\145\x6e\164" => $XL, "\x63\x6f\155\155\x65\x6e\164" => $Sb);
                Ebi:
            case CRYPT_RSA_PRIVATE_FORMAT_XML:
            case CRYPT_RSA_PUBLIC_FORMAT_XML:
                $this->components = array();
                $cN = xml_parser_create("\x55\x54\x46\55\70");
                xml_set_object($cN, $this);
                xml_set_element_handler($cN, "\x5f\163\x74\141\162\x74\x5f\145\x6c\145\155\x65\x6e\164\x5f\150\x61\x6e\x64\x6c\145\x72", "\137\x73\x74\157\x70\x5f\145\x6c\x65\x6d\x65\156\x74\137\150\x61\156\144\x6c\x65\162");
                xml_set_character_data_handler($cN, "\x5f\144\x61\164\141\x5f\150\x61\x6e\144\154\145\x72");
                if (xml_parse($cN, "\x3c\170\155\x6c\76" . $mx . "\74\x2f\x78\x6d\x6c\x3e")) {
                    goto HaC;
                }
                return false;
                HaC:
                return isset($this->components["\x6d\x6f\x64\165\154\x75\163"]) && isset($this->components["\x70\165\142\x6c\151\x63\x45\x78\160\157\x6e\x65\x6e\164"]) ? $this->components : false;
            case CRYPT_RSA_PRIVATE_FORMAT_PUTTY:
                $wM = array();
                $mx = preg_split("\43\x5c\x72\134\156\x7c\134\162\174\134\x6e\x23", $mx);
                $n0 = trim(preg_replace("\x23\x50\165\x54\x54\131\55\125\x73\145\162\x2d\113\x65\171\55\x46\x69\154\x65\x2d\x32\x3a\40\50\56\x2b\51\43", "\44\x31", $mx[0]));
                if (!($n0 != "\163\163\x68\55\162\163\141")) {
                    goto Hag;
                }
                return false;
                Hag:
                $bd = trim(preg_replace("\43\x45\x6e\143\x72\171\160\x74\x69\157\x6e\x3a\x20\50\x2e\x2b\x29\x23", "\44\x31", $mx[1]));
                $Sb = trim(preg_replace("\x23\103\157\155\155\x65\x6e\164\72\x20\50\x2e\x2b\51\43", "\44\61", $mx[2]));
                $SA = trim(preg_replace("\43\x50\165\142\154\151\143\55\114\x69\156\145\x73\x3a\40\50\x5c\x64\x2b\x29\43", "\44\x31", $mx[3]));
                $tl = base64_decode(implode('', array_map("\164\162\x69\155", array_slice($mx, 4, $SA))));
                $tl = substr($tl, 11);
                extract(unpack("\x4e\154\145\156\x67\x74\150", $this->_string_shift($tl, 4)));
                $wM["\x70\x75\x62\154\x69\143\105\x78\x70\157\x6e\x65\156\x74"] = new Math_BigInteger($this->_string_shift($tl, $MI), -256);
                extract(unpack("\116\x6c\x65\156\x67\164\x68", $this->_string_shift($tl, 4)));
                $wM["\155\x6f\x64\165\x6c\x75\163"] = new Math_BigInteger($this->_string_shift($tl, $MI), -256);
                $sZ = trim(preg_replace("\x23\120\x72\x69\166\141\164\x65\55\x4c\151\156\145\163\72\40\x28\134\144\x2b\x29\x23", "\x24\61", $mx[$SA + 4]));
                $bo = base64_decode(implode('', array_map("\164\x72\x69\x6d", array_slice($mx, $SA + 5, $sZ))));
                switch ($bd) {
                    case "\141\145\163\62\x35\66\x2d\x63\x62\143":
                        if (class_exists("\103\x72\171\160\164\137\x41\105\x53")) {
                            goto jD7;
                        }
                        include_once "\103\x72\x79\x70\164\x2f\x41\x45\x53\x2e\x70\150\160";
                        jD7:
                        $cM = '';
                        $sv = 0;
                        gas:
                        if (!(strlen($cM) < 32)) {
                            goto lng;
                        }
                        $DA = pack("\116\141\52", $sv++, $this->password);
                        $cM .= pack("\110\x2a", sha1($DA));
                        goto gas;
                        lng:
                        $cM = substr($cM, 0, 32);
                        $NI = new Crypt_AES();
                }
                Ai8:
                q1z:
                if (!($bd != "\x6e\157\x6e\145")) {
                    goto y1b;
                }
                $NI->setKey($cM);
                $NI->disablePadding();
                $bo = $NI->decrypt($bo);
                if (!($bo === false)) {
                    goto T3d;
                }
                return false;
                T3d:
                y1b:
                extract(unpack("\x4e\x6c\x65\x6e\x67\x74\x68", $this->_string_shift($bo, 4)));
                if (!(strlen($bo) < $MI)) {
                    goto onx;
                }
                return false;
                onx:
                $wM["\x70\x72\x69\x76\141\164\x65\105\x78\160\x6f\156\x65\156\164"] = new Math_BigInteger($this->_string_shift($bo, $MI), -256);
                extract(unpack("\116\x6c\x65\x6e\147\164\x68", $this->_string_shift($bo, 4)));
                if (!(strlen($bo) < $MI)) {
                    goto avp;
                }
                return false;
                avp:
                $wM["\160\162\151\155\x65\x73"] = array(1 => new Math_BigInteger($this->_string_shift($bo, $MI), -256));
                extract(unpack("\116\154\145\x6e\147\164\150", $this->_string_shift($bo, 4)));
                if (!(strlen($bo) < $MI)) {
                    goto N45;
                }
                return false;
                N45:
                $wM["\160\x72\x69\155\145\163"][] = new Math_BigInteger($this->_string_shift($bo, $MI), -256);
                $DA = $wM["\160\162\x69\x6d\x65\x73"][1]->subtract($this->one);
                $wM["\145\x78\x70\157\156\145\156\x74\x73"] = array(1 => $wM["\160\165\142\154\x69\x63\105\170\x70\x6f\x6e\145\x6e\164"]->modInverse($DA));
                $DA = $wM["\x70\162\151\155\x65\x73"][2]->subtract($this->one);
                $wM["\145\x78\160\157\x6e\x65\156\x74\x73"][] = $wM["\160\165\x62\x6c\151\x63\x45\170\160\x6f\x6e\145\156\164"]->modInverse($DA);
                extract(unpack("\x4e\x6c\x65\156\147\x74\x68", $this->_string_shift($bo, 4)));
                if (!(strlen($bo) < $MI)) {
                    goto mJs;
                }
                return false;
                mJs:
                $wM["\143\x6f\x65\146\x66\x69\143\151\145\156\164\x73"] = array(2 => new Math_BigInteger($this->_string_shift($bo, $MI), -256));
                return $wM;
        }
        p2X:
        x_P:
    }
    function getSize()
    {
        return !isset($this->modulus) ? 0 : strlen($this->modulus->toBits());
    }
    function _start_element_handler($ZP, $nX, $Lm)
    {
        switch ($nX) {
            case "\x4d\x4f\x44\125\114\125\123":
                $this->current =& $this->components["\155\x6f\x64\x75\154\x75\x73"];
                goto K3k;
            case "\105\130\120\x4f\116\x45\116\x54":
                $this->current =& $this->components["\x70\x75\142\154\x69\143\105\x78\x70\x6f\156\x65\x6e\164"];
                goto K3k;
            case "\x50":
                $this->current =& $this->components["\160\162\x69\x6d\145\163"][1];
                goto K3k;
            case "\121":
                $this->current =& $this->components["\x70\162\x69\x6d\145\x73"][2];
                goto K3k;
            case "\x44\x50":
                $this->current =& $this->components["\145\170\160\x6f\156\145\x6e\x74\163"][1];
                goto K3k;
            case "\104\x51":
                $this->current =& $this->components["\145\x78\x70\x6f\x6e\x65\x6e\164\163"][2];
                goto K3k;
            case "\x49\116\x56\105\x52\123\105\x51":
                $this->current =& $this->components["\x63\157\x65\146\146\x69\x63\151\x65\156\x74\x73"][2];
                goto K3k;
            case "\104":
                $this->current =& $this->components["\x70\162\151\166\141\164\x65\x45\x78\x70\157\x6e\x65\x6e\164"];
        }
        hXO:
        K3k:
        $this->current = '';
    }
    function _stop_element_handler($ZP, $nX)
    {
        if (!isset($this->current)) {
            goto nUk;
        }
        $this->current = new Math_BigInteger(base64_decode($this->current), 256);
        unset($this->current);
        nUk:
    }
    function _data_handler($ZP, $b2)
    {
        if (!(!isset($this->current) || is_object($this->current))) {
            goto bMb;
        }
        return;
        bMb:
        $this->current .= trim($b2);
    }
    function loadKey($mx, $n0 = false)
    {
        if (!(is_object($mx) && strtolower(get_class($mx)) == "\x63\162\x79\x70\x74\137\162\163\141")) {
            goto rU_;
        }
        $this->privateKeyFormat = $mx->privateKeyFormat;
        $this->publicKeyFormat = $mx->publicKeyFormat;
        $this->k = $mx->k;
        $this->hLen = $mx->hLen;
        $this->sLen = $mx->sLen;
        $this->mgfHLen = $mx->mgfHLen;
        $this->encryptionMode = $mx->encryptionMode;
        $this->signatureMode = $mx->signatureMode;
        $this->password = $mx->password;
        $this->configFile = $mx->configFile;
        $this->comment = $mx->comment;
        if (!is_object($mx->hash)) {
            goto JRT;
        }
        $this->hash = new Crypt_Hash($mx->hash->getHash());
        JRT:
        if (!is_object($mx->mgfHash)) {
            goto jpB;
        }
        $this->mgfHash = new Crypt_Hash($mx->mgfHash->getHash());
        jpB:
        if (!is_object($mx->modulus)) {
            goto M7v;
        }
        $this->modulus = $mx->modulus->copy();
        M7v:
        if (!is_object($mx->exponent)) {
            goto dEC;
        }
        $this->exponent = $mx->exponent->copy();
        dEC:
        if (!is_object($mx->publicExponent)) {
            goto C3G;
        }
        $this->publicExponent = $mx->publicExponent->copy();
        C3G:
        $this->primes = array();
        $this->exponents = array();
        $this->coefficients = array();
        foreach ($this->primes as $aH) {
            $this->primes[] = $aH->copy();
            Nh8:
        }
        O5_:
        foreach ($this->exponents as $IH) {
            $this->exponents[] = $IH->copy();
            BaD:
        }
        ZC0:
        foreach ($this->coefficients as $kH) {
            $this->coefficients[] = $kH->copy();
            XvE:
        }
        Iy_:
        return true;
        rU_:
        if ($n0 === false) {
            goto TRM;
        }
        $wM = $this->_parseKey($mx, $n0);
        goto Vct;
        TRM:
        $NR = array(CRYPT_RSA_PUBLIC_FORMAT_RAW, CRYPT_RSA_PRIVATE_FORMAT_PKCS1, CRYPT_RSA_PRIVATE_FORMAT_XML, CRYPT_RSA_PRIVATE_FORMAT_PUTTY, CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);
        foreach ($NR as $n0) {
            $wM = $this->_parseKey($mx, $n0);
            if (!($wM !== false)) {
                goto Iow;
            }
            goto LCi;
            Iow:
            JMB:
        }
        LCi:
        Vct:
        if (!($wM === false)) {
            goto LUG;
        }
        $this->comment = null;
        $this->modulus = null;
        $this->k = null;
        $this->exponent = null;
        $this->primes = null;
        $this->exponents = null;
        $this->coefficients = null;
        $this->publicExponent = null;
        return false;
        LUG:
        if (!(isset($wM["\143\x6f\x6d\x6d\x65\x6e\x74"]) && $wM["\x63\157\155\x6d\145\156\164"] !== false)) {
            goto Mwq;
        }
        $this->comment = $wM["\143\x6f\155\x6d\x65\156\x74"];
        Mwq:
        $this->modulus = $wM["\155\x6f\144\165\x6c\165\163"];
        $this->k = strlen($this->modulus->toBytes());
        $this->exponent = isset($wM["\x70\162\151\x76\x61\x74\145\105\x78\x70\157\156\x65\156\164"]) ? $wM["\160\162\151\166\141\164\145\x45\170\x70\x6f\x6e\x65\156\164"] : $wM["\160\165\x62\154\151\143\105\x78\x70\157\156\x65\156\x74"];
        if (isset($wM["\160\x72\x69\x6d\145\x73"])) {
            goto qSd;
        }
        $this->primes = array();
        $this->exponents = array();
        $this->coefficients = array();
        $this->publicExponent = false;
        goto C90;
        qSd:
        $this->primes = $wM["\x70\x72\151\x6d\145\163"];
        $this->exponents = $wM["\x65\170\160\157\156\x65\x6e\x74\163"];
        $this->coefficients = $wM["\143\157\145\x66\x66\151\143\151\x65\156\x74\x73"];
        $this->publicExponent = $wM["\x70\165\x62\154\x69\x63\105\x78\160\157\156\x65\156\x74"];
        C90:
        switch ($n0) {
            case CRYPT_RSA_PUBLIC_FORMAT_OPENSSH:
            case CRYPT_RSA_PUBLIC_FORMAT_RAW:
                $this->setPublicKey();
                goto p1c;
            case CRYPT_RSA_PRIVATE_FORMAT_PKCS1:
                switch (true) {
                    case strpos($mx, "\x2d\102\105\x47\x49\116\40\120\125\x42\x4c\x49\x43\x20\113\x45\x59\x2d") !== false:
                    case strpos($mx, "\55\102\x45\x47\111\116\x20\x52\x53\x41\40\120\125\102\x4c\x49\x43\x20\113\105\x59\x2d") !== false:
                        $this->setPublicKey();
                }
                sDe:
                Aei:
        }
        BpN:
        p1c:
        return true;
    }
    function setPassword($OQ = false)
    {
        $this->password = $OQ;
    }
    function setPublicKey($mx = false, $n0 = false)
    {
        if (empty($this->publicExponent)) {
            goto Ry4;
        }
        return false;
        Ry4:
        if (!($mx === false && !empty($this->modulus))) {
            goto K_S;
        }
        $this->publicExponent = $this->exponent;
        return true;
        K_S:
        if ($n0 === false) {
            goto pNA;
        }
        $wM = $this->_parseKey($mx, $n0);
        goto UqI;
        pNA:
        $NR = array(CRYPT_RSA_PUBLIC_FORMAT_RAW, CRYPT_RSA_PUBLIC_FORMAT_PKCS1, CRYPT_RSA_PUBLIC_FORMAT_XML, CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);
        foreach ($NR as $n0) {
            $wM = $this->_parseKey($mx, $n0);
            if (!($wM !== false)) {
                goto O80;
            }
            goto fj4;
            O80:
            bPw:
        }
        fj4:
        UqI:
        if (!($wM === false)) {
            goto RHE;
        }
        return false;
        RHE:
        if (!(empty($this->modulus) || !$this->modulus->equals($wM["\155\157\x64\165\x6c\x75\163"]))) {
            goto uOM;
        }
        $this->modulus = $wM["\155\x6f\144\x75\x6c\165\163"];
        $this->exponent = $this->publicExponent = $wM["\160\165\x62\x6c\151\x63\x45\170\160\x6f\x6e\x65\156\x74"];
        return true;
        uOM:
        $this->publicExponent = $wM["\x70\165\142\154\151\143\x45\170\160\x6f\156\x65\x6e\x74"];
        return true;
    }
    function setPrivateKey($mx = false, $n0 = false)
    {
        if (!($mx === false && !empty($this->publicExponent))) {
            goto f_q;
        }
        $this->publicExponent = false;
        return true;
        f_q:
        $kx = new Crypt_RSA();
        if ($kx->loadKey($mx, $n0)) {
            goto pW7;
        }
        return false;
        pW7:
        $kx->publicExponent = false;
        $this->loadKey($kx);
        return true;
    }
    function getPublicKey($n0 = CRYPT_RSA_PUBLIC_FORMAT_PKCS8)
    {
        if (!(empty($this->modulus) || empty($this->publicExponent))) {
            goto ofJ;
        }
        return false;
        ofJ:
        $nj = $this->publicKeyFormat;
        $this->publicKeyFormat = $n0;
        $DA = $this->_convertPublicKey($this->modulus, $this->publicExponent);
        $this->publicKeyFormat = $nj;
        return $DA;
    }
    function getPublicKeyFingerprint($VX = "\x6d\144\x35")
    {
        if (!(empty($this->modulus) || empty($this->publicExponent))) {
            goto sLZ;
        }
        return false;
        sLZ:
        $XL = $this->modulus->toBytes(true);
        $D0 = $this->publicExponent->toBytes(true);
        $wr = pack("\x4e\x61\52\x4e\x61\x2a\116\x61\x2a", strlen("\x73\163\x68\x2d\x72\x73\141"), "\x73\x73\x68\x2d\x72\x73\141", strlen($D0), $D0, strlen($XL), $XL);
        switch ($VX) {
            case "\163\x68\141\62\x35\66":
                $mN = new Crypt_Hash("\x73\150\x61\62\65\66");
                $qp = base64_encode($mN->hash($wr));
                return substr($qp, 0, strlen($qp) - 1);
            case "\x6d\x64\65":
                return substr(chunk_split(md5($wr), 2, "\x3a"), 0, -1);
            default:
                return false;
        }
        Rch:
        oAu:
    }
    function getPrivateKey($n0 = CRYPT_RSA_PUBLIC_FORMAT_PKCS1)
    {
        if (!empty($this->primes)) {
            goto UZg;
        }
        return false;
        UZg:
        $nj = $this->privateKeyFormat;
        $this->privateKeyFormat = $n0;
        $DA = $this->_convertPrivateKey($this->modulus, $this->publicExponent, $this->exponent, $this->primes, $this->exponents, $this->coefficients);
        $this->privateKeyFormat = $nj;
        return $DA;
    }
    function _getPrivatePublicKey($tp = CRYPT_RSA_PUBLIC_FORMAT_PKCS8)
    {
        if (!(empty($this->modulus) || empty($this->exponent))) {
            goto lcd;
        }
        return false;
        lcd:
        $nj = $this->publicKeyFormat;
        $this->publicKeyFormat = $tp;
        $DA = $this->_convertPublicKey($this->modulus, $this->exponent);
        $this->publicKeyFormat = $nj;
        return $DA;
    }
    function __toString()
    {
        $mx = $this->getPrivateKey($this->privateKeyFormat);
        if (!($mx !== false)) {
            goto IGM;
        }
        return $mx;
        IGM:
        $mx = $this->_getPrivatePublicKey($this->publicKeyFormat);
        return $mx !== false ? $mx : '';
    }
    function __clone()
    {
        $mx = new Crypt_RSA();
        $mx->loadKey($this);
        return $mx;
    }
    function _generateMinMax($ST)
    {
        $Bk = $ST >> 3;
        $lC = str_repeat(chr(0), $Bk);
        $fu = str_repeat(chr(0xff), $Bk);
        $m0 = $ST & 7;
        if ($m0) {
            goto A4U;
        }
        $lC[0] = chr(0x80);
        goto yao;
        A4U:
        $lC = chr(1 << $m0 - 1) . $lC;
        $fu = chr((1 << $m0) - 1) . $fu;
        yao:
        return array("\155\x69\x6e" => new Math_BigInteger($lC, 256), "\155\x61\170" => new Math_BigInteger($fu, 256));
    }
    function _decodeLength(&$jA)
    {
        $MI = ord($this->_string_shift($jA));
        if (!($MI & 0x80)) {
            goto UeY;
        }
        $MI &= 0x7f;
        $DA = $this->_string_shift($jA, $MI);
        list(, $MI) = unpack("\116", substr(str_pad($DA, 4, chr(0), STR_PAD_LEFT), -4));
        UeY:
        return $MI;
    }
    function _encodeLength($MI)
    {
        if (!($MI <= 0x7f)) {
            goto xyR;
        }
        return chr($MI);
        xyR:
        $DA = ltrim(pack("\116", $MI), chr(0));
        return pack("\x43\141\52", 0x80 | strlen($DA), $DA);
    }
    function _string_shift(&$jA, $Fx = 1)
    {
        $ik = substr($jA, 0, $Fx);
        $jA = substr($jA, $Fx);
        return $ik;
    }
    function setPrivateKeyFormat($Zq)
    {
        $this->privateKeyFormat = $Zq;
    }
    function setPublicKeyFormat($Zq)
    {
        $this->publicKeyFormat = $Zq;
    }
    function setHash($mN)
    {
        switch ($mN) {
            case "\155\144\62":
            case "\155\x64\x35":
            case "\163\150\x61\61":
            case "\163\x68\141\x32\x35\66":
            case "\x73\150\x61\x33\70\64":
            case "\163\x68\141\x35\x31\x32":
                $this->hash = new Crypt_Hash($mN);
                $this->hashName = $mN;
                goto wFw;
            default:
                $this->hash = new Crypt_Hash("\x73\x68\141\x31");
                $this->hashName = "\163\x68\141\61";
        }
        SBW:
        wFw:
        $this->hLen = $this->hash->getLength();
    }
    function setMGFHash($mN)
    {
        switch ($mN) {
            case "\x6d\144\x32":
            case "\x6d\x64\65":
            case "\x73\150\141\61":
            case "\163\x68\141\x32\65\66":
            case "\x73\x68\141\x33\70\x34":
            case "\x73\150\x61\x35\61\62":
                $this->mgfHash = new Crypt_Hash($mN);
                goto XvG;
            default:
                $this->mgfHash = new Crypt_Hash("\x73\x68\x61\61");
        }
        jSR:
        XvG:
        $this->mgfHLen = $this->mgfHash->getLength();
    }
    function setSaltLength($u5)
    {
        $this->sLen = $u5;
    }
    function _i2osp($c2, $gS)
    {
        $c2 = $c2->toBytes();
        if (!(strlen($c2) > $gS)) {
            goto uHk;
        }
        user_error("\111\156\x74\x65\x67\x65\162\x20\x74\x6f\x6f\x20\154\x61\x72\147\145");
        return false;
        uHk:
        return str_pad($c2, $gS, chr(0), STR_PAD_LEFT);
    }
    function _os2ip($c2)
    {
        return new Math_BigInteger($c2, 256);
    }
    function _exponentiate($c2)
    {
        switch (true) {
            case empty($this->primes):
            case $this->primes[1]->equals($this->zero):
            case empty($this->coefficients):
            case $this->coefficients[2]->equals($this->zero):
            case empty($this->exponents):
            case $this->exponents[1]->equals($this->zero):
                return $c2->modPow($this->exponent, $this->modulus);
        }
        Nyn:
        s36:
        $ur = count($this->primes);
        if (defined("\x43\x52\131\x50\x54\137\x52\x53\101\137\x44\111\x53\101\102\114\105\x5f\x42\114\111\116\104\x49\x4e\107")) {
            goto zgH;
        }
        $zJ = $this->primes[1];
        $vB = 2;
        n1L:
        if (!($vB <= $ur)) {
            goto lKO;
        }
        if (!($zJ->compare($this->primes[$vB]) > 0)) {
            goto e5Q;
        }
        $zJ = $this->primes[$vB];
        e5Q:
        sXw:
        $vB++;
        goto n1L;
        lKO:
        $sO = new Math_BigInteger(1);
        $mv = $sO->random($sO, $zJ->subtract($sO));
        $JK = array(1 => $this->_blind($c2, $mv, 1), 2 => $this->_blind($c2, $mv, 2));
        $Oo = $JK[1]->subtract($JK[2]);
        $Oo = $Oo->multiply($this->coefficients[2]);
        list(, $Oo) = $Oo->divide($this->primes[1]);
        $OM = $JK[2]->add($Oo->multiply($this->primes[2]));
        $mv = $this->primes[1];
        $vB = 3;
        ujF:
        if (!($vB <= $ur)) {
            goto aHy;
        }
        $JK = $this->_blind($c2, $mv, $vB);
        $mv = $mv->multiply($this->primes[$vB - 1]);
        $Oo = $JK->subtract($OM);
        $Oo = $Oo->multiply($this->coefficients[$vB]);
        list(, $Oo) = $Oo->divide($this->primes[$vB]);
        $OM = $OM->add($mv->multiply($Oo));
        dWE:
        $vB++;
        goto ujF;
        aHy:
        goto z6M;
        zgH:
        $JK = array(1 => $c2->modPow($this->exponents[1], $this->primes[1]), 2 => $c2->modPow($this->exponents[2], $this->primes[2]));
        $Oo = $JK[1]->subtract($JK[2]);
        $Oo = $Oo->multiply($this->coefficients[2]);
        list(, $Oo) = $Oo->divide($this->primes[1]);
        $OM = $JK[2]->add($Oo->multiply($this->primes[2]));
        $mv = $this->primes[1];
        $vB = 3;
        n9V:
        if (!($vB <= $ur)) {
            goto Kch;
        }
        $JK = $c2->modPow($this->exponents[$vB], $this->primes[$vB]);
        $mv = $mv->multiply($this->primes[$vB - 1]);
        $Oo = $JK->subtract($OM);
        $Oo = $Oo->multiply($this->coefficients[$vB]);
        list(, $Oo) = $Oo->divide($this->primes[$vB]);
        $OM = $OM->add($mv->multiply($Oo));
        w5S:
        $vB++;
        goto n9V;
        Kch:
        z6M:
        return $OM;
    }
    function _blind($c2, $mv, $vB)
    {
        $c2 = $c2->multiply($mv->modPow($this->publicExponent, $this->primes[$vB]));
        $c2 = $c2->modPow($this->exponents[$vB], $this->primes[$vB]);
        $mv = $mv->modInverse($this->primes[$vB]);
        $c2 = $c2->multiply($mv);
        list(, $c2) = $c2->divide($this->primes[$vB]);
        return $c2;
    }
    function _equals($c2, $zE)
    {
        if (!(strlen($c2) != strlen($zE))) {
            goto FwT;
        }
        return false;
        FwT:
        $ga = 0;
        $vB = 0;
        o_e:
        if (!($vB < strlen($c2))) {
            goto qRS;
        }
        $ga |= ord($c2[$vB]) ^ ord($zE[$vB]);
        Lk8:
        $vB++;
        goto o_e;
        qRS:
        return $ga == 0;
    }
    function _rsaep($OM)
    {
        if (!($OM->compare($this->zero) < 0 || $OM->compare($this->modulus) > 0)) {
            goto Ivx;
        }
        user_error("\115\145\163\x73\x61\147\145\40\x72\145\x70\x72\145\x73\x65\x6e\x74\x61\x74\151\166\145\x20\x6f\x75\164\x20\x6f\146\x20\162\141\x6e\x67\145");
        return false;
        Ivx:
        return $this->_exponentiate($OM);
    }
    function _rsadp($rt)
    {
        if (!($rt->compare($this->zero) < 0 || $rt->compare($this->modulus) > 0)) {
            goto BDp;
        }
        user_error("\x43\x69\x70\x68\x65\x72\164\145\170\164\x20\x72\145\x70\162\145\163\x65\x6e\164\141\x74\151\166\x65\40\157\165\x74\x20\157\x66\x20\x72\141\156\x67\145");
        return false;
        BDp:
        return $this->_exponentiate($rt);
    }
    function _rsasp1($OM)
    {
        if (!($OM->compare($this->zero) < 0 || $OM->compare($this->modulus) > 0)) {
            goto pol;
        }
        user_error("\115\x65\163\163\141\147\145\x20\162\x65\x70\162\x65\x73\145\156\164\x61\x74\151\166\145\40\x6f\165\x74\x20\157\x66\x20\162\x61\x6e\147\x65");
        return false;
        pol:
        return $this->_exponentiate($OM);
    }
    function _rsavp1($pq)
    {
        if (!($pq->compare($this->zero) < 0 || $pq->compare($this->modulus) > 0)) {
            goto VZL;
        }
        user_error("\123\151\x67\156\x61\164\165\x72\x65\x20\162\145\x70\x72\145\x73\145\156\164\141\164\x69\x76\x65\40\x6f\165\164\40\157\x66\40\x72\141\x6e\147\145");
        return false;
        VZL:
        return $this->_exponentiate($pq);
    }
    function _mgf1($P6, $Lv)
    {
        $HO = '';
        $Ev = ceil($Lv / $this->mgfHLen);
        $vB = 0;
        S_4:
        if (!($vB < $Ev)) {
            goto Rbx;
        }
        $rt = pack("\x4e", $vB);
        $HO .= $this->mgfHash->hash($P6 . $rt);
        lU8:
        $vB++;
        goto S_4;
        Rbx:
        return substr($HO, 0, $Lv);
    }
    function _rsaes_oaep_encrypt($OM, $PN = '')
    {
        $eR = strlen($OM);
        if (!($eR > $this->k - 2 * $this->hLen - 2)) {
            goto eFW;
        }
        user_error("\115\145\x73\163\x61\x67\145\x20\x74\157\157\40\154\157\x6e\147");
        return false;
        eFW:
        $qm = $this->hash->hash($PN);
        $uW = str_repeat(chr(0), $this->k - $eR - 2 * $this->hLen - 2);
        $D1 = $qm . $uW . chr(1) . $OM;
        $MO = crypt_random_string($this->hLen);
        $xx = $this->_mgf1($MO, $this->k - $this->hLen - 1);
        $di = $D1 ^ $xx;
        $g6 = $this->_mgf1($di, $this->hLen);
        $HI = $MO ^ $g6;
        $RL = chr(0) . $HI . $di;
        $OM = $this->_os2ip($RL);
        $rt = $this->_rsaep($OM);
        $rt = $this->_i2osp($rt, $this->k);
        return $rt;
    }
    function _rsaes_oaep_decrypt($rt, $PN = '')
    {
        if (!(strlen($rt) != $this->k || $this->k < 2 * $this->hLen + 2)) {
            goto fRq;
        }
        user_error("\x44\145\143\162\x79\160\164\x69\157\x6e\x20\145\162\162\x6f\x72");
        return false;
        fRq:
        $rt = $this->_os2ip($rt);
        $OM = $this->_rsadp($rt);
        if (!($OM === false)) {
            goto A3R;
        }
        user_error("\x44\145\x63\x72\171\160\164\x69\157\156\x20\x65\x72\x72\157\162");
        return false;
        A3R:
        $RL = $this->_i2osp($OM, $this->k);
        $qm = $this->hash->hash($PN);
        $zE = ord($RL[0]);
        $HI = substr($RL, 1, $this->hLen);
        $di = substr($RL, $this->hLen + 1);
        $g6 = $this->_mgf1($di, $this->hLen);
        $MO = $HI ^ $g6;
        $xx = $this->_mgf1($MO, $this->k - $this->hLen - 1);
        $D1 = $di ^ $xx;
        $ne = substr($D1, 0, $this->hLen);
        $OM = substr($D1, $this->hLen);
        if ($this->_equals($qm, $ne)) {
            goto DkP;
        }
        user_error("\104\x65\x63\x72\171\x70\164\x69\x6f\x6e\40\x65\x72\x72\157\x72");
        return false;
        DkP:
        $OM = ltrim($OM, chr(0));
        if (!(ord($OM[0]) != 1)) {
            goto GZe;
        }
        user_error("\x44\x65\143\162\171\x70\x74\x69\x6f\x6e\x20\145\162\162\x6f\162");
        return false;
        GZe:
        return substr($OM, 1);
    }
    function _raw_encrypt($OM)
    {
        $DA = $this->_os2ip($OM);
        $DA = $this->_rsaep($DA);
        return $this->_i2osp($DA, $this->k);
    }
    function _rsaes_pkcs1_v1_5_encrypt($OM)
    {
        $eR = strlen($OM);
        if (!($eR > $this->k - 11)) {
            goto S79;
        }
        user_error("\x4d\x65\163\163\141\147\x65\40\164\157\x6f\40\x6c\157\x6e\147");
        return false;
        S79:
        $th = $this->k - $eR - 3;
        $uW = '';
        FTb:
        if (!(strlen($uW) != $th)) {
            goto PX4;
        }
        $DA = crypt_random_string($th - strlen($uW));
        $DA = str_replace("\x0", '', $DA);
        $uW .= $DA;
        goto FTb;
        PX4:
        $n0 = 2;
        if (!(defined("\103\x52\x59\120\124\137\122\123\x41\x5f\x50\x4b\x43\123\61\x35\x5f\x43\x4f\115\120\x41\124") && (!isset($this->publicExponent) || $this->exponent !== $this->publicExponent))) {
            goto lDN;
        }
        $n0 = 1;
        $uW = str_repeat("\xff", $th);
        lDN:
        $RL = chr(0) . chr($n0) . $uW . chr(0) . $OM;
        $OM = $this->_os2ip($RL);
        $rt = $this->_rsaep($OM);
        $rt = $this->_i2osp($rt, $this->k);
        return $rt;
    }
    function _rsaes_pkcs1_v1_5_decrypt($rt)
    {
        if (!(strlen($rt) != $this->k)) {
            goto hvs;
        }
        user_error("\x44\145\143\x72\171\160\164\151\157\x6e\40\x65\162\x72\x6f\162");
        return false;
        hvs:
        $rt = $this->_os2ip($rt);
        $OM = $this->_rsadp($rt);
        if (!($OM === false)) {
            goto ab5;
        }
        user_error("\x44\145\143\x72\171\160\x74\x69\x6f\156\x20\x65\x72\x72\x6f\x72");
        return false;
        ab5:
        $RL = $this->_i2osp($OM, $this->k);
        if (!(ord($RL[0]) != 0 || ord($RL[1]) > 2)) {
            goto z3O;
        }
        user_error("\104\145\x63\x72\x79\160\164\151\x6f\x6e\40\145\x72\x72\157\162");
        return false;
        z3O:
        $uW = substr($RL, 2, strpos($RL, chr(0), 2) - 2);
        $OM = substr($RL, strlen($uW) + 3);
        if (!(strlen($uW) < 8)) {
            goto CO8;
        }
        user_error("\x44\145\143\162\x79\x70\x74\x69\x6f\156\40\x65\x72\162\x6f\162");
        return false;
        CO8:
        return $OM;
    }
    function _emsa_pss_encode($OM, $GM)
    {
        $sg = $GM + 1 >> 3;
        $u5 = $this->sLen !== null ? $this->sLen : $this->hLen;
        $ql = $this->hash->hash($OM);
        if (!($sg < $this->hLen + $u5 + 2)) {
            goto qNk;
        }
        user_error("\105\156\x63\x6f\x64\x69\156\x67\x20\x65\162\x72\x6f\162");
        return false;
        qNk:
        $pW = crypt_random_string($u5);
        $ME = "\0\x0\x0\x0\0\0\0\0" . $ql . $pW;
        $Oo = $this->hash->hash($ME);
        $uW = str_repeat(chr(0), $sg - $u5 - $this->hLen - 2);
        $D1 = $uW . chr(1) . $pW;
        $xx = $this->_mgf1($Oo, $sg - $this->hLen - 1);
        $di = $D1 ^ $xx;
        $di[0] = ~chr(0xff << ($GM & 7)) & $di[0];
        $RL = $di . $Oo . chr(0xbc);
        return $RL;
    }
    function _emsa_pss_verify($OM, $RL, $GM)
    {
        $sg = $GM + 1 >> 3;
        $u5 = $this->sLen !== null ? $this->sLen : $this->hLen;
        $ql = $this->hash->hash($OM);
        if (!($sg < $this->hLen + $u5 + 2)) {
            goto xsq;
        }
        return false;
        xsq:
        if (!($RL[strlen($RL) - 1] != chr(0xbc))) {
            goto RZr;
        }
        return false;
        RZr:
        $di = substr($RL, 0, -$this->hLen - 1);
        $Oo = substr($RL, -$this->hLen - 1, $this->hLen);
        $DA = chr(0xff << ($GM & 7));
        if (!((~$di[0] & $DA) != $DA)) {
            goto g3s;
        }
        return false;
        g3s:
        $xx = $this->_mgf1($Oo, $sg - $this->hLen - 1);
        $D1 = $di ^ $xx;
        $D1[0] = ~chr(0xff << ($GM & 7)) & $D1[0];
        $DA = $sg - $this->hLen - $u5 - 2;
        if (!(substr($D1, 0, $DA) != str_repeat(chr(0), $DA) || ord($D1[$DA]) != 1)) {
            goto n30;
        }
        return false;
        n30:
        $pW = substr($D1, $DA + 1);
        $ME = "\0\0\x0\0\0\0\x0\0" . $ql . $pW;
        $O5 = $this->hash->hash($ME);
        return $this->_equals($Oo, $O5);
    }
    function _rsassa_pss_sign($OM)
    {
        $RL = $this->_emsa_pss_encode($OM, 8 * $this->k - 1);
        $OM = $this->_os2ip($RL);
        $pq = $this->_rsasp1($OM);
        $pq = $this->_i2osp($pq, $this->k);
        return $pq;
    }
    function _rsassa_pss_verify($OM, $pq)
    {
        if (!(strlen($pq) != $this->k)) {
            goto vZk;
        }
        user_error("\111\156\x76\141\x6c\x69\144\40\x73\151\147\156\141\x74\165\x72\x65");
        return false;
        vZk:
        $bj = 8 * $this->k;
        $Zb = $this->_os2ip($pq);
        $ME = $this->_rsavp1($Zb);
        if (!($ME === false)) {
            goto fJY;
        }
        user_error("\111\156\x76\141\154\x69\x64\40\x73\x69\x67\156\141\x74\x75\x72\145");
        return false;
        fJY:
        $RL = $this->_i2osp($ME, $bj >> 3);
        if (!($RL === false)) {
            goto t5g;
        }
        user_error("\x49\156\x76\141\154\x69\144\x20\163\151\147\x6e\x61\x74\x75\x72\145");
        return false;
        t5g:
        return $this->_emsa_pss_verify($OM, $RL, $bj - 1);
    }
    function _emsa_pkcs1_v1_5_encode($OM, $sg)
    {
        $Oo = $this->hash->hash($OM);
        if (!($Oo === false)) {
            goto b0k;
        }
        return false;
        b0k:
        switch ($this->hashName) {
            case "\155\x64\x32":
                $HO = pack("\x48\x2a", "\63\x30\x32\60\63\x30\x30\x63\x30\x36\60\x38\62\x61\x38\66\64\70\x38\66\146\x37\60\144\60\62\x30\62\x30\x35\60\x30\60\x34\x31\x30");
                goto Udw;
            case "\155\144\x35":
                $HO = pack("\110\52", "\x33\x30\x32\60\x33\60\60\x63\60\66\x30\x38\62\141\70\66\x34\70\70\66\x66\67\60\144\60\x32\60\x35\60\65\60\60\x30\64\x31\x30");
                goto Udw;
            case "\x73\x68\141\x31":
                $HO = pack("\x48\x2a", "\x33\x30\x32\x31\63\60\60\71\x30\66\60\x35\62\142\x30\x65\60\x33\60\62\61\141\60\65\x30\x30\x30\64\x31\64");
                goto Udw;
            case "\x73\150\141\x32\x35\66":
                $HO = pack("\x48\52", "\x33\60\63\61\x33\x30\x30\144\x30\x36\x30\71\66\60\70\66\x34\x38\x30\x31\x36\65\x30\x33\x30\x34\60\62\x30\x31\60\x35\60\x30\x30\64\x32\60");
                goto Udw;
            case "\x73\x68\141\63\x38\x34":
                $HO = pack("\110\52", "\x33\x30\x34\61\x33\x30\60\144\x30\x36\x30\71\x36\x30\70\66\x34\x38\x30\x31\x36\65\x30\63\60\64\x30\x32\60\x32\x30\65\60\60\x30\64\x33\x30");
                goto Udw;
            case "\x73\x68\x61\65\x31\x32":
                $HO = pack("\x48\x2a", "\63\60\65\61\x33\60\x30\x64\60\66\x30\71\x36\60\70\x36\x34\x38\x30\61\66\x35\x30\x33\x30\x34\x30\x32\60\63\60\65\60\60\x30\64\64\x30");
        }
        AhN:
        Udw:
        $HO .= $Oo;
        $co = strlen($HO);
        if (!($sg < $co + 11)) {
            goto Ay8;
        }
        user_error("\111\x6e\x74\145\x6e\x64\145\x64\x20\x65\156\143\x6f\144\x65\x64\x20\x6d\145\163\x73\x61\x67\145\40\154\x65\x6e\x67\x74\x68\40\164\x6f\157\40\x73\150\157\162\x74");
        return false;
        Ay8:
        $uW = str_repeat(chr(0xff), $sg - $co - 3);
        $RL = "\x0\1{$uW}\x0{$HO}";
        return $RL;
    }
    function _rsassa_pkcs1_v1_5_sign($OM)
    {
        $RL = $this->_emsa_pkcs1_v1_5_encode($OM, $this->k);
        if (!($RL === false)) {
            goto MSf;
        }
        user_error("\122\123\101\x20\x6d\x6f\144\x75\x6c\x75\x73\x20\164\157\x6f\40\x73\150\x6f\x72\164");
        return false;
        MSf:
        $OM = $this->_os2ip($RL);
        $pq = $this->_rsasp1($OM);
        $pq = $this->_i2osp($pq, $this->k);
        return $pq;
    }
    function _rsassa_pkcs1_v1_5_verify($OM, $pq)
    {
        if (!(strlen($pq) != $this->k)) {
            goto DO4;
        }
        user_error("\111\x6e\x76\141\x6c\151\144\x20\163\x69\x67\156\141\164\x75\162\145");
        return false;
        DO4:
        $pq = $this->_os2ip($pq);
        $ME = $this->_rsavp1($pq);
        if (!($ME === false)) {
            goto l2P;
        }
        user_error("\111\x6e\x76\141\154\151\x64\x20\x73\151\x67\156\141\x74\165\x72\145");
        return false;
        l2P:
        $RL = $this->_i2osp($ME, $this->k);
        if (!($RL === false)) {
            goto qoz;
        }
        user_error("\x49\x6e\166\141\154\x69\x64\40\163\151\x67\x6e\x61\x74\165\x72\x65");
        return false;
        qoz:
        $Up = $this->_emsa_pkcs1_v1_5_encode($OM, $this->k);
        if (!($Up === false)) {
            goto CXm;
        }
        user_error("\x52\x53\x41\40\155\x6f\x64\x75\x6c\165\x73\40\164\157\x6f\40\x73\x68\157\162\x74");
        return false;
        CXm:
        return $this->_equals($RL, $Up);
    }
    function setEncryptionMode($tp)
    {
        $this->encryptionMode = $tp;
    }
    function setSignatureMode($tp)
    {
        $this->signatureMode = $tp;
    }
    function setComment($Sb)
    {
        $this->comment = $Sb;
    }
    function getComment()
    {
        return $this->comment;
    }
    function encrypt($Fj)
    {
        switch ($this->encryptionMode) {
            case CRYPT_RSA_ENCRYPTION_NONE:
                $Fj = str_split($Fj, $this->k);
                $ii = '';
                foreach ($Fj as $OM) {
                    $ii .= $this->_raw_encrypt($OM);
                    TrM:
                }
                BXY:
                return $ii;
            case CRYPT_RSA_ENCRYPTION_PKCS1:
                $MI = $this->k - 11;
                if (!($MI <= 0)) {
                    goto AJw;
                }
                return false;
                AJw:
                $Fj = str_split($Fj, $MI);
                $ii = '';
                foreach ($Fj as $OM) {
                    $ii .= $this->_rsaes_pkcs1_v1_5_encrypt($OM);
                    Q3K:
                }
                mek:
                return $ii;
            default:
                $MI = $this->k - 2 * $this->hLen - 2;
                if (!($MI <= 0)) {
                    goto h1t;
                }
                return false;
                h1t:
                $Fj = str_split($Fj, $MI);
                $ii = '';
                foreach ($Fj as $OM) {
                    $ii .= $this->_rsaes_oaep_encrypt($OM);
                    lri:
                }
                N07:
                return $ii;
        }
        mU1:
        RFx:
    }
    function decrypt($ii)
    {
        if (!($this->k <= 0)) {
            goto NqA;
        }
        return false;
        NqA:
        $ii = str_split($ii, $this->k);
        $ii[count($ii) - 1] = str_pad($ii[count($ii) - 1], $this->k, chr(0), STR_PAD_LEFT);
        $Fj = '';
        switch ($this->encryptionMode) {
            case CRYPT_RSA_ENCRYPTION_NONE:
                $ml = "\x5f\x72\x61\167\137\x65\x6e\x63\x72\x79\x70\164";
                goto edp;
            case CRYPT_RSA_ENCRYPTION_PKCS1:
                $ml = "\137\x72\163\141\x65\163\137\160\153\x63\163\x31\x5f\166\x31\x5f\x35\137\144\145\x63\162\171\160\164";
                goto edp;
            default:
                $ml = "\137\162\163\141\145\x73\137\157\141\x65\x70\x5f\x64\x65\143\162\x79\160\x74";
        }
        xeK:
        edp:
        foreach ($ii as $rt) {
            $DA = $this->{$ml}($rt);
            if (!($DA === false)) {
                goto Bwi;
            }
            return false;
            Bwi:
            $Fj .= $DA;
            nJr:
        }
        CyV:
        return $Fj;
    }
    function sign($tI)
    {
        if (!(empty($this->modulus) || empty($this->exponent))) {
            goto cxm;
        }
        return false;
        cxm:
        switch ($this->signatureMode) {
            case CRYPT_RSA_SIGNATURE_PKCS1:
                return $this->_rsassa_pkcs1_v1_5_sign($tI);
            default:
                return $this->_rsassa_pss_sign($tI);
        }
        xdy:
        Xc0:
    }
    function verify($tI, $sq)
    {
        if (!(empty($this->modulus) || empty($this->exponent))) {
            goto Ou_;
        }
        return false;
        Ou_:
        switch ($this->signatureMode) {
            case CRYPT_RSA_SIGNATURE_PKCS1:
                return $this->_rsassa_pkcs1_v1_5_verify($tI, $sq);
            default:
                return $this->_rsassa_pss_verify($tI, $sq);
        }
        cHt:
        KUG:
    }
    function _extractBER($zl)
    {
        $DA = preg_replace("\x23\x2e\52\x3f\x5e\55\53\133\x5e\55\x5d\x2b\55\x2b\133\x5c\162\134\156\x20\x5d\52\x24\x23\155\x73", '', $zl, 1);
        $DA = preg_replace("\x23\55\x2b\x5b\136\55\x5d\53\x2d\53\43", '', $DA);
        $DA = str_replace(array("\xd", "\12", "\40"), '', $DA);
        $DA = preg_match("\43\x5e\133\141\55\172\x41\x2d\x5a\134\x64\57\53\x5d\x2a\x3d\173\60\54\62\175\x24\43", $DA) ? base64_decode($DA) : false;
        return $DA != false ? $DA : $zl;
    }
}
