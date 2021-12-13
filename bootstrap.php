<?php
namespace ocunit;

/**
 * Show all error reporting.
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

$configurations = parse_ini_file("config.ini", true, INI_SCANNER_NORMAL);

define("__OCUNIT_ROOT__", dirname(__FILE__, 1)); // do not change it

/**
 * Should I run expensive database operations?
 */
define("__OCUNIT_EXECUTE_EXPENSIVE__", (bool)$configurations["ocunit"]["execute_expensive"]);
