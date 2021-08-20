<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class PricingTest extends TestCase
{
	public function testManufacturerPriceExists()
	{
	    // for each product:
        // manufacturer price exist
		$this->markTestIncomplete("Manufacturer pricing is not implemented.");
	}

	public function testProductPriceIsGreaterThanManufacturerPrice()
	{
	    // for each product:
        // price > manufacturer price x multiplier
		$this->markTestIncomplete("Comparing manufacturer price against store price is not implemented.");
	}

	public function testProductPriceIsGreaterThanManufacturerPriceEvenAfterDiscounts()
	{
	    // create a discount
        // apply a discount
        // price is still higher than manufacturer pricing
		$this->markTestIncomplete("Do not sell at below cost prices.");
	}

	public function testPriceChangeHistoryMaintained()
	{
	    // for each product:
        // edit the price using the admin panel.
        // look for a new record in price history table.
        // database trigger created
		$this->markTestIncomplete("Pricing history is a todo.");
	}
}