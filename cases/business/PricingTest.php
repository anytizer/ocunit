<?php
namespace cases\business;

use library\DatabaseExecuter;
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

        $lookups = [
            "trigger_after_update_oc_product",
        ];

        $dbx = new DatabaseExecuter();
        $triggers = $dbx->triggers();
        foreach($lookups as $trigger)
        {
            $this->assertTrue(in_array($trigger, $triggers), "Trigger not found - {$trigger}");
        }
	}

    public function testPhysicalProductMustHaveNonZeroPrice()
    {
        $dbx = new DatabaseExecuter();
        $physical_products = $dbx->physical_products();
        foreach($physical_products as $product)
        {
            $this->assertTrue((float)$product["price"] > 0.01, "Pricing error on Product ID: #{$product['product_id']}");
        }
    }
}