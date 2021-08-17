<?php
require_once "opencart.php";
require_once "OpenCartTest.php";

use Opencart\Catalog\Controller\Startup\Setting as Setting;
use \Opencart\System\Engine\Registry as Registry;
use \Opencart\System\Engine\Event as Event;

class Test extends OpenCartTest
{
    public function testIndexLoaded()
    {
        $registry = new Registry();

        #$route = "common/dashboard";
        #$registry->set('controller', $route);

        $event = new Event($registry);
        $registry->set('event', $event);

        print_r($registry);
        print_r($event);
    }
}