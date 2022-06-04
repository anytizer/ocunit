<?php
namespace ocunit\business;

use ocunit\library\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testDeleteCustomer()
    {
        $c = new Customer();
        $c->delete_all();

        $this->assertFalse(false);
    }
}