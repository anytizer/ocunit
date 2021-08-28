<?php
require_once "opencart.php";
require_once "OpenCartTest.php";

use Opencart\System\Engine\Event as Event;
use Opencart\System\Engine\Registry as Registry;

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