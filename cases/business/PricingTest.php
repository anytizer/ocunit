<?php
namespace cases\business;

use library\DatabaseExecutor;
use library\MySQLPDO;
use \PHPUnit\Framework\TestCase;

class PricingTest extends TestCase
{
	public function testManufacturerPriceExists()
	{
        $pdo = new MySQLPDO();

	    // for each product:
        // manufacturer price exist
        $dbx = new DatabaseExecutor();
        $products = $dbx->products();
        foreach($products as $product)
        {
            $check_sql="SELECT COUNT(product_price) total FROM `tw_manufacturer_prices` WHERE product_id=:product_id;";

            $exists = $pdo->query($check_sql, [
                "product_id" => $product["product_id"],
            ]);

            $this->assertEquals(1, $exists[0]["total"], "Manufacturer price missing for ID: #".$product["product_id"]);
        }
	}

	public function testProductPriceIsGreaterThanManufacturerPrice()
	{
	    // for each product:
        // price > manufacturer price x multiplier
        $pdo = new MySQLPDO();

        $dbx = new DatabaseExecutor();
        $products = $dbx->products();
        foreach($products as $product)
        {
            $check_sql="SELECT product_price FROM `tw_manufacturer_prices` WHERE product_id=:product_id;";

            $exists = $pdo->query($check_sql, [
                "product_id" => $product["product_id"],
            ]);

            if(!empty($exists[0]) && (float)$product["price"]>0)
            {
                $error = sprintf("Manufacturer price %f against store price %f for ID: #%d.", $exists[0]["product_price"], $product["price"], $product["product_id"]);
                $this->assertTrue( $product["price"] > $exists[0]["product_price"], $error);
            }

            // @todo: In case of free/downloadable products; do not compare.
        }
	}

	public function testProductPriceIsGreaterThanManufacturerPriceEvenAfterDiscounts()
	{
	    // create a discount
        // apply a discount
        // price is still higher than manufacturer pricing
        // @todo: `oc_product_special`
		$this->markTestIncomplete("Do not sell at below cost prices even after discounts.");
	}

	public function testPriceChangeHistoryMaintained()
	{
	    // for each product:
        // edit the price using the admin panel.
        // look for a new record in price history table.
        // database trigger created

        // @todo: Match the oc_ prefix
        $lookups = [
            "trigger_after_update_oc_product",
        ];

        $dbx = new DatabaseExecutor();
        $triggers = $dbx->triggers();
        foreach($lookups as $trigger)
        {
            $this->assertTrue(in_array($trigger, $triggers), "Trigger not found - {$trigger}");
        }
	}

    public function testPhysicalProductMustHaveNonZeroPrice()
    {
        $dbx = new DatabaseExecutor();
        $physical_products = $dbx->physical_products();
        if(count($physical_products))
        {
            foreach($physical_products as $product)
            {
                $this->assertTrue((float)$product["price"] > 0.01, "Pricing error on Product ID: #{$product['product_id']}");
            }
        }
        else
        {
            $this->assertTrue(true, "Done checking prices of physical products.");
        }
    }
}