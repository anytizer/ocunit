<?php

/**
 * Show all errors.
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Disable stack tracing with xDebug, if available.
 * But, chances are rare on modern xDebug.
 */
$xdebug_disable = "xdebug_disable";
if (function_exists($xdebug_disable)) {
    $xdebug_disable();
}

define("__OCUNIT_ROOT__", realpath(dirname(__FILE__, 1))); // do not change it

function _env($section="")
{
    $configurations = parse_ini_file(__OCUNIT_ROOT__."/config.ini", true, INI_SCANNER_NORMAL);
    if($section and array_key_exists($section, $configurations))
        $configurations = $configurations[$section];

    return $configurations;
}

$configurations = _env("");


/**
 * Should I run expensive database operations?
 * Boolean true/false value
 */
define("__OCUNIT_EXECUTE_EXPENSIVE__", $configurations["ocunit"]["execute_expensive"] == "true");

require_once(__OCUNIT_ROOT__ . "/library/oc.php");
require_once(__OCUNIT_ROOT__ . "/library/FileToucher.php");
require_once(__OCUNIT_ROOT__ . "/library/Slug.php");