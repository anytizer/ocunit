<?php
require_once "../bootstrap.php";

require_once("../library/class.oc.inc.php");
$occonfig = new library\oc();
$occonfig->must_include(realpath($configurations["opencart"]["store"]), "config.php");
$occonfig->must_define("DIR_SYSTEM");
$occonfig->must_define("DIR_STORAGE");

require_once "../continuation.inc.php";
