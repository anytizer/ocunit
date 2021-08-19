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
        // for from/to postal addresses:
        // for weight w, calculate the shipment.
        $this->markTestIncomplete("API by post office is integrated.");
    }

    public function testPickupRequest()
    {
        // when there is an order that is paid; marked as ready for shipment; email the post office.
        $this->markTestIncomplete("Request post office to pickup parcels.");
    }

    public function testPickedUpItemEmailsToCustomer()
    {
        // if a product is picked up by the post office, email the tracking code to the customer
        $this->markTestIncomplete("Send email after product picked-up by post office");
    }

    public function testDenyCrossBoarderShipping()
    {
        $this->markTestIncomplete("Sell within the country of store only.");
    }
}