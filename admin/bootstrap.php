<?php
declare(strict_types=1);

namespace ocunit\admin;

use ocunit\library\oc as oc;

$configurations = [];
require_once dirname(__FILE__) . "/../config.php";
require_once dirname(__FILE__) . "/../library/oc.php";

$oc = new oc();

$oc->must_require(realpath($configurations["opencart"]["admin"]), "config.php");
$oc->must_define("DIR_SYSTEM");
$oc->must_define("DIR_STORAGE");

$oc->must_require(realpath($configurations["opencart"]["store"]), "config.php");
$oc->must_define("HTTP_CATALOG");

require_once("../continuation.inc.php");
