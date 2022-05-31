<?php

namespace ocunit\admin;

use Exception;
use ocunit\library\oc as oc;

require_once "../config.php";
require_once "../library/oc.php";

try {
    $oc = new oc();
    $oc->must_include(realpath($configurations["opencart"]["admin"]), "config.php");
    $oc->must_include(realpath($configurations["opencart"]["store"]), "config.php");
    $oc->must_define("HTTP_CATALOG"); // admin defines frontend
} catch (\Exception $e) {
    throw new Exception("OC Configurations not found.");
}

require_once("../continuation.inc.php");
