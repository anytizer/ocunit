<?php
/**
 * Relative path where your OpenCart is installed.
 * Put without trailing /
 */
$opencart_upload_folder = "../opencart/upload";



/**
 * *********** DO NOT MODIFIY BELOW ***********
 */

require_once("vendor/autoload.php");

/**
 * Test suite specific content
 */
require_once("class.MySQLPDO.inc.php");
require_once("class.api.inc.php");
require_once("class.catalog.inc.php");
require_once("class.admin.inc.php");

/**
 * Frontend config file
 */
require_once("{$opencart_upload_folder}/config.php");

/**
 * Admin config file
 * 
 * Silently load admin configurations too.
 * The admin config for contsants collide with that in frontend.
 */
ob_start();
require_once("{$opencart_upload_folder}/admin/config.php");
ob_end_clean();
