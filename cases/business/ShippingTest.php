<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class ShippingTest extends TestCase
{
	public function testFreeShippingWithinCityOfStore()
    {
        $this->markTestIncomplete("Free shipping within city of store location.");
    }

    public function testPostOfficeApiUsage()
    {
        $this->markTestIncomplete("API by post office is integrated.");
    }

    public function testPickupRequest()
    {
        $this->markTestIncomplete("Request post office to pickup parcels.");
    }

    public function testDenyCrossBoarderShipping()
    {
        $this->markTestIncomplete("Sell within the country of store.");
    }
}