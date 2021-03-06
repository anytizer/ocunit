<?php

namespace ocunit;

use Exception;
use ocunit\library\oc as oc;
use Opencart\System\Engine\Autoloader;

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
 * If you want to relocate to your own ini folder; change the line below: `$file = ...`
 *
 * @param string $ini_file
 * @return array
 */
function _env(string $ini_file = "something.ini"): array
{
    $file = __OCUNIT_ROOT__ . "/ini/{$ini_file}";

    $ini = [];
    if (is_file($file)) {
        $ini = parse_ini_file($file, true, INI_SCANNER_NORMAL);
    }

    return $ini;
}

/**
 * Synchronized date time
 * @return string
 */
function dt(): string
{
    return date("Y-m-d H:i:s");
}

$configurations = _env("config.ini");

/**
 * Should I run expensive database operations?
 */
define("__OCUNIT_EXECUTE_EXPENSIVE__", strtolower($configurations["ocunit"]["execute_expensive"]) == "true");

require_once __OCUNIT_ROOT__ . "/library/oc.php"; // @todo fix order of require.

require_once __OCUNIT_ROOT__ . "/library/DatabaseExecutor.php";
require_once __OCUNIT_ROOT__ . "/library/FQL.php";
require_once __OCUNIT_ROOT__ . "/library/FileToucher.php";
require_once __OCUNIT_ROOT__ . "/library/MySQLPDO.php";
require_once __OCUNIT_ROOT__ . "/library/Order.php";
require_once __OCUNIT_ROOT__ . "/library/Slug.php";
require_once __OCUNIT_ROOT__ . "/library/api.php";
require_once __OCUNIT_ROOT__ . "/library/catalog.php";
require_once __OCUNIT_ROOT__ . "/library/CredentialsDTO.php";
require_once __OCUNIT_ROOT__ . "/library/Admin.php";
require_once __OCUNIT_ROOT__ . "/library/Customer.php";
require_once __OCUNIT_ROOT__ . "/library/Store.php";
require_once __OCUNIT_ROOT__ . "/library/Session.php";
require_once __OCUNIT_ROOT__ . "/library/Logo.php";
require_once __OCUNIT_ROOT__ . "/library/Information.php";
require_once __OCUNIT_ROOT__ . "/library/Banner.php";
require_once __OCUNIT_ROOT__ . "/library/Image.php";
require_once __OCUNIT_ROOT__ . "/library/Category.php";
require_once __OCUNIT_ROOT__ . "/library/Product.php";
require_once __OCUNIT_ROOT__ . "/library/Manufacturer.php";

require_once __OCUNIT_ROOT__ . "/vendor/autoload.php";

/**
 * Basic headers to browse the OpenCart pages
 */
if (empty($_SERVER["REMOTE_ADDR"])) $_SERVER["REMOTE_ADDR"] = "0.0.0.0";
if (empty($_SERVER["HTTP_X_FORWARDED_FOR"])) $_SERVER["HTTP_X_FORWARDED_FOR"] = "0.0.0.0";
if (empty($_SERVER["HTTP_CLIENT_IP"])) $_SERVER["HTTP_CLIENT_IP"] = "0.0.0.0";
if (empty($_SERVER["HTTP_USER_AGENT"])) $_SERVER["HTTP_USER_AGENT"] = "ocunit";
if (empty($_SERVER["HTTP_REFERER"])) $_SERVER["HTTP_REFERER"] = "http://localhost/oc/opencart/";

try
{
    $oc = new oc();

    $oc->must_require(realpath($configurations["opencart"]["admin"]), "config.php");
    $oc->must_define("DIR_SYSTEM");
    $oc->must_define("DIR_STORAGE");

    $oc->must_require(realpath($configurations["opencart"]["store"]), "config.php");
    $oc->must_define("HTTP_CATALOG");
}
catch(Exception $exception)
{
    die("Failed loading OpenCart configurations.");
}

// Helper
$system = realpath(DIR_SYSTEM); // to remove /
require_once $system . "/helper/general.php";
require_once $system . "/helper/utf8.php";
require_once $system . "/engine/autoloader.php";
require_once $system . "/engine/config.php";
require_once DIR_STORAGE . "/vendor/autoload.php";

// Mount opencart

$autoloader = new Autoloader();
$autoloader->register("Opencart\\Admin", DIR_APPLICATION);
$autoloader->register("Opencart\\Catalog", DIR_OPENCART . "/catalog");
$autoloader->register("Opencart\\Extension", DIR_EXTENSION);
$autoloader->register("Opencart\\System", DIR_SYSTEM);

