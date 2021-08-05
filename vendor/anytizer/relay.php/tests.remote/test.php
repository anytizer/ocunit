<?php
/**
 * Copy this file where your vendor/ is.
 */
require_once "./vendor/autoload.php"; // local
#require_once "vendor/autoload.php"; // global

use anytizer\relay;

$_GET = array(
    "format" => "json",
);

$_POST = array();

/**
 * Courtesy service
 */
$url = "https://api.ipify.org/";

$relay = new relay();

$result = $relay->fetch($url);
$data = json_decode($result, true);

/**
 * Output the data fetched
 */
print_r($data);
