<?php

namespace ocunit;

use ocunit\library\oc as oc;

$configurations = [];
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

/**
 * @param $ini_file
 * @return array|false
 */
function _env($ini_file)
{
    $ini = parse_ini_file(__OCUNIT_ROOT__."/{$ini_file}", true, INI_SCANNER_NORMAL);
    return $ini;
}

function dt(): string
{
    return date("Y-m-d H:i:s");
}

$configurations = _env("config.ini");

/**
 * Should I run expensive database operations?
 * Boolean true/false value
 */
define("__OCUNIT_EXECUTE_EXPENSIVE__", $configurations["ocunit"]["execute_expensive"] == "true");

require_once(__OCUNIT_ROOT__ . "/library/DatabaseExecutor.php");
require_once(__OCUNIT_ROOT__ . "/library/FQL.php");
require_once(__OCUNIT_ROOT__ . "/library/FileToucher.php");
require_once(__OCUNIT_ROOT__ . "/library/MySQLPDO.php");
require_once(__OCUNIT_ROOT__ . "/library/Order.php");
require_once(__OCUNIT_ROOT__ . "/library/Slug.php");
require_once(__OCUNIT_ROOT__ . "/library/api.php");
require_once(__OCUNIT_ROOT__ . "/library/catalog.php");
require_once(__OCUNIT_ROOT__ . "/library/CredentialsDTO.php");
require_once(__OCUNIT_ROOT__ . "/library/oc.php");
require_once(__OCUNIT_ROOT__ . "/library/Admin.php");
require_once(__OCUNIT_ROOT__ . "/library/Customer.php");
require_once(__OCUNIT_ROOT__ . "/library/Store.php");
require_once(__OCUNIT_ROOT__ . "/library/Session.php");
require_once(__OCUNIT_ROOT__ . "/library/Logo.php");

require_once(__OCUNIT_ROOT__ . "/vendor/autoload.php");

$oc = new oc();

$oc->must_require(realpath($configurations["opencart"]["admin"]), "config.php");
$oc->must_define("DIR_SYSTEM");
$oc->must_define("DIR_STORAGE");

$oc->must_require(realpath($configurations["opencart"]["store"]), "config.php");
$oc->must_define("HTTP_CATALOG");

/**
 * Basic headers to browse the OpenCart pages
 */
if (empty($_SERVER["REMOTE_ADDR"])) $_SERVER["REMOTE_ADDR"] = "0.0.0.0";
if (empty($_SERVER["HTTP_USER_AGENT"])) $_SERVER["HTTP_USER_AGENT"] = "ocunit";
if (empty($_SERVER["HTTP_REFERER"])) $_SERVER["HTTP_REFERER"] = "http://localhost/oc/opencart/";

// IDE Silencer: Do nothing as already defined in config.php file(s).
if (!defined("DIR_SYSTEM")) die("DIR_SYSTEM not defined.");
if (!defined("DIR_STORAGE")) die("DIR_STORAGE not defined.");

// Helper
$system = realpath(DIR_SYSTEM);
require_once $system . "/helper/general.php";
require_once $system . "/helper/utf8.php";
require_once DIR_STORAGE . "/vendor/autoload.php";
require_once $system . "/engine/autoloader.php";
require_once $system . "/engine/config.php";

// Mount opencart
use Opencart\System\Engine\Autoloader as Autoloader;
$autoloader = new Autoloader();
$autoloader->register("Opencart\\Admin", DIR_APPLICATION);
$autoloader->register("Opencart\\Catalog", DIR_OPENCART . "/catalog");
$autoloader->register("Opencart\\Extension", DIR_EXTENSION);
$autoloader->register("Opencart\\System", DIR_SYSTEM);
