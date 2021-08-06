<?php
/**
 * Path where your OpenCart is installed.
 */
$opencart_upload = "../opencart/upload";
require_once("{$opencart_upload}/config.php");

/**
 * Silently load admin configurations too.
 */
ob_start();
require_once("{$opencart_upload}/admin/config.php");
ob_end_clean();

require_once("class.MySQLPDO.inc.php");

require_once("vendor/autoload.php");
