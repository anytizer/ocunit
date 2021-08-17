<?php
require_once "opencart.php";
require_once "OpenCartTest.php";

use Opencart\Catalog\Controller\Startup\Setting as Setting;
use \Opencart\System\Engine\Registry as Registry;

class Test extends OpenCartTest
{
    public function testIndexLoaded()
    {
        $registry = new Registry();
        $route = "common/dashboard";
        $registry->set('controller', $route);

        $event = new \Opencart\System\Engine\Event($registry);
        $registry->set('event', $event);
        print_r($registry);
    }
}