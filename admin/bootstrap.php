<?php
namespace ocunit\admin;
use \ocunit\library\oc;

require_once "../bootstrap.php";

require_once("../library/class.oc.inc.php");

global $configurations;

$occonfig = new oc();
try {
    $occonfig->must_include(realpath($configurations["opencart"]["admin"]), "config.php");
} catch (\Exception $e) {
}
try {
    $occonfig->must_define("HTTP_CATALOG");
} catch (\Exception $e) {
}

require_once("../continuation.inc.php");
