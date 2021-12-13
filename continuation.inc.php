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

require_once(__OCUNIT_ROOT__."/vendor/autoload.php");

require_once(__OCUNIT_ROOT__."/library/FQL.php");
require_once(__OCUNIT_ROOT__."/library/MySQLPDO.php");
require_once(__OCUNIT_ROOT__."/library/DatabaseExecutor.php");
require_once(__OCUNIT_ROOT__."/library/api.php");
require_once(__OCUNIT_ROOT__."/library/catalog.php");
require_once(__OCUNIT_ROOT__."/library/admin.php");
require_once(__OCUNIT_ROOT__."/library/credentials.php");
require_once(__OCUNIT_ROOT__."/library/Order.php");

/**
 * Basic headers to browse OpenCart pages
 */
if (empty($_SERVER["REMOTE_ADDR"])) {
    $_SERVER["REMOTE_ADDR"] = "0.0.0.0";
}

use \Opencart\System\Engine\Autoloader as Autoloader;
$autoloader = new Autoloader();
$autoloader->register("Opencart\\Admin", DIR_APPLICATION);
$autoloader->register("Opencart\\Catalog", DIR_OPENCART."/catalog");
$autoloader->register("Opencart\\Extension", DIR_EXTENSION);
$autoloader->register("Opencart\\System", DIR_SYSTEM);
