<?php


namespace MiniOrange\OAuth\Helper;

define("\x43\x52\131\120\124\137\110\x41\123\x48\x5f\115\x4f\x44\x45\x5f\111\116\124\105\x52\116\101\114", 1);
define("\x43\122\131\x50\124\137\110\101\123\x48\x5f\x4d\x4f\x44\x45\x5f\115\x48\101\123\x48", 2);
define("\x43\122\131\x50\124\x5f\110\x41\123\110\137\115\x4f\x44\105\x5f\x48\x41\x53\x48", 3);
class Crypt_Hash
{
    var $hashParam;
    var $b;
    var $l = false;
    var $hash;
    var $key = false;
    var $opad;
    var $ipad;
    function __construct($mN = "\x73\x68\141\61")
    {
        if (defined("\103\x52\x59\x50\124\137\110\101\123\110\137\x4d\117\104\x45")) {
            goto R3;
        }
        switch (true) {
            case extension_loaded("\x68\141\x73\150"):
                define("\103\122\131\120\124\137\110\101\123\x48\137\x4d\117\104\x45", CRYPT_HASH_MODE_HASH);
                goto Gd;
            case extension_loaded("\155\150\x61\163\x68"):
                define("\103\122\x59\120\x54\x5f\x48\101\123\110\x5f\115\x4f\104\x45", CRYPT_HASH_MODE_MHASH);
                goto Gd;
            default:
                define("\x43\x52\x59\120\x54\137\110\101\123\110\137\115\117\x44\105", CRYPT_HASH_MODE_INTERNAL);
        }
        SZ:
        Gd:
        R3:
        $this->setHash($mN);
    }
    function Crypt_Hash($mN = "\x73\150\141\x31")
    {
        $this->__construct($mN);
    }
    function setKey($mx = false)
    {
        $this->key = $mx;
    }
    function getHash()
    {
        return $this->hashParam;
    }
    function setHash($mN)
    {
        $this->hashParam = $mN = strtolower($mN);
        switch ($mN) {
            case "\x6d\x64\x35\55\71\x36":
            case "\163\150\x61\61\55\71\66":
            case "\163\150\141\x32\x35\66\x2d\x39\x36":
            case "\x73\150\x61\x35\61\62\55\71\x36":
                $mN = substr($mN, 0, -3);
                $this->l = 12;
                goto U3;
            case "\x6d\x64\62":
            case "\x6d\144\65":
                $this->l = 16;
                goto U3;
            case "\163\x68\x61\61":
                $this->l = 20;
                goto U3;
            case "\x73\150\141\62\x35\x36":
                $this->l = 32;
                goto U3;
            case "\163\150\x61\63\x38\x34":
                $this->l = 48;
                goto U3;
            case "\x73\150\141\x35\61\62":
                $this->l = 64;
        }
        Jl:
        U3:
        switch ($mN) {
            case "\155\x64\62":
                $tp = CRYPT_HASH_MODE == CRYPT_HASH_MODE_HASH && in_array("\x6d\x64\62", hash_algos()) ? CRYPT_HASH_MODE_HASH : CRYPT_HASH_MODE_INTERNAL;
                goto eJ;
            case "\x73\150\x61\x33\70\64":
            case "\x73\x68\141\65\x31\x32":
                $tp = CRYPT_HASH_MODE == CRYPT_HASH_MODE_MHASH ? CRYPT_HASH_MODE_INTERNAL : CRYPT_HASH_MODE;
                goto eJ;
            default:
                $tp = CRYPT_HASH_MODE;
        }
        d8:
        eJ:
        switch ($tp) {
            case CRYPT_HASH_MODE_MHASH:
                switch ($mN) {
                    case "\155\144\65":
                        $this->hash = MHASH_MD5;
                        goto t2;
                    case "\x73\150\x61\62\x35\66":
                        $this->hash = MHASH_SHA256;
                        goto t2;
                    case "\163\x68\141\x31":
                    default:
                        $this->hash = MHASH_SHA1;
                }
                Sp:
                t2:
                return;
            case CRYPT_HASH_MODE_HASH:
                switch ($mN) {
                    case "\155\144\x35":
                        $this->hash = "\155\x64\x35";
                        return;
                    case "\x6d\x64\62":
                    case "\163\150\x61\62\65\x36":
                    case "\163\x68\x61\63\70\x34":
                    case "\x73\x68\141\x35\x31\x32":
                        $this->hash = $mN;
                        return;
                    case "\x73\150\141\61":
                    default:
                        $this->hash = "\163\150\x61\x31";
                }
                M0:
                Pd:
                return;
        }
        QY:
        dW:
        switch ($mN) {
            case "\155\144\62":
                $this->b = 16;
                $this->hash = array($this, "\x5f\x6d\144\x32");
                goto ng;
            case "\x6d\x64\x35":
                $this->b = 64;
                $this->hash = array($this, "\x5f\155\144\x35");
                goto ng;
            case "\x73\150\x61\62\x35\x36":
                $this->b = 64;
                $this->hash = array($this, "\x5f\x73\x68\141\x32\65\x36");
                goto ng;
            case "\163\150\141\x33\x38\x34":
            case "\163\x68\x61\65\x31\x32":
                $this->b = 128;
                $this->hash = array($this, "\137\163\x68\141\x35\x31\x32");
                goto ng;
            case "\x73\x68\x61\x31":
            default:
                $this->b = 64;
                $this->hash = array($this, "\137\163\150\141\61");
        }
        jQ:
        ng:
        $this->ipad = str_repeat(chr(0x36), $this->b);
        $this->opad = str_repeat(chr(0x5c), $this->b);
    }
    function hash($li)
    {
        $tp = is_array($this->hash) ? CRYPT_HASH_MODE_INTERNAL : CRYPT_HASH_MODE;
        if (!empty($this->key) || is_string($this->key)) {
            goto q0N;
        }
        switch ($tp) {
            case CRYPT_HASH_MODE_MHASH:
                $Ok = mhash($this->hash, $li);
                goto pI;
            case CRYPT_HASH_MODE_HASH:
                $Ok = hash($this->hash, $li, true);
                goto pI;
            case CRYPT_HASH_MODE_INTERNAL:
                $Ok = call_user_func($this->hash, $li);
        }
        x3O:
        pI:
        goto YKP;
        q0N:
        switch ($tp) {
            case CRYPT_HASH_MODE_MHASH:
                $Ok = mhash($this->hash, $li, $this->key);
                goto qu;
            case CRYPT_HASH_MODE_HASH:
                $Ok = hash_hmac($this->hash, $li, $this->key, true);
                goto qu;
            case CRYPT_HASH_MODE_INTERNAL:
                $mx = strlen($this->key) > $this->b ? call_user_func($this->hash, $this->key) : $this->key;
                $mx = str_pad($mx, $this->b, chr(0));
                $DA = $this->ipad ^ $mx;
                $DA .= $li;
                $DA = call_user_func($this->hash, $DA);
                $Ok = $this->opad ^ $mx;
                $Ok .= $DA;
                $Ok = call_user_func($this->hash, $Ok);
        }
        Hr:
        qu:
        YKP:
        return substr($Ok, 0, $this->l);
    }
    function getLength()
    {
        return $this->l;
    }
    function _md5($OM)
    {
        return pack("\x48\52", md5($OM));
    }
    function _sha1($OM)
    {
        return pack("\x48\x2a", sha1($OM));
    }
    function _md2($OM)
    {
        static $pq = array(41, 46, 67, 201, 162, 216, 124, 1, 61, 54, 84, 161, 236, 240, 6, 19, 98, 167, 5, 243, 192, 199, 115, 140, 152, 147, 43, 217, 188, 76, 130, 202, 30, 155, 87, 60, 253, 212, 224, 22, 103, 66, 111, 24, 138, 23, 229, 18, 190, 78, 196, 214, 218, 158, 222, 73, 160, 251, 245, 142, 187, 47, 238, 122, 169, 104, 121, 145, 21, 178, 7, 63, 148, 194, 16, 137, 11, 34, 95, 33, 128, 127, 93, 154, 90, 144, 50, 39, 53, 62, 204, 231, 191, 247, 151, 3, 255, 25, 48, 179, 72, 165, 181, 209, 215, 94, 146, 42, 172, 86, 170, 198, 79, 184, 56, 210, 150, 164, 125, 182, 118, 252, 107, 226, 156, 116, 4, 241, 69, 157, 112, 89, 100, 113, 135, 32, 134, 91, 207, 101, 230, 45, 168, 2, 27, 96, 37, 173, 174, 176, 185, 246, 28, 70, 97, 105, 52, 64, 126, 15, 85, 71, 163, 35, 221, 81, 175, 58, 195, 92, 249, 206, 186, 197, 234, 38, 44, 83, 13, 110, 133, 40, 132, 9, 211, 223, 205, 244, 65, 129, 77, 82, 106, 220, 55, 200, 108, 193, 171, 250, 36, 225, 123, 8, 12, 189, 177, 74, 120, 136, 149, 139, 227, 99, 232, 109, 233, 203, 213, 254, 59, 0, 29, 57, 242, 239, 183, 14, 102, 88, 208, 228, 166, 119, 114, 248, 235, 117, 75, 10, 49, 68, 80, 180, 143, 237, 31, 26, 219, 153, 141, 51, 159, 17, 131, 20);
        $Nr = 16 - (strlen($OM) & 0xf);
        $OM .= str_repeat(chr($Nr), $Nr);
        $MI = strlen($OM);
        $rt = str_repeat(chr(0), 16);
        $PN = chr(0);
        $vB = 0;
        OlD:
        if (!($vB < $MI)) {
            goto gmp;
        }
        $aj = 0;
        d_E:
        if (!($aj < 16)) {
            goto FWy;
        }
        $rt[$aj] = chr($pq[ord($OM[$vB + $aj] ^ $PN)] ^ ord($rt[$aj]));
        $PN = $rt[$aj];
        s_J:
        $aj++;
        goto d_E;
        FWy:
        X3y:
        $vB += 16;
        goto OlD;
        gmp:
        $OM .= $rt;
        $MI += 16;
        $c2 = str_repeat(chr(0), 48);
        $vB = 0;
        alj:
        if (!($vB < $MI)) {
            goto OK8;
        }
        $aj = 0;
        hCP:
        if (!($aj < 16)) {
            goto xRb;
        }
        $c2[$aj + 16] = $OM[$vB + $aj];
        $c2[$aj + 32] = $c2[$aj + 16] ^ $c2[$aj];
        QHN:
        $aj++;
        goto hCP;
        xRb:
        $HO = chr(0);
        $aj = 0;
        ZB3:
        if (!($aj < 18)) {
            goto za0;
        }
        $N1 = 0;
        YYU:
        if (!($N1 < 48)) {
            goto BBP;
        }
        $c2[$N1] = $HO = $c2[$N1] ^ chr($pq[ord($HO)]);
        uXv:
        $N1++;
        goto YYU;
        BBP:
        $HO = chr(ord($HO) + $aj);
        L65:
        $aj++;
        goto ZB3;
        za0:
        ub_:
        $vB += 16;
        goto alj;
        OK8:
        return substr($c2, 0, 16);
    }
    function _sha256($OM)
    {
        if (!extension_loaded("\x73\x75\x68\157\163\151\156")) {
            goto qxB;
        }
        return pack("\110\x2a", sha256($OM));
        qxB:
        $mN = array(0x6a09e667, 0xbb67ae85, 0x3c6ef372, 0xa54ff53a, 0x510e527f, 0x9b05688c, 0x1f83d9ab, 0x5be0cd19);
        static $N1 = array(0x428a2f98, 0x71374491, 0xb5c0fbcf, 0xe9b5dba5, 0x3956c25b, 0x59f111f1, 0x923f82a4, 0xab1c5ed5, 0xd807aa98, 0x12835b01, 0x243185be, 0x550c7dc3, 0x72be5d74, 0x80deb1fe, 0x9bdc06a7, 0xc19bf174, 0xe49b69c1, 0xefbe4786, 0xfc19dc6, 0x240ca1cc, 0x2de92c6f, 0x4a7484aa, 0x5cb0a9dc, 0x76f988da, 0x983e5152, 0xa831c66d, 0xb00327c8, 0xbf597fc7, 0xc6e00bf3, 0xd5a79147, 0x6ca6351, 0x14292967, 0x27b70a85, 0x2e1b2138, 0x4d2c6dfc, 0x53380d13, 0x650a7354, 0x766a0abb, 0x81c2c92e, 0x92722c85, 0xa2bfe8a1, 0xa81a664b, 0xc24b8b70, 0xc76c51a3, 0xd192e819, 0xd6990624, 0xf40e3585, 0x106aa070, 0x19a4c116, 0x1e376c08, 0x2748774c, 0x34b0bcb5, 0x391c0cb3, 0x4ed8aa4a, 0x5b9cca4f, 0x682e6ff3, 0x748f82ee, 0x78a5636f, 0x84c87814, 0x8cc70208, 0x90befffa, 0xa4506ceb, 0xbef9a3f7, 0xc67178f2);
        $MI = strlen($OM);
        $OM .= str_repeat(chr(0), 64 - ($MI + 8 & 0x3f));
        $OM[$MI] = chr(0x80);
        $OM .= pack("\116\x32", 0, $MI << 3);
        $a4 = str_split($OM, 64);
        foreach ($a4 as $bH) {
            $wn = array();
            $vB = 0;
            XiT:
            if (!($vB < 16)) {
                goto DTo;
            }
            extract(unpack("\116\164\145\155\x70", $this->_string_shift($bH, 4)));
            $wn[] = $DA;
            Uk4:
            $vB++;
            goto XiT;
            DTo:
            $vB = 16;
            hvd:
            if (!($vB < 64)) {
                goto RoH;
            }
            $yX = $this->_rightRotate($wn[$vB - 15], 7) ^ $this->_rightRotate($wn[$vB - 15], 18) ^ $this->_rightShift($wn[$vB - 15], 3);
            $kA = $this->_rightRotate($wn[$vB - 2], 17) ^ $this->_rightRotate($wn[$vB - 2], 19) ^ $this->_rightShift($wn[$vB - 2], 10);
            $wn[$vB] = $this->_add($wn[$vB - 16], $yX, $wn[$vB - 7], $kA);
            Ipn:
            $vB++;
            goto hvd;
            RoH:
            list($PQ, $WQ, $rt, $zF, $P0, $ZT, $gl, $Oo) = $mN;
            $vB = 0;
            mYa:
            if (!($vB < 64)) {
                goto SDq;
            }
            $yX = $this->_rightRotate($PQ, 2) ^ $this->_rightRotate($PQ, 13) ^ $this->_rightRotate($PQ, 22);
            $Vi = $PQ & $WQ ^ $PQ & $rt ^ $WQ & $rt;
            $ya = $this->_add($yX, $Vi);
            $kA = $this->_rightRotate($P0, 6) ^ $this->_rightRotate($P0, 11) ^ $this->_rightRotate($P0, 25);
            $lj = $P0 & $ZT ^ $this->_not($P0) & $gl;
            $bx = $this->_add($Oo, $kA, $lj, $N1[$vB], $wn[$vB]);
            $Oo = $gl;
            $gl = $ZT;
            $ZT = $P0;
            $P0 = $this->_add($zF, $bx);
            $zF = $rt;
            $rt = $WQ;
            $WQ = $PQ;
            $PQ = $this->_add($bx, $ya);
            wm8:
            $vB++;
            goto mYa;
            SDq:
            $mN = array($this->_add($mN[0], $PQ), $this->_add($mN[1], $WQ), $this->_add($mN[2], $rt), $this->_add($mN[3], $zF), $this->_add($mN[4], $P0), $this->_add($mN[5], $ZT), $this->_add($mN[6], $gl), $this->_add($mN[7], $Oo));
            w9K:
        }
        wOr:
        return pack("\116\x38", $mN[0], $mN[1], $mN[2], $mN[3], $mN[4], $mN[5], $mN[6], $mN[7]);
    }
    function _sha512($OM)
    {
        if (class_exists("\115\x61\x74\150\x5f\102\151\147\x49\156\164\x65\x67\145\x72")) {
            goto idv;
        }
        include_once "\115\141\x74\x68\x2f\102\151\x67\x49\x6e\x74\145\x67\145\x72\x2e\x70\x68\160";
        idv:
        static $SD, $Ma, $N1;
        if (isset($N1)) {
            goto Z9y;
        }
        $SD = array("\x63\142\x62\x62\x39\144\x35\x64\x63\x31\x30\x35\x39\145\x64\70", "\x36\62\71\141\x32\x39\62\141\63\x36\x37\143\144\x35\x30\67", "\x39\61\x35\71\x30\61\65\x61\63\60\x37\x30\x64\144\x31\67", "\x31\65\62\x66\145\143\144\70\x66\67\60\x65\65\71\x33\71", "\x36\x37\x33\63\x32\66\x36\x37\146\146\143\x30\60\142\63\61", "\x38\x65\x62\x34\64\x61\x38\x37\x36\70\x35\x38\x31\65\61\61", "\144\x62\60\143\x32\145\60\144\66\64\146\71\70\x66\141\67", "\x34\x37\142\x35\x34\x38\x31\x64\x62\145\146\141\x34\x66\x61\x34");
        $Ma = array("\x36\x61\60\71\x65\x36\x36\x37\x66\x33\x62\143\143\x39\60\x38", "\x62\x62\66\x37\141\145\70\65\x38\64\143\x61\141\67\63\x62", "\x33\x63\66\x65\146\x33\x37\x32\x66\x65\x39\x34\146\x38\x32\x62", "\141\65\64\146\146\x35\63\141\x35\146\x31\x64\63\66\146\61", "\x35\61\60\145\65\x32\67\146\x61\144\x65\66\x38\62\x64\61", "\x39\x62\60\65\x36\x38\x38\143\62\x62\63\x65\66\x63\x31\x66", "\61\146\x38\63\144\x39\x61\x62\x66\142\x34\61\x62\x64\66\x62", "\x35\142\145\x30\x63\144\61\x39\61\63\67\145\x32\61\x37\x39");
        $vB = 0;
        Hh0:
        if (!($vB < 8)) {
            goto oTY;
        }
        $SD[$vB] = new Math_BigInteger($SD[$vB], 16);
        $SD[$vB]->setPrecision(64);
        $Ma[$vB] = new Math_BigInteger($Ma[$vB], 16);
        $Ma[$vB]->setPrecision(64);
        ujT:
        $vB++;
        goto Hh0;
        oTY:
        $N1 = array("\x34\x32\x38\141\x32\146\71\70\x64\67\62\70\141\x65\62\62", "\67\61\63\67\x34\x34\x39\61\x32\x33\145\x66\x36\65\x63\x64", "\x62\65\143\60\146\x62\x63\146\145\x63\64\x64\63\x62\62\x66", "\x65\x39\142\65\144\142\141\65\x38\x31\70\71\x64\142\142\x63", "\63\71\65\x36\143\62\x35\142\146\x33\x34\70\142\x35\63\70", "\x35\x39\146\x31\x31\x31\146\x31\142\66\x30\65\x64\x30\x31\x39", "\71\x32\x33\146\x38\62\x61\64\x61\x66\61\x39\x34\x66\71\142", "\141\x62\61\x63\65\145\x64\65\x64\x61\x36\x64\70\61\x31\x38", "\144\70\60\x37\x61\141\71\70\141\x33\60\63\60\x32\x34\x32", "\61\x32\x38\63\65\142\60\x31\x34\x35\x37\x30\66\x66\x62\x65", "\x32\x34\63\x31\70\x35\x62\145\64\x65\145\64\142\x32\x38\143", "\65\65\x30\143\x37\144\143\63\144\x35\146\x66\x62\64\145\x32", "\x37\x32\142\145\x35\x64\67\x34\x66\62\67\x62\x38\71\x36\x66", "\x38\60\x64\x65\x62\x31\146\145\x33\x62\x31\66\71\66\142\61", "\x39\x62\144\x63\x30\x36\141\x37\62\x35\143\67\61\62\63\65", "\143\x31\x39\x62\x66\61\x37\64\x63\146\66\71\x32\x36\x39\x34", "\x65\64\x39\x62\66\71\x63\x31\71\x65\x66\x31\x34\141\x64\x32", "\x65\146\x62\x65\64\67\70\66\63\70\64\x66\x32\65\x65\x33", "\60\146\x63\61\71\x64\x63\66\x38\x62\70\143\144\65\142\x35", "\x32\x34\x30\143\141\61\143\x63\67\x37\x61\143\71\x63\66\65", "\x32\144\145\71\x32\x63\x36\146\x35\x39\x32\142\60\x32\67\65", "\64\x61\67\x34\x38\64\141\141\66\145\141\x36\x65\x34\70\x33", "\65\x63\x62\60\x61\x39\144\143\x62\x64\x34\61\146\x62\144\64", "\67\x36\x66\x39\x38\70\x64\x61\x38\63\61\x31\65\63\x62\65", "\71\x38\63\145\x35\x31\x35\x32\145\x65\66\x36\x64\x66\x61\142", "\x61\x38\63\61\143\x36\66\144\62\144\x62\64\63\x32\61\60", "\x62\60\60\x33\x32\x37\x63\x38\71\x38\146\x62\x32\61\x33\x66", "\x62\x66\65\x39\x37\146\143\67\142\x65\x65\x66\x30\145\x65\64", "\x63\66\145\60\x30\142\146\x33\x33\144\x61\70\x38\x66\x63\62", "\144\65\141\67\71\x31\64\67\x39\x33\60\141\x61\67\62\65", "\60\x36\x63\x61\66\63\x35\61\145\60\x30\63\x38\x32\66\x66", "\61\64\x32\x39\x32\x39\x36\67\x30\x61\60\x65\66\x65\x37\x30", "\62\x37\x62\x37\60\141\x38\x35\x34\66\144\x32\62\146\146\143", "\62\145\x31\142\62\x31\63\70\65\x63\62\66\143\71\62\66", "\x34\144\62\143\x36\144\146\x63\x35\141\x63\x34\62\141\145\144", "\65\63\63\70\x30\144\61\x33\x39\x64\x39\x35\x62\x33\144\x66", "\66\x35\60\x61\67\63\65\x34\70\142\141\x66\66\x33\x64\x65", "\x37\66\x36\141\x30\141\142\142\63\143\67\67\x62\x32\141\x38", "\x38\x31\143\x32\x63\x39\62\145\64\67\145\144\x61\145\x65\66", "\71\62\67\x32\62\143\70\x35\x31\64\70\x32\63\x35\63\x62", "\141\62\x62\x66\x65\x38\x61\61\x34\143\x66\61\x30\x33\x36\x34", "\141\x38\x31\x61\x36\66\x34\142\142\x63\64\62\x33\60\60\x31", "\x63\x32\64\x62\70\142\x37\x30\x64\x30\x66\70\71\x37\x39\61", "\x63\67\x36\143\65\61\x61\63\60\x36\65\64\x62\145\x33\x30", "\144\x31\71\x32\x65\70\61\x39\x64\x36\145\x66\x35\62\61\x38", "\x64\x36\71\71\x30\x36\62\x34\65\x35\66\65\141\x39\x31\60", "\x66\x34\x30\x65\63\65\x38\65\65\67\x37\61\62\x30\x32\x61", "\61\60\66\x61\141\60\x37\60\x33\x32\142\142\144\x31\142\70", "\61\x39\x61\x34\143\61\x31\x36\142\x38\x64\62\144\x30\x63\70", "\x31\145\63\x37\66\143\x30\x38\x35\61\x34\x31\x61\x62\x35\x33", "\x32\67\64\x38\x37\x37\64\143\144\146\x38\145\x65\142\x39\x39", "\x33\64\x62\60\142\143\142\65\x65\61\x39\142\64\70\x61\70", "\63\71\61\143\60\143\142\x33\143\65\143\x39\65\x61\66\x33", "\x34\145\144\70\141\141\64\x61\145\x33\x34\x31\70\141\x63\x62", "\x35\142\71\x63\143\141\64\146\x37\67\x36\x33\145\x33\67\x33", "\x36\70\x32\145\66\146\146\x33\x64\66\x62\62\142\70\141\x33", "\67\x34\x38\x66\x38\62\x65\145\x35\144\x65\146\142\x32\146\143", "\67\70\x61\x35\66\63\x36\x66\64\63\x31\x37\x32\146\66\60", "\70\64\x63\70\x37\70\61\x34\141\x31\x66\60\x61\142\x37\62", "\x38\x63\143\x37\x30\x32\60\70\x31\141\66\x34\63\71\x65\x63", "\71\60\x62\x65\x66\x66\x66\x61\62\63\x36\x33\61\145\62\70", "\x61\x34\65\x30\x36\x63\x65\x62\x64\145\70\62\x62\144\145\71", "\142\x65\x66\x39\x61\63\x66\x37\x62\62\143\x36\67\x39\61\65", "\x63\x36\x37\x31\x37\70\x66\x32\x65\x33\67\x32\x35\x33\62\x62", "\143\141\62\67\x33\x65\143\145\x65\141\62\66\x36\61\71\x63", "\144\61\x38\66\x62\x38\x63\67\62\x31\143\x30\143\62\x30\x37", "\145\x61\x64\141\x37\x64\x64\66\143\144\x65\x30\145\142\61\145", "\146\65\67\x64\64\146\x37\x66\x65\x65\x36\x65\x64\x31\67\70", "\60\x36\x66\60\x36\x37\141\141\67\x32\61\67\x36\146\142\x61", "\x30\141\66\x33\x37\x64\143\65\x61\62\x63\x38\71\x38\141\66", "\x31\x31\x33\146\71\70\x30\64\x62\145\146\x39\x30\144\141\x65", "\x31\142\67\x31\60\x62\63\x35\61\63\x31\x63\64\67\x31\142", "\62\70\144\x62\x37\67\146\x35\x32\x33\x30\64\x37\144\70\x34", "\x33\x32\x63\141\x61\x62\x37\x62\x34\x30\143\x37\x32\x34\x39\63", "\63\x63\71\x65\142\145\60\141\61\x35\143\71\142\145\x62\143", "\64\x33\x31\x64\x36\x37\x63\64\71\x63\61\x30\60\x64\64\143", "\x34\x63\x63\x35\144\64\142\x65\143\142\63\145\x34\62\142\x36", "\65\x39\67\146\x32\71\x39\143\x66\x63\66\x35\x37\x65\x32\141", "\65\146\143\x62\66\146\141\x62\x33\x61\144\x36\x66\141\145\143", "\x36\143\64\x34\x31\x39\x38\x63\64\141\64\67\65\70\x31\x37");
        $vB = 0;
        HpI:
        if (!($vB < 80)) {
            goto Ujx;
        }
        $N1[$vB] = new Math_BigInteger($N1[$vB], 16);
        hP0:
        $vB++;
        goto HpI;
        Ujx:
        Z9y:
        $mN = $this->l == 48 ? $SD : $Ma;
        $MI = strlen($OM);
        $OM .= str_repeat(chr(0), 128 - ($MI + 16 & 0x7f));
        $OM[$MI] = chr(0x80);
        $OM .= pack("\x4e\64", 0, 0, 0, $MI << 3);
        $a4 = str_split($OM, 128);
        foreach ($a4 as $bH) {
            $wn = array();
            $vB = 0;
            wf8:
            if (!($vB < 16)) {
                goto cpD;
            }
            $DA = new Math_BigInteger($this->_string_shift($bH, 8), 256);
            $DA->setPrecision(64);
            $wn[] = $DA;
            NeU:
            $vB++;
            goto wf8;
            cpD:
            $vB = 16;
            w5G:
            if (!($vB < 80)) {
                goto ggD;
            }
            $DA = array($wn[$vB - 15]->bitwise_rightRotate(1), $wn[$vB - 15]->bitwise_rightRotate(8), $wn[$vB - 15]->bitwise_rightShift(7));
            $yX = $DA[0]->bitwise_xor($DA[1]);
            $yX = $yX->bitwise_xor($DA[2]);
            $DA = array($wn[$vB - 2]->bitwise_rightRotate(19), $wn[$vB - 2]->bitwise_rightRotate(61), $wn[$vB - 2]->bitwise_rightShift(6));
            $kA = $DA[0]->bitwise_xor($DA[1]);
            $kA = $kA->bitwise_xor($DA[2]);
            $wn[$vB] = $wn[$vB - 16]->copy();
            $wn[$vB] = $wn[$vB]->add($yX);
            $wn[$vB] = $wn[$vB]->add($wn[$vB - 7]);
            $wn[$vB] = $wn[$vB]->add($kA);
            Wrt:
            $vB++;
            goto w5G;
            ggD:
            $PQ = $mN[0]->copy();
            $WQ = $mN[1]->copy();
            $rt = $mN[2]->copy();
            $zF = $mN[3]->copy();
            $P0 = $mN[4]->copy();
            $ZT = $mN[5]->copy();
            $gl = $mN[6]->copy();
            $Oo = $mN[7]->copy();
            $vB = 0;
            DqV:
            if (!($vB < 80)) {
                goto vcF;
            }
            $DA = array($PQ->bitwise_rightRotate(28), $PQ->bitwise_rightRotate(34), $PQ->bitwise_rightRotate(39));
            $yX = $DA[0]->bitwise_xor($DA[1]);
            $yX = $yX->bitwise_xor($DA[2]);
            $DA = array($PQ->bitwise_and($WQ), $PQ->bitwise_and($rt), $WQ->bitwise_and($rt));
            $Vi = $DA[0]->bitwise_xor($DA[1]);
            $Vi = $Vi->bitwise_xor($DA[2]);
            $ya = $yX->add($Vi);
            $DA = array($P0->bitwise_rightRotate(14), $P0->bitwise_rightRotate(18), $P0->bitwise_rightRotate(41));
            $kA = $DA[0]->bitwise_xor($DA[1]);
            $kA = $kA->bitwise_xor($DA[2]);
            $DA = array($P0->bitwise_and($ZT), $gl->bitwise_and($P0->bitwise_not()));
            $lj = $DA[0]->bitwise_xor($DA[1]);
            $bx = $Oo->add($kA);
            $bx = $bx->add($lj);
            $bx = $bx->add($N1[$vB]);
            $bx = $bx->add($wn[$vB]);
            $Oo = $gl->copy();
            $gl = $ZT->copy();
            $ZT = $P0->copy();
            $P0 = $zF->add($bx);
            $zF = $rt->copy();
            $rt = $WQ->copy();
            $WQ = $PQ->copy();
            $PQ = $bx->add($ya);
            ugy:
            $vB++;
            goto DqV;
            vcF:
            $mN = array($mN[0]->add($PQ), $mN[1]->add($WQ), $mN[2]->add($rt), $mN[3]->add($zF), $mN[4]->add($P0), $mN[5]->add($ZT), $mN[6]->add($gl), $mN[7]->add($Oo));
            Ery:
        }
        R8H:
        $DA = $mN[0]->toBytes() . $mN[1]->toBytes() . $mN[2]->toBytes() . $mN[3]->toBytes() . $mN[4]->toBytes() . $mN[5]->toBytes();
        if (!($this->l != 48)) {
            goto ZqR;
        }
        $DA .= $mN[6]->toBytes() . $mN[7]->toBytes();
        ZqR:
        return $DA;
    }
    function _rightRotate($vZ, $Ez)
    {
        $yM = 32 - $Ez;
        $Fe = (1 << $yM) - 1;
        return $vZ << $yM & 0xffffffff | $vZ >> $Ez & $Fe;
    }
    function _rightShift($vZ, $Ez)
    {
        $Fe = (1 << 32 - $Ez) - 1;
        return $vZ >> $Ez & $Fe;
    }
    function _not($vZ)
    {
        return ~$vZ & 0xffffffff;
    }
    function _add()
    {
        static $wX;
        if (isset($wX)) {
            goto Ugm;
        }
        $wX = pow(2, 32);
        Ugm:
        $ga = 0;
        $EP = func_get_args();
        foreach ($EP as $vS) {
            $ga += $vS < 0 ? ($vS & 0x7fffffff) + 0x80000000 : $vS;
            p8C:
        }
        otC:
        switch (true) {
            case is_int($ga):
            case version_compare(PHP_VERSION, "\x35\x2e\x33\x2e\x30") >= 0 && (php_uname("\155") & "\337\337\xdf") != "\x41\x52\115":
            case (PHP_OS & "\337\xdf\337") === "\127\111\116":
                return fmod($ga, $wX);
        }
        GTr:
        V1V:
        return fmod($ga, 0x80000000) & 0x7fffffff | (fmod(floor($ga / 0x80000000), 2) & 1) << 31;
    }
    function _string_shift(&$jA, $Fx = 1)
    {
        $ik = substr($jA, 0, $Fx);
        $jA = substr($jA, $Fx);
        return $ik;
    }
}
