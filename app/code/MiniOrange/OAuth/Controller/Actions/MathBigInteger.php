<?php


namespace miniorange\OAuth\Controller\Actions;

define("\115\141\164\150\x42\151\147\111\x6e\164\145\147\x65\x72\137\115\117\x4e\x54\x47\117\x4d\105\122\x59", 0);
define("\x4d\141\164\x68\102\151\147\111\x6e\x74\145\147\145\162\137\x42\101\122\122\x45\124\124", 1);
define("\x4d\141\x74\150\102\151\147\111\x6e\164\145\147\145\x72\137\120\117\127\x45\x52\117\106\x32", 2);
define("\x4d\141\x74\x68\x42\151\147\111\x6e\x74\145\147\145\162\137\x43\114\101\x53\123\111\x43", 3);
define("\x4d\x61\164\x68\x42\151\147\111\x6e\164\145\147\145\162\x5f\116\x4f\116\x45", 4);
define("\115\141\x74\x68\102\151\147\x49\156\164\145\x67\145\x72\137\x56\101\114\x55\x45", 0);
define("\115\141\x74\x68\x42\x69\147\x49\x6e\164\145\147\x65\162\137\123\x49\107\116", 1);
define("\x4d\141\164\x68\x42\x69\x67\111\x6e\x74\145\147\x65\162\x5f\x56\101\x52\111\101\x42\114\x45", 0);
define("\115\141\164\150\x42\x69\147\x49\x6e\x74\145\147\x65\162\x5f\104\101\x54\x41", 1);
define("\115\x61\164\x68\102\x69\x67\x49\156\x74\145\x67\x65\x72\x5f\115\x4f\104\x45\137\111\116\124\x45\x52\x4e\101\114", 1);
define("\115\x61\x74\150\102\151\x67\111\156\164\x65\147\145\x72\137\x4d\117\104\x45\137\102\x43\115\101\124\110", 2);
define("\x4d\x61\x74\150\x42\151\x67\x49\x6e\x74\x65\147\145\162\137\x4d\x4f\x44\x45\x5f\x47\115\x50", 3);
define("\115\x61\164\150\x42\x69\147\111\156\164\145\x67\x65\x72\x5f\113\x41\122\x41\124\123\x55\102\x41\x5f\x43\125\124\x4f\106\106", 25);
class MathBigInteger
{
    var $value;
    var $is_negative = false;
    var $precision = -1;
    var $bitmask = false;
    var $hex;
    function __construct($c2 = 0, $qp = 10)
    {
        if (defined("\115\x61\164\150\102\151\x67\x49\156\x74\x65\x67\145\x72\x5f\x4d\x4f\104\105")) {
            goto hj;
        }
        switch (true) {
            case extension_loaded("\147\155\x70"):
                define("\x4d\x61\164\150\x42\x69\147\x49\x6e\x74\145\147\145\162\137\x4d\x4f\x44\x45", MathBigInteger_MODE_GMP);
                goto AR;
            case extension_loaded("\x62\x63\155\141\x74\150"):
                define("\x4d\141\164\x68\102\x69\x67\x49\156\164\x65\147\x65\162\x5f\x4d\117\x44\x45", MathBigInteger_MODE_BCMATH);
                goto AR;
            default:
                define("\115\x61\164\150\102\x69\x67\111\156\164\x65\x67\145\162\137\x4d\117\x44\x45", MathBigInteger_MODE_INTERNAL);
        }
        FE:
        AR:
        hj:
        if (!(extension_loaded("\x6f\160\145\156\x73\x73\154") && !defined("\115\141\164\150\102\x69\147\x49\x6e\164\x65\147\x65\x72\x5f\x4f\x50\x45\116\x53\x53\x4c\137\x44\x49\123\x41\102\x4c\105") && !defined("\x4d\x61\x74\150\102\151\147\x49\x6e\x74\x65\x67\x65\162\137\117\120\x45\116\123\123\114\x5f\105\116\x41\102\x4c\105\x44"))) {
            goto qo;
        }
        ob_start();
        phpinfo();
        $uF = ob_get_contents();
        ob_end_clean();
        preg_match_all("\x23\x4f\x70\x65\x6e\x53\x53\114\x20\x28\x48\145\141\144\145\x72\x7c\x4c\151\142\162\141\162\171\51\x20\x56\145\162\x73\151\x6f\x6e\50\56\x2a\51\x23\151\155", $uF, $fR);
        $N3 = [];
        if (empty($fR[1])) {
            goto RA;
        }
        $vB = 0;
        yi:
        if (!($vB < count($fR[1]))) {
            goto RZ;
        }
        $WN = trim(str_replace("\x3d\76", '', strip_tags($fR[2][$vB])));
        if (!preg_match("\57\50\x5c\144\x2b\x5c\56\x5c\144\53\134\x2e\134\144\x2b\51\x2f\151", $WN, $OM)) {
            goto nI;
        }
        $N3[$fR[1][$vB]] = $OM[0];
        goto EX;
        nI:
        $N3[$fR[1][$vB]] = $WN;
        EX:
        bh:
        $vB++;
        goto yi;
        RZ:
        RA:
        switch (true) {
            case !isset($N3["\110\x65\x61\x64\x65\x72"]):
            case !isset($N3["\114\151\142\x72\x61\x72\171"]):
            case $N3["\x48\x65\x61\x64\145\x72"] == $N3["\114\151\142\x72\x61\x72\x79"]:
            case version_compare($N3["\x48\x65\141\144\145\x72"], "\x31\x2e\60\56\x30") >= 0 && version_compare($N3["\x4c\151\142\162\141\x72\x79"], "\x31\56\x30\x2e\x30") >= 0:
                define("\x4d\141\x74\x68\102\151\x67\x49\156\x74\x65\147\145\x72\x5f\x4f\120\x45\116\123\123\114\x5f\105\x4e\x41\x42\114\x45\x44", true);
                goto Lb;
            default:
                define("\x4d\x61\164\x68\102\151\147\111\156\x74\145\147\145\x72\137\x4f\120\105\x4e\x53\x53\x4c\x5f\x44\111\x53\x41\x42\114\105", true);
        }
        KR:
        Lb:
        qo:
        if (defined("\120\110\x50\137\111\x4e\x54\137\x53\x49\132\x45")) {
            goto IP;
        }
        define("\120\110\x50\137\111\x4e\x54\x5f\x53\111\x5a\105", 4);
        IP:
        if (!(!defined("\x4d\x61\164\150\102\151\147\111\156\x74\x65\147\x65\162\x5f\x42\x41\x53\105") && MathBigInteger_MODE == MathBigInteger_MODE_INTERNAL)) {
            goto Lt;
        }
        switch (PHP_INT_SIZE) {
            case 8:
                define("\x4d\141\164\150\x42\151\147\x49\x6e\164\145\x67\145\x72\x5f\102\x41\123\105", 31);
                define("\x4d\141\x74\150\102\x69\147\111\156\164\x65\147\x65\162\x5f\102\x41\x53\x45\137\x46\x55\114\114", 0x80000000);
                define("\115\x61\x74\x68\102\x69\147\111\156\x74\145\x67\x65\162\137\115\101\130\x5f\104\x49\107\111\124", 0x7fffffff);
                define("\115\x61\164\x68\x42\x69\147\111\x6e\164\145\147\x65\162\137\115\123\102", 0x40000000);
                define("\115\141\164\150\x42\x69\x67\111\x6e\x74\145\147\145\x72\x5f\x4d\x41\130\x31\x30", 1000000000);
                define("\x4d\141\164\150\102\x69\147\x49\x6e\x74\x65\x67\145\x72\137\115\x41\130\61\x30\x5f\114\x45\116", 9);
                define("\x4d\141\164\150\102\151\x67\x49\156\x74\x65\x67\x65\x72\137\115\x41\130\137\x44\111\107\111\124\x32", pow(2, 62));
                goto t_;
            default:
                define("\115\141\164\x68\x42\151\x67\x49\x6e\164\145\147\x65\162\137\102\101\123\105", 26);
                define("\115\x61\x74\150\x42\151\x67\111\156\x74\x65\x67\145\x72\x5f\x42\101\x53\105\x5f\x46\125\114\114", 0x4000000);
                define("\115\141\164\x68\x42\151\147\x49\x6e\164\145\x67\x65\162\x5f\x4d\x41\130\137\104\111\x47\x49\124", 0x3ffffff);
                define("\x4d\x61\x74\x68\102\x69\147\111\x6e\x74\x65\147\x65\162\x5f\x4d\123\102", 0x2000000);
                define("\x4d\x61\x74\150\x42\x69\147\111\156\164\x65\147\x65\x72\x5f\x4d\x41\130\61\x30", 10000000);
                define("\x4d\141\x74\x68\102\x69\147\x49\x6e\x74\145\x67\x65\162\137\115\x41\130\x31\60\x5f\114\105\x4e", 7);
                define("\x4d\x61\164\150\102\151\x67\x49\x6e\x74\145\x67\145\x72\x5f\115\x41\x58\x5f\x44\x49\x47\111\x54\62", pow(2, 52));
        }
        Wg:
        t_:
        Lt:
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                switch (true) {
                    case is_resource($c2) && get_resource_type($c2) == "\107\x4d\120\40\x69\156\164\145\x67\x65\x72":
                    case is_object($c2) && get_class($c2) == "\x47\x4d\x50":
                        $this->value = $c2;
                        return;
                }
                tA:
                rH:
                $this->value = gmp_init(0);
                goto mI;
            case MathBigInteger_MODE_BCMATH:
                $this->value = "\x30";
                goto mI;
            default:
                $this->value = [];
        }
        uO:
        mI:
        if (!(empty($c2) && (abs($qp) != 256 || $c2 !== "\x30"))) {
            goto MF;
        }
        return;
        MF:
        switch ($qp) {
            case -256:
                if (!(ord($c2[0]) & 0x80)) {
                    goto rs;
                }
                $c2 = ~$c2;
                $this->is_negative = true;
                rs:
            case 256:
                switch (MathBigInteger_MODE) {
                    case MathBigInteger_MODE_GMP:
                        $this->value = function_exists("\x67\155\160\x5f\151\155\160\157\x72\x74") ? gmp_import($c2) : gmp_init("\60\x78" . bin2hex($c2));
                        if (!$this->is_negative) {
                            goto fj;
                        }
                        $this->value = gmp_neg($this->value);
                        fj:
                        goto Rj;
                    case MathBigInteger_MODE_BCMATH:
                        $lq = strlen($c2) + 3 & 0xfffffffc;
                        $c2 = str_pad($c2, $lq, chr(0), STR_PAD_LEFT);
                        $vB = 0;
                        Lv:
                        if (!($vB < $lq)) {
                            goto ZA;
                        }
                        $this->value = bcmul($this->value, "\64\62\x39\x34\71\66\x37\x32\71\x36", 0);
                        $this->value = bcadd($this->value, 0x1000000 * ord($c2[$vB]) + (ord($c2[$vB + 1]) << 16 | ord($c2[$vB + 2]) << 8 | ord($c2[$vB + 3])), 0);
                        eE:
                        $vB += 4;
                        goto Lv;
                        ZA:
                        if (!$this->is_negative) {
                            goto Zg;
                        }
                        $this->value = "\55" . $this->value;
                        Zg:
                        goto Rj;
                    default:
                        hU:
                        if (!strlen($c2)) {
                            goto Wr;
                        }
                        $this->value[] = $this->_bytes2int($this->_base256_rshift($c2, MathBigInteger_BASE));
                        goto hU;
                        Wr:
                }
                iI:
                Rj:
                if (!$this->is_negative) {
                    goto GC;
                }
                if (!(MathBigInteger_MODE != MathBigInteger_MODE_INTERNAL)) {
                    goto rr;
                }
                $this->is_negative = false;
                rr:
                $DA = $this->add(new MathBigInteger("\x2d\x31"));
                $this->value = $DA->value;
                GC:
                goto Su;
            case 16:
            case -16:
                if (!($qp > 0 && $c2[0] == "\x2d")) {
                    goto rP;
                }
                $this->is_negative = true;
                $c2 = substr($c2, 1);
                rP:
                $c2 = preg_replace("\43\136\x28\x3f\72\x30\x78\51\x3f\x28\x5b\101\55\106\x61\55\x66\x30\55\71\135\x2a\x29\56\x2a\43", "\44\x31", $c2);
                $Tz = false;
                if (!($qp < 0 && hexdec($c2[0]) >= 8)) {
                    goto bX;
                }
                $this->is_negative = $Tz = true;
                $c2 = bin2hex(~pack("\110\x2a", $c2));
                bX:
                switch (MathBigInteger_MODE) {
                    case MathBigInteger_MODE_GMP:
                        $DA = $this->is_negative ? "\x2d\x30\170" . $c2 : "\x30\170" . $c2;
                        $this->value = gmp_init($DA);
                        $this->is_negative = false;
                        goto HP;
                    case MathBigInteger_MODE_BCMATH:
                        $c2 = strlen($c2) & 1 ? "\x30" . $c2 : $c2;
                        $DA = new MathBigInteger(pack("\110\52", $c2), 256);
                        $this->value = $this->is_negative ? "\55" . $DA->value : $DA->value;
                        $this->is_negative = false;
                        goto HP;
                    default:
                        $c2 = strlen($c2) & 1 ? "\x30" . $c2 : $c2;
                        $DA = new MathBigInteger(pack("\x48\x2a", $c2), 256);
                        $this->value = $DA->value;
                }
                fa:
                HP:
                if (!$Tz) {
                    goto YR;
                }
                $DA = $this->add(new MathBigInteger("\55\x31"));
                $this->value = $DA->value;
                YR:
                goto Su;
            case 10:
            case -10:
                $c2 = preg_replace("\43\x28\x3f\x3c\x21\x5e\x29\x28\77\x3a\x2d\x29\56\52\174\50\x3f\x3c\75\x5e\174\x2d\x29\60\52\x7c\133\136\55\x30\55\71\135\56\52\x23", '', $c2);
                switch (MathBigInteger_MODE) {
                    case MathBigInteger_MODE_GMP:
                        $this->value = gmp_init($c2);
                        goto mf;
                    case MathBigInteger_MODE_BCMATH:
                        $this->value = $c2 === "\55" ? "\60" : (string) $c2;
                        goto mf;
                    default:
                        $DA = new MathBigInteger();
                        $wi = new MathBigInteger();
                        $wi->value = [MathBigInteger_MAX10];
                        if (!($c2[0] == "\55")) {
                            goto FK;
                        }
                        $this->is_negative = true;
                        $c2 = substr($c2, 1);
                        FK:
                        $c2 = str_pad($c2, strlen($c2) + (MathBigInteger_MAX10_LEN - 1) * strlen($c2) % MathBigInteger_MAX10_LEN, 0, STR_PAD_LEFT);
                        WX:
                        if (!strlen($c2)) {
                            goto C_;
                        }
                        $DA = $DA->multiply($wi);
                        $DA = $DA->add(new MathBigInteger($this->_int2bytes(substr($c2, 0, MathBigInteger_MAX10_LEN)), 256));
                        $c2 = substr($c2, MathBigInteger_MAX10_LEN);
                        goto WX;
                        C_:
                        $this->value = $DA->value;
                }
                oE:
                mf:
                goto Su;
            case 2:
            case -2:
                if (!($qp > 0 && $c2[0] == "\x2d")) {
                    goto C8;
                }
                $this->is_negative = true;
                $c2 = substr($c2, 1);
                C8:
                $c2 = preg_replace("\43\x5e\x28\133\60\x31\x5d\x2a\x29\x2e\52\43", "\44\61", $c2);
                $c2 = str_pad($c2, strlen($c2) + 3 * strlen($c2) % 4, 0, STR_PAD_LEFT);
                $zl = "\x30\170";
                ZW:
                if (!strlen($c2)) {
                    goto iV;
                }
                $hO = substr($c2, 0, 4);
                $zl .= dechex(bindec($hO));
                $c2 = substr($c2, 4);
                goto ZW;
                iV:
                if (!$this->is_negative) {
                    goto aw;
                }
                $zl = "\x2d" . $zl;
                aw:
                $DA = new MathBigInteger($zl, 8 * $qp);
                $this->value = $DA->value;
                $this->is_negative = $DA->is_negative;
                goto Su;
            default:
        }
        D8:
        Su:
    }
    function MathBigInteger($c2 = 0, $qp = 10)
    {
        $this->__construct($c2, $qp);
    }
    function toBytes($JW = false)
    {
        if (!$JW) {
            goto le;
        }
        $v8 = $this->compare(new MathBigInteger());
        if (!($v8 == 0)) {
            goto wB;
        }
        return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
        wB:
        $DA = $v8 < 0 ? $this->add(new MathBigInteger(1)) : $this->copy();
        $Bk = $DA->toBytes();
        if (!empty($Bk)) {
            goto SU;
        }
        $Bk = chr(0);
        SU:
        if (!(ord($Bk[0]) & 0x80)) {
            goto hD;
        }
        $Bk = chr(0) . $Bk;
        hD:
        return $v8 < 0 ? ~$Bk : $Bk;
        le:
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                if (!(gmp_cmp($this->value, gmp_init(0)) == 0)) {
                    goto d2;
                }
                return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
                d2:
                if (function_exists("\147\155\160\137\145\x78\x70\157\x72\164")) {
                    goto S9;
                }
                $DA = gmp_strval(gmp_abs($this->value), 16);
                $DA = strlen($DA) & 1 ? "\x30" . $DA : $DA;
                $DA = pack("\110\52", $DA);
                goto dZ;
                S9:
                $DA = gmp_export($this->value);
                dZ:
                return $this->precision > 0 ? substr(str_pad($DA, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($DA, chr(0));
            case MathBigInteger_MODE_BCMATH:
                if (!($this->value === "\x30")) {
                    goto bk;
                }
                return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
                bk:
                $Vw = '';
                $C3 = $this->value;
                if (!($C3[0] == "\55")) {
                    goto v4;
                }
                $C3 = substr($C3, 1);
                v4:
                Ka:
                if (!(bccomp($C3, "\x30", 0) > 0)) {
                    goto gL;
                }
                $DA = bcmod($C3, "\61\66\x37\x37\x37\x32\61\66");
                $Vw = chr($DA >> 16) . chr($DA >> 8) . chr($DA) . $Vw;
                $C3 = bcdiv($C3, "\61\66\x37\x37\x37\62\x31\x36", 0);
                goto Ka;
                gL:
                return $this->precision > 0 ? substr(str_pad($Vw, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($Vw, chr(0));
        }
        O3:
        DR:
        if (count($this->value)) {
            goto ya;
        }
        return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
        ya:
        $ga = $this->_int2bytes($this->value[count($this->value) - 1]);
        $DA = $this->copy();
        $vB = count($DA->value) - 2;
        Co:
        if (!($vB >= 0)) {
            goto eY;
        }
        $DA->_base256_lshift($ga, MathBigInteger_BASE);
        $ga = $ga | str_pad($DA->_int2bytes($DA->value[$vB]), strlen($ga), chr(0), STR_PAD_LEFT);
        PB:
        --$vB;
        goto Co;
        eY:
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
        pR:
        if (!($vB >= $kb)) {
            goto ih;
        }
        $ST = str_pad(decbin(hexdec(substr($XF, $vB, 8))), 32, "\60", STR_PAD_LEFT) . $ST;
        wh:
        $vB -= 8;
        goto pR;
        ih:
        if (!$kb) {
            goto OP;
        }
        $ST = str_pad(decbin(hexdec(substr($XF, 0, $kb))), 8, "\x30", STR_PAD_LEFT) . $ST;
        OP:
        $ga = $this->precision > 0 ? substr($ST, -$this->precision) : ltrim($ST, "\x30");
        if (!($JW && $this->compare(new MathBigInteger()) > 0 && $this->precision <= 0)) {
            goto VM;
        }
        return "\60" . $ga;
        VM:
        return $ga;
    }
    function toString()
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                return gmp_strval($this->value);
            case MathBigInteger_MODE_BCMATH:
                if (!($this->value === "\60")) {
                    goto mH;
                }
                return "\60";
                mH:
                return ltrim($this->value, "\x30");
        }
        UP:
        TY:
        if (count($this->value)) {
            goto fF;
        }
        return "\60";
        fF:
        $DA = $this->copy();
        $DA->is_negative = false;
        $z8 = new MathBigInteger();
        $z8->value = [MathBigInteger_MAX10];
        $ga = '';
        dE:
        if (!count($DA->value)) {
            goto uQ;
        }
        list($DA, $wX) = $DA->divide($z8);
        $ga = str_pad(isset($wX->value[0]) ? $wX->value[0] : '', MathBigInteger_MAX10_LEN, "\60", STR_PAD_LEFT) . $ga;
        goto dE;
        uQ:
        $ga = ltrim($ga, "\x30");
        if (!empty($ga)) {
            goto Wp;
        }
        $ga = "\60";
        Wp:
        if (!$this->is_negative) {
            goto gr;
        }
        $ga = "\55" . $ga;
        gr:
        return $ga;
    }
    function copy()
    {
        $DA = new MathBigInteger();
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
        $yx = ["\150\x65\x78"];
        if (!($this->precision > 0)) {
            goto DU;
        }
        $yx[] = "\160\162\x65\143\151\x73\151\157\x6e";
        DU:
        return $yx;
    }
    function __wakeup()
    {
        $DA = new MathBigInteger($this->hex, -16);
        $this->value = $DA->value;
        $this->is_negative = $DA->is_negative;
        if (!($this->precision > 0)) {
            goto ao;
        }
        $this->setPrecision($this->precision);
        ao:
    }
    function __debugInfo()
    {
        $lY = [];
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $U7 = "\147\155\160";
                goto st;
            case MathBigInteger_MODE_BCMATH:
                $U7 = "\x62\143\x6d\141\164\150";
                goto st;
            case MathBigInteger_MODE_INTERNAL:
                $U7 = "\151\x6e\164\145\162\156\x61\154";
                $lY[] = PHP_INT_SIZE == 8 ? "\66\x34\x2d\x62\151\x74" : "\63\x32\x2d\x62\151\164";
        }
        NO:
        st:
        if (!(MathBigInteger_MODE != MathBigInteger_MODE_GMP && defined("\115\141\x74\x68\102\151\x67\x49\156\x74\x65\x67\145\x72\x5f\x4f\x50\x45\116\x53\123\114\x5f\x45\x4e\x41\x42\x4c\x45\x44"))) {
            goto sx;
        }
        $lY[] = "\117\160\145\156\123\123\x4c";
        sx:
        if (empty($lY)) {
            goto n7;
        }
        $U7 .= "\x20\x28" . implode($lY, "\54\x20") . "\x29";
        n7:
        return ["\x76\x61\x6c\165\145" => "\x30\170" . $this->toHex(true), "\145\156\x67\151\x6e\x65" => $U7];
    }
    function add($zE)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA = new MathBigInteger();
                $DA->value = gmp_add($this->value, $zE->value);
                return $this->_normalize($DA);
            case MathBigInteger_MODE_BCMATH:
                $DA = new MathBigInteger();
                $DA->value = bcadd($this->value, $zE->value, 0);
                return $this->_normalize($DA);
        }
        tR:
        Ai:
        $DA = $this->_add($this->value, $this->is_negative, $zE->value, $zE->is_negative);
        $ga = new MathBigInteger();
        $ga->value = $DA[MathBigInteger_VALUE];
        $ga->is_negative = $DA[MathBigInteger_SIGN];
        return $this->_normalize($ga);
    }
    function _add($Rb, $UJ, $et, $NN)
    {
        $ho = count($Rb);
        $db = count($et);
        if ($ho == 0) {
            goto eG;
        }
        if ($db == 0) {
            goto u3;
        }
        goto ru;
        eG:
        return [MathBigInteger_VALUE => $et, MathBigInteger_SIGN => $NN];
        goto ru;
        u3:
        return [MathBigInteger_VALUE => $Rb, MathBigInteger_SIGN => $UJ];
        ru:
        if (!($UJ != $NN)) {
            goto ne;
        }
        if (!($Rb == $et)) {
            goto tm;
        }
        return [MathBigInteger_VALUE => [], MathBigInteger_SIGN => false];
        tm:
        $DA = $this->_subtract($Rb, false, $et, false);
        $DA[MathBigInteger_SIGN] = $this->_compare($Rb, false, $et, false) > 0 ? $UJ : $NN;
        return $DA;
        ne:
        if ($ho < $db) {
            goto AH;
        }
        $dO = $db;
        $Vw = $Rb;
        goto hr;
        AH:
        $dO = $ho;
        $Vw = $et;
        hr:
        $Vw[count($Vw)] = 0;
        $Xf = 0;
        $vB = 0;
        $aj = 1;
        aT:
        if (!($aj < $dO)) {
            goto S0;
        }
        $hN = $Rb[$aj] * MathBigInteger_BASE_FULL + $Rb[$vB] + $et[$aj] * MathBigInteger_BASE_FULL + $et[$vB] + $Xf;
        $Xf = $hN >= MathBigInteger_MAX_DIGIT2;
        $hN = $Xf ? $hN - MathBigInteger_MAX_DIGIT2 : $hN;
        $DA = MathBigInteger_BASE === 26 ? intval($hN / 0x4000000) : $hN >> 31;
        $Vw[$vB] = (int) ($hN - MathBigInteger_BASE_FULL * $DA);
        $Vw[$aj] = $DA;
        mT:
        $vB += 2;
        $aj += 2;
        goto aT;
        S0:
        if (!($aj == $dO)) {
            goto af;
        }
        $hN = $Rb[$vB] + $et[$vB] + $Xf;
        $Xf = $hN >= MathBigInteger_BASE_FULL;
        $Vw[$vB] = $Xf ? $hN - MathBigInteger_BASE_FULL : $hN;
        ++$vB;
        af:
        if (!$Xf) {
            goto Mv;
        }
        Ky:
        if (!($Vw[$vB] == MathBigInteger_MAX_DIGIT)) {
            goto at;
        }
        $Vw[$vB] = 0;
        eV:
        ++$vB;
        goto Ky;
        at:
        ++$Vw[$vB];
        Mv:
        return [MathBigInteger_VALUE => $this->_trim($Vw), MathBigInteger_SIGN => $UJ];
    }
    function subtract($zE)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA = new MathBigInteger();
                $DA->value = gmp_sub($this->value, $zE->value);
                return $this->_normalize($DA);
            case MathBigInteger_MODE_BCMATH:
                $DA = new MathBigInteger();
                $DA->value = bcsub($this->value, $zE->value, 0);
                return $this->_normalize($DA);
        }
        S6:
        SH:
        $DA = $this->_subtract($this->value, $this->is_negative, $zE->value, $zE->is_negative);
        $ga = new MathBigInteger();
        $ga->value = $DA[MathBigInteger_VALUE];
        $ga->is_negative = $DA[MathBigInteger_SIGN];
        return $this->_normalize($ga);
    }
    function _subtract($Rb, $UJ, $et, $NN)
    {
        $ho = count($Rb);
        $db = count($et);
        if ($ho == 0) {
            goto jn;
        }
        if ($db == 0) {
            goto AI;
        }
        goto pF;
        jn:
        return [MathBigInteger_VALUE => $et, MathBigInteger_SIGN => !$NN];
        goto pF;
        AI:
        return [MathBigInteger_VALUE => $Rb, MathBigInteger_SIGN => $UJ];
        pF:
        if (!($UJ != $NN)) {
            goto o1;
        }
        $DA = $this->_add($Rb, false, $et, false);
        $DA[MathBigInteger_SIGN] = $UJ;
        return $DA;
        o1:
        $XK = $this->_compare($Rb, $UJ, $et, $NN);
        if ($XK) {
            goto Ul;
        }
        return [MathBigInteger_VALUE => [], MathBigInteger_SIGN => false];
        Ul:
        if (!(!$UJ && $XK < 0 || $UJ && $XK > 0)) {
            goto N_;
        }
        $DA = $Rb;
        $Rb = $et;
        $et = $DA;
        $UJ = !$UJ;
        $ho = count($Rb);
        $db = count($et);
        N_:
        $Xf = 0;
        $vB = 0;
        $aj = 1;
        yL:
        if (!($aj < $db)) {
            goto Zi;
        }
        $hN = $Rb[$aj] * MathBigInteger_BASE_FULL + $Rb[$vB] - $et[$aj] * MathBigInteger_BASE_FULL - $et[$vB] - $Xf;
        $Xf = $hN < 0;
        $hN = $Xf ? $hN + MathBigInteger_MAX_DIGIT2 : $hN;
        $DA = MathBigInteger_BASE === 26 ? intval($hN / 0x4000000) : $hN >> 31;
        $Rb[$vB] = (int) ($hN - MathBigInteger_BASE_FULL * $DA);
        $Rb[$aj] = $DA;
        BF:
        $vB += 2;
        $aj += 2;
        goto yL;
        Zi:
        if (!($aj == $db)) {
            goto WD;
        }
        $hN = $Rb[$vB] - $et[$vB] - $Xf;
        $Xf = $hN < 0;
        $Rb[$vB] = $Xf ? $hN + MathBigInteger_BASE_FULL : $hN;
        ++$vB;
        WD:
        if (!$Xf) {
            goto th;
        }
        xK:
        if ($Rb[$vB]) {
            goto wH;
        }
        $Rb[$vB] = MathBigInteger_MAX_DIGIT;
        XU:
        ++$vB;
        goto xK;
        wH:
        --$Rb[$vB];
        th:
        return [MathBigInteger_VALUE => $this->_trim($Rb), MathBigInteger_SIGN => $UJ];
    }
    function multiply($c2)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA = new MathBigInteger();
                $DA->value = gmp_mul($this->value, $c2->value);
                return $this->_normalize($DA);
            case MathBigInteger_MODE_BCMATH:
                $DA = new MathBigInteger();
                $DA->value = bcmul($this->value, $c2->value, 0);
                return $this->_normalize($DA);
        }
        PH:
        Vu:
        $DA = $this->_multiply($this->value, $this->is_negative, $c2->value, $c2->is_negative);
        $ut = new MathBigInteger();
        $ut->value = $DA[MathBigInteger_VALUE];
        $ut->is_negative = $DA[MathBigInteger_SIGN];
        return $this->_normalize($ut);
    }
    function _multiply($Rb, $UJ, $et, $NN)
    {
        $LI = count($Rb);
        $iJ = count($et);
        if (!(!$LI || !$iJ)) {
            goto Uj;
        }
        return [MathBigInteger_VALUE => [], MathBigInteger_SIGN => false];
        Uj:
        return [MathBigInteger_VALUE => min($LI, $iJ) < 2 * MathBigInteger_KARATSUBA_CUTOFF ? $this->_trim($this->_regularMultiply($Rb, $et)) : $this->_trim($this->_karatsuba($Rb, $et)), MathBigInteger_SIGN => $UJ != $NN];
    }
    function _regularMultiply($Rb, $et)
    {
        $LI = count($Rb);
        $iJ = count($et);
        if (!(!$LI || !$iJ)) {
            goto pP;
        }
        return [];
        pP:
        if (!($LI < $iJ)) {
            goto NI;
        }
        $DA = $Rb;
        $Rb = $et;
        $et = $DA;
        $LI = count($Rb);
        $iJ = count($et);
        NI:
        $eP = $this->_array_repeat(0, $LI + $iJ);
        $Xf = 0;
        $aj = 0;
        a7:
        if (!($aj < $LI)) {
            goto F6;
        }
        $DA = $Rb[$aj] * $et[0] + $Xf;
        $Xf = MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$aj] = (int) ($DA - MathBigInteger_BASE_FULL * $Xf);
        qN:
        ++$aj;
        goto a7;
        F6:
        $eP[$aj] = $Xf;
        $vB = 1;
        nA:
        if (!($vB < $iJ)) {
            goto LJ;
        }
        $Xf = 0;
        $aj = 0;
        $N1 = $vB;
        FI:
        if (!($aj < $LI)) {
            goto mL;
        }
        $DA = $eP[$N1] + $Rb[$aj] * $et[$vB] + $Xf;
        $Xf = MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$N1] = (int) ($DA - MathBigInteger_BASE_FULL * $Xf);
        JR:
        ++$aj;
        ++$N1;
        goto FI;
        mL:
        $eP[$N1] = $Xf;
        OH:
        ++$vB;
        goto nA;
        LJ:
        return $eP;
    }
    function _karatsuba($Rb, $et)
    {
        $OM = min(count($Rb) >> 1, count($et) >> 1);
        if (!($OM < MathBigInteger_KARATSUBA_CUTOFF)) {
            goto Pj;
        }
        return $this->_regularMultiply($Rb, $et);
        Pj:
        $nF = array_slice($Rb, $OM);
        $CW = array_slice($Rb, 0, $OM);
        $J5 = array_slice($et, $OM);
        $QI = array_slice($et, 0, $OM);
        $KY = $this->_karatsuba($nF, $J5);
        $nn = $this->_karatsuba($CW, $QI);
        $Lk = $this->_add($nF, false, $CW, false);
        $DA = $this->_add($J5, false, $QI, false);
        $Lk = $this->_karatsuba($Lk[MathBigInteger_VALUE], $DA[MathBigInteger_VALUE]);
        $DA = $this->_add($KY, false, $nn, false);
        $Lk = $this->_subtract($Lk, false, $DA[MathBigInteger_VALUE], false);
        $KY = array_merge(array_fill(0, 2 * $OM, 0), $KY);
        $Lk[MathBigInteger_VALUE] = array_merge(array_fill(0, $OM, 0), $Lk[MathBigInteger_VALUE]);
        $cB = $this->_add($KY, false, $Lk[MathBigInteger_VALUE], $Lk[MathBigInteger_SIGN]);
        $cB = $this->_add($cB[MathBigInteger_VALUE], $cB[MathBigInteger_SIGN], $nn, false);
        return $cB[MathBigInteger_VALUE];
    }
    function _square($c2 = false)
    {
        return count($c2) < 2 * MathBigInteger_KARATSUBA_CUTOFF ? $this->_trim($this->_baseSquare($c2)) : $this->_trim($this->_karatsubaSquare($c2));
    }
    function _baseSquare($Vw)
    {
        if (!empty($Vw)) {
            goto M1;
        }
        return [];
        M1:
        $kw = $this->_array_repeat(0, 2 * count($Vw));
        $vB = 0;
        $qX = count($Vw) - 1;
        zJ:
        if (!($vB <= $qX)) {
            goto Dl;
        }
        $St = $vB << 1;
        $DA = $kw[$St] + $Vw[$vB] * $Vw[$vB];
        $Xf = MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $kw[$St] = (int) ($DA - MathBigInteger_BASE_FULL * $Xf);
        $aj = $vB + 1;
        $N1 = $St + 1;
        nY:
        if (!($aj <= $qX)) {
            goto XT;
        }
        $DA = $kw[$N1] + 2 * $Vw[$aj] * $Vw[$vB] + $Xf;
        $Xf = MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $kw[$N1] = (int) ($DA - MathBigInteger_BASE_FULL * $Xf);
        qB:
        ++$aj;
        ++$N1;
        goto nY;
        XT:
        $kw[$vB + $qX + 1] = $Xf;
        lU:
        ++$vB;
        goto zJ;
        Dl:
        return $kw;
    }
    function _karatsubaSquare($Vw)
    {
        $OM = count($Vw) >> 1;
        if (!($OM < MathBigInteger_KARATSUBA_CUTOFF)) {
            goto XX;
        }
        return $this->_baseSquare($Vw);
        XX:
        $nF = array_slice($Vw, $OM);
        $CW = array_slice($Vw, 0, $OM);
        $KY = $this->_karatsubaSquare($nF);
        $nn = $this->_karatsubaSquare($CW);
        $Lk = $this->_add($nF, false, $CW, false);
        $Lk = $this->_karatsubaSquare($Lk[MathBigInteger_VALUE]);
        $DA = $this->_add($KY, false, $nn, false);
        $Lk = $this->_subtract($Lk, false, $DA[MathBigInteger_VALUE], false);
        $KY = array_merge(array_fill(0, 2 * $OM, 0), $KY);
        $Lk[MathBigInteger_VALUE] = array_merge(array_fill(0, $OM, 0), $Lk[MathBigInteger_VALUE]);
        $my = $this->_add($KY, false, $Lk[MathBigInteger_VALUE], $Lk[MathBigInteger_SIGN]);
        $my = $this->_add($my[MathBigInteger_VALUE], $my[MathBigInteger_SIGN], $nn, false);
        return $my[MathBigInteger_VALUE];
    }
    function divide($zE)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $wt = new MathBigInteger();
                $Ki = new MathBigInteger();
                list($wt->value, $Ki->value) = gmp_div_qr($this->value, $zE->value);
                if (!(gmp_sign($Ki->value) < 0)) {
                    goto zc;
                }
                $Ki->value = gmp_add($Ki->value, gmp_abs($zE->value));
                zc:
                return [$this->_normalize($wt), $this->_normalize($Ki)];
            case MathBigInteger_MODE_BCMATH:
                $wt = new MathBigInteger();
                $Ki = new MathBigInteger();
                $wt->value = bcdiv($this->value, $zE->value, 0);
                $Ki->value = bcmod($this->value, $zE->value);
                if (!($Ki->value[0] == "\x2d")) {
                    goto ky;
                }
                $Ki->value = bcadd($Ki->value, $zE->value[0] == "\x2d" ? substr($zE->value, 1) : $zE->value, 0);
                ky:
                return [$this->_normalize($wt), $this->_normalize($Ki)];
        }
        k2:
        I3:
        if (!(count($zE->value) == 1)) {
            goto hW;
        }
        list($jS, $mv) = $this->_divide_digit($this->value, $zE->value[0]);
        $wt = new MathBigInteger();
        $Ki = new MathBigInteger();
        $wt->value = $jS;
        $Ki->value = [$mv];
        $wt->is_negative = $this->is_negative != $zE->is_negative;
        return [$this->_normalize($wt), $this->_normalize($Ki)];
        hW:
        static $C7;
        if (isset($C7)) {
            goto WG;
        }
        $C7 = new MathBigInteger();
        WG:
        $c2 = $this->copy();
        $zE = $zE->copy();
        $BH = $c2->is_negative;
        $nq = $zE->is_negative;
        $c2->is_negative = $zE->is_negative = false;
        $XK = $c2->compare($zE);
        if ($XK) {
            goto Bq;
        }
        $DA = new MathBigInteger();
        $DA->value = [1];
        $DA->is_negative = $BH != $nq;
        return [$this->_normalize($DA), $this->_normalize(new MathBigInteger())];
        Bq:
        if (!($XK < 0)) {
            goto nV;
        }
        if (!$BH) {
            goto jH;
        }
        $c2 = $zE->subtract($c2);
        jH:
        return [$this->_normalize(new MathBigInteger()), $this->_normalize($c2)];
        nV:
        $m0 = $zE->value[count($zE->value) - 1];
        $hn = 0;
        hl:
        if ($m0 & MathBigInteger_MSB) {
            goto d9;
        }
        $m0 <<= 1;
        Kl:
        ++$hn;
        goto hl;
        d9:
        $c2->_lshift($hn);
        $zE->_lshift($hn);
        $et =& $zE->value;
        $JS = count($c2->value) - 1;
        $Gn = count($zE->value) - 1;
        $wt = new MathBigInteger();
        $KV =& $wt->value;
        $KV = $this->_array_repeat(0, $JS - $Gn + 1);
        static $DA, $s0, $Fn;
        if (isset($DA)) {
            goto Kv;
        }
        $DA = new MathBigInteger();
        $s0 = new MathBigInteger();
        $Fn = new MathBigInteger();
        Kv:
        $hf =& $DA->value;
        $EK =& $Fn->value;
        $hf = array_merge($this->_array_repeat(0, $JS - $Gn), $et);
        TB:
        if (!($c2->compare($DA) >= 0)) {
            goto cv;
        }
        ++$KV[$JS - $Gn];
        $c2 = $c2->subtract($DA);
        $JS = count($c2->value) - 1;
        goto TB;
        cv:
        $vB = $JS;
        WE:
        if (!($vB >= $Gn + 1)) {
            goto z2;
        }
        $Rb =& $c2->value;
        $oy = [isset($Rb[$vB]) ? $Rb[$vB] : 0, isset($Rb[$vB - 1]) ? $Rb[$vB - 1] : 0, isset($Rb[$vB - 2]) ? $Rb[$vB - 2] : 0];
        $kf = [$et[$Gn], $Gn > 0 ? $et[$Gn - 1] : 0];
        $ai = $vB - $Gn - 1;
        if ($oy[0] == $kf[0]) {
            goto BZ;
        }
        $KV[$ai] = $this->_safe_divide($oy[0] * MathBigInteger_BASE_FULL + $oy[1], $kf[0]);
        goto n1;
        BZ:
        $KV[$ai] = MathBigInteger_MAX_DIGIT;
        n1:
        $hf = [$kf[1], $kf[0]];
        $s0->value = [$KV[$ai]];
        $s0 = $s0->multiply($DA);
        $EK = [$oy[2], $oy[1], $oy[0]];
        pd:
        if (!($s0->compare($Fn) > 0)) {
            goto Pi;
        }
        --$KV[$ai];
        $s0->value = [$KV[$ai]];
        $s0 = $s0->multiply($DA);
        goto pd;
        Pi:
        $kI = $this->_array_repeat(0, $ai);
        $hf = [$KV[$ai]];
        $DA = $DA->multiply($zE);
        $hf =& $DA->value;
        $hf = array_merge($kI, $hf);
        $c2 = $c2->subtract($DA);
        if (!($c2->compare($C7) < 0)) {
            goto cR;
        }
        $hf = array_merge($kI, $et);
        $c2 = $c2->add($DA);
        --$KV[$ai];
        cR:
        $JS = count($Rb) - 1;
        Li:
        --$vB;
        goto WE;
        z2:
        $c2->_rshift($hn);
        $wt->is_negative = $BH != $nq;
        if (!$BH) {
            goto YW;
        }
        $zE->_rshift($hn);
        $c2 = $zE->subtract($c2);
        YW:
        return [$this->_normalize($wt), $this->_normalize($c2)];
    }
    function _divide_digit($WH, $z8)
    {
        $Xf = 0;
        $ga = [];
        $vB = count($WH) - 1;
        Bo:
        if (!($vB >= 0)) {
            goto Em;
        }
        $DA = MathBigInteger_BASE_FULL * $Xf + $WH[$vB];
        $ga[$vB] = $this->_safe_divide($DA, $z8);
        $Xf = (int) ($DA - $z8 * $ga[$vB]);
        S5:
        --$vB;
        goto Bo;
        Em:
        return [$ga, $Xf];
    }
    function modPow($P0, $Td)
    {
        $Td = $this->bitmask !== false && $this->bitmask->compare($Td) < 0 ? $this->bitmask : $Td->abs();
        if (!($P0->compare(new MathBigInteger()) < 0)) {
            goto qO;
        }
        $P0 = $P0->abs();
        $DA = $this->modInverse($Td);
        if (!($DA === false)) {
            goto bQ;
        }
        return false;
        bQ:
        return $this->_normalize($DA->modPow($P0, $Td));
        qO:
        if (!(MathBigInteger_MODE == MathBigInteger_MODE_GMP)) {
            goto J1;
        }
        $DA = new MathBigInteger();
        $DA->value = gmp_powm($this->value, $P0->value, $Td->value);
        return $this->_normalize($DA);
        J1:
        if (!($this->compare(new MathBigInteger()) < 0 || $this->compare($Td) > 0)) {
            goto sG;
        }
        list(, $DA) = $this->divide($Td);
        return $DA->modPow($P0, $Td);
        sG:
        if (!defined("\115\141\164\x68\x42\151\x67\x49\156\164\x65\x67\x65\x72\137\117\x50\x45\116\123\123\x4c\x5f\105\116\x41\102\x4c\x45\x44")) {
            goto N8;
        }
        $wM = ["\x6d\157\x64\x75\154\165\x73" => $Td->toBytes(true), "\x70\x75\142\x6c\x69\x63\105\170\160\157\x6e\x65\x6e\x74" => $P0->toBytes(true)];
        $wM = ["\155\157\x64\165\x6c\165\163" => pack("\103\x61\52\141\x2a", 2, $this->_encodeASN1Length(strlen($wM["\x6d\x6f\144\x75\x6c\165\x73"])), $wM["\x6d\x6f\144\165\154\165\163"]), "\x70\x75\142\x6c\151\143\x45\170\x70\157\x6e\145\x6e\x74" => pack("\x43\x61\52\141\x2a", 2, $this->_encodeASN1Length(strlen($wM["\160\x75\142\154\151\x63\x45\x78\160\157\156\145\x6e\164"])), $wM["\160\x75\142\154\x69\143\105\x78\160\157\156\145\156\164"])];
        $wr = pack("\x43\141\x2a\x61\52\x61\x2a", 48, $this->_encodeASN1Length(strlen($wM["\x6d\157\144\165\154\x75\163"]) + strlen($wM["\160\x75\x62\x6c\x69\x63\105\170\x70\157\156\145\156\x74"])), $wM["\155\x6f\144\x75\x6c\x75\163"], $wM["\160\165\142\154\151\143\105\x78\160\x6f\x6e\x65\x6e\164"]);
        $Mw = pack("\x48\x2a", "\x33\60\60\x64\x30\x36\60\x39\62\141\x38\x36\x34\70\x38\66\146\x37\60\144\60\x31\60\x31\60\61\x30\x35\60\x30");
        $wr = chr(0) . $wr;
        $wr = chr(3) . $this->_encodeASN1Length(strlen($wr)) . $wr;
        $zO = pack("\x43\x61\x2a\141\x2a", 48, $this->_encodeASN1Length(strlen($Mw . $wr)), $Mw . $wr);
        $wr = "\x2d\55\55\55\55\x42\105\107\x49\x4e\x20\120\x55\x42\x4c\x49\x43\x20\x4b\x45\x59\55\x2d\55\55\x2d\xd\xa" . chunk_split(base64_encode($zO)) . "\55\x2d\x2d\55\x2d\105\116\104\40\120\x55\x42\114\x49\103\40\113\105\131\x2d\x2d\55\x2d\55";
        $Fj = str_pad($this->toBytes(), strlen($Td->toBytes(true)) - 1, "\0", STR_PAD_LEFT);
        if (!openssl_public_encrypt($Fj, $ga, $wr, OPENSSL_NO_PADDING)) {
            goto vw;
        }
        return new MathBigInteger($ga, 256);
        vw:
        N8:
        if (!(MathBigInteger_MODE == MathBigInteger_MODE_BCMATH)) {
            goto Ad;
        }
        $DA = new MathBigInteger();
        $DA->value = bcpowmod($this->value, $P0->value, $Td->value, 0);
        return $this->_normalize($DA);
        Ad:
        if (!empty($P0->value)) {
            goto id;
        }
        $DA = new MathBigInteger();
        $DA->value = [1];
        return $this->_normalize($DA);
        id:
        if (!($P0->value == [1])) {
            goto Qn;
        }
        list(, $DA) = $this->divide($Td);
        return $this->_normalize($DA);
        Qn:
        if (!($P0->value == [2])) {
            goto Nb;
        }
        $DA = new MathBigInteger();
        $DA->value = $this->_square($this->value);
        list(, $DA) = $DA->divide($Td);
        return $this->_normalize($DA);
        Nb:
        return $this->_normalize($this->_slidingWindow($P0, $Td, MathBigInteger_BARRETT));
        if (!($Td->value[0] & 1)) {
            goto gN;
        }
        return $this->_normalize($this->_slidingWindow($P0, $Td, MathBigInteger_MONTGOMERY));
        gN:
        $vB = 0;
        lK:
        if (!($vB < count($Td->value))) {
            goto JW;
        }
        if (!$Td->value[$vB]) {
            goto gf;
        }
        $DA = decbin($Td->value[$vB]);
        $aj = strlen($DA) - strrpos($DA, "\61") - 1;
        $aj += 26 * $vB;
        goto JW;
        gf:
        K5:
        ++$vB;
        goto lK;
        JW:
        $k9 = $Td->copy();
        $k9->_rshift($aj);
        $q2 = new MathBigInteger();
        $q2->value = [1];
        $q2->_lshift($aj);
        $u2 = $k9->value != [1] ? $this->_slidingWindow($P0, $k9, MathBigInteger_MONTGOMERY) : new MathBigInteger();
        $D2 = $this->_slidingWindow($P0, $q2, MathBigInteger_POWEROF2);
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
        iP:
        if (!($vB >= 0)) {
            goto TT;
        }
        $yh .= str_pad(decbin($kV[$vB]), MathBigInteger_BASE, "\x30", STR_PAD_LEFT);
        Ux:
        --$vB;
        goto iP;
        TT:
        $qQ = strlen($yh);
        $vB = 0;
        $xZ = 1;
        s3:
        if (!($vB < count($tR) && $qQ > $tR[$vB])) {
            goto ff;
        }
        Cy:
        ++$xZ;
        ++$vB;
        goto s3;
        ff:
        $g2 = $Td->value;
        $n_ = [];
        $n_[1] = $this->_prepareReduce($this->value, $g2, $tp);
        $n_[2] = $this->_squareReduce($n_[1], $g2, $tp);
        $DA = 1 << $xZ - 1;
        $vB = 1;
        vZ:
        if (!($vB < $DA)) {
            goto c8;
        }
        $St = $vB << 1;
        $n_[$St + 1] = $this->_multiplyReduce($n_[$St - 1], $n_[2], $g2, $tp);
        lI:
        ++$vB;
        goto vZ;
        c8:
        $ga = [1];
        $ga = $this->_prepareReduce($ga, $g2, $tp);
        $vB = 0;
        J5:
        if (!($vB < $qQ)) {
            goto aI;
        }
        if (!$yh[$vB]) {
            goto km;
        }
        $aj = $xZ - 1;
        YG:
        if (!($aj > 0)) {
            goto ek;
        }
        if (empty($yh[$vB + $aj])) {
            goto e9;
        }
        goto ek;
        e9:
        mx:
        --$aj;
        goto YG;
        ek:
        $N1 = 0;
        g0:
        if (!($N1 <= $aj)) {
            goto S_;
        }
        $ga = $this->_squareReduce($ga, $g2, $tp);
        ZG:
        ++$N1;
        goto g0;
        S_:
        $ga = $this->_multiplyReduce($ga, $n_[bindec(substr($yh, $vB, $aj + 1))], $g2, $tp);
        $vB += $aj + 1;
        goto nQ;
        km:
        $ga = $this->_squareReduce($ga, $g2, $tp);
        ++$vB;
        nQ:
        Pg:
        goto J5;
        aI:
        $DA = new MathBigInteger();
        $DA->value = $this->_reduce($ga, $g2, $tp);
        return $DA;
    }
    function _reduce($c2, $Td, $tp)
    {
        switch ($tp) {
            case MathBigInteger_MONTGOMERY:
                return $this->_montgomery($c2, $Td);
            case MathBigInteger_BARRETT:
                return $this->_barrett($c2, $Td);
            case MathBigInteger_POWEROF2:
                $s0 = new MathBigInteger();
                $s0->value = $c2;
                $Fn = new MathBigInteger();
                $Fn->value = $Td;
                return $c2->_mod2($Td);
            case MathBigInteger_CLASSIC:
                $s0 = new MathBigInteger();
                $s0->value = $c2;
                $Fn = new MathBigInteger();
                $Fn->value = $Td;
                list(, $DA) = $s0->divide($Fn);
                return $DA->value;
            case MathBigInteger_NONE:
                return $c2;
            default:
        }
        IQ:
        Y_:
    }
    function _prepareReduce($c2, $Td, $tp)
    {
        if (!($tp == MathBigInteger_MONTGOMERY)) {
            goto PW;
        }
        return $this->_prepMontgomery($c2, $Td);
        PW:
        return $this->_reduce($c2, $Td, $tp);
    }
    function _multiplyReduce($c2, $zE, $Td, $tp)
    {
        if (!($tp == MathBigInteger_MONTGOMERY)) {
            goto SY;
        }
        return $this->_montgomeryMultiply($c2, $zE, $Td);
        SY:
        $DA = $this->_multiply($c2, false, $zE, false);
        return $this->_reduce($DA[MathBigInteger_VALUE], $Td, $tp);
    }
    function _squareReduce($c2, $Td, $tp)
    {
        if (!($tp == MathBigInteger_MONTGOMERY)) {
            goto Eu;
        }
        return $this->_montgomeryMultiply($c2, $c2, $Td);
        Eu:
        return $this->_reduce($this->_square($c2), $Td, $tp);
    }
    function _mod2($Td)
    {
        $DA = new MathBigInteger();
        $DA->value = [1];
        return $this->bitwise_and($Td->subtract($DA));
    }
    function _barrett($Td, $OM)
    {
        static $a5 = array(MathBigInteger_VARIABLE => array(), MathBigInteger_DATA => array());
        $sy = count($OM);
        if (!(count($Td) > 2 * $sy)) {
            goto v7;
        }
        $s0 = new MathBigInteger();
        $Fn = new MathBigInteger();
        $s0->value = $Td;
        $Fn->value = $OM;
        list(, $DA) = $s0->divide($Fn);
        return $DA->value;
        v7:
        if (!($sy < 5)) {
            goto ym;
        }
        return $this->_regularBarrett($Td, $OM);
        ym:
        if (($mx = array_search($OM, $a5[MathBigInteger_VARIABLE])) === false) {
            goto HQ;
        }
        extract($a5[MathBigInteger_DATA][$mx]);
        goto Jf;
        HQ:
        $mx = count($a5[MathBigInteger_VARIABLE]);
        $a5[MathBigInteger_VARIABLE][] = $OM;
        $s0 = new MathBigInteger();
        $iF =& $s0->value;
        $iF = $this->_array_repeat(0, $sy + ($sy >> 1));
        $iF[] = 1;
        $Fn = new MathBigInteger();
        $Fn->value = $OM;
        list($Vg, $BA) = $s0->divide($Fn);
        $Vg = $Vg->value;
        $BA = $BA->value;
        $a5[MathBigInteger_DATA][] = ["\x75" => $Vg, "\x6d\61" => $BA];
        Jf:
        $wa = $sy + ($sy >> 1);
        $wL = array_slice($Td, 0, $wa);
        $rL = array_slice($Td, $wa);
        $wL = $this->_trim($wL);
        $DA = $this->_multiply($rL, false, $BA, false);
        $Td = $this->_add($wL, false, $DA[MathBigInteger_VALUE], false);
        if (!($sy & 1)) {
            goto Ae;
        }
        return $this->_regularBarrett($Td[MathBigInteger_VALUE], $OM);
        Ae:
        $DA = array_slice($Td[MathBigInteger_VALUE], $sy - 1);
        $DA = $this->_multiply($DA, false, $Vg, false);
        $DA = array_slice($DA[MathBigInteger_VALUE], ($sy >> 1) + 1);
        $DA = $this->_multiply($DA, false, $OM, false);
        $ga = $this->_subtract($Td[MathBigInteger_VALUE], false, $DA[MathBigInteger_VALUE], false);
        o0:
        if (!($this->_compare($ga[MathBigInteger_VALUE], $ga[MathBigInteger_SIGN], $OM, false) >= 0)) {
            goto SX;
        }
        $ga = $this->_subtract($ga[MathBigInteger_VALUE], $ga[MathBigInteger_SIGN], $OM, false);
        goto o0;
        SX:
        return $ga[MathBigInteger_VALUE];
    }
    function _regularBarrett($c2, $Td)
    {
        static $a5 = array(MathBigInteger_VARIABLE => array(), MathBigInteger_DATA => array());
        $bg = count($Td);
        if (!(count($c2) > 2 * $bg)) {
            goto Zj;
        }
        $s0 = new MathBigInteger();
        $Fn = new MathBigInteger();
        $s0->value = $c2;
        $Fn->value = $Td;
        list(, $DA) = $s0->divide($Fn);
        return $DA->value;
        Zj:
        if (!(($mx = array_search($Td, $a5[MathBigInteger_VARIABLE])) === false)) {
            goto pB;
        }
        $mx = count($a5[MathBigInteger_VARIABLE]);
        $a5[MathBigInteger_VARIABLE][] = $Td;
        $s0 = new MathBigInteger();
        $iF =& $s0->value;
        $iF = $this->_array_repeat(0, 2 * $bg);
        $iF[] = 1;
        $Fn = new MathBigInteger();
        $Fn->value = $Td;
        list($DA, ) = $s0->divide($Fn);
        $a5[MathBigInteger_DATA][] = $DA->value;
        pB:
        $DA = array_slice($c2, $bg - 1);
        $DA = $this->_multiply($DA, false, $a5[MathBigInteger_DATA][$mx], false);
        $DA = array_slice($DA[MathBigInteger_VALUE], $bg + 1);
        $ga = array_slice($c2, 0, $bg + 1);
        $DA = $this->_multiplyLower($DA, false, $Td, false, $bg + 1);
        if (!($this->_compare($ga, false, $DA[MathBigInteger_VALUE], $DA[MathBigInteger_SIGN]) < 0)) {
            goto WP;
        }
        $VO = $this->_array_repeat(0, $bg + 1);
        $VO[count($VO)] = 1;
        $ga = $this->_add($ga, false, $VO, false);
        $ga = $ga[MathBigInteger_VALUE];
        WP:
        $ga = $this->_subtract($ga, false, $DA[MathBigInteger_VALUE], $DA[MathBigInteger_SIGN]);
        qf:
        if (!($this->_compare($ga[MathBigInteger_VALUE], $ga[MathBigInteger_SIGN], $Td, false) > 0)) {
            goto Ej;
        }
        $ga = $this->_subtract($ga[MathBigInteger_VALUE], $ga[MathBigInteger_SIGN], $Td, false);
        goto qf;
        Ej:
        return $ga[MathBigInteger_VALUE];
    }
    function _multiplyLower($Rb, $UJ, $et, $NN, $ln)
    {
        $LI = count($Rb);
        $iJ = count($et);
        if (!(!$LI || !$iJ)) {
            goto Bl;
        }
        return [MathBigInteger_VALUE => [], MathBigInteger_SIGN => false];
        Bl:
        if (!($LI < $iJ)) {
            goto Ht;
        }
        $DA = $Rb;
        $Rb = $et;
        $et = $DA;
        $LI = count($Rb);
        $iJ = count($et);
        Ht:
        $eP = $this->_array_repeat(0, $LI + $iJ);
        $Xf = 0;
        $aj = 0;
        Fh:
        if (!($aj < $LI)) {
            goto kJ;
        }
        $DA = $Rb[$aj] * $et[0] + $Xf;
        $Xf = MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$aj] = (int) ($DA - MathBigInteger_BASE_FULL * $Xf);
        w4:
        ++$aj;
        goto Fh;
        kJ:
        if (!($aj < $ln)) {
            goto ql;
        }
        $eP[$aj] = $Xf;
        ql:
        $vB = 1;
        Jc:
        if (!($vB < $iJ)) {
            goto Mo;
        }
        $Xf = 0;
        $aj = 0;
        $N1 = $vB;
        J0:
        if (!($aj < $LI && $N1 < $ln)) {
            goto x3;
        }
        $DA = $eP[$N1] + $Rb[$aj] * $et[$vB] + $Xf;
        $Xf = MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $eP[$N1] = (int) ($DA - MathBigInteger_BASE_FULL * $Xf);
        gD:
        ++$aj;
        ++$N1;
        goto J0;
        x3:
        if (!($N1 < $ln)) {
            goto fK;
        }
        $eP[$N1] = $Xf;
        fK:
        FS:
        ++$vB;
        goto Jc;
        Mo:
        return [MathBigInteger_VALUE => $this->_trim($eP), MathBigInteger_SIGN => $UJ != $NN];
    }
    function _montgomery($c2, $Td)
    {
        static $a5 = array(MathBigInteger_VARIABLE => array(), MathBigInteger_DATA => array());
        if (!(($mx = array_search($Td, $a5[MathBigInteger_VARIABLE])) === false)) {
            goto Tf;
        }
        $mx = count($a5[MathBigInteger_VARIABLE]);
        $a5[MathBigInteger_VARIABLE][] = $c2;
        $a5[MathBigInteger_DATA][] = $this->_modInverse67108864($Td);
        Tf:
        $N1 = count($Td);
        $ga = [MathBigInteger_VALUE => $c2];
        $vB = 0;
        P2:
        if (!($vB < $N1)) {
            goto Ia;
        }
        $DA = $ga[MathBigInteger_VALUE][$vB] * $a5[MathBigInteger_DATA][$mx];
        $DA = $DA - MathBigInteger_BASE_FULL * (MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31);
        $DA = $this->_regularMultiply([$DA], $Td);
        $DA = array_merge($this->_array_repeat(0, $vB), $DA);
        $ga = $this->_add($ga[MathBigInteger_VALUE], false, $DA, false);
        s4:
        ++$vB;
        goto P2;
        Ia:
        $ga[MathBigInteger_VALUE] = array_slice($ga[MathBigInteger_VALUE], $N1);
        if (!($this->_compare($ga, false, $Td, false) >= 0)) {
            goto oY;
        }
        $ga = $this->_subtract($ga[MathBigInteger_VALUE], false, $Td, false);
        oY:
        return $ga[MathBigInteger_VALUE];
    }
    function _montgomeryMultiply($c2, $zE, $OM)
    {
        $DA = $this->_multiply($c2, false, $zE, false);
        return $this->_montgomery($DA[MathBigInteger_VALUE], $OM);
        static $a5 = array(MathBigInteger_VARIABLE => array(), MathBigInteger_DATA => array());
        if (!(($mx = array_search($OM, $a5[MathBigInteger_VARIABLE])) === false)) {
            goto BV;
        }
        $mx = count($a5[MathBigInteger_VARIABLE]);
        $a5[MathBigInteger_VARIABLE][] = $OM;
        $a5[MathBigInteger_DATA][] = $this->_modInverse67108864($OM);
        BV:
        $Td = max(count($c2), count($zE), count($OM));
        $c2 = array_pad($c2, $Td, 0);
        $zE = array_pad($zE, $Td, 0);
        $OM = array_pad($OM, $Td, 0);
        $PQ = [MathBigInteger_VALUE => $this->_array_repeat(0, $Td + 1)];
        $vB = 0;
        Oc:
        if (!($vB < $Td)) {
            goto Kx;
        }
        $DA = $PQ[MathBigInteger_VALUE][0] + $c2[$vB] * $zE[0];
        $DA = $DA - MathBigInteger_BASE_FULL * (MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31);
        $DA = $DA * $a5[MathBigInteger_DATA][$mx];
        $DA = $DA - MathBigInteger_BASE_FULL * (MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31);
        $DA = $this->_add($this->_regularMultiply([$c2[$vB]], $zE), false, $this->_regularMultiply([$DA], $OM), false);
        $PQ = $this->_add($PQ[MathBigInteger_VALUE], false, $DA[MathBigInteger_VALUE], false);
        $PQ[MathBigInteger_VALUE] = array_slice($PQ[MathBigInteger_VALUE], 1);
        j8:
        ++$vB;
        goto Oc;
        Kx:
        if (!($this->_compare($PQ[MathBigInteger_VALUE], false, $OM, false) >= 0)) {
            goto Yu;
        }
        $PQ = $this->_subtract($PQ[MathBigInteger_VALUE], false, $OM, false);
        Yu:
        return $PQ[MathBigInteger_VALUE];
    }
    function _prepMontgomery($c2, $Td)
    {
        $s0 = new MathBigInteger();
        $s0->value = array_merge($this->_array_repeat(0, count($Td)), $c2);
        $Fn = new MathBigInteger();
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
        $ga = fmod($ga * (2 - fmod($c2 * $ga, MathBigInteger_BASE_FULL)), MathBigInteger_BASE_FULL);
        return $ga & MathBigInteger_MAX_DIGIT;
    }
    function modInverse($Td)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA = new MathBigInteger();
                $DA->value = gmp_invert($this->value, $Td->value);
                return $DA->value === false ? false : $this->_normalize($DA);
        }
        hH:
        bv:
        static $C7, $sO;
        if (isset($C7)) {
            goto Ty;
        }
        $C7 = new MathBigInteger();
        $sO = new MathBigInteger(1);
        Ty:
        $Td = $Td->abs();
        if (!($this->compare($C7) < 0)) {
            goto Pr;
        }
        $DA = $this->abs();
        $DA = $DA->modInverse($Td);
        return $this->_normalize($Td->subtract($DA));
        Pr:
        extract($this->extendedGCD($Td));
        if ($Yv->equals($sO)) {
            goto zw;
        }
        return false;
        zw:
        $c2 = $c2->compare($C7) < 0 ? $c2->add($Td) : $c2;
        return $this->compare($C7) < 0 ? $this->_normalize($Td->subtract($c2)) : $this->_normalize($c2);
    }
    function extendedGCD($Td)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                extract(gmp_gcdext($this->value, $Td->value));
                return ["\x67\x63\x64" => $this->_normalize(new MathBigInteger($gl)), "\170" => $this->_normalize(new MathBigInteger($pq)), "\x79" => $this->_normalize(new MathBigInteger($HO))];
            case MathBigInteger_MODE_BCMATH:
                $Vg = $this->value;
                $sN = $Td->value;
                $PQ = "\x31";
                $WQ = "\x30";
                $rt = "\60";
                $zF = "\x31";
                ZY:
                if (!(bccomp($sN, "\x30", 0) != 0)) {
                    goto HV;
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
                goto ZY;
                HV:
                return ["\x67\x63\x64" => $this->_normalize(new MathBigInteger($Vg)), "\x78" => $this->_normalize(new MathBigInteger($PQ)), "\x79" => $this->_normalize(new MathBigInteger($WQ))];
        }
        Zm:
        kN:
        $zE = $Td->copy();
        $c2 = $this->copy();
        $gl = new MathBigInteger();
        $gl->value = [1];
        c0:
        if ($c2->value[0] & 1 || $zE->value[0] & 1) {
            goto Dw;
        }
        $c2->_rshift(1);
        $zE->_rshift(1);
        $gl->_lshift(1);
        goto c0;
        Dw:
        $Vg = $c2->copy();
        $sN = $zE->copy();
        $PQ = new MathBigInteger();
        $WQ = new MathBigInteger();
        $rt = new MathBigInteger();
        $zF = new MathBigInteger();
        $PQ->value = $zF->value = $gl->value = [1];
        $WQ->value = $rt->value = [];
        We:
        if (empty($Vg->value)) {
            goto MZ;
        }
        qt:
        if ($Vg->value[0] & 1) {
            goto q8;
        }
        $Vg->_rshift(1);
        if (!(!empty($PQ->value) && $PQ->value[0] & 1 || !empty($WQ->value) && $WQ->value[0] & 1)) {
            goto Yx;
        }
        $PQ = $PQ->add($zE);
        $WQ = $WQ->subtract($c2);
        Yx:
        $PQ->_rshift(1);
        $WQ->_rshift(1);
        goto qt;
        q8:
        ml:
        if ($sN->value[0] & 1) {
            goto qg;
        }
        $sN->_rshift(1);
        if (!(!empty($zF->value) && $zF->value[0] & 1 || !empty($rt->value) && $rt->value[0] & 1)) {
            goto pg;
        }
        $rt = $rt->add($zE);
        $zF = $zF->subtract($c2);
        pg:
        $rt->_rshift(1);
        $zF->_rshift(1);
        goto ml;
        qg:
        if ($Vg->compare($sN) >= 0) {
            goto ly;
        }
        $sN = $sN->subtract($Vg);
        $rt = $rt->subtract($PQ);
        $zF = $zF->subtract($WQ);
        goto qY;
        ly:
        $Vg = $Vg->subtract($sN);
        $PQ = $PQ->subtract($rt);
        $WQ = $WQ->subtract($zF);
        qY:
        goto We;
        MZ:
        return ["\147\143\144" => $this->_normalize($gl->multiply($sN)), "\170" => $this->_normalize($rt), "\171" => $this->_normalize($zF)];
    }
    function gcd($Td)
    {
        extract($this->extendedGCD($Td));
        return $Yv;
    }
    function abs()
    {
        $DA = new MathBigInteger();
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA->value = gmp_abs($this->value);
                goto d5;
            case MathBigInteger_MODE_BCMATH:
                $DA->value = bccomp($this->value, "\x30", 0) < 0 ? substr($this->value, 1) : $this->value;
                goto d5;
            default:
                $DA->value = $this->value;
        }
        tL:
        d5:
        return $DA;
    }
    function compare($zE)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                return gmp_cmp($this->value, $zE->value);
            case MathBigInteger_MODE_BCMATH:
                return bccomp($this->value, $zE->value, 0);
        }
        Nz:
        Rb:
        return $this->_compare($this->value, $this->is_negative, $zE->value, $zE->is_negative);
    }
    function _compare($Rb, $UJ, $et, $NN)
    {
        if (!($UJ != $NN)) {
            goto c3;
        }
        return !$UJ && $NN ? 1 : -1;
        c3:
        $ga = $UJ ? -1 : 1;
        if (!(count($Rb) != count($et))) {
            goto Ys;
        }
        return count($Rb) > count($et) ? $ga : -$ga;
        Ys:
        $dO = max(count($Rb), count($et));
        $Rb = array_pad($Rb, $dO, 0);
        $et = array_pad($et, $dO, 0);
        $vB = count($Rb) - 1;
        CT:
        if (!($vB >= 0)) {
            goto w3;
        }
        if (!($Rb[$vB] != $et[$vB])) {
            goto XK;
        }
        return $Rb[$vB] > $et[$vB] ? $ga : -$ga;
        XK:
        pq:
        --$vB;
        goto CT;
        w3:
        return 0;
    }
    function equals($c2)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                return gmp_cmp($this->value, $c2->value) == 0;
            default:
                return $this->value === $c2->value && $this->is_negative == $c2->is_negative;
        }
        mE:
        F5:
    }
    function setPrecision($ST)
    {
        $this->precision = $ST;
        if (MathBigInteger_MODE != MathBigInteger_MODE_BCMATH) {
            goto Xc;
        }
        $this->bitmask = new MathBigInteger(bcpow("\x32", $ST, 0));
        goto ze;
        Xc:
        $this->bitmask = new MathBigInteger(chr((1 << ($ST & 0x7)) - 1) . str_repeat(chr(0xff), $ST >> 3), 256);
        ze:
        $DA = $this->_normalize($this);
        $this->value = $DA->value;
    }
    function bitwise_and($c2)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA = new MathBigInteger();
                $DA->value = gmp_and($this->value, $c2->value);
                return $this->_normalize($DA);
            case MathBigInteger_MODE_BCMATH:
                $ch = $this->toBytes();
                $ja = $c2->toBytes();
                $MI = max(strlen($ch), strlen($ja));
                $ch = str_pad($ch, $MI, chr(0), STR_PAD_LEFT);
                $ja = str_pad($ja, $MI, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new MathBigInteger($ch & $ja, 256));
        }
        Ff:
        yU:
        $ga = $this->copy();
        $MI = min(count($c2->value), count($this->value));
        $ga->value = array_slice($ga->value, 0, $MI);
        $vB = 0;
        Dz:
        if (!($vB < $MI)) {
            goto qd;
        }
        $ga->value[$vB] &= $c2->value[$vB];
        F7:
        ++$vB;
        goto Dz;
        qd:
        return $this->_normalize($ga);
    }
    function bitwise_or($c2)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA = new MathBigInteger();
                $DA->value = gmp_or($this->value, $c2->value);
                return $this->_normalize($DA);
            case MathBigInteger_MODE_BCMATH:
                $ch = $this->toBytes();
                $ja = $c2->toBytes();
                $MI = max(strlen($ch), strlen($ja));
                $ch = str_pad($ch, $MI, chr(0), STR_PAD_LEFT);
                $ja = str_pad($ja, $MI, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new MathBigInteger($ch | $ja, 256));
        }
        yV:
        tN:
        $MI = max(count($this->value), count($c2->value));
        $ga = $this->copy();
        $ga->value = array_pad($ga->value, $MI, 0);
        $c2->value = array_pad($c2->value, $MI, 0);
        $vB = 0;
        Za:
        if (!($vB < $MI)) {
            goto GD;
        }
        $ga->value[$vB] |= $c2->value[$vB];
        m2:
        ++$vB;
        goto Za;
        GD:
        return $this->_normalize($ga);
    }
    function bitwise_xor($c2)
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                $DA = new MathBigInteger();
                $DA->value = gmp_xor(gmp_abs($this->value), gmp_abs($c2->value));
                return $this->_normalize($DA);
            case MathBigInteger_MODE_BCMATH:
                $ch = $this->toBytes();
                $ja = $c2->toBytes();
                $MI = max(strlen($ch), strlen($ja));
                $ch = str_pad($ch, $MI, chr(0), STR_PAD_LEFT);
                $ja = str_pad($ja, $MI, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new MathBigInteger($ch ^ $ja, 256));
        }
        y2:
        fc:
        $MI = max(count($this->value), count($c2->value));
        $ga = $this->copy();
        $ga->is_negative = false;
        $ga->value = array_pad($ga->value, $MI, 0);
        $c2->value = array_pad($c2->value, $MI, 0);
        $vB = 0;
        m7:
        if (!($vB < $MI)) {
            goto Ct;
        }
        $ga->value[$vB] ^= $c2->value[$vB];
        Hd:
        ++$vB;
        goto m7;
        Ct:
        return $this->_normalize($ga);
    }
    function bitwise_not()
    {
        $DA = $this->toBytes();
        if (!($DA == '')) {
            goto bx;
        }
        return $this->_normalize(new MathBigInteger());
        bx:
        $la = decbin(ord($DA[0]));
        $DA = ~$DA;
        $m0 = decbin(ord($DA[0]));
        if (!(strlen($m0) == 8)) {
            goto Xi;
        }
        $m0 = substr($m0, strpos($m0, "\60"));
        Xi:
        $DA[0] = chr(bindec($m0));
        $I4 = strlen($la) + 8 * strlen($DA) - 8;
        $rr = $this->precision - $I4;
        if (!($rr <= 0)) {
            goto fZ;
        }
        return $this->_normalize(new MathBigInteger($DA, 256));
        fZ:
        $hv = chr((1 << ($rr & 0x7)) - 1) . str_repeat(chr(0xff), $rr >> 3);
        $this->_base256_lshift($hv, $I4);
        $DA = str_pad($DA, strlen($hv), chr(0), STR_PAD_LEFT);
        return $this->_normalize(new MathBigInteger($hv | $DA, 256));
    }
    function bitwise_rightShift($hn)
    {
        $DA = new MathBigInteger();
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                static $Q1;
                if (isset($Q1)) {
                    goto Te;
                }
                $Q1 = gmp_init("\x32");
                Te:
                $DA->value = gmp_div_q($this->value, gmp_pow($Q1, $hn));
                goto va;
            case MathBigInteger_MODE_BCMATH:
                $DA->value = bcdiv($this->value, bcpow("\62", $hn, 0), 0);
                goto va;
            default:
                $DA->value = $this->value;
                $DA->_rshift($hn);
        }
        Hh:
        va:
        return $this->_normalize($DA);
    }
    function bitwise_leftShift($hn)
    {
        $DA = new MathBigInteger();
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                static $Q1;
                if (isset($Q1)) {
                    goto Ln;
                }
                $Q1 = gmp_init("\62");
                Ln:
                $DA->value = gmp_mul($this->value, gmp_pow($Q1, $hn));
                goto uR;
            case MathBigInteger_MODE_BCMATH:
                $DA->value = bcmul($this->value, bcpow("\62", $hn, 0), 0);
                goto uR;
            default:
                $DA->value = $this->value;
                $DA->_lshift($hn);
        }
        PC:
        uR:
        return $this->_normalize($DA);
    }
    function bitwise_leftRotate($hn)
    {
        $ST = $this->toBytes();
        if ($this->precision > 0) {
            goto ND;
        }
        $DA = ord($ST[0]);
        $vB = 0;
        Ni:
        if (!($DA >> $vB)) {
            goto Fd;
        }
        ae:
        ++$vB;
        goto Ni;
        Fd:
        $s_ = 8 * strlen($ST) - 8 + $vB;
        $Fe = chr((1 << ($s_ & 0x7)) - 1) . str_repeat(chr(0xff), $s_ >> 3);
        goto xQ;
        ND:
        $s_ = $this->precision;
        if (MathBigInteger_MODE == MathBigInteger_MODE_BCMATH) {
            goto iv;
        }
        $Fe = $this->bitmask->toBytes();
        goto nl;
        iv:
        $Fe = $this->bitmask->subtract(new MathBigInteger(1));
        $Fe = $Fe->toBytes();
        nl:
        xQ:
        if (!($hn < 0)) {
            goto UO;
        }
        $hn += $s_;
        UO:
        $hn %= $s_;
        if ($hn) {
            goto SC;
        }
        return $this->copy();
        SC:
        $ch = $this->bitwise_leftShift($hn);
        $ch = $ch->bitwise_and(new MathBigInteger($Fe, 256));
        $ja = $this->bitwise_rightShift($s_ - $hn);
        $ga = MathBigInteger_MODE != MathBigInteger_MODE_BCMATH ? $ch->bitwise_or($ja) : $ch->add($ja);
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
        if (function_exists("\x63\162\171\x70\x74\137\x72\141\x6e\144\157\x6d\x5f\163\x74\x72\x69\x6e\147")) {
            goto DX;
        }
        $bK = '';
        if (!($dO & 1)) {
            goto HI;
        }
        $bK .= chr(random_int(0, 255));
        HI:
        $PK = $dO >> 1;
        $vB = 0;
        Sx:
        if (!($vB < $PK)) {
            goto rL;
        }
        $bK .= pack("\x6e", random_int(0, 0xffff));
        IB:
        ++$vB;
        goto Sx;
        rL:
        goto w6;
        DX:
        $bK = crypt_random_string($dO);
        w6:
        return new MathBigInteger($bK, 256);
    }
    function random($nk, $yL = false)
    {
        if (!($nk === false)) {
            goto XG;
        }
        return false;
        XG:
        if ($yL === false) {
            goto hQ;
        }
        $lC = $nk;
        $fu = $yL;
        goto KM;
        hQ:
        $fu = $nk;
        $lC = $this;
        KM:
        $RV = $fu->compare($lC);
        if (!$RV) {
            goto Ah;
        }
        if ($RV < 0) {
            goto t9;
        }
        goto A7;
        Ah:
        return $this->_normalize($lC);
        goto A7;
        t9:
        $DA = $fu;
        $fu = $lC;
        $lC = $DA;
        A7:
        static $sO;
        if (isset($sO)) {
            goto zk;
        }
        $sO = new MathBigInteger(1);
        zk:
        $fu = $fu->subtract($lC->subtract($sO));
        $dO = strlen(ltrim($fu->toBytes(), chr(0)));
        $hu = new MathBigInteger(chr(1) . str_repeat("\0", $dO), 256);
        $bK = $this->_random_number_helper($dO);
        list($AO) = $hu->divide($fu);
        $AO = $AO->multiply($fu);
        XJ:
        if (!($bK->compare($AO) >= 0)) {
            goto X9;
        }
        $bK = $bK->subtract($AO);
        $hu = $hu->subtract($AO);
        $bK = $bK->bitwise_leftShift(8);
        $bK = $bK->add($this->_random_number_helper(1));
        $hu = $hu->bitwise_leftShift(8);
        list($AO) = $hu->divide($fu);
        $AO = $AO->multiply($fu);
        goto XJ;
        X9:
        list(, $bK) = $bK->divide($fu);
        return $this->_normalize($bK->add($lC));
    }
    function randomPrime($nk, $yL = false, $Jy = false)
    {
        if (!($nk === false)) {
            goto l3;
        }
        return false;
        l3:
        if ($yL === false) {
            goto PS;
        }
        $lC = $nk;
        $fu = $yL;
        goto sA;
        PS:
        $fu = $nk;
        $lC = $this;
        sA:
        $RV = $fu->compare($lC);
        if (!$RV) {
            goto O2;
        }
        if ($RV < 0) {
            goto d1;
        }
        goto k4;
        O2:
        return $lC->isPrime() ? $lC : false;
        goto k4;
        d1:
        $DA = $fu;
        $fu = $lC;
        $lC = $DA;
        k4:
        static $sO, $Q1;
        if (isset($sO)) {
            goto a3;
        }
        $sO = new MathBigInteger(1);
        $Q1 = new MathBigInteger(2);
        a3:
        $kb = time();
        $c2 = $this->random($lC, $fu);
        if (!(MathBigInteger_MODE == MathBigInteger_MODE_GMP && extension_loaded("\147\155\160") && version_compare(PHP_VERSION, "\x35\x2e\62\56\60", "\76\x3d"))) {
            goto ka;
        }
        $lc = new MathBigInteger();
        $lc->value = gmp_nextprime($c2->value);
        if (!($lc->compare($fu) <= 0)) {
            goto RK;
        }
        return $lc;
        RK:
        if ($lC->equals($c2)) {
            goto Bs;
        }
        $c2 = $c2->subtract($sO);
        Bs:
        return $c2->randomPrime($lC, $c2);
        ka:
        if (!$c2->equals($Q1)) {
            goto xg;
        }
        return $c2;
        xg:
        $c2->_make_odd();
        if (!($c2->compare($fu) > 0)) {
            goto Ms;
        }
        if (!$lC->equals($fu)) {
            goto M6;
        }
        return false;
        M6:
        $c2 = $lC->copy();
        $c2->_make_odd();
        Ms:
        $iD = $c2->copy();
        N1:
        if (!true) {
            goto F1;
        }
        if (!($Jy !== false && time() - $kb > $Jy)) {
            goto h1;
        }
        return false;
        h1:
        if (!$c2->isPrime()) {
            goto cI;
        }
        return $c2;
        cI:
        $c2 = $c2->add($Q1);
        if (!($c2->compare($fu) > 0)) {
            goto Di;
        }
        $c2 = $lC->copy();
        if (!$c2->equals($Q1)) {
            goto gi;
        }
        return $c2;
        gi:
        $c2->_make_odd();
        Di:
        if (!$c2->equals($iD)) {
            goto z8;
        }
        return false;
        z8:
        goto N1;
        F1:
    }
    function _make_odd()
    {
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                gmp_setbit($this->value, 0);
                goto lj;
            case MathBigInteger_MODE_BCMATH:
                if (!($this->value[strlen($this->value) - 1] % 2 == 0)) {
                    goto GR;
                }
                $this->value = bcadd($this->value, "\x31");
                GR:
                goto lj;
            default:
                $this->value[0] |= 1;
        }
        JO:
        lj:
    }
    function isPrime($HO = false)
    {
        $MI = strlen($this->toBytes());
        if ($HO) {
            goto Lj;
        }
        if ($MI >= 163) {
            goto rz;
        }
        if ($MI >= 106) {
            goto sN;
        }
        if ($MI >= 81) {
            goto Tn;
        }
        if ($MI >= 68) {
            goto Uk;
        }
        if ($MI >= 56) {
            goto nS;
        }
        if ($MI >= 50) {
            goto Z7;
        }
        if ($MI >= 43) {
            goto LV;
        }
        if ($MI >= 37) {
            goto tP;
        }
        if ($MI >= 31) {
            goto vi;
        }
        if ($MI >= 25) {
            goto vO;
        }
        if ($MI >= 18) {
            goto v8;
        }
        $HO = 27;
        goto Wc;
        v8:
        $HO = 18;
        Wc:
        goto fx;
        vO:
        $HO = 15;
        fx:
        goto H9;
        vi:
        $HO = 12;
        H9:
        goto JZ;
        tP:
        $HO = 9;
        JZ:
        goto zh;
        LV:
        $HO = 8;
        zh:
        goto D5;
        Z7:
        $HO = 7;
        D5:
        goto NY;
        nS:
        $HO = 6;
        NY:
        goto o5;
        Uk:
        $HO = 5;
        o5:
        goto wO;
        Tn:
        $HO = 4;
        wO:
        goto y4;
        sN:
        $HO = 3;
        y4:
        goto WL;
        rz:
        $HO = 2;
        WL:
        Lj:
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                return gmp_prob_prime($this->value, $HO) != 0;
            case MathBigInteger_MODE_BCMATH:
                if (!($this->value === "\x32")) {
                    goto SM;
                }
                return true;
                SM:
                if (!($this->value[strlen($this->value) - 1] % 2 == 0)) {
                    goto Ns;
                }
                return false;
                Ns:
                goto XV;
            default:
                if (!($this->value == [2])) {
                    goto OC;
                }
                return true;
                OC:
                if (!(~$this->value[0] & 1)) {
                    goto VG;
                }
                return false;
                VG:
        }
        bM:
        XV:
        static $VT, $C7, $sO, $Q1;
        if (isset($VT)) {
            goto gV;
        }
        $VT = [3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499, 503, 509, 521, 523, 541, 547, 557, 563, 569, 571, 577, 587, 593, 599, 601, 607, 613, 617, 619, 631, 641, 643, 647, 653, 659, 661, 673, 677, 683, 691, 701, 709, 719, 727, 733, 739, 743, 751, 757, 761, 769, 773, 787, 797, 809, 811, 821, 823, 827, 829, 839, 853, 857, 859, 863, 877, 881, 883, 887, 907, 911, 919, 929, 937, 941, 947, 953, 967, 971, 977, 983, 991, 997];
        if (!(MathBigInteger_MODE != MathBigInteger_MODE_INTERNAL)) {
            goto wN;
        }
        $vB = 0;
        oh:
        if (!($vB < count($VT))) {
            goto Uh;
        }
        $VT[$vB] = new MathBigInteger($VT[$vB]);
        y7:
        ++$vB;
        goto oh;
        Uh:
        wN:
        $C7 = new MathBigInteger();
        $sO = new MathBigInteger(1);
        $Q1 = new MathBigInteger(2);
        gV:
        if (!$this->equals($sO)) {
            goto yq;
        }
        return false;
        yq:
        if (MathBigInteger_MODE != MathBigInteger_MODE_INTERNAL) {
            goto aB;
        }
        $Vw = $this->value;
        foreach ($VT as $aH) {
            list(, $mv) = $this->_divide_digit($Vw, $aH);
            if ($mv) {
                goto Ng;
            }
            return count($Vw) == 1 && $Vw[0] == $aH;
            Ng:
            Bz:
        }
        PN:
        goto ZB;
        aB:
        foreach ($VT as $aH) {
            list(, $mv) = $this->divide($aH);
            if (!$mv->equals($C7)) {
                goto Q4;
            }
            return $this->equals($aH);
            Q4:
            vz:
        }
        uE:
        ZB:
        $Td = $this->copy();
        $wN = $Td->subtract($sO);
        $Qv = $Td->subtract($Q1);
        $mv = $wN->copy();
        $Nx = $mv->value;
        if (MathBigInteger_MODE == MathBigInteger_MODE_BCMATH) {
            goto NQ;
        }
        $vB = 0;
        $Ow = count($Nx);
        kp:
        if (!($vB < $Ow)) {
            goto MQ;
        }
        $DA = ~$Nx[$vB] & 0xffffff;
        $aj = 1;
        uF:
        if (!($DA >> $aj & 1)) {
            goto rR;
        }
        Rl:
        ++$aj;
        goto uF;
        rR:
        if (!($aj != 25)) {
            goto XY;
        }
        goto MQ;
        XY:
        Js:
        ++$vB;
        goto kp;
        MQ:
        $pq = 26 * $vB + $aj;
        $mv->_rshift($pq);
        goto PE;
        NQ:
        $pq = 0;
        Uu:
        if (!($mv->value[strlen($mv->value) - 1] % 2 == 0)) {
            goto HG;
        }
        $mv->value = bcdiv($mv->value, "\x32", 0);
        ++$pq;
        goto Uu;
        HG:
        PE:
        $vB = 0;
        R2:
        if (!($vB < $HO)) {
            goto Qz;
        }
        $PQ = $this->random($Q1, $Qv);
        $zE = $PQ->modPow($mv, $Td);
        if (!(!$zE->equals($sO) && !$zE->equals($wN))) {
            goto BM;
        }
        $aj = 1;
        v1:
        if (!($aj < $pq && !$zE->equals($wN))) {
            goto Z1;
        }
        $zE = $zE->modPow($Q1, $Td);
        if (!$zE->equals($sO)) {
            goto CH;
        }
        return false;
        CH:
        aV:
        ++$aj;
        goto v1;
        Z1:
        if ($zE->equals($wN)) {
            goto yf;
        }
        return false;
        yf:
        BM:
        Ot:
        ++$vB;
        goto R2;
        Qz:
        return true;
    }
    function _lshift($hn)
    {
        if (!($hn == 0)) {
            goto jL;
        }
        return;
        jL:
        $Wy = (int) ($hn / MathBigInteger_BASE);
        $hn %= MathBigInteger_BASE;
        $hn = 1 << $hn;
        $Xf = 0;
        $vB = 0;
        A1:
        if (!($vB < count($this->value))) {
            goto GU;
        }
        $DA = $this->value[$vB] * $hn + $Xf;
        $Xf = MathBigInteger_BASE === 26 ? intval($DA / 0x4000000) : $DA >> 31;
        $this->value[$vB] = (int) ($DA - $Xf * MathBigInteger_BASE_FULL);
        JK:
        ++$vB;
        goto A1;
        GU:
        if (!$Xf) {
            goto ai;
        }
        $this->value[count($this->value)] = $Xf;
        ai:
        Vz:
        if (!$Wy--) {
            goto Rk;
        }
        array_unshift($this->value, 0);
        goto Vz;
        Rk:
    }
    function _rshift($hn)
    {
        if (!($hn == 0)) {
            goto uk;
        }
        return;
        uk:
        $Wy = (int) ($hn / MathBigInteger_BASE);
        $hn %= MathBigInteger_BASE;
        $Rd = MathBigInteger_BASE - $hn;
        $Le = (1 << $hn) - 1;
        if (!$Wy) {
            goto CX;
        }
        $this->value = array_slice($this->value, $Wy);
        CX:
        $Xf = 0;
        $vB = count($this->value) - 1;
        iB:
        if (!($vB >= 0)) {
            goto lO;
        }
        $DA = $this->value[$vB] >> $hn | $Xf;
        $Xf = ($this->value[$vB] & $Le) << $Rd;
        $this->value[$vB] = $DA;
        cr:
        --$vB;
        goto iB;
        lO:
        $this->value = $this->_trim($this->value);
    }
    function _normalize($ga)
    {
        $ga->precision = $this->precision;
        $ga->bitmask = $this->bitmask;
        switch (MathBigInteger_MODE) {
            case MathBigInteger_MODE_GMP:
                if (!($this->bitmask !== false)) {
                    goto hv;
                }
                $ga->value = gmp_and($ga->value, $ga->bitmask->value);
                hv:
                return $ga;
            case MathBigInteger_MODE_BCMATH:
                if (empty($ga->bitmask->value)) {
                    goto G0;
                }
                $ga->value = bcmod($ga->value, $ga->bitmask->value);
                G0:
                return $ga;
        }
        dN:
        au:
        $Vw =& $ga->value;
        if (count($Vw)) {
            goto Im;
        }
        return $ga;
        Im:
        $Vw = $this->_trim($Vw);
        if (empty($ga->bitmask->value)) {
            goto s8;
        }
        $MI = min(count($Vw), count($this->bitmask->value));
        $Vw = array_slice($Vw, 0, $MI);
        $vB = 0;
        bf:
        if (!($vB < $MI)) {
            goto Yl;
        }
        $Vw[$vB] = $Vw[$vB] & $this->bitmask->value[$vB];
        iD:
        ++$vB;
        goto bf;
        Yl:
        s8:
        return $ga;
    }
    function _trim($Vw)
    {
        $vB = count($Vw) - 1;
        N3:
        if (!($vB >= 0)) {
            goto jT;
        }
        if (!$Vw[$vB]) {
            goto NL;
        }
        goto jT;
        NL:
        unset($Vw[$vB]);
        v6:
        --$vB;
        goto N3;
        jT:
        return $Vw;
    }
    function _array_repeat($e9, $wi)
    {
        return $wi ? array_fill(0, $wi, $e9) : [];
    }
    function _base256_lshift(&$c2, $hn)
    {
        if (!($hn == 0)) {
            goto px;
        }
        return;
        px:
        $pY = $hn >> 3;
        $hn &= 7;
        $Xf = 0;
        $vB = strlen($c2) - 1;
        Bn:
        if (!($vB >= 0)) {
            goto b6;
        }
        $DA = ord($c2[$vB]) << $hn | $Xf;
        $c2[$vB] = chr($DA);
        $Xf = $DA >> 8;
        k0:
        --$vB;
        goto Bn;
        b6:
        $Xf = $Xf != 0 ? chr($Xf) : '';
        $c2 = $Xf . $c2 . str_repeat(chr(0), $pY);
    }
    function _base256_rshift(&$c2, $hn)
    {
        if (!($hn == 0)) {
            goto CG;
        }
        $c2 = ltrim($c2, chr(0));
        return '';
        CG:
        $pY = $hn >> 3;
        $hn &= 7;
        $Ki = '';
        if (!$pY) {
            goto a9;
        }
        $kb = $pY > strlen($c2) ? -strlen($c2) : -$pY;
        $Ki = substr($c2, $kb);
        $c2 = substr($c2, 0, -$pY);
        a9:
        $Xf = 0;
        $Rd = 8 - $hn;
        $vB = 0;
        CV:
        if (!($vB < strlen($c2))) {
            goto Pn;
        }
        $DA = ord($c2[$vB]) >> $hn | $Xf;
        $Xf = ord($c2[$vB]) << $Rd & 0xff;
        $c2[$vB] = chr($DA);
        iC:
        ++$vB;
        goto CV;
        Pn:
        $c2 = ltrim($c2, chr(0));
        $Ki = chr($Xf >> $Rd) . $Ki;
        return ltrim($Ki, chr(0));
    }
    function _int2bytes($c2)
    {
        return ltrim(pack("\x4e", $c2), chr(0));
    }
    function _bytes2int($c2)
    {
        $DA = unpack("\x4e\x69\x6e\164", str_pad($c2, 4, chr(0), STR_PAD_LEFT));
        return $DA["\151\x6e\164"];
    }
    function _encodeASN1Length($MI)
    {
        if (!($MI <= 0x7f)) {
            goto ec;
        }
        return chr($MI);
        ec:
        $DA = ltrim(pack("\x4e", $MI), chr(0));
        return pack("\x43\141\x2a", 0x80 | strlen($DA), $DA);
    }
    function _safe_divide($c2, $zE)
    {
        if (!(MathBigInteger_BASE === 26)) {
            goto BC;
        }
        return (int) ($c2 / $zE);
        BC:
        return ($c2 - $c2 % $zE) / $zE;
    }
}
