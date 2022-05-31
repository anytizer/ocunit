<?php

namespace ocunit\admin;

use ocunit\library\oc as oc;

require_once dirname(__FILE__) . "/../config.php";

require_once(__OCUNIT_ROOT__ . "/library/oc.php");

$oc = new oc();
$oc->must_include(realpath($configurations["opencart"]["store"]), "config.php");
$oc->must_define("DIR_SYSTEM");
$oc->must_define("DIR_STORAGE");

require_once "../continuation.inc.php";
