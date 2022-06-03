<?php

namespace ocunit;

/**
 * Basic headers to browse the OpenCart pages
 */
if (empty($_SERVER["REMOTE_ADDR"])) $_SERVER["REMOTE_ADDR"] = "0.0.0.0";
if (empty($_SERVER["HTTP_USER_AGENT"])) $_SERVER["HTTP_USER_AGENT"] = "ocunit";
if (empty($_SERVER["HTTP_REFERER"])) $_SERVER["HTTP_REFERER"] = "http://localhost/oc/opencart/";

// IDE Silencer: Do nothing as already defined in config.php files.
if (!defined("DIR_SYSTEM")) die("DIR_SYSTEM not defined.");
if (!defined("DIR_STORAGE")) die("DIR_STORAGE not defined.");

// Helper
$system = realpath(DIR_SYSTEM);
require_once $system . "/helper/general.php";
require_once $system . "/helper/utf8.php";
require_once DIR_STORAGE . "/vendor/autoload.php";
require_once $system . "/engine/autoloader.php";
require_once $system . "/engine/config.php";

use Opencart\System\Engine\Autoloader as Autoloader;

$autoloader = new Autoloader();
$autoloader->register("Opencart\\Admin", DIR_APPLICATION);
$autoloader->register("Opencart\\Catalog", DIR_OPENCART . "/catalog");
$autoloader->register("Opencart\\Extension", DIR_EXTENSION);
$autoloader->register("Opencart\\System", DIR_SYSTEM);
