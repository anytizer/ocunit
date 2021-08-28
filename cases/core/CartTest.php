<?php

namespace cases\core;

use Opencart\System\Engine\Loader;
use Opencart\System\Engine\Registry;
use Opencart\System\Library\Cache;
use Opencart\System\Library\Cart\Cart;
use Opencart\System\Library\Cart\Customer;
use Opencart\System\Library\Cart\Tax;
use Opencart\System\Library\Cart\Weight;
use Opencart\System\Library\Request;
use Opencart\System\Library\Session;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private Registry $registry;

    /**
     * @throws \Exception
     */
    public function setUp(): void
    {
        global $autoloader;

        $registry = new Registry();
        $registry->set("autoloader", $autoloader);

        $config = new \Opencart\System\Engine\Config();
        $config->addPath(DIR_CONFIG);
        $config->load("default");
        $config->load(strtolower(APPLICATION));
        $config->set("application", APPLICATION);
        $registry->set("config", $config);

        $log = new \Opencart\System\Library\Log($config->get("error_filename"));
        $registry->set("log", $log);

        $loader = new Loader($registry);
        $registry->set("load", $loader);

        $db = new \Opencart\System\Library\DB("mysqli", DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        $registry->set("db", $db);

        $request = new Request();
        $registry->set("request", $request);

        $session = new Session("db", $registry);
        $registry->set("session", $session);

        $customer = new Customer($registry);
        $registry->set("customer", $customer);

        $cache = new Cache("file");
        $registry->set("cache", $cache);

        $tax = new Tax($registry);
        $registry->set("tax", $tax);

        $weight = new Weight($registry);
        $registry->set("weight", $weight);

        $customer = new Customer($registry);
        $registry->set("customer", $customer);

        #$cart = new Cart($registry);
        #$registry->set("cart", $cart);

        $this->registry = $registry;
    }

    public function testCartClear()
    {
        $cart = new Cart($this->registry);
        $cart->clear();

        $products = $cart->getProducts();
        $this->assertEmpty($products, "Cart was not cleared.");
    }

    public function testCustomerLogin()
    {
        $customer = new Customer($this->registry);

        global $configurations;
        $credentials = $configurations["credentials"]["customer_valid"];
        $success = $customer->login($credentials["username"], $credentials["password"]);
        $this->assertTrue($success, "Customer could NOT login.");
    }
}
