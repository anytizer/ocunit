<?php
namespace ocunit\admin;

use \ocunit\library\oc as oc;
use \Exception;

require_once dirname(__FILE__)."/../config.php";
require_once dirname(__FILE__)."/../library/oc.php";

$oc = new oc();
$oc->must_include(realpath($configurations["opencart"]["admin"]), "config.php");
$oc->must_define("HTTP_CATALOG"); // admin defines frontend

require_once("../continuation.inc.php");
