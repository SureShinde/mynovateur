<?php


namespace MiniOrange\OAuth\Helper\OAuth\lib;

class AESEncryption
{
    public static function encrypt_data($jA, $TE)
    {
        $ga = '';
        $vB = 0;
        fu:
        if (!($vB < strlen($jA))) {
            goto GS;
        }
        $RW = substr($jA, $vB, 1);
        if (!(strlen($TE) > 1)) {
            goto UK;
        }
        $tc = substr($TE, $vB % strlen($TE) - 1, 1);
        $RW = chr(ord($RW) + ord($tc));
        $ga .= $RW;
        UK:
        a6:
        $vB++;
        goto fu;
        GS:
        return base64_encode($ga);
    }
    public static function decrypt_data($jA, $TE)
    {
        $ga = '';
        $jA = base64_decode($jA);
        $vB = 0;
        ax:
        if (!($vB < strlen($jA))) {
            goto yJ;
        }
        $RW = substr($jA, $vB, 1);
        if (!(strlen($TE) > 1)) {
            goto Bb;
        }
        $tc = substr($TE, $vB % strlen($TE) - 1, 1);
        $RW = chr(ord($RW) - ord($tc));
        $ga .= $RW;
        Bb:
        d_:
        $vB++;
        goto ax;
        yJ:
        return $ga;
    }
}
