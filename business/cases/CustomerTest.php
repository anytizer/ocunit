<?php
namespace ocunit\business;

use ocunit\library\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testDeleteCustomer()
    {
        $customer = new Customer();
        $customer->delete_all();

        $this->assertFalse(false);
    }

    public function testCreateCustomer()
    {
        $customer = new Customer();

        // @todo Push to .ini file
        $info = [
            "email" => "customer@example.com",
            "password" => "customer",
        ];

        $customer_id = $customer->create($info);
        $this->assertTrue($customer_id!="");
    }
}