<?php

/**
 * Modify config.ini first!
 */


/**
 * Show all error reporting.
 */
error_reporting(E_ALL|E_STRICT);

/**
 * Disable stack tracing with xDebug, if available.
 * But, chances are rare on modern xDebug.
 */
$xdebug_disable = "xdebug_disable";
if(function_exists($xdebug_disable))
{
    $xdebug_disable();
}

global $configurations;
$configurations = parse_ini_file("config.ini", true, INI_SCANNER_NORMAL);

/**
 * Admin config file
 *
 * The constants defined in admin will definitely collide with that in frontend.
 */
global $opencart_admin_folder;
$opencart_admin_folder = realpath($configurations["opencart"]["admin"]);
if($opencart_admin_folder!="" && is_dir($opencart_admin_folder) && is_file("{$opencart_admin_folder}/config.php"))
{
    /**
     * OpenCart Frontend configuration file
     */
    require_once "{$opencart_admin_folder}/config.php";
}
else
{
    die("Cannot continue - Store admin not loaded.");
}

global $opencart_upload_folder;
$opencart_upload_folder = realpath($configurations["opencart"]["store"]);
if($opencart_upload_folder!="" && is_dir($opencart_upload_folder) && is_file("{$opencart_upload_folder}/config.php"))
{
    /**
     * OpenCart Frontend configuration file
     */
    require_once "{$opencart_upload_folder}/config.php";
}
else
{
    die("Cannot continue - Store front not loaded.");
}

define("__OCUNIT_ROOT__", dirname(__FILE__, 1)); // do not change it

/**
 * Should I run expensive database operations?
 */
define("__OCUNIT_EXECUTE_EXPENSIVE__", (bool)$configurations["ocunit"]["execute_expensive"]);

// Helper
require_once DIR_SYSTEM . "helper/general.php";
require_once DIR_SYSTEM . "helper/utf8.php";
require_once DIR_STORAGE . "vendor/autoload.php";
require_once DIR_SYSTEM . "engine/autoloader.php";
require_once DIR_SYSTEM . "engine/config.php";

require_once("vendor/autoload.php");

require_once("library/class.fql.inc.php");
require_once("library/class.MySQLPDO.inc.php");
require_once("library/class.DatabaseExecutor.inc.php");
require_once("library/class.api.inc.php");
require_once("library/class.catalog.inc.php");
require_once("library/class.admin.inc.php");
require_once("library/class.credentials.inc.php");

/**
 * Basic headers to browse OpenCart pages
 */
if(!isset($_SERVER["REMOTE_ADDR"])) { $_SERVER["REMOTE_ADDR"] = "0.0.0.0"; }

use \Opencart\System\Engine\Autoloader;
global $autoloader;
$autoloader = new Autoloader();
$autoloader->register("Opencart\\" . APPLICATION, DIR_APPLICATION);
$autoloader->register("Opencart\Extension", DIR_EXTENSION);
$autoloader->register("Opencart\System", DIR_SYSTEM);

