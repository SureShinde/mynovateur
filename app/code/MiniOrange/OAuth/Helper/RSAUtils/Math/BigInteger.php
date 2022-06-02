<?php


namespace MiniOrange\OAuth\Helper;

define("\115\x41\x54\x48\x5f\102\x49\107\x49\116\x54\x45\107\x45\x52\137\x4d\x4f\116\x54\x47\x4f\115\105\122\x59", 0);
define("\x4d\101\124\110\x5f\x42\x49\x47\111\116\x54\x45\x47\x45\122\137\102\101\x52\x52\105\x54\x54", 1);
define("\115\101\x54\110\137\x42\111\107\111\116\124\x45\x47\105\122\x5f\x50\x4f\x57\x45\x52\x4f\106\62", 2);
define("\x4d\101\x54\110\x5f\x42\x49\x47\111\x4e\x54\105\107\105\122\x5f\x43\114\x41\123\123\111\103", 3);
define("\115\101\x54\x48\x5f\x42\111\x47\x49\116\x54\105\x47\105\x52\137\x4e\x4f\116\x45", 4);
define("\x4d\x41\x54\x48\137\102\x49\x47\x49\x4e\x54\105\x47\105\122\137\x56\x41\114\125\x45", 0);
define("\115\x41\x54\110\137\x42\x49\x47\111\x4e\124\x45\x47\105\x52\137\x53\111\107\116", 1);
define("\x4d\101\x54\x48\137\102\111\x47\x49\116\124\105\107\105\x52\x5f\x56\101\x52\x49\x41\102\114\105", 0);
define("\x4d\x41\x54\110\137\102\x49\107\111\x4e\x54\105\x47\x45\122\137\104\x41\124\x41", 1);
define("\x4d\101\124\x48\x5f\102\111\107\x49\x4e\x54\x45\107\105\x52\x5f\115\x4f\104\105\x5f\x49\116\x54\105\122\116\x41\x4c", 1);
define("\115\101\124\x48\137\x42\x49\x47\111\116\124\x45\107\x45\122\x5f\115\x4f\x44\x45\x5f\x42\x43\115\101\124\x48", 2);
define("\x4d\101\124\x48\137\x42\111\107\111\116\124\105\x47\105\122\137\x4d\117\104\x45\137\107\x4d\120", 3);
define("\115\x41\124\x48\137\102\x49\107\111\x4e\124\x45\x47\105\x52\x5f\x4b\101\122\101\124\x53\125\102\101\x5f\x43\125\x54\x4f\106\x46", 25);
class Math_BigInteger
{
    var $value;
    var $is_negative = false;
    var $precision = -1;
    var $bitmask = false;
    var $hex;
    function __construct($c2 = 0, $qp = 10)
    {
        if (defined("\x4d\x41\x54\x48\x5f\x42\111\107\x49\116\x54\x45\x47\105\122\x5f\115\x4f\x44\105")) {
            goto TuJ;
        }
        switch (true) {
            case extension_loaded("\x67\155\x70"):
                define("\x4d\x41\x54\110\x5f\x42\111\107\111\116\x54\105\x47\105\122\x5f\115\x4f\x44\105", MATH_BIGINTEGER_MODE_GMP);
                goto lFM;
            case extension_loaded("\x62\x63\x6d\x61\x74\x68"):
                define("\x4d\101\124\110\137\102\x49\x47\x49\x4e\124\105\x47\105\122\x5f\115\x4f\x44\x45", MATH_BIGINTEGER_MODE_BCMATH);
                goto lFM;
            default:
                define("\x4d\x41\124\x48\x5f\102\111\x47\111\116\x54\x45\x47\105\122\137\x4d\117\x44\105", MATH_BIGINTEGER_MODE_INTERNAL);
        }
        aBh:
        lFM:
        TuJ:
        if (!(extension_loaded("\157\x70\x65\x6e\x73\x73\x6c") && !defined("\x4d\101\x54\x48\x5f\102\x49\x47\x49\116\124\105\x47\x45\122\137\117\x50\x45\x4e\123\x53\114\x5f\104\111\x53\101\102\x4c\105") && !defined("\x4d\x41\x54\110\x5f\x42\111\x47\111\116\124\x45\x47\x45\x52\x5f\x4f\120\105\116\x53\x53\x4c\x5f\105\116\x41\102\x4c\x45\x44"))) {
            goto lJ8;
        }
        ob_start();
        @phpinfo();
        $uF = ob_get_contents();
        ob_end_clean();
        preg_match_all("\x23\x4f\x70\145\156\123\123\114\40\x28\x48\145\141\x64\x65\x72\x7c\x4c\x69\142\162\141\x72\171\51\x20\126\x65\x72\x73\x69\x6f\x6e\50\x2e\52\51\x23\x69\155", $uF, $fR);
        $N3 = array();
        if (empty($fR[1])) {
            goto woH;
        }
        $vB = 0;
        kG3:
        if (!($vB < count($fR[1]))) {
            goto Rvy;
        }
        $WN = trim(str_replace("\75\x3e", '', strip_tags($fR[2][$vB])));
        if (!preg_match("\x2f\x28\134\144\x2b\134\56\x5c\x64\x2b\x5c\56\x5c\144\53\51\x2f\151", $WN, $OM)) {
            goto tlH;
        }
        $N3[$fR[1][$vB]] = $OM[0];
        goto B37;
        tlH:
        $N3[$fR[1][$vB]] = $WN;
        B37:
        k0u:
        $vB++;
        goto kG3;
        Rvy:
        woH:
        switch (true) {
            case !isset($N3["\110\145\141\144\x65\162"]):
            case !isset($N3["\x4c\x69\142\x72\141\x72\171"]):
            case $N3["\110\x65\x61\144\x65\x72"] == $N3["\x4c\x69\x62\x72\141\162\171"]:
            case version_compare($N3["\x48\x65\141\144\x65\162"], "\x31\x2e\60\56\60") >= 0 && version_compare($N3["\114\x69\142\x72\141\x72\x79"], "\x31\x2e\60\x2e\x30") >= 0:
                define("\115\x41\124\110\137\102\x49\107\x49\116\x54\x45\107\x45\122\137\117\120\x45\x4e\x53\x53\x4c\x5f\x45\116\x41\x42\x4c\x45\104", true);
                goto MrD;
            default:
                define("\115\x41\x54\x48\137\x42\x49\107\x49\x4e\124\x45\107\105\122\137\117\120\x45\116\x53\123\x4c\137\104\111\123\101\x42\x4c\105", true);
        }
        fG0:
        MrD:
        lJ8:
        if (defined("\x50\x48\x50\x5f\111\x4e\124\x5f\123\x49\x5a\x45")) {
            goto AVC;
        }
        define("\120\110\120\137\111\116\x54\x5f\123\x49\132\x45", 4);
        AVC:
        if (!(!defined("\x4d\x41\x54\110\x5f\102\111\x47\x49\116\124\x45\x47\x45\122\137\102\101\x53\105") && MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_INTERNAL)) {
            goto Ens;
        }
        switch (PHP_INT_SIZE) {
            case 8:
                define("\x4d\x41\x54\110\x5f\102\x49\107\x49\116\124\105\107\x45\x52\137\102\101\x53\105", 31);
                define("\x4d\101\x54\x48\137\102\111\x47\111\116\x54\x45\x47\105\x52\137\x42\101\123\x45\137\x46\x55\x4c\114", 0x80000000);
                define("\115\101\124\110\137\102\x49\x47\111\x4e\x54\105\x47\105\122\137\x4d\101\130\137\104\x49\x47\x49\x54", 0x7fffffff);
                define("\x4d\101\x54\110\137\x42\x49\107\x49\x4e\124\105\107\105\x52\x5f\115\123\x42", 0x40000000);
                define("\x4d\x41\124\110\137\x42\x49\107\x49\x4e\x54\x45\x47\105\122\137\x4d\101\130\61\x30", 1000000000);
                define("\115\101\124\110\x5f\102\111\107\111\x4e\124\105\107\105\x52\x5f\115\101\x58\x31\x30\137\114\x45\116", 9);
                define("\x4d\x41\x54\110\137\x42\111\x47\111\x4e\x54\x45\107\105\122\x5f\115\x41\130\x5f\x44\111\107\x49\124\x32", pow(2, 62));
                goto Jvh;
            default:
                define("\x4d\101\x54\x48\x5f\102\111\x47\111\x4e\x54\x45\107\105\x52\137\102\x41\123\105", 26);
                define("\115\101\124\x48\x5f\x42\x49\x47\111\x4e\x54\x45\107\x45\x52\137\x42\x41\x53\105\x5f\106\125\x4c\x4c", 0x4000000);
                define("\x4d\x41\124\x48\x5f\102\111\x47\x49\116\x54\x45\107\105\x52\x5f\115\101\x58\x5f\104\111\107\111\x54", 0x3ffffff);
                define("\x4d\101\124\x48\137\102\111\107\x49\x4e\x54\105\x47\105\122\x5f\x4d\123\102", 0x2000000);
                define("\x4d\101\124\110\137\x42\x49\107\x49\x4e\124\x45\107\x45\122\x5f\x4d\x41\130\x31\60", 10000000);
                define("\x4d\x41\124\x48\x5f\x42\x49\x47\111\x4e\124\x45\x47\x45\122\137\x4d\101\x58\x31\x30\x5f\x4c\105\116", 7);
                define("\x4d\x41\x54\110\137\x42\x49\107\x49\116\124\105\x47\x45\122\137\115\x41\130\137\104\x49\107\x49\124\x32", pow(2, 52));
        }
        dbT:
        Jvh:
        Ens:
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                switch (true) {
                    case is_resource($c2) && get_resource_type($c2) == "\x47\x4d\x50\x20\151\156\x74\x65\x67\x65\x72":
                    case is_object($c2) && get_class($c2) == "\x47\115\x50":
                        $this->value = $c2;
                        return;
                }
                o2V:
                HKg:
                $this->value = gmp_init(0);
                goto qEw;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $this->value = "\60";
                goto qEw;
            default:
                $this->value = array();
        }
        XcW:
        qEw:
        if (!(empty($c2) && (abs($qp) != 256 || $c2 !== "\x30"))) {
            goto NS0;
        }
        return;
        NS0:
        switch ($qp) {
            case -256:
                if (!(ord($c2[0]) & 0x80)) {
                    goto a7Z;
                }
                $c2 = ~$c2;
                $this->is_negative = true;
                a7Z:
            case 256:
                switch (MATH_BIGINTEGER_MODE) {
                    case MATH_BIGINTEGER_MODE_GMP:
                        $this->value = function_exists("\x67\155\160\137\x69\155\160\157\162\164") ? gmp_import($c2) : gmp_init("\60\x78" . bin2hex($c2));
                        if (!$this->is_negative) {
                            goto KXF;
                        }
                        $this->value = gmp_neg($this->value);
                        KXF:
                        goto XMg;
                    case MATH_BIGINTEGER_MODE_BCMATH:
                        $lq = strlen($c2) + 3 & 0xfffffffc;
                        $c2 = str_pad($c2, $lq, chr(0), STR_PAD_LEFT);
                        $vB = 0;
                        OpG:
                        if (!($vB < $lq)) {
                            goto Iz0;
                        }
                        $this->value = bcmul($this->value, "\x34\62\71\x34\71\66\67\62\x39\66", 0);
                        $this->value = bcadd($this->value, 0x1000000 * ord($c2[$vB]) + (ord($c2[$vB + 1]) << 16 | ord($c2[$vB + 2]) << 8 | ord($c2[$vB + 3])), 0);
                        aWG:
                        $vB += 4;
                        goto OpG;
                        Iz0:
                        if (!$this->is_negative) {
                            goto b4l;
                        }
                        $this->value = "\x2d" . $this->value;
                        b4l:
                        goto XMg;
                    default:
                        vvS:
                        if (!strlen($c2)) {
                            goto Mek;
                        }
                        $this->value[] = $this->_bytes2int($this->_base256_rshift($c2, MATH_BIGINTEGER_BASE));
                        goto vvS;
                        Mek:
                }
                DfX:
                XMg:
                if (!$this->is_negative) {
                    goto uww;
                }
                if (!(MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL)) {
                    goto cJo;
                }
                $this->is_negative = false;
                cJo:
                $DA = $this->add(new Math_BigInteger("\x2d\x31"));
                $this->value = $DA->value;
                uww:
                goto Jtr;
            case 16:
            case -16:
                if (!($qp > 0 && $c2[0] == "\x2d")) {
                    goto uvQ;
                }
                $this->is_negative = true;
                $c2 = substr($c2, 1);
                uvQ:
                $c2 = preg_replace("\43\136\x28\x3f\x3a\x30\x78\x29\x3f\50\x5b\x41\x2d\106\x61\x2d\x66\x30\55\x39\135\52\x29\x2e\x2a\43", "\x24\61", $c2);
                $Tz = false;
                if (!($qp < 0 && hexdec($c2[0]) >= 8)) {
                    goto LqD;
                }
                $this->is_negative = $Tz = true;
                $c2 = bin2hex(~pack("\110\x2a", $c2));
                LqD:
                switch (MATH_BIGINTEGER_MODE) {
                    case MATH_BIGINTEGER_MODE_GMP:
                        $DA = $this->is_negative ? "\x2d\x30\x78" . $c2 : "\60\170" . $c2;
                        $this->value = gmp_init($DA);
                        $this->is_negative = false;
                        goto X8K;
                    case MATH_BIGINTEGER_MODE_BCMATH:
                        $c2 = strlen($c2) & 1 ? "\x30" . $c2 : $c2;
                        $DA = new Math_BigInteger(pack("\110\52", $c2), 256);
                        $this->value = $this->is_negative ? "\x2d" . $DA->value : $DA->value;
                        $this->is_negative = false;
                        goto X8K;
                    default:
                        $c2 = strlen($c2) & 1 ? "\60" . $c2 : $c2;
                        $DA = new Math_BigInteger(pack("\x48\52", $c2), 256);
                        $this->value = $DA->value;
                }
                NF2:
                X8K:
                if (!$Tz) {
                    goto cEI;
                }
                $DA = $this->add(new Math_BigInteger("\x2d\61"));
                $this->value = $DA->value;
                cEI:
                goto Jtr;
            case 10:
            case -10:
                $c2 = preg_replace("\x23\x28\x3f\x3c\x21\136\x29\x28\77\x3a\55\51\x2e\x2a\x7c\50\77\x3c\x3d\136\x7c\x2d\x29\60\52\174\133\136\x2d\60\x2d\71\x5d\x2e\x2a\x23", '', $c2);
                switch (MATH_BIGINTEGER_MODE) {
                    case MATH_BIGINTEGER_MODE_GMP:
                        $this->value = gmp_init($c2);
                        goto wNh;
                    case MATH_BIGINTEGER_MODE_BCMATH:
                        $this->value = $c2 === "\x2d" ? "\x30" : (string) $c2;
                        goto wNh;
                    default:
                        $DA = new Math_BigInteger();
                        $wi = new Math_BigInteger();
                        $wi->value = array(MATH_BIGINTEGER_MAX10);
                        if (!($c2[0] == "\55")) {
                            goto VMT;
                        }
                        $this->is_negative = true;
                        $c2 = substr($c2, 1);
                        VMT:
                        $c2 = str_pad($c2, strlen($c2) + (MATH_BIGINTEGER_MAX10_LEN - 1) * strlen($c2) % MATH_BIGINTEGER_MAX10_LEN, 0, STR_PAD_LEFT);
                        t1x:
                        if (!strlen($c2)) {
                            goto Tsv;
                        }
                        $DA = $DA->multiply($wi);
                        $DA = $DA->add(new Math_BigInteger($this->_int2bytes(substr($c2, 0, MATH_BIGINTEGER_MAX10_LEN)), 256));
                        $c2 = substr($c2, MATH_BIGINTEGER_MAX10_LEN);
                        goto t1x;
                        Tsv:
                        $this->value = $DA->value;
                }
                L5L:
                wNh:
                goto Jtr;
            case 2:
            case -2:
                if (!($qp > 0 && $c2[0] == "\55")) {
                    goto FsP;
                }
                $this->is_negative = true;
                $c2 = substr($c2, 1);
                FsP:
                $c2 = preg_replace("\x23\136\50\133\60\61\x5d\x2a\x29\x2e\x2a\x23", "\x24\x31", $c2);
                $c2 = str_pad($c2, strlen($c2) + 3 * strlen($c2) % 4, 0, STR_PAD_LEFT);
                $zl = "\x30\170";
                utf:
                if (!strlen($c2)) {
                    goto Lr5;
                }
                $hO = substr($c2, 0, 4);
                $zl .= dechex(bindec($hO));
                $c2 = substr($c2, 4);
                goto utf;
                Lr5:
                if (!$this->is_negative) {
                    goto D4R;
                }
                $zl = "\55" . $zl;
                D4R:
                $DA = new Math_BigInteger($zl, 8 * $qp);
                $this->value = $DA->value;
                $this->is_negative = $DA->is_negative;
                goto Jtr;
            default:
        }
        XxT:
        Jtr:
    }
    function Math_BigInteger($c2 = 0, $qp = 10)
    {
        $this->__construct($c2, $qp);
    }
    function toBytes($JW = false)
    {
        if (!$JW) {
            goto eWq;
        }
        $v8 = $this->compare(new Math_BigInteger());
        if (!($v8 == 0)) {
            goto l1A;
        }
        return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
        l1A:
        $DA = $v8 < 0 ? $this->add(new Math_BigInteger(1)) : $this->copy();
        $Bk = $DA->toBytes();
        if (!empty($Bk)) {
            goto J63;
        }
        $Bk = chr(0);
        J63:
        if (!(ord($Bk[0]) & 0x80)) {
            goto f2H;
        }
        $Bk = chr(0) . $Bk;
        f2H:
        return $v8 < 0 ? ~$Bk : $Bk;
        eWq:
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                if (!(gmp_cmp($this->value, gmp_init(0)) == 0)) {
                    goto r5g;
                }
                return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
                r5g:
                if (function_exists("\x67\155\x70\137\x65\170\x70\x6f\x72\164")) {
                    goto z_t;
                }
                $DA = gmp_strval(gmp_abs($this->value), 16);
                $DA = strlen($DA) & 1 ? "\60" . $DA : $DA;
                $DA = pack("\110\x2a", $DA);
                goto cRf;
                z_t:
                $DA = gmp_export($this->value);
                cRf:
                return $this->precision > 0 ? substr(str_pad($DA, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($DA, chr(0));
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value === "\x30")) {
                    goto fW4;
                }
                return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
                fW4:
                $Vw = '';
                $C3 = $this->value;
                if (!($C3[0] == "\55")) {
                    goto A0g;
                }
                $C3 = substr($C3, 1);
                A0g:
                EmR:
                if (!(bccomp($C3, "\60", 0) > 0)) {
                    goto ca1;
                }
                $DA = bcmod($C3, "\x31\66\x37\x37\67\62\x31\66");
                $Vw = chr($DA >> 16) . chr($DA >> 8) . chr($DA) . $Vw;
                $C3 = bcdiv($C3, "\x31\66\67\x37\x37\62\x31\66", 0);
                goto EmR;
                ca1:
                return $this->precision > 0 ? substr(str_pad($Vw, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($Vw, chr(0));
        }
        s18:
        KtC:
        if (count($this->value)) {
            goto vNO;
        }
        return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
        vNO:
        $ga = $this->_int2bytes($this->value[count($this->value) - 1]);
        $DA = $this->copy();
        $vB = count($DA->value) - 2;
        X9d:
        if (!($vB >= 0)) {
            goto r9s;
        }
        $DA->_base256_lshift($ga, MATH_BIGINTEGER_BASE);
        $ga = $ga | str_pad($DA->_int2bytes($DA->value[$vB]), strlen($ga), chr(0), STR_PAD_LEFT);
        pDq:
        --$vB;
        goto X9d;
        r9s:
        return $this->precision > 0 ? str_pad(substr($ga, -($this->precision + 7 >> 3)), $this->precision + 7 >> 3, chr(0), STR_PAD_LEFT) : $ga;
    }
    function toHex($JW = false)
    {
        return bin2hex($this->toBytes($JW));
    }
    function toBits($JW = false)
    {
        $XF = $this->toHex($JW);
        $ST = '';
        $vB = strlen($XF) - 8;
        $kb = strlen($XF) & 7;
        EUa:
        if (!($vB >= $kb)) {
            goto LdC;
        }
        $ST = str_pad(decbin(hexdec(substr($XF, $vB, 8))), 32, "\x30", STR_PAD_LEFT) . $ST;
        BzN:
        $vB -= 8;
        goto EUa;
        LdC:
        if (!$kb) {
            goto UG0;
        }
        $ST = str_pad(decbin(hexdec(substr($XF, 0, $kb))), 8, "\60", STR_PAD_LEFT) . $ST;
        UG0:
        $ga = $this->precision > 0 ? substr($ST, -$this->precision) : ltrim($ST, "\x30");
        if (!($JW && $this->compare(new Math_BigInteger()) > 0 && $this->precision <= 0)) {
            goto RC8;
        }
        return "\x30" . $ga;
        RC8:
        return $ga;
    }
    function toString()
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_strval($this->value);
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value === "\x30")) {
                    goto J2P;
                }
                return "\60";
                J2P:
                return ltrim($this->value, "\x30");
        }
        JCX:
        BNA:
        if (count($this->value)) {
            goto jpz;
        }
        return "\60";
        jpz:
        $DA = $this->copy();
        $DA->is_negative = false;
        $z8 = new Math_BigInteger();
        $z8->value = array(MATH_BIGINTEGER_MAX10);
        $ga = '';
        LPY:
        if (!count($DA->value)) {
            goto CX0;
        }
        list($DA, $wX) = $DA->divide($z8);
        $ga = str_pad(isset($wX->value[0]) ? $wX->value[0] : '', MATH_BIGINTEGER_MAX10_LEN, "\x30", STR_PAD_LEFT) . $ga;
        goto LPY;
        CX0:
        $ga = ltrim($ga, "\x30");
        if (!empty($ga)) {
            goto xyO;
        }
        $ga = "\x30";
        xyO:
        if (!$this->is_negative) {
            goto wMp;
        }
        $ga = "\x2d" . $ga;
        wMp:
        return $ga;
    }
    function copy()
    {
        $DA = new Math_BigInteger();
        $DA->value = $this->value;
        $DA->is_negative = $this->is_negative;
        $DA->precision = $this->precision;
        $DA->bitmask = $this->bitmask;
        return $DA;
    }
    function __toString()
    {
        return $this->toString();
    }
    function __clone()
    {
        return $this->copy();
    }
    function __sleep()
    {
        $this->hex = $this->toHex(true);
        $yx = array("\x68\145\x78");
        if (!($this->precision > 0)) {
            goto XV_;
        }
        $yx[] = "\160\162\145\x63\x69\x73\x69\x6f\x6e";
        XV_:
        return $yx;
    }
    function __wakeup()
    {
        $DA = new Math_BigInteger($this->hex, -16);
        $this->value = $DA->value;
        $this->is_negative = $DA->is_negative;
        if (!($this->precision > 0)) {
            goto UQ1;
        }
        $this->setPrecision($this->precision);
        UQ1:
    }
    function __debugInfo()
    {
        $lY = array();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $U7 = "\147\155\160";
                goto uaj;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $U7 = "\142\x63\x6d\x61\164\x68";
                goto uaj;
            case MATH_BIGINTEGER_MODE_INTERNAL:
                $U7 = "\x69\x6e\164\x65\x72\x6e\141\x6c";
                $lY[] = PHP_INT_SIZE == 8 ? "\66\64\x2d\x62\x69\164" : "\x33\x32\x2d\x62\151\164";
        }
        fVR:
        uaj:
        if (!(MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_GMP && defined("\115\x41\124\110\x5f\102\111\107\x49\116\124\105\107\x45\x52\x5f\117\120\x45\x4e\123\123\x4c\137\105\x4e\101\102\114\x45\x44"))) {
            goto O37;
        }
        $lY[] = "\117\160\145\156\x53\123\114";
        O37:
        if (empty($lY)) {
            goto BbW;
        }
        $U7 .= "\40\50" . implode($lY, "\x2c\x20") . "\51";
        BbW:
        return array("\166\x61\x6c\165\x65" => "\60\x78" . $this->toHex(true), "\x65\156\x67\x69\156\x65" => $U7);
    }
    function add($zE)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA = new Math_BigInteger();
                $DA->value = gmp_add($this->value, $zE->value);
                return $this->_normalize($DA);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $DA = new Math_BigInteger();
                $DA->value = bcadd($this->value, $zE->value, 0);
                return $this->_normalize($DA);
        }
        hjK:
        yNj:
        $DA = $this->_add($this->value, $this->is_negative, $zE->value, $zE->is_negative);
        $ga = new Math_BigInteger();
        $ga->value = $DA[MATH_BIGINTEGER_VALUE];
        $ga->is_negative = $DA[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($ga);
    }
    function _add($Rb, $UJ, $et, $NN)
    {
        $ho = count($Rb);
        $db = count($et);
        if ($ho == 0) {
            goto OEY;
        }
        if ($db == 0) {
            goto Yrq;
        }
        goto poS;
        OEY:
        return array(MATH_BIGINTEGER_VALUE => $et, MATH_BIGINTEGER_SIGN => $NN);
        goto poS;
        Yrq:
        return array(MATH_BIGINTEGER_VALUE => $Rb, MATH_BIGINTEGER_SIGN => $UJ);
        poS:
        if (!($UJ != $NN)) {
            goto sqs;
        }
        if (!($Rb == $et)) {
            goto r4k;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        r4k:
        $DA = $this->_subtract($Rb, false, $et, false);
        $DA[MATH_BIGINTEGER_SIGN] = $this->_compare($Rb, false, $et, false) > 0 ? $UJ : $NN;
        return $DA;
        sqs:
        if ($ho < $db) {
            goto XcP;
        }
        $dO = $db;
        $Vw = $Rb;
        goto HqG;
        XcP:
        $dO = $ho;
        $Vw = $et;
        HqG:
        $Vw[count($Vw)] = 0;
        $Xf = 0;
        $vB = 0;
        $aj = 1;
        G2j:
        if (!($aj < $dO)) {
            goto fzQ;
        }
        $hN = $Rb[$aj] * MATH_BIGINTEGER_BASE_FULL + $Rb[$vB] + $et[$aj] * MATH_BIGINTEGER_BASE_FULL + $et[$vB] + $Xf;
        $Xf = $hN >= MATH_BIGINTEGER_MAX_DIGIT2;
        $hN = $Xf ? $hN - MATH_BIGINTEGER_MAX_DIGIT2 : $hN;
        $DA = MATH_BIGINTEGER_BASE === 26 ? intval($hN / 0x4000000) : $hN >> 31;
        $Vw[$vB] = (int) ($hN - MATH_BIGINTEGER_BASE_FULL * $DA);
        $Vw[$aj] = $DA;
        xQD:
        $vB += 2;
        $aj += 2;
        goto G2j;
        fzQ:
        if (!($aj == $dO)) {
            goto pVw;
        }
        $hN = $Rb[$vB] + $et[$vB] + $Xf;
        $Xf = $hN >= MATH_BIGINTEGER_BASE_FULL;
        $Vw[$vB] = $Xf ? $hN - MATH_BIGINTEGER_BASE_FULL : $hN;
        ++$vB;
        pVw:
        if (!$Xf) {
            goto Sjn;
        }
        iQi:
        if (!($Vw[$vB] == MATH_BIGINTEGER_MAX_DIGIT)) {
            goto k6x;
        }
        $Vw[$vB] = 0;
        IES:
        ++$vB;
        goto iQi;
        k6x:
        ++$Vw[$vB];
        Sjn:
        return array(MATH_BIGINTEGER_VALUE => $this->_trim($Vw), MATH_BIGINTEGER_SIGN => $UJ);
    }
    function subtract($zE)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA = new Math_BigInteger();
                $DA->value = gmp_sub($this->value, $zE->value);
                return $this->_normalize($DA);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $DA = new Math_BigInteger();
                $DA->value = bcsub($this->value, $zE->value, 0);
                return $this->_normalize($DA);
        }
        IVU:
        orW:
        $DA = $this->_subtract($this->value, $this->is_negative, $zE->value, $zE->is_negative);
        $ga = new Math_BigInteger();
        $ga->value = $DA[MATH_BIGINTEGER_VALUE];
        $ga->is_negative = $DA[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($ga);
    }
    function _subtract($Rb, $UJ, $et, $NN)
    {
        $ho = count($Rb);
        $db = count($et);
        if ($ho == 0) {
            goto GtD;
        }
        if ($db == 0) {
            goto RQf;
        }
        goto Dfo;
        GtD:
        return array(MATH_BIGINTEGER_VALUE => $et, MATH_BIGINTEGER_SIGN => !$NN);
        goto Dfo;
        RQf:
        return array(MATH_BIGINTEGER_VALUE => $Rb, MATH_BIGINTEGER_SIGN => $UJ);
        Dfo:
        if (!($UJ != $NN)) {
            goto X1I;
        }
        $DA = $this->_add($Rb, false, $et, false);
        $DA[MATH_BIGINTEGER_SIGN] = $UJ;
        return $DA;
        X1I:
        $XK = $this->_compare($Rb, $UJ, $et, $NN);
        if ($XK) {
            goto rch;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        rch:
        if (!(!$UJ && $XK < 0 || $UJ && $XK > 0)) {
            goto yWh;
        }
        $DA = $Rb;
        $Rb = $et;
        $et = $DA;
        $UJ = !$UJ;
        $ho = count($Rb);
        $db = count($et);
        yWh:
        $Xf = 0;
        $vB = 0;
        $aj = 1;
        ciS:
        if (!($aj < $db)) {
            goto bXW;
        }
        $hN = $Rb[$aj] * MATH_BIGINTEGER_BASE_FULL + $Rb[$vB] - $et[$aj] * MATH_BIGINTEGER_BASE_FULL - $et[$vB] - $Xf;
        $Xf = $hN < 0;
        $hN = $Xf ? $hN + MATH_BIGINTEGER_MAX_DIGIT2 : $hN;
        $DA = MATH_BIGINTEGER_BASE === 26 ? intval($hN / 0x4000000) : $hN >> 31;
        $Rb[$vB] = (int) ($hN - MATH_BIGINTEGER_BASE_FULL * $DA);
        $Rb[$aj] = $DA;
        py5:
        $vB += 2;
        $aj += 2;
        goto ciS;
        bXW:
        if (!($aj == $db)) {
            goto coV;
        }
        $hN = $Rb[$vB] - $et[$vB] - $Xf;
        $Xf = $hN < 0;
        $Rb[$vB] = $Xf ? $hN + MATH_BIGINTEGER_BASE_FULL : $hN;
        ++$vB;
        coV:
        if (!$Xf) {
            goto Gyn;
        }
        PpP:
        if ($Rb[$vB]) {
            goto RWa;
        }
        $Rb[$vB] = MATH_BIGINTEGER_MAX_DIGIT;
        dgl:
        ++$vB;
        goto PpP;
        RWa:
        --$Rb[$vB];
        Gyn:
        return array(MATH_BIGINTEGER_VALUE => $this->_trim($Rb), MATH_BIGINTEGER_SIGN => $UJ);
    }
    function multiply($c2)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA = new Math_BigInteger();
                $DA->value = gmp_mul($this->value, $c2->value);
                return $this->_normalize($DA);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $DA = new Math_BigInteger();
                $DA->value = bcmul($this->value, $c2->value, 0);
                return $this->_normalize($DA);
        }
        BI5:
        oMX:
        $DA = $this->_multiply($this->value, $this->is_negative, $c2->value, $c2->is_negative);
        $ut = new Math_BigInteger();
        $ut->value = $DA[MATH_BIGINTEGER_VALUE];
        $ut->is_negative = $DA[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($ut);
    }
    function _multiply($Rb, $UJ, $et, $NN)
    {
        $LI = count($Rb);
        $iJ = count($et);
        if (!(!$LI || !$iJ)) {
            goto r84;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        r84:
        return array(MATH_BIGINTEGER_VALUE => min($LI, $iJ) < 2 * MATH_BIGINTEGER_KARATSUBA_CUTOFF ? $this->_trim($this->_regularMultiply($Rb, $et)) : $this->_trim($this->_karatsuba($Rb, $et)), MATH_BIGINTEGER_SIGN => $UJ != $NN);
    }
    function _regularMultiply($Rb, $et)
    {
        $LI = count($Rb);
        $iJ = count($et);
        if (!(!$LI || !$iJ)) {
            goto NDZ;
        }
        return array();
        NDZ:
        if (!($LI < $iJ)) {
            goto ge7;
        }
        $DA = $Rb;
        $Rb = $et;
        $et = $DA;
        $LI = count($Rb);
        $iJ = count($et);
        ge7:
        $eP = $this->_array_repeat(0, $LI + $iJ);
        $Xf = 0;
        $aj = 0;
        DER:
        if (!($aj < $LI)) {
            goto DV3;
        }
        $DA = $Rb[$aj] * $et[0] + $Xf;
        $Xf = MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$aj] = (int) ($DA - MATH_BIGINTEGER_BASE_FULL * $Xf);
        ao5:
        ++$aj;
        goto DER;
        DV3:
        $eP[$aj] = $Xf;
        $vB = 1;
        N12:
        if (!($vB < $iJ)) {
            goto y3x;
        }
        $Xf = 0;
        $aj = 0;
        $N1 = $vB;
        jZJ:
        if (!($aj < $LI)) {
            goto dvG;
        }
        $DA = $eP[$N1] + $Rb[$aj] * $et[$vB] + $Xf;
        $Xf = MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$N1] = (int) ($DA - MATH_BIGINTEGER_BASE_FULL * $Xf);
        P21:
        ++$aj;
        ++$N1;
        goto jZJ;
        dvG:
        $eP[$N1] = $Xf;
        UAI:
        ++$vB;
        goto N12;
        y3x:
        return $eP;
    }
    function _karatsuba($Rb, $et)
    {
        $OM = min(count($Rb) >> 1, count($et) >> 1);
        if (!($OM < MATH_BIGINTEGER_KARATSUBA_CUTOFF)) {
            goto OaR;
        }
        return $this->_regularMultiply($Rb, $et);
        OaR:
        $nF = array_slice($Rb, $OM);
        $CW = array_slice($Rb, 0, $OM);
        $J5 = array_slice($et, $OM);
        $QI = array_slice($et, 0, $OM);
        $KY = $this->_karatsuba($nF, $J5);
        $nn = $this->_karatsuba($CW, $QI);
        $Lk = $this->_add($nF, false, $CW, false);
        $DA = $this->_add($J5, false, $QI, false);
        $Lk = $this->_karatsuba($Lk[MATH_BIGINTEGER_VALUE], $DA[MATH_BIGINTEGER_VALUE]);
        $DA = $this->_add($KY, false, $nn, false);
        $Lk = $this->_subtract($Lk, false, $DA[MATH_BIGINTEGER_VALUE], false);
        $KY = array_merge(array_fill(0, 2 * $OM, 0), $KY);
        $Lk[MATH_BIGINTEGER_VALUE] = array_merge(array_fill(0, $OM, 0), $Lk[MATH_BIGINTEGER_VALUE]);
        $cB = $this->_add($KY, false, $Lk[MATH_BIGINTEGER_VALUE], $Lk[MATH_BIGINTEGER_SIGN]);
        $cB = $this->_add($cB[MATH_BIGINTEGER_VALUE], $cB[MATH_BIGINTEGER_SIGN], $nn, false);
        return $cB[MATH_BIGINTEGER_VALUE];
    }
    function _square($c2 = false)
    {
        return count($c2) < 2 * MATH_BIGINTEGER_KARATSUBA_CUTOFF ? $this->_trim($this->_baseSquare($c2)) : $this->_trim($this->_karatsubaSquare($c2));
    }
    function _baseSquare($Vw)
    {
        if (!empty($Vw)) {
            goto aSM;
        }
        return array();
        aSM:
        $kw = $this->_array_repeat(0, 2 * count($Vw));
        $vB = 0;
        $qX = count($Vw) - 1;
        sBi:
        if (!($vB <= $qX)) {
            goto nhI;
        }
        $St = $vB << 1;
        $DA = $kw[$St] + $Vw[$vB] * $Vw[$vB];
        $Xf = MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $kw[$St] = (int) ($DA - MATH_BIGINTEGER_BASE_FULL * $Xf);
        $aj = $vB + 1;
        $N1 = $St + 1;
        K4P:
        if (!($aj <= $qX)) {
            goto jsM;
        }
        $DA = $kw[$N1] + 2 * $Vw[$aj] * $Vw[$vB] + $Xf;
        $Xf = MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $kw[$N1] = (int) ($DA - MATH_BIGINTEGER_BASE_FULL * $Xf);
        R41:
        ++$aj;
        ++$N1;
        goto K4P;
        jsM:
        $kw[$vB + $qX + 1] = $Xf;
        SvH:
        ++$vB;
        goto sBi;
        nhI:
        return $kw;
    }
    function _karatsubaSquare($Vw)
    {
        $OM = count($Vw) >> 1;
        if (!($OM < MATH_BIGINTEGER_KARATSUBA_CUTOFF)) {
            goto WDS;
        }
        return $this->_baseSquare($Vw);
        WDS:
        $nF = array_slice($Vw, $OM);
        $CW = array_slice($Vw, 0, $OM);
        $KY = $this->_karatsubaSquare($nF);
        $nn = $this->_karatsubaSquare($CW);
        $Lk = $this->_add($nF, false, $CW, false);
        $Lk = $this->_karatsubaSquare($Lk[MATH_BIGINTEGER_VALUE]);
        $DA = $this->_add($KY, false, $nn, false);
        $Lk = $this->_subtract($Lk, false, $DA[MATH_BIGINTEGER_VALUE], false);
        $KY = array_merge(array_fill(0, 2 * $OM, 0), $KY);
        $Lk[MATH_BIGINTEGER_VALUE] = array_merge(array_fill(0, $OM, 0), $Lk[MATH_BIGINTEGER_VALUE]);
        $my = $this->_add($KY, false, $Lk[MATH_BIGINTEGER_VALUE], $Lk[MATH_BIGINTEGER_SIGN]);
        $my = $this->_add($my[MATH_BIGINTEGER_VALUE], $my[MATH_BIGINTEGER_SIGN], $nn, false);
        return $my[MATH_BIGINTEGER_VALUE];
    }
    function divide($zE)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $wt = new Math_BigInteger();
                $Ki = new Math_BigInteger();
                list($wt->value, $Ki->value) = gmp_div_qr($this->value, $zE->value);
                if (!(gmp_sign($Ki->value) < 0)) {
                    goto A5c;
                }
                $Ki->value = gmp_add($Ki->value, gmp_abs($zE->value));
                A5c:
                return array($this->_normalize($wt), $this->_normalize($Ki));
            case MATH_BIGINTEGER_MODE_BCMATH:
                $wt = new Math_BigInteger();
                $Ki = new Math_BigInteger();
                $wt->value = bcdiv($this->value, $zE->value, 0);
                $Ki->value = bcmod($this->value, $zE->value);
                if (!($Ki->value[0] == "\55")) {
                    goto ggC;
                }
                $Ki->value = bcadd($Ki->value, $zE->value[0] == "\x2d" ? substr($zE->value, 1) : $zE->value, 0);
                ggC:
                return array($this->_normalize($wt), $this->_normalize($Ki));
        }
        jXj:
        ix5:
        if (!(count($zE->value) == 1)) {
            goto EaQ;
        }
        list($jS, $mv) = $this->_divide_digit($this->value, $zE->value[0]);
        $wt = new Math_BigInteger();
        $Ki = new Math_BigInteger();
        $wt->value = $jS;
        $Ki->value = array($mv);
        $wt->is_negative = $this->is_negative != $zE->is_negative;
        return array($this->_normalize($wt), $this->_normalize($Ki));
        EaQ:
        static $C7;
        if (isset($C7)) {
            goto qlG;
        }
        $C7 = new Math_BigInteger();
        qlG:
        $c2 = $this->copy();
        $zE = $zE->copy();
        $BH = $c2->is_negative;
        $nq = $zE->is_negative;
        $c2->is_negative = $zE->is_negative = false;
        $XK = $c2->compare($zE);
        if ($XK) {
            goto UKC;
        }
        $DA = new Math_BigInteger();
        $DA->value = array(1);
        $DA->is_negative = $BH != $nq;
        return array($this->_normalize($DA), $this->_normalize(new Math_BigInteger()));
        UKC:
        if (!($XK < 0)) {
            goto W5V;
        }
        if (!$BH) {
            goto kpZ;
        }
        $c2 = $zE->subtract($c2);
        kpZ:
        return array($this->_normalize(new Math_BigInteger()), $this->_normalize($c2));
        W5V:
        $m0 = $zE->value[count($zE->value) - 1];
        $hn = 0;
        hNy:
        if ($m0 & MATH_BIGINTEGER_MSB) {
            goto BFz;
        }
        $m0 <<= 1;
        HMU:
        ++$hn;
        goto hNy;
        BFz:
        $c2->_lshift($hn);
        $zE->_lshift($hn);
        $et =& $zE->value;
        $JS = count($c2->value) - 1;
        $Gn = count($zE->value) - 1;
        $wt = new Math_BigInteger();
        $KV =& $wt->value;
        $KV = $this->_array_repeat(0, $JS - $Gn + 1);
        static $DA, $s0, $Fn;
        if (isset($DA)) {
            goto U0s;
        }
        $DA = new Math_BigInteger();
        $s0 = new Math_BigInteger();
        $Fn = new Math_BigInteger();
        U0s:
        $hf =& $DA->value;
        $EK =& $Fn->value;
        $hf = array_merge($this->_array_repeat(0, $JS - $Gn), $et);
        e0s:
        if (!($c2->compare($DA) >= 0)) {
            goto vhm;
        }
        ++$KV[$JS - $Gn];
        $c2 = $c2->subtract($DA);
        $JS = count($c2->value) - 1;
        goto e0s;
        vhm:
        $vB = $JS;
        Ox5:
        if (!($vB >= $Gn + 1)) {
            goto BJK;
        }
        $Rb =& $c2->value;
        $oy = array(isset($Rb[$vB]) ? $Rb[$vB] : 0, isset($Rb[$vB - 1]) ? $Rb[$vB - 1] : 0, isset($Rb[$vB - 2]) ? $Rb[$vB - 2] : 0);
        $kf = array($et[$Gn], $Gn > 0 ? $et[$Gn - 1] : 0);
        $ai = $vB - $Gn - 1;
        if ($oy[0] == $kf[0]) {
            goto Yf6;
        }
        $KV[$ai] = $this->_safe_divide($oy[0] * MATH_BIGINTEGER_BASE_FULL + $oy[1], $kf[0]);
        goto cbD;
        Yf6:
        $KV[$ai] = MATH_BIGINTEGER_MAX_DIGIT;
        cbD:
        $hf = array($kf[1], $kf[0]);
        $s0->value = array($KV[$ai]);
        $s0 = $s0->multiply($DA);
        $EK = array($oy[2], $oy[1], $oy[0]);
        Qlh:
        if (!($s0->compare($Fn) > 0)) {
            goto Ne0;
        }
        --$KV[$ai];
        $s0->value = array($KV[$ai]);
        $s0 = $s0->multiply($DA);
        goto Qlh;
        Ne0:
        $kI = $this->_array_repeat(0, $ai);
        $hf = array($KV[$ai]);
        $DA = $DA->multiply($zE);
        $hf =& $DA->value;
        $hf = array_merge($kI, $hf);
        $c2 = $c2->subtract($DA);
        if (!($c2->compare($C7) < 0)) {
            goto z1M;
        }
        $hf = array_merge($kI, $et);
        $c2 = $c2->add($DA);
        --$KV[$ai];
        z1M:
        $JS = count($Rb) - 1;
        WMg:
        --$vB;
        goto Ox5;
        BJK:
        $c2->_rshift($hn);
        $wt->is_negative = $BH != $nq;
        if (!$BH) {
            goto LSi;
        }
        $zE->_rshift($hn);
        $c2 = $zE->subtract($c2);
        LSi:
        return array($this->_normalize($wt), $this->_normalize($c2));
    }
    function _divide_digit($WH, $z8)
    {
        $Xf = 0;
        $ga = array();
        $vB = count($WH) - 1;
        uCH:
        if (!($vB >= 0)) {
            goto sDo;
        }
        $DA = MATH_BIGINTEGER_BASE_FULL * $Xf + $WH[$vB];
        $ga[$vB] = $this->_safe_divide($DA, $z8);
        $Xf = (int) ($DA - $z8 * $ga[$vB]);
        WXH:
        --$vB;
        goto uCH;
        sDo:
        return array($ga, $Xf);
    }
    function modPow($P0, $Td)
    {
        $Td = $this->bitmask !== false && $this->bitmask->compare($Td) < 0 ? $this->bitmask : $Td->abs();
        if (!($P0->compare(new Math_BigInteger()) < 0)) {
            goto Q9v;
        }
        $P0 = $P0->abs();
        $DA = $this->modInverse($Td);
        if (!($DA === false)) {
            goto Y2u;
        }
        return false;
        Y2u:
        return $this->_normalize($DA->modPow($P0, $Td));
        Q9v:
        if (!(MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_GMP)) {
            goto Qyq;
        }
        $DA = new Math_BigInteger();
        $DA->value = gmp_powm($this->value, $P0->value, $Td->value);
        return $this->_normalize($DA);
        Qyq:
        if (!($this->compare(new Math_BigInteger()) < 0 || $this->compare($Td) > 0)) {
            goto A3H;
        }
        list(, $DA) = $this->divide($Td);
        return $DA->modPow($P0, $Td);
        A3H:
        if (!defined("\x4d\101\x54\x48\x5f\x42\111\107\x49\116\124\x45\107\x45\x52\x5f\x4f\x50\105\x4e\123\123\x4c\137\x45\116\101\102\x4c\x45\104")) {
            goto yuD;
        }
        $wM = array("\155\157\144\x75\x6c\165\x73" => $Td->toBytes(true), "\x70\165\x62\x6c\151\x63\105\x78\160\x6f\156\145\x6e\x74" => $P0->toBytes(true));
        $wM = array("\x6d\157\144\x75\154\x75\x73" => pack("\x43\x61\52\x61\52", 2, $this->_encodeASN1Length(strlen($wM["\155\157\144\165\x6c\x75\x73"])), $wM["\155\x6f\x64\165\154\x75\x73"]), "\160\x75\x62\x6c\151\x63\x45\170\160\x6f\x6e\145\156\164" => pack("\x43\x61\52\141\52", 2, $this->_encodeASN1Length(strlen($wM["\x70\165\142\x6c\151\143\105\170\x70\157\x6e\145\156\x74"])), $wM["\160\165\x62\154\151\x63\105\170\x70\x6f\x6e\x65\156\x74"]));
        $wr = pack("\x43\x61\52\x61\52\x61\52", 48, $this->_encodeASN1Length(strlen($wM["\155\157\x64\165\x6c\x75\x73"]) + strlen($wM["\x70\x75\142\x6c\151\143\105\x78\x70\157\156\145\156\x74"])), $wM["\155\157\144\165\154\165\163"], $wM["\x70\165\x62\154\151\143\105\x78\x70\x6f\x6e\145\156\164"]);
        $Mw = pack("\110\x2a", "\63\60\x30\144\60\66\60\x39\x32\141\x38\x36\x34\70\x38\66\x66\67\60\144\x30\x31\60\x31\x30\x31\x30\x35\x30\60");
        $wr = chr(0) . $wr;
        $wr = chr(3) . $this->_encodeASN1Length(strlen($wr)) . $wr;
        $zO = pack("\x43\x61\x2a\141\52", 48, $this->_encodeASN1Length(strlen($Mw . $wr)), $Mw . $wr);
        $wr = "\x2d\x2d\x2d\x2d\55\x42\x45\107\111\x4e\x20\x50\125\102\114\111\103\x20\x4b\105\131\55\55\55\x2d\x2d\15\xa" . chunk_split(base64_encode($zO)) . "\55\55\55\x2d\x2d\x45\x4e\x44\40\x50\x55\102\x4c\x49\x43\x20\113\105\131\x2d\x2d\x2d\x2d\55";
        $Fj = str_pad($this->toBytes(), strlen($Td->toBytes(true)) - 1, "\x0", STR_PAD_LEFT);
        if (!openssl_public_encrypt($Fj, $ga, $wr, OPENSSL_NO_PADDING)) {
            goto qMF;
        }
        return new Math_BigInteger($ga, 256);
        qMF:
        yuD:
        if (!(MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH)) {
            goto We9;
        }
        $DA = new Math_BigInteger();
        $DA->value = bcpowmod($this->value, $P0->value, $Td->value, 0);
        return $this->_normalize($DA);
        We9:
        if (!empty($P0->value)) {
            goto GMs;
        }
        $DA = new Math_BigInteger();
        $DA->value = array(1);
        return $this->_normalize($DA);
        GMs:
        if (!($P0->value == array(1))) {
            goto o8j;
        }
        list(, $DA) = $this->divide($Td);
        return $this->_normalize($DA);
        o8j:
        if (!($P0->value == array(2))) {
            goto Awr;
        }
        $DA = new Math_BigInteger();
        $DA->value = $this->_square($this->value);
        list(, $DA) = $DA->divide($Td);
        return $this->_normalize($DA);
        Awr:
        return $this->_normalize($this->_slidingWindow($P0, $Td, MATH_BIGINTEGER_BARRETT));
        if (!($Td->value[0] & 1)) {
            goto JMy;
        }
        return $this->_normalize($this->_slidingWindow($P0, $Td, MATH_BIGINTEGER_MONTGOMERY));
        JMy:
        $vB = 0;
        NAX:
        if (!($vB < count($Td->value))) {
            goto Z6K;
        }
        if (!$Td->value[$vB]) {
            goto MRA;
        }
        $DA = decbin($Td->value[$vB]);
        $aj = strlen($DA) - strrpos($DA, "\61") - 1;
        $aj += 26 * $vB;
        goto Z6K;
        MRA:
        qwo:
        ++$vB;
        goto NAX;
        Z6K:
        $k9 = $Td->copy();
        $k9->_rshift($aj);
        $q2 = new Math_BigInteger();
        $q2->value = array(1);
        $q2->_lshift($aj);
        $u2 = $k9->value != array(1) ? $this->_slidingWindow($P0, $k9, MATH_BIGINTEGER_MONTGOMERY) : new Math_BigInteger();
        $D2 = $this->_slidingWindow($P0, $q2, MATH_BIGINTEGER_POWEROF2);
        $J5 = $q2->modInverse($k9);
        $a2 = $k9->modInverse($q2);
        $ga = $u2->multiply($q2);
        $ga = $ga->multiply($J5);
        $DA = $D2->multiply($k9);
        $DA = $DA->multiply($a2);
        $ga = $ga->add($DA);
        list(, $ga) = $ga->divide($Td);
        return $this->_normalize($ga);
    }
    function powMod($P0, $Td)
    {
        return $this->modPow($P0, $Td);
    }
    function _slidingWindow($P0, $Td, $tp)
    {
        static $tR = array(7, 25, 81, 241, 673, 1793);
        $kV = $P0->value;
        $qQ = count($kV) - 1;
        $yh = decbin($kV[$qQ]);
        $vB = $qQ - 1;
        ewq:
        if (!($vB >= 0)) {
            goto kUI;
        }
        $yh .= str_pad(decbin($kV[$vB]), MATH_BIGINTEGER_BASE, "\x30", STR_PAD_LEFT);
        CL5:
        --$vB;
        goto ewq;
        kUI:
        $qQ = strlen($yh);
        $vB = 0;
        $xZ = 1;
        mCX:
        if (!($vB < count($tR) && $qQ > $tR[$vB])) {
            goto gex;
        }
        n3j:
        ++$xZ;
        ++$vB;
        goto mCX;
        gex:
        $g2 = $Td->value;
        $n_ = array();
        $n_[1] = $this->_prepareReduce($this->value, $g2, $tp);
        $n_[2] = $this->_squareReduce($n_[1], $g2, $tp);
        $DA = 1 << $xZ - 1;
        $vB = 1;
        g03:
        if (!($vB < $DA)) {
            goto R2M;
        }
        $St = $vB << 1;
        $n_[$St + 1] = $this->_multiplyReduce($n_[$St - 1], $n_[2], $g2, $tp);
        QQj:
        ++$vB;
        goto g03;
        R2M:
        $ga = array(1);
        $ga = $this->_prepareReduce($ga, $g2, $tp);
        $vB = 0;
        PEZ:
        if (!($vB < $qQ)) {
            goto h5g;
        }
        if (!$yh[$vB]) {
            goto UB4;
        }
        $aj = $xZ - 1;
        qwf:
        if (!($aj > 0)) {
            goto TCX;
        }
        if (empty($yh[$vB + $aj])) {
            goto Afk;
        }
        goto TCX;
        Afk:
        KW8:
        --$aj;
        goto qwf;
        TCX:
        $N1 = 0;
        qgP:
        if (!($N1 <= $aj)) {
            goto rO8;
        }
        $ga = $this->_squareReduce($ga, $g2, $tp);
        f_9:
        ++$N1;
        goto qgP;
        rO8:
        $ga = $this->_multiplyReduce($ga, $n_[bindec(substr($yh, $vB, $aj + 1))], $g2, $tp);
        $vB += $aj + 1;
        goto aZ1;
        UB4:
        $ga = $this->_squareReduce($ga, $g2, $tp);
        ++$vB;
        aZ1:
        gSV:
        goto PEZ;
        h5g:
        $DA = new Math_BigInteger();
        $DA->value = $this->_reduce($ga, $g2, $tp);
        return $DA;
    }
    function _reduce($c2, $Td, $tp)
    {
        switch ($tp) {
            case MATH_BIGINTEGER_MONTGOMERY:
                return $this->_montgomery($c2, $Td);
            case MATH_BIGINTEGER_BARRETT:
                return $this->_barrett($c2, $Td);
            case MATH_BIGINTEGER_POWEROF2:
                $s0 = new Math_BigInteger();
                $s0->value = $c2;
                $Fn = new Math_BigInteger();
                $Fn->value = $Td;
                return $c2->_mod2($Td);
            case MATH_BIGINTEGER_CLASSIC:
                $s0 = new Math_BigInteger();
                $s0->value = $c2;
                $Fn = new Math_BigInteger();
                $Fn->value = $Td;
                list(, $DA) = $s0->divide($Fn);
                return $DA->value;
            case MATH_BIGINTEGER_NONE:
                return $c2;
            default:
        }
        og1:
        JkC:
    }
    function _prepareReduce($c2, $Td, $tp)
    {
        if (!($tp == MATH_BIGINTEGER_MONTGOMERY)) {
            goto plQ;
        }
        return $this->_prepMontgomery($c2, $Td);
        plQ:
        return $this->_reduce($c2, $Td, $tp);
    }
    function _multiplyReduce($c2, $zE, $Td, $tp)
    {
        if (!($tp == MATH_BIGINTEGER_MONTGOMERY)) {
            goto i12;
        }
        return $this->_montgomeryMultiply($c2, $zE, $Td);
        i12:
        $DA = $this->_multiply($c2, false, $zE, false);
        return $this->_reduce($DA[MATH_BIGINTEGER_VALUE], $Td, $tp);
    }
    function _squareReduce($c2, $Td, $tp)
    {
        if (!($tp == MATH_BIGINTEGER_MONTGOMERY)) {
            goto Acn;
        }
        return $this->_montgomeryMultiply($c2, $c2, $Td);
        Acn:
        return $this->_reduce($this->_square($c2), $Td, $tp);
    }
    function _mod2($Td)
    {
        $DA = new Math_BigInteger();
        $DA->value = array(1);
        return $this->bitwise_and($Td->subtract($DA));
    }
    function _barrett($Td, $OM)
    {
        static $a5 = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        $sy = count($OM);
        if (!(count($Td) > 2 * $sy)) {
            goto U1a;
        }
        $s0 = new Math_BigInteger();
        $Fn = new Math_BigInteger();
        $s0->value = $Td;
        $Fn->value = $OM;
        list(, $DA) = $s0->divide($Fn);
        return $DA->value;
        U1a:
        if (!($sy < 5)) {
            goto fU2;
        }
        return $this->_regularBarrett($Td, $OM);
        fU2:
        if (($mx = array_search($OM, $a5[MATH_BIGINTEGER_VARIABLE])) === false) {
            goto M1b;
        }
        extract($a5[MATH_BIGINTEGER_DATA][$mx]);
        goto Yn9;
        M1b:
        $mx = count($a5[MATH_BIGINTEGER_VARIABLE]);
        $a5[MATH_BIGINTEGER_VARIABLE][] = $OM;
        $s0 = new Math_BigInteger();
        $iF =& $s0->value;
        $iF = $this->_array_repeat(0, $sy + ($sy >> 1));
        $iF[] = 1;
        $Fn = new Math_BigInteger();
        $Fn->value = $OM;
        list($Vg, $BA) = $s0->divide($Fn);
        $Vg = $Vg->value;
        $BA = $BA->value;
        $a5[MATH_BIGINTEGER_DATA][] = array("\x75" => $Vg, "\155\61" => $BA);
        Yn9:
        $wa = $sy + ($sy >> 1);
        $wL = array_slice($Td, 0, $wa);
        $rL = array_slice($Td, $wa);
        $wL = $this->_trim($wL);
        $DA = $this->_multiply($rL, false, $BA, false);
        $Td = $this->_add($wL, false, $DA[MATH_BIGINTEGER_VALUE], false);
        if (!($sy & 1)) {
            goto Wsi;
        }
        return $this->_regularBarrett($Td[MATH_BIGINTEGER_VALUE], $OM);
        Wsi:
        $DA = array_slice($Td[MATH_BIGINTEGER_VALUE], $sy - 1);
        $DA = $this->_multiply($DA, false, $Vg, false);
        $DA = array_slice($DA[MATH_BIGINTEGER_VALUE], ($sy >> 1) + 1);
        $DA = $this->_multiply($DA, false, $OM, false);
        $ga = $this->_subtract($Td[MATH_BIGINTEGER_VALUE], false, $DA[MATH_BIGINTEGER_VALUE], false);
        BGt:
        if (!($this->_compare($ga[MATH_BIGINTEGER_VALUE], $ga[MATH_BIGINTEGER_SIGN], $OM, false) >= 0)) {
            goto Rmi;
        }
        $ga = $this->_subtract($ga[MATH_BIGINTEGER_VALUE], $ga[MATH_BIGINTEGER_SIGN], $OM, false);
        goto BGt;
        Rmi:
        return $ga[MATH_BIGINTEGER_VALUE];
    }
    function _regularBarrett($c2, $Td)
    {
        static $a5 = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        $bg = count($Td);
        if (!(count($c2) > 2 * $bg)) {
            goto A8Z;
        }
        $s0 = new Math_BigInteger();
        $Fn = new Math_BigInteger();
        $s0->value = $c2;
        $Fn->value = $Td;
        list(, $DA) = $s0->divide($Fn);
        return $DA->value;
        A8Z:
        if (!(($mx = array_search($Td, $a5[MATH_BIGINTEGER_VARIABLE])) === false)) {
            goto Fn9;
        }
        $mx = count($a5[MATH_BIGINTEGER_VARIABLE]);
        $a5[MATH_BIGINTEGER_VARIABLE][] = $Td;
        $s0 = new Math_BigInteger();
        $iF =& $s0->value;
        $iF = $this->_array_repeat(0, 2 * $bg);
        $iF[] = 1;
        $Fn = new Math_BigInteger();
        $Fn->value = $Td;
        list($DA, ) = $s0->divide($Fn);
        $a5[MATH_BIGINTEGER_DATA][] = $DA->value;
        Fn9:
        $DA = array_slice($c2, $bg - 1);
        $DA = $this->_multiply($DA, false, $a5[MATH_BIGINTEGER_DATA][$mx], false);
        $DA = array_slice($DA[MATH_BIGINTEGER_VALUE], $bg + 1);
        $ga = array_slice($c2, 0, $bg + 1);
        $DA = $this->_multiplyLower($DA, false, $Td, false, $bg + 1);
        if (!($this->_compare($ga, false, $DA[MATH_BIGINTEGER_VALUE], $DA[MATH_BIGINTEGER_SIGN]) < 0)) {
            goto Sbb;
        }
        $VO = $this->_array_repeat(0, $bg + 1);
        $VO[count($VO)] = 1;
        $ga = $this->_add($ga, false, $VO, false);
        $ga = $ga[MATH_BIGINTEGER_VALUE];
        Sbb:
        $ga = $this->_subtract($ga, false, $DA[MATH_BIGINTEGER_VALUE], $DA[MATH_BIGINTEGER_SIGN]);
        kPR:
        if (!($this->_compare($ga[MATH_BIGINTEGER_VALUE], $ga[MATH_BIGINTEGER_SIGN], $Td, false) > 0)) {
            goto u63;
        }
        $ga = $this->_subtract($ga[MATH_BIGINTEGER_VALUE], $ga[MATH_BIGINTEGER_SIGN], $Td, false);
        goto kPR;
        u63:
        return $ga[MATH_BIGINTEGER_VALUE];
    }
    function _multiplyLower($Rb, $UJ, $et, $NN, $ln)
    {
        $LI = count($Rb);
        $iJ = count($et);
        if (!(!$LI || !$iJ)) {
            goto sn9;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        sn9:
        if (!($LI < $iJ)) {
            goto fiu;
        }
        $DA = $Rb;
        $Rb = $et;
        $et = $DA;
        $LI = count($Rb);
        $iJ = count($et);
        fiu:
        $eP = $this->_array_repeat(0, $LI + $iJ);
        $Xf = 0;
        $aj = 0;
        RCM:
        if (!($aj < $LI)) {
            goto d1h;
        }
        $DA = $Rb[$aj] * $et[0] + $Xf;
        $Xf = MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$aj] = (int) ($DA - MATH_BIGINTEGER_BASE_FULL * $Xf);
        gGg:
        ++$aj;
        goto RCM;
        d1h:
        if (!($aj < $ln)) {
            goto W8C;
        }
        $eP[$aj] = $Xf;
        W8C:
        $vB = 1;
        hlF:
        if (!($vB < $iJ)) {
            goto J0J;
        }
        $Xf = 0;
        $aj = 0;
        $N1 = $vB;
        xF1:
        if (!($aj < $LI && $N1 < $ln)) {
            goto Esk;
        }
        $DA = $eP[$N1] + $Rb[$aj] * $et[$vB] + $Xf;
        $Xf = MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$N1] = (int) ($DA - MATH_BIGINTEGER_BASE_FULL * $Xf);
        Xuk:
        ++$aj;
        ++$N1;
        goto xF1;
        Esk:
        if (!($N1 < $ln)) {
            goto D1s;
        }
        $eP[$N1] = $Xf;
        D1s:
        r1y:
        ++$vB;
        goto hlF;
        J0J:
        return array(MATH_BIGINTEGER_VALUE => $this->_trim($eP), MATH_BIGINTEGER_SIGN => $UJ != $NN);
    }
    function _montgomery($c2, $Td)
    {
        static $a5 = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        if (!(($mx = array_search($Td, $a5[MATH_BIGINTEGER_VARIABLE])) === false)) {
            goto uZY;
        }
        $mx = count($a5[MATH_BIGINTEGER_VARIABLE]);
        $a5[MATH_BIGINTEGER_VARIABLE][] = $c2;
        $a5[MATH_BIGINTEGER_DATA][] = $this->_modInverse67108864($Td);
        uZY:
        $N1 = count($Td);
        $ga = array(MATH_BIGINTEGER_VALUE => $c2);
        $vB = 0;
        IEs:
        if (!($vB < $N1)) {
            goto de2;
        }
        $DA = $ga[MATH_BIGINTEGER_VALUE][$vB] * $a5[MATH_BIGINTEGER_DATA][$mx];
        $DA = $DA - MATH_BIGINTEGER_BASE_FULL * (MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31);
        $DA = $this->_regularMultiply(array($DA), $Td);
        $DA = array_merge($this->_array_repeat(0, $vB), $DA);
        $ga = $this->_add($ga[MATH_BIGINTEGER_VALUE], false, $DA, false);
        qyf:
        ++$vB;
        goto IEs;
        de2:
        $ga[MATH_BIGINTEGER_VALUE] = array_slice($ga[MATH_BIGINTEGER_VALUE], $N1);
        if (!($this->_compare($ga, false, $Td, false) >= 0)) {
            goto DSn;
        }
        $ga = $this->_subtract($ga[MATH_BIGINTEGER_VALUE], false, $Td, false);
        DSn:
        return $ga[MATH_BIGINTEGER_VALUE];
    }
    function _montgomeryMultiply($c2, $zE, $OM)
    {
        $DA = $this->_multiply($c2, false, $zE, false);
        return $this->_montgomery($DA[MATH_BIGINTEGER_VALUE], $OM);
        static $a5 = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        if (!(($mx = array_search($OM, $a5[MATH_BIGINTEGER_VARIABLE])) === false)) {
            goto gpZ;
        }
        $mx = count($a5[MATH_BIGINTEGER_VARIABLE]);
        $a5[MATH_BIGINTEGER_VARIABLE][] = $OM;
        $a5[MATH_BIGINTEGER_DATA][] = $this->_modInverse67108864($OM);
        gpZ:
        $Td = max(count($c2), count($zE), count($OM));
        $c2 = array_pad($c2, $Td, 0);
        $zE = array_pad($zE, $Td, 0);
        $OM = array_pad($OM, $Td, 0);
        $PQ = array(MATH_BIGINTEGER_VALUE => $this->_array_repeat(0, $Td + 1));
        $vB = 0;
        Pn2:
        if (!($vB < $Td)) {
            goto wmG;
        }
        $DA = $PQ[MATH_BIGINTEGER_VALUE][0] + $c2[$vB] * $zE[0];
        $DA = $DA - MATH_BIGINTEGER_BASE_FULL * (MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31);
        $DA = $DA * $a5[MATH_BIGINTEGER_DATA][$mx];
        $DA = $DA - MATH_BIGINTEGER_BASE_FULL * (MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31);
        $DA = $this->_add($this->_regularMultiply(array($c2[$vB]), $zE), false, $this->_regularMultiply(array($DA), $OM), false);
        $PQ = $this->_add($PQ[MATH_BIGINTEGER_VALUE], false, $DA[MATH_BIGINTEGER_VALUE], false);
        $PQ[MATH_BIGINTEGER_VALUE] = array_slice($PQ[MATH_BIGINTEGER_VALUE], 1);
        Asg:
        ++$vB;
        goto Pn2;
        wmG:
        if (!($this->_compare($PQ[MATH_BIGINTEGER_VALUE], false, $OM, false) >= 0)) {
            goto ibo;
        }
        $PQ = $this->_subtract($PQ[MATH_BIGINTEGER_VALUE], false, $OM, false);
        ibo:
        return $PQ[MATH_BIGINTEGER_VALUE];
    }
    function _prepMontgomery($c2, $Td)
    {
        $s0 = new Math_BigInteger();
        $s0->value = array_merge($this->_array_repeat(0, count($Td)), $c2);
        $Fn = new Math_BigInteger();
        $Fn->value = $Td;
        list(, $DA) = $s0->divide($Fn);
        return $DA->value;
    }
    function _modInverse67108864($c2)
    {
        $c2 = -$c2[0];
        $ga = $c2 & 0x3;
        $ga = $ga * (2 - $c2 * $ga) & 0xf;
        $ga = $ga * (2 - ($c2 & 0xff) * $ga) & 0xff;
        $ga = $ga * (2 - ($c2 & 0xffff) * $ga & 0xffff) & 0xffff;
        $ga = fmod($ga * (2 - fmod($c2 * $ga, MATH_BIGINTEGER_BASE_FULL)), MATH_BIGINTEGER_BASE_FULL);
        return $ga & MATH_BIGINTEGER_MAX_DIGIT;
    }
    function modInverse($Td)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA = new Math_BigInteger();
                $DA->value = gmp_invert($this->value, $Td->value);
                return $DA->value === false ? false : $this->_normalize($DA);
        }
        FDw:
        snM:
        static $C7, $sO;
        if (isset($C7)) {
            goto JIr;
        }
        $C7 = new Math_BigInteger();
        $sO = new Math_BigInteger(1);
        JIr:
        $Td = $Td->abs();
        if (!($this->compare($C7) < 0)) {
            goto w20;
        }
        $DA = $this->abs();
        $DA = $DA->modInverse($Td);
        return $this->_normalize($Td->subtract($DA));
        w20:
        extract($this->extendedGCD($Td));
        if ($Yv->equals($sO)) {
            goto joX;
        }
        return false;
        joX:
        $c2 = $c2->compare($C7) < 0 ? $c2->add($Td) : $c2;
        return $this->compare($C7) < 0 ? $this->_normalize($Td->subtract($c2)) : $this->_normalize($c2);
    }
    function extendedGCD($Td)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                extract(gmp_gcdext($this->value, $Td->value));
                return array("\147\143\144" => $this->_normalize(new Math_BigInteger($gl)), "\x78" => $this->_normalize(new Math_BigInteger($pq)), "\x79" => $this->_normalize(new Math_BigInteger($HO)));
            case MATH_BIGINTEGER_MODE_BCMATH:
                $Vg = $this->value;
                $sN = $Td->value;
                $PQ = "\61";
                $WQ = "\x30";
                $rt = "\x30";
                $zF = "\61";
                eFS:
                if (!(bccomp($sN, "\60", 0) != 0)) {
                    goto WCo;
                }
                $jS = bcdiv($Vg, $sN, 0);
                $DA = $Vg;
                $Vg = $sN;
                $sN = bcsub($DA, bcmul($sN, $jS, 0), 0);
                $DA = $PQ;
                $PQ = $rt;
                $rt = bcsub($DA, bcmul($PQ, $jS, 0), 0);
                $DA = $WQ;
                $WQ = $zF;
                $zF = bcsub($DA, bcmul($WQ, $jS, 0), 0);
                goto eFS;
                WCo:
                return array("\147\x63\x64" => $this->_normalize(new Math_BigInteger($Vg)), "\x78" => $this->_normalize(new Math_BigInteger($PQ)), "\x79" => $this->_normalize(new Math_BigInteger($WQ)));
        }
        L4t:
        zkx:
        $zE = $Td->copy();
        $c2 = $this->copy();
        $gl = new Math_BigInteger();
        $gl->value = array(1);
        nVF:
        if ($c2->value[0] & 1 || $zE->value[0] & 1) {
            goto mZy;
        }
        $c2->_rshift(1);
        $zE->_rshift(1);
        $gl->_lshift(1);
        goto nVF;
        mZy:
        $Vg = $c2->copy();
        $sN = $zE->copy();
        $PQ = new Math_BigInteger();
        $WQ = new Math_BigInteger();
        $rt = new Math_BigInteger();
        $zF = new Math_BigInteger();
        $PQ->value = $zF->value = $gl->value = array(1);
        $WQ->value = $rt->value = array();
        mKO:
        if (empty($Vg->value)) {
            goto h9m;
        }
        NBg:
        if ($Vg->value[0] & 1) {
            goto g4Y;
        }
        $Vg->_rshift(1);
        if (!(!empty($PQ->value) && $PQ->value[0] & 1 || !empty($WQ->value) && $WQ->value[0] & 1)) {
            goto QQH;
        }
        $PQ = $PQ->add($zE);
        $WQ = $WQ->subtract($c2);
        QQH:
        $PQ->_rshift(1);
        $WQ->_rshift(1);
        goto NBg;
        g4Y:
        k6K:
        if ($sN->value[0] & 1) {
            goto aev;
        }
        $sN->_rshift(1);
        if (!(!empty($zF->value) && $zF->value[0] & 1 || !empty($rt->value) && $rt->value[0] & 1)) {
            goto uwa;
        }
        $rt = $rt->add($zE);
        $zF = $zF->subtract($c2);
        uwa:
        $rt->_rshift(1);
        $zF->_rshift(1);
        goto k6K;
        aev:
        if ($Vg->compare($sN) >= 0) {
            goto SnH;
        }
        $sN = $sN->subtract($Vg);
        $rt = $rt->subtract($PQ);
        $zF = $zF->subtract($WQ);
        goto MxZ;
        SnH:
        $Vg = $Vg->subtract($sN);
        $PQ = $PQ->subtract($rt);
        $WQ = $WQ->subtract($zF);
        MxZ:
        goto mKO;
        h9m:
        return array("\147\x63\x64" => $this->_normalize($gl->multiply($sN)), "\x78" => $this->_normalize($rt), "\x79" => $this->_normalize($zF));
    }
    function gcd($Td)
    {
        extract($this->extendedGCD($Td));
        return $Yv;
    }
    function abs()
    {
        $DA = new Math_BigInteger();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA->value = gmp_abs($this->value);
                goto cI0;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $DA->value = bccomp($this->value, "\x30", 0) < 0 ? substr($this->value, 1) : $this->value;
                goto cI0;
            default:
                $DA->value = $this->value;
        }
        Dcj:
        cI0:
        return $DA;
    }
    function compare($zE)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_cmp($this->value, $zE->value);
            case MATH_BIGINTEGER_MODE_BCMATH:
                return bccomp($this->value, $zE->value, 0);
        }
        kSs:
        XhU:
        return $this->_compare($this->value, $this->is_negative, $zE->value, $zE->is_negative);
    }
    function _compare($Rb, $UJ, $et, $NN)
    {
        if (!($UJ != $NN)) {
            goto GT_;
        }
        return !$UJ && $NN ? 1 : -1;
        GT_:
        $ga = $UJ ? -1 : 1;
        if (!(count($Rb) != count($et))) {
            goto aqQ;
        }
        return count($Rb) > count($et) ? $ga : -$ga;
        aqQ:
        $dO = max(count($Rb), count($et));
        $Rb = array_pad($Rb, $dO, 0);
        $et = array_pad($et, $dO, 0);
        $vB = count($Rb) - 1;
        M2I:
        if (!($vB >= 0)) {
            goto lqJ;
        }
        if (!($Rb[$vB] != $et[$vB])) {
            goto Dkr;
        }
        return $Rb[$vB] > $et[$vB] ? $ga : -$ga;
        Dkr:
        DPL:
        --$vB;
        goto M2I;
        lqJ:
        return 0;
    }
    function equals($c2)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_cmp($this->value, $c2->value) == 0;
            default:
                return $this->value === $c2->value && $this->is_negative == $c2->is_negative;
        }
        qsw:
        qaV:
    }
    function setPrecision($ST)
    {
        $this->precision = $ST;
        if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_BCMATH) {
            goto dFI;
        }
        $this->bitmask = new Math_BigInteger(bcpow("\x32", $ST, 0));
        goto kHf;
        dFI:
        $this->bitmask = new Math_BigInteger(chr((1 << ($ST & 0x7)) - 1) . str_repeat(chr(0xff), $ST >> 3), 256);
        kHf:
        $DA = $this->_normalize($this);
        $this->value = $DA->value;
    }
    function bitwise_and($c2)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA = new Math_BigInteger();
                $DA->value = gmp_and($this->value, $c2->value);
                return $this->_normalize($DA);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $ch = $this->toBytes();
                $ja = $c2->toBytes();
                $MI = max(strlen($ch), strlen($ja));
                $ch = str_pad($ch, $MI, chr(0), STR_PAD_LEFT);
                $ja = str_pad($ja, $MI, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new Math_BigInteger($ch & $ja, 256));
        }
        oXj:
        ak5:
        $ga = $this->copy();
        $MI = min(count($c2->value), count($this->value));
        $ga->value = array_slice($ga->value, 0, $MI);
        $vB = 0;
        ixq:
        if (!($vB < $MI)) {
            goto q0T;
        }
        $ga->value[$vB] &= $c2->value[$vB];
        cC6:
        ++$vB;
        goto ixq;
        q0T:
        return $this->_normalize($ga);
    }
    function bitwise_or($c2)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA = new Math_BigInteger();
                $DA->value = gmp_or($this->value, $c2->value);
                return $this->_normalize($DA);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $ch = $this->toBytes();
                $ja = $c2->toBytes();
                $MI = max(strlen($ch), strlen($ja));
                $ch = str_pad($ch, $MI, chr(0), STR_PAD_LEFT);
                $ja = str_pad($ja, $MI, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new Math_BigInteger($ch | $ja, 256));
        }
        Ixa:
        vqB:
        $MI = max(count($this->value), count($c2->value));
        $ga = $this->copy();
        $ga->value = array_pad($ga->value, $MI, 0);
        $c2->value = array_pad($c2->value, $MI, 0);
        $vB = 0;
        DuK:
        if (!($vB < $MI)) {
            goto r0V;
        }
        $ga->value[$vB] |= $c2->value[$vB];
        k17:
        ++$vB;
        goto DuK;
        r0V:
        return $this->_normalize($ga);
    }
    function bitwise_xor($c2)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $DA = new Math_BigInteger();
                $DA->value = gmp_xor(gmp_abs($this->value), gmp_abs($c2->value));
                return $this->_normalize($DA);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $ch = $this->toBytes();
                $ja = $c2->toBytes();
                $MI = max(strlen($ch), strlen($ja));
                $ch = str_pad($ch, $MI, chr(0), STR_PAD_LEFT);
                $ja = str_pad($ja, $MI, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new Math_BigInteger($ch ^ $ja, 256));
        }
        hzC:
        vM_:
        $MI = max(count($this->value), count($c2->value));
        $ga = $this->copy();
        $ga->is_negative = false;
        $ga->value = array_pad($ga->value, $MI, 0);
        $c2->value = array_pad($c2->value, $MI, 0);
        $vB = 0;
        ZgO:
        if (!($vB < $MI)) {
            goto GtR;
        }
        $ga->value[$vB] ^= $c2->value[$vB];
        qEg:
        ++$vB;
        goto ZgO;
        GtR:
        return $this->_normalize($ga);
    }
    function bitwise_not()
    {
        $DA = $this->toBytes();
        if (!($DA == '')) {
            goto sFh;
        }
        return $this->_normalize(new Math_BigInteger());
        sFh:
        $la = decbin(ord($DA[0]));
        $DA = ~$DA;
        $m0 = decbin(ord($DA[0]));
        if (!(strlen($m0) == 8)) {
            goto Owq;
        }
        $m0 = substr($m0, strpos($m0, "\x30"));
        Owq:
        $DA[0] = chr(bindec($m0));
        $I4 = strlen($la) + 8 * strlen($DA) - 8;
        $rr = $this->precision - $I4;
        if (!($rr <= 0)) {
            goto WAJ;
        }
        return $this->_normalize(new Math_BigInteger($DA, 256));
        WAJ:
        $hv = chr((1 << ($rr & 0x7)) - 1) . str_repeat(chr(0xff), $rr >> 3);
        $this->_base256_lshift($hv, $I4);
        $DA = str_pad($DA, strlen($hv), chr(0), STR_PAD_LEFT);
        return $this->_normalize(new Math_BigInteger($hv | $DA, 256));
    }
    function bitwise_rightShift($hn)
    {
        $DA = new Math_BigInteger();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                static $Q1;
                if (isset($Q1)) {
                    goto QRv;
                }
                $Q1 = gmp_init("\62");
                QRv:
                $DA->value = gmp_div_q($this->value, gmp_pow($Q1, $hn));
                goto cwf;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $DA->value = bcdiv($this->value, bcpow("\x32", $hn, 0), 0);
                goto cwf;
            default:
                $DA->value = $this->value;
                $DA->_rshift($hn);
        }
        XfY:
        cwf:
        return $this->_normalize($DA);
    }
    function bitwise_leftShift($hn)
    {
        $DA = new Math_BigInteger();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                static $Q1;
                if (isset($Q1)) {
                    goto ejr;
                }
                $Q1 = gmp_init("\x32");
                ejr:
                $DA->value = gmp_mul($this->value, gmp_pow($Q1, $hn));
                goto GPr;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $DA->value = bcmul($this->value, bcpow("\x32", $hn, 0), 0);
                goto GPr;
            default:
                $DA->value = $this->value;
                $DA->_lshift($hn);
        }
        h0I:
        GPr:
        return $this->_normalize($DA);
    }
    function bitwise_leftRotate($hn)
    {
        $ST = $this->toBytes();
        if ($this->precision > 0) {
            goto bcf;
        }
        $DA = ord($ST[0]);
        $vB = 0;
        Apq:
        if (!($DA >> $vB)) {
            goto U7f;
        }
        WYp:
        ++$vB;
        goto Apq;
        U7f:
        $s_ = 8 * strlen($ST) - 8 + $vB;
        $Fe = chr((1 << ($s_ & 0x7)) - 1) . str_repeat(chr(0xff), $s_ >> 3);
        goto wIL;
        bcf:
        $s_ = $this->precision;
        if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH) {
            goto MWH;
        }
        $Fe = $this->bitmask->toBytes();
        goto SD7;
        MWH:
        $Fe = $this->bitmask->subtract(new Math_BigInteger(1));
        $Fe = $Fe->toBytes();
        SD7:
        wIL:
        if (!($hn < 0)) {
            goto usR;
        }
        $hn += $s_;
        usR:
        $hn %= $s_;
        if ($hn) {
            goto v19;
        }
        return $this->copy();
        v19:
        $ch = $this->bitwise_leftShift($hn);
        $ch = $ch->bitwise_and(new Math_BigInteger($Fe, 256));
        $ja = $this->bitwise_rightShift($s_ - $hn);
        $ga = MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_BCMATH ? $ch->bitwise_or($ja) : $ch->add($ja);
        return $this->_normalize($ga);
    }
    function bitwise_rightRotate($hn)
    {
        return $this->bitwise_leftRotate(-$hn);
    }
    function setRandomGenerator($mu)
    {
    }
    function _random_number_helper($dO)
    {
        if (function_exists("\143\162\x79\160\x74\137\x72\x61\156\x64\157\155\137\163\x74\x72\151\156\x67")) {
            goto ogq;
        }
        $bK = '';
        if (!($dO & 1)) {
            goto jyr;
        }
        $bK .= chr(mt_rand(0, 255));
        jyr:
        $PK = $dO >> 1;
        $vB = 0;
        fnV:
        if (!($vB < $PK)) {
            goto nXA;
        }
        $bK .= pack("\156", mt_rand(0, 0xffff));
        w92:
        ++$vB;
        goto fnV;
        nXA:
        goto gSM;
        ogq:
        $bK = crypt_random_string($dO);
        gSM:
        return new Math_BigInteger($bK, 256);
    }
    function random($nk, $yL = false)
    {
        if (!($nk === false)) {
            goto ajC;
        }
        return false;
        ajC:
        if ($yL === false) {
            goto O5c;
        }
        $lC = $nk;
        $fu = $yL;
        goto it_;
        O5c:
        $fu = $nk;
        $lC = $this;
        it_:
        $RV = $fu->compare($lC);
        if (!$RV) {
            goto v1S;
        }
        if ($RV < 0) {
            goto cEE;
        }
        goto TKw;
        v1S:
        return $this->_normalize($lC);
        goto TKw;
        cEE:
        $DA = $fu;
        $fu = $lC;
        $lC = $DA;
        TKw:
        static $sO;
        if (isset($sO)) {
            goto n_u;
        }
        $sO = new Math_BigInteger(1);
        n_u:
        $fu = $fu->subtract($lC->subtract($sO));
        $dO = strlen(ltrim($fu->toBytes(), chr(0)));
        $hu = new Math_BigInteger(chr(1) . str_repeat("\x0", $dO), 256);
        $bK = $this->_random_number_helper($dO);
        list($AO) = $hu->divide($fu);
        $AO = $AO->multiply($fu);
        S1t:
        if (!($bK->compare($AO) >= 0)) {
            goto d61;
        }
        $bK = $bK->subtract($AO);
        $hu = $hu->subtract($AO);
        $bK = $bK->bitwise_leftShift(8);
        $bK = $bK->add($this->_random_number_helper(1));
        $hu = $hu->bitwise_leftShift(8);
        list($AO) = $hu->divide($fu);
        $AO = $AO->multiply($fu);
        goto S1t;
        d61:
        list(, $bK) = $bK->divide($fu);
        return $this->_normalize($bK->add($lC));
    }
    function randomPrime($nk, $yL = false, $Jy = false)
    {
        if (!($nk === false)) {
            goto gjn;
        }
        return false;
        gjn:
        if ($yL === false) {
            goto hcK;
        }
        $lC = $nk;
        $fu = $yL;
        goto NGf;
        hcK:
        $fu = $nk;
        $lC = $this;
        NGf:
        $RV = $fu->compare($lC);
        if (!$RV) {
            goto ifJ;
        }
        if ($RV < 0) {
            goto PO5;
        }
        goto ujR;
        ifJ:
        return $lC->isPrime() ? $lC : false;
        goto ujR;
        PO5:
        $DA = $fu;
        $fu = $lC;
        $lC = $DA;
        ujR:
        static $sO, $Q1;
        if (isset($sO)) {
            goto DLQ;
        }
        $sO = new Math_BigInteger(1);
        $Q1 = new Math_BigInteger(2);
        DLQ:
        $kb = time();
        $c2 = $this->random($lC, $fu);
        if (!(MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_GMP && extension_loaded("\x67\155\160") && version_compare(PHP_VERSION, "\x35\56\62\56\60", "\x3e\x3d"))) {
            goto L3o;
        }
        $lc = new Math_BigInteger();
        $lc->value = gmp_nextprime($c2->value);
        if (!($lc->compare($fu) <= 0)) {
            goto jJs;
        }
        return $lc;
        jJs:
        if ($lC->equals($c2)) {
            goto p6D;
        }
        $c2 = $c2->subtract($sO);
        p6D:
        return $c2->randomPrime($lC, $c2);
        L3o:
        if (!$c2->equals($Q1)) {
            goto b2C;
        }
        return $c2;
        b2C:
        $c2->_make_odd();
        if (!($c2->compare($fu) > 0)) {
            goto Ote;
        }
        if (!$lC->equals($fu)) {
            goto lg4;
        }
        return false;
        lg4:
        $c2 = $lC->copy();
        $c2->_make_odd();
        Ote:
        $iD = $c2->copy();
        WHC:
        if (!true) {
            goto VyM;
        }
        if (!($Jy !== false && time() - $kb > $Jy)) {
            goto FBh;
        }
        return false;
        FBh:
        if (!$c2->isPrime()) {
            goto lk9;
        }
        return $c2;
        lk9:
        $c2 = $c2->add($Q1);
        if (!($c2->compare($fu) > 0)) {
            goto A7Q;
        }
        $c2 = $lC->copy();
        if (!$c2->equals($Q1)) {
            goto F6q;
        }
        return $c2;
        F6q:
        $c2->_make_odd();
        A7Q:
        if (!$c2->equals($iD)) {
            goto EZs;
        }
        return false;
        EZs:
        goto WHC;
        VyM:
    }
    function _make_odd()
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                gmp_setbit($this->value, 0);
                goto acE;
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value[strlen($this->value) - 1] % 2 == 0)) {
                    goto A0Y;
                }
                $this->value = bcadd($this->value, "\x31");
                A0Y:
                goto acE;
            default:
                $this->value[0] |= 1;
        }
        TPn:
        acE:
    }
    function isPrime($HO = false)
    {
        $MI = strlen($this->toBytes());
        if ($HO) {
            goto Oa4;
        }
        if ($MI >= 163) {
            goto nKG;
        }
        if ($MI >= 106) {
            goto JRy;
        }
        if ($MI >= 81) {
            goto Z0p;
        }
        if ($MI >= 68) {
            goto zM8;
        }
        if ($MI >= 56) {
            goto gAj;
        }
        if ($MI >= 50) {
            goto EIm;
        }
        if ($MI >= 43) {
            goto AhH;
        }
        if ($MI >= 37) {
            goto y4c;
        }
        if ($MI >= 31) {
            goto He8;
        }
        if ($MI >= 25) {
            goto esl;
        }
        if ($MI >= 18) {
            goto F2x;
        }
        $HO = 27;
        goto FYp;
        F2x:
        $HO = 18;
        FYp:
        goto W_Q;
        esl:
        $HO = 15;
        W_Q:
        goto Wkh;
        He8:
        $HO = 12;
        Wkh:
        goto M9T;
        y4c:
        $HO = 9;
        M9T:
        goto wgS;
        AhH:
        $HO = 8;
        wgS:
        goto WMd;
        EIm:
        $HO = 7;
        WMd:
        goto GR9;
        gAj:
        $HO = 6;
        GR9:
        goto mJ0;
        zM8:
        $HO = 5;
        mJ0:
        goto G_v;
        Z0p:
        $HO = 4;
        G_v:
        goto iLC;
        JRy:
        $HO = 3;
        iLC:
        goto bJd;
        nKG:
        $HO = 2;
        bJd:
        Oa4:
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_prob_prime($this->value, $HO) != 0;
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value === "\62")) {
                    goto MPw;
                }
                return true;
                MPw:
                if (!($this->value[strlen($this->value) - 1] % 2 == 0)) {
                    goto UUY;
                }
                return false;
                UUY:
                goto XAv;
            default:
                if (!($this->value == array(2))) {
                    goto qtu;
                }
                return true;
                qtu:
                if (!(~$this->value[0] & 1)) {
                    goto sAo;
                }
                return false;
                sAo:
        }
        pPO:
        XAv:
        static $VT, $C7, $sO, $Q1;
        if (isset($VT)) {
            goto U_G;
        }
        $VT = array(3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499, 503, 509, 521, 523, 541, 547, 557, 563, 569, 571, 577, 587, 593, 599, 601, 607, 613, 617, 619, 631, 641, 643, 647, 653, 659, 661, 673, 677, 683, 691, 701, 709, 719, 727, 733, 739, 743, 751, 757, 761, 769, 773, 787, 797, 809, 811, 821, 823, 827, 829, 839, 853, 857, 859, 863, 877, 881, 883, 887, 907, 911, 919, 929, 937, 941, 947, 953, 967, 971, 977, 983, 991, 997);
        if (!(MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL)) {
            goto Sq1;
        }
        $vB = 0;
        YI9:
        if (!($vB < count($VT))) {
            goto UYE;
        }
        $VT[$vB] = new Math_BigInteger($VT[$vB]);
        kt7:
        ++$vB;
        goto YI9;
        UYE:
        Sq1:
        $C7 = new Math_BigInteger();
        $sO = new Math_BigInteger(1);
        $Q1 = new Math_BigInteger(2);
        U_G:
        if (!$this->equals($sO)) {
            goto aNN;
        }
        return false;
        aNN:
        if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL) {
            goto Ruu;
        }
        $Vw = $this->value;
        foreach ($VT as $aH) {
            list(, $mv) = $this->_divide_digit($Vw, $aH);
            if ($mv) {
                goto wuY;
            }
            return count($Vw) == 1 && $Vw[0] == $aH;
            wuY:
            f1U:
        }
        ovz:
        goto bWJ;
        Ruu:
        foreach ($VT as $aH) {
            list(, $mv) = $this->divide($aH);
            if (!$mv->equals($C7)) {
                goto RM5;
            }
            return $this->equals($aH);
            RM5:
            h4J:
        }
        zBD:
        bWJ:
        $Td = $this->copy();
        $wN = $Td->subtract($sO);
        $Qv = $Td->subtract($Q1);
        $mv = $wN->copy();
        $Nx = $mv->value;
        if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH) {
            goto T9n;
        }
        $vB = 0;
        $Ow = count($Nx);
        Mnw:
        if (!($vB < $Ow)) {
            goto Jy5;
        }
        $DA = ~$Nx[$vB] & 0xffffff;
        $aj = 1;
        T9X:
        if (!($DA >> $aj & 1)) {
            goto xgr;
        }
        lcf:
        ++$aj;
        goto T9X;
        xgr:
        if (!($aj != 25)) {
            goto btL;
        }
        goto Jy5;
        btL:
        MRN:
        ++$vB;
        goto Mnw;
        Jy5:
        $pq = 26 * $vB + $aj;
        $mv->_rshift($pq);
        goto j7M;
        T9n:
        $pq = 0;
        O3k:
        if (!($mv->value[strlen($mv->value) - 1] % 2 == 0)) {
            goto jjw;
        }
        $mv->value = bcdiv($mv->value, "\62", 0);
        ++$pq;
        goto O3k;
        jjw:
        j7M:
        $vB = 0;
        ufW:
        if (!($vB < $HO)) {
            goto kym;
        }
        $PQ = $this->random($Q1, $Qv);
        $zE = $PQ->modPow($mv, $Td);
        if (!(!$zE->equals($sO) && !$zE->equals($wN))) {
            goto a86;
        }
        $aj = 1;
        APm:
        if (!($aj < $pq && !$zE->equals($wN))) {
            goto Uzq;
        }
        $zE = $zE->modPow($Q1, $Td);
        if (!$zE->equals($sO)) {
            goto N5P;
        }
        return false;
        N5P:
        Xl1:
        ++$aj;
        goto APm;
        Uzq:
        if ($zE->equals($wN)) {
            goto sTv;
        }
        return false;
        sTv:
        a86:
        eHV:
        ++$vB;
        goto ufW;
        kym:
        return true;
    }
    function _lshift($hn)
    {
        if (!($hn == 0)) {
            goto t1e;
        }
        return;
        t1e:
        $Wy = (int) ($hn / MATH_BIGINTEGER_BASE);
        $hn %= MATH_BIGINTEGER_BASE;
        $hn = 1 << $hn;
        $Xf = 0;
        $vB = 0;
        Kh7:
        if (!($vB < count($this->value))) {
            goto Mkf;
        }
        $DA = $this->value[$vB] * $hn + $Xf;
        $Xf = MATH_BIGINTEGER_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $this->value[$vB] = (int) ($DA - $Xf * MATH_BIGINTEGER_BASE_FULL);
        oyD:
        ++$vB;
        goto Kh7;
        Mkf:
        if (!$Xf) {
            goto GM2;
        }
        $this->value[count($this->value)] = $Xf;
        GM2:
        jGu:
        if (!$Wy--) {
            goto cNf;
        }
        array_unshift($this->value, 0);
        goto jGu;
        cNf:
    }
    function _rshift($hn)
    {
        if (!($hn == 0)) {
            goto cOH;
        }
        return;
        cOH:
        $Wy = (int) ($hn / MATH_BIGINTEGER_BASE);
        $hn %= MATH_BIGINTEGER_BASE;
        $Rd = MATH_BIGINTEGER_BASE - $hn;
        $Le = (1 << $hn) - 1;
        if (!$Wy) {
            goto qL5;
        }
        $this->value = array_slice($this->value, $Wy);
        qL5:
        $Xf = 0;
        $vB = count($this->value) - 1;
        wib:
        if (!($vB >= 0)) {
            goto shK;
        }
        $DA = $this->value[$vB] >> $hn | $Xf;
        $Xf = ($this->value[$vB] & $Le) << $Rd;
        $this->value[$vB] = $DA;
        qpn:
        --$vB;
        goto wib;
        shK:
        $this->value = $this->_trim($this->value);
    }
    function _normalize($ga)
    {
        $ga->precision = $this->precision;
        $ga->bitmask = $this->bitmask;
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                if (!($this->bitmask !== false)) {
                    goto LOG;
                }
                $ga->value = gmp_and($ga->value, $ga->bitmask->value);
                LOG:
                return $ga;
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (empty($ga->bitmask->value)) {
                    goto z5i;
                }
                $ga->value = bcmod($ga->value, $ga->bitmask->value);
                z5i:
                return $ga;
        }
        tgo:
        fnB:
        $Vw =& $ga->value;
        if (count($Vw)) {
            goto bLg;
        }
        return $ga;
        bLg:
        $Vw = $this->_trim($Vw);
        if (empty($ga->bitmask->value)) {
            goto fiJ;
        }
        $MI = min(count($Vw), count($this->bitmask->value));
        $Vw = array_slice($Vw, 0, $MI);
        $vB = 0;
        XuU:
        if (!($vB < $MI)) {
            goto ZWG;
        }
        $Vw[$vB] = $Vw[$vB] & $this->bitmask->value[$vB];
        AGD:
        ++$vB;
        goto XuU;
        ZWG:
        fiJ:
        return $ga;
    }
    function _trim($Vw)
    {
        $vB = count($Vw) - 1;
        MRd:
        if (!($vB >= 0)) {
            goto ywj;
        }
        if (!$Vw[$vB]) {
            goto XFH;
        }
        goto ywj;
        XFH:
        unset($Vw[$vB]);
        bmG:
        --$vB;
        goto MRd;
        ywj:
        return $Vw;
    }
    function _array_repeat($e9, $wi)
    {
        return $wi ? array_fill(0, $wi, $e9) : array();
    }
    function _base256_lshift(&$c2, $hn)
    {
        if (!($hn == 0)) {
            goto k5l;
        }
        return;
        k5l:
        $pY = $hn >> 3;
        $hn &= 7;
        $Xf = 0;
        $vB = strlen($c2) - 1;
        nEN:
        if (!($vB >= 0)) {
            goto fRW;
        }
        $DA = ord($c2[$vB]) << $hn | $Xf;
        $c2[$vB] = chr($DA);
        $Xf = $DA >> 8;
        Ud1:
        --$vB;
        goto nEN;
        fRW:
        $Xf = $Xf != 0 ? chr($Xf) : '';
        $c2 = $Xf . $c2 . str_repeat(chr(0), $pY);
    }
    function _base256_rshift(&$c2, $hn)
    {
        if (!($hn == 0)) {
            goto Qi9;
        }
        $c2 = ltrim($c2, chr(0));
        return '';
        Qi9:
        $pY = $hn >> 3;
        $hn &= 7;
        $Ki = '';
        if (!$pY) {
            goto SA8;
        }
        $kb = $pY > strlen($c2) ? -strlen($c2) : -$pY;
        $Ki = substr($c2, $kb);
        $c2 = substr($c2, 0, -$pY);
        SA8:
        $Xf = 0;
        $Rd = 8 - $hn;
        $vB = 0;
        oW3:
        if (!($vB < strlen($c2))) {
            goto wvw;
        }
        $DA = ord($c2[$vB]) >> $hn | $Xf;
        $Xf = ord($c2[$vB]) << $Rd & 0xff;
        $c2[$vB] = chr($DA);
        X7o:
        ++$vB;
        goto oW3;
        wvw:
        $c2 = ltrim($c2, chr(0));
        $Ki = chr($Xf >> $Rd) . $Ki;
        return ltrim($Ki, chr(0));
    }
    function _int2bytes($c2)
    {
        return ltrim(pack("\116", $c2), chr(0));
    }
    function _bytes2int($c2)
    {
        $DA = unpack("\x4e\151\156\x74", str_pad($c2, 4, chr(0), STR_PAD_LEFT));
        return $DA["\151\156\x74"];
    }
    function _encodeASN1Length($MI)
    {
        if (!($MI <= 0x7f)) {
            goto Lo1;
        }
        return chr($MI);
        Lo1:
        $DA = ltrim(pack("\116", $MI), chr(0));
        return pack("\x43\x61\52", 0x80 | strlen($DA), $DA);
    }
    function _safe_divide($c2, $zE)
    {
        if (!(MATH_BIGINTEGER_BASE === 26)) {
            goto HSH;
        }
        return (int) ($c2 / $zE);
        HSH:
        return ($c2 - $c2 % $zE) / $zE;
    }
}
