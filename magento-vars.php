<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Enable, adjust and copy this code for each store you run
 *
 * Store #0, default one
 *
 * if (isHttpHost("example.com")) {
 *    $_SERVER["MAGE_RUN_CODE"] = "default";
 *    $_SERVER["MAGE_RUN_TYPE"] = "store";
 * }
 *
 * @param string $host
 * @return bool
 */
function isHttpHost($host)
{
    if (!isset($_SERVER['HTTP_HOST'])) {
        return false;
    }
    return strpos(str_replace('---', '.', $_SERVER['HTTP_HOST']), $host) === 0;
}
if (isHttpHost("mcstaging.numericups.com")) {
    $_SERVER["MAGE_RUN_CODE"] = "default";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}
if (isHttpHost("mcstaging.legrand.co.in")) {
    $_SERVER["MAGE_RUN_CODE"] = "legrand";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}
if (isHttpHost("mcprod.numericups.com")) {
    $_SERVER["MAGE_RUN_CODE"] = "default";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}
if (isHttpHost("mcprod.legrand.co.in")) {
    $_SERVER["MAGE_RUN_CODE"] = "legrand";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}
if (isHttpHost("www.numericups.com")) {
    $_SERVER["MAGE_RUN_CODE"] = "default";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}
if (isHttpHost("numericups.com")) {
    $_SERVER["MAGE_RUN_CODE"] = "default";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}
if (isHttpHost("www.legrand.co.in")) {
    $_SERVER["MAGE_RUN_CODE"] = "legrand";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}
if (isHttpHost("legrand.co.in")) {
    $_SERVER["MAGE_RUN_CODE"] = "legrand";
    $_SERVER["MAGE_RUN_TYPE"] = "store";
}