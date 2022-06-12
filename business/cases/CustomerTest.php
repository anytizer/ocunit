<?php

namespace ocunit\business;

use ocunit\library\Customer;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class CustomerTest extends TestCase
{
    public function testDeleteCustomer()
    {
        $customer = new Customer();
        $total = $customer->delete_all();

        $this->assertTrue($total >= 1);
    }

    public function testCreateCustomer()
    {
        $customer = new Customer();

        $customers = _env("stores.ini")["customers"];
        foreach ($customers as $email => $name) {
            $info = [
                "email" => $email,
                "name" => $name,
                "password" => "customer", // @todo change it | randomly generate | and email the customer
            ];

            $customer_id = $customer->create($info);
        }

        $this->assertNotEmpty($customers);
    }
}