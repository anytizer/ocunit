<?php

namespace cases\core;

use Exception;
use ocunit\library\oc;
use Opencart\System\Library\Cart\Cart;
use Opencart\System\Library\Cart\Customer;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCartClear()
    {
        $registry = $this->_registry();

        $cart = new Cart($registry);
        $cart->clear();

        $products = $cart->getProducts();
        $this->assertEmpty($products, "Cart was not cleared for anonymous visitor.");
    }

    /**
     * @throws Exception
     */
    private function _registry(): \Opencart\System\Engine\Registry
    {
        return (new oc())->_registry();
    }

    /**
     * @throws Exception
     */
    public function testCustomerLogin()
    {
        $registry = $this->_registry();

        $customer = new Customer($registry);

        global $configurations;
        $credentials = $configurations["credentials"]["customer_valid"];
        $success = $customer->login($credentials["username"], $credentials["password"]);
        $this->assertTrue($success, "Customer could NOT login.");
    }

    /**
     * @throws Exception
     */
    public function testCustomerLoginFailure()
    {
        $registry = $this->_registry();

        $customer = new Customer($registry);

        global $configurations;
        $credentials = $configurations["credentials"]["customer_invalid"];
        $success = $customer->login($credentials["username"], $credentials["password"]);
        $this->assertFalse($success, "Customer logged in with wrong credentials.");
    }
}
