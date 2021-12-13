<?php
namespace ocunit;

// IDE Silencer: Do nothing as already defined in config.php files.
if(!defined("DIR_SYSTEM")) define("DIR_SYSTEM", "../store/upload/system");
if(!defined("DIR_STORAGE")) define("DIR_STORAGE", "../store/upload/system/storage");

// Helper
require_once DIR_SYSTEM . "helper/general.php";
require_once DIR_SYSTEM . "helper/utf8.php";
require_once DIR_STORAGE . "vendor/autoload.php";
require_once DIR_SYSTEM . "engine/autoloader.php";
require_once DIR_SYSTEM . "engine/config.php";

require_once("vendor/autoload.php");

require_once(__OCUNIT_ROOT__."/library/class.fql.inc.php");
require_once(__OCUNIT_ROOT__."/library/class.MySQLPDO.inc.php");
require_once(__OCUNIT_ROOT__."/library/class.DatabaseExecutor.inc.php");
require_once(__OCUNIT_ROOT__."/library/class.api.inc.php");
require_once(__OCUNIT_ROOT__."/library/class.catalog.inc.php");
require_once(__OCUNIT_ROOT__."/library/class.admin.inc.php");
require_once(__OCUNIT_ROOT__."/library/class.credentials.inc.php");

/**
 * Basic headers to browse OpenCart pages
 */
if (empty($_SERVER["REMOTE_ADDR"])) {
    $_SERVER["REMOTE_ADDR"] = "0.0.0.0";
}

#global $autoloader;
$autoloader = new \Opencart\System\Engine\Autoloader();
$autoloader->register("Opencart\\" . APPLICATION, DIR_APPLICATION);
$autoloader->register("Opencart\Extension", DIR_EXTENSION);
$autoloader->register("Opencart\System", DIR_SYSTEM);
