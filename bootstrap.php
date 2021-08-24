<?php
/**
 * Path where your OpenCart is installed at.
 * Put WITHOUT trailing slash /
 */
global $opencart_upload_folder;
$opencart_upload_folder = realpath("../store/upload");
assert($opencart_upload_folder!="");
assert(is_dir($opencart_upload_folder));

/**
 * OpenCart Frontend configuration file
 */
#require_once("{$opencart_upload_folder}/config.php");

/**
 * Admin config file
 * 
 * Silently load admin configurations too.
 * The constants defined in admin will definitely collide with that in frontend.
 */
#ob_start();
require_once("{$opencart_upload_folder}/admin/config.php");
#ob_end_clean();

// Helper
require_once(DIR_SYSTEM . "helper/general.php");
require_once(DIR_SYSTEM . "helper/utf8.php");
require_once(DIR_STORAGE . "vendor/autoload.php");
require_once(DIR_SYSTEM . "engine/autoloader.php");
require_once(DIR_SYSTEM . "engine/config.php");

$_SERVER["REMOTE_ADDR"] = "0.0.0.0";

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

define("__OCUNIT_ROOT__", dirname(__FILE__, 1)); // do not change it
const __OCUNIT_EXECUTE_EXPENSIVE__ = false; // Should I run expensive database operations?

require_once("vendor/autoload.php");

require_once("library/class.fql.inc.php");
require_once("library/class.PostQuery.inc.php");
require_once("library/class.MySQLPDO.inc.php");
require_once("library/class.DatabaseExecutor.inc.php");
require_once("library/class.api.inc.php");
require_once("library/class.catalog.inc.php");
require_once("library/class.admin.inc.php");
require_once("library/class.credentials.inc.php");

/**
 * Define site-wide business rules, multipliers, product count, etc.
 * Also, user credentials,
 */
require_once("library/class.BusinessRules.inc.php");

use \library\PostQuery;

/**
 * Modify these values with your store data
 */
$searches_in_html_pages = [
    // home page
    // http://localhost/opencart/upload/
    // http://localhost/opencart/upload/index.php
    // http://localhost/opencart/upload/index.php?route=common/home&language=en-gb
    new PostQuery(
        "index.php",
        [],
        [],
        [
            "Apparels",
            "Perfumes",
            "Toys",
            "Information Technology",
            "<div id=\"toast\"></div>",
        ]
    ),

    // Sub-Category Listing Page
    // Used electronics, wires and parts
    // index.php?route=product/category&language=en-gb&path=66_63
    // http://localhost/opencart/upload/index.php?route=product/product&language=en-gb&path=66_63&product_id=82
    new PostQuery(
        "index.php",
        [
            "route" => "product/category",
            "language" => "en-gb",
            "path" => "66_63",
        ],
        [],
        [
			"Piano",
            "Raspberry Pi",
			"Camcorder",
			"Headphones",
			"Micro SD Card",
            ">Micro SD Card 32GB</a></h4>", // starts with ">" as a part of h4.a tag
            // "<h4><a href="http://localhost/opencart/upload/index.php?route=product/product&amp;language=en-gb&amp;path=66_63&amp;product_id=82">Micro SD Card 32GB</a></h4>",
        ]
    ),

    // Product Details Page
    // http://localhost/opencart/upload/index.php?route=product/product&language=en-gb&path=66_63&product_id=82
    new PostQuery(
        "index.php",
        [
            "route" => "product/product",
            "language" => "en-gb",
            "path" => "66_63",
            "product_id" => 82,
        ],
        [],
        [
            "<h1>Micro SD Card 32GB</h1>",
            "<h2>$14.00</h2>",
            "<li>Product Code: SDCARD</li>",
            "<li>Availability: In Stock</li>",
            "<li>Ex Tax: $10.00</li>",
        ]        
    ),

    // API Token
    new PostQuery(
        "index.php",
        [
            "route" => "api/login",
        ],
        [
			"username" => "test1",
			"key" => "9acd35f146d93542c062e73697564373f0eac52ebf84ace1d9f59f2face8c5c4ed67d2939ebe86756e6fe4f1fbeb7bf3189d195883b8556b79339d9f3fbb518c32f9a72ab4226a495c2a6aa0f4508a7f8662d1d8fc7d5cfba81a89294556ba10338771247914482be7ce08e4c196af019802a8b69874a82f50863c7f89f64dcc",
		],
        [
            "api_token",
        ]
    ),
];

/**
 * Boot to OpenCart front page without HTML output
 */
# ob_start();
# require_once("{$opencart_upload_folder}/index.php");
# require_once(DIR_SYSTEM . "startup.php");
# ob_end_clean();

/**
 * Define which tables should have how many records count?
 * Hints: Look into the database tables manually and edit your preferences.
 *
 * Tables with 0 count will be truncated.
 */
$tables_counters = [
    DB_PREFIX."api" => 2,
    DB_PREFIX."banner" => 0,
    DB_PREFIX."banner_image" => 0,
    DB_PREFIX."cart" => 0,
    DB_PREFIX."coupon" => 0,
    DB_PREFIX."currency" => 1,
    DB_PREFIX."customer" => 1,
    DB_PREFIX."customer_group_description" => 4,
    DB_PREFIX."customer_login" => 0,
    DB_PREFIX."filter" => 0,
    DB_PREFIX."fraud_ip" => 0,
    DB_PREFIX."gdpr" => 0,
    DB_PREFIX."language" => 1, // 1
    DB_PREFIX."manufacturer" => 6,
    DB_PREFIX."notification" => 0,
    DB_PREFIX."order" => 0,
    DB_PREFIX."order_product" => 0,

    DB_PREFIX."product" => 91,
    DB_PREFIX."product_description" => 91,
    DB_PREFIX."product_to_category" => 91,

    #DB_PREFIX."download" => 5,
    #DB_PREFIX."product_to_download" => 5,

    DB_PREFIX."review" => 0,
    DB_PREFIX."session" => 0,
    DB_PREFIX."setting" => 373,
    DB_PREFIX."store" => 3,
    DB_PREFIX."user_group" => 5,
    DB_PREFIX."voucher" => 0,
    DB_PREFIX."voucher_history" => 0,
];