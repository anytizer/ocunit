<?php
namespace ocunit\admin;
use \ocunit\library\oc;

require_once "../bootstrap.php";

require_once("../library/class.oc.inc.php");

$occonfig = new oc();
try {
    $occonfig->must_include(realpath($configurations["opencart"]["admin"]), "config.php");
    $occonfig->must_define("HTTP_CATALOG"); // admin defines frontend
} catch (\Exception $e) {
}

require_once("../continuation.inc.php");
