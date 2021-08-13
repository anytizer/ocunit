<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class PricingTest extends TestCase
{
	public function testVendorPriceExists()
	{
		$this->markTestIncomplete("Vendor pricing is not implemented.");
	}

	public function testProductPriceIsGreaterThanVendorPrice()
	{
		$this->markTestIncomplete("Comparing vendor price against store price is not implemented.");
	}

	public function testProductPriceIsGreaterThanVendorPriceEvenAfterDiscounts()
	{
		$this->markTestIncomplete("Do not sell at below cost prices.");
	}

	public function testPriceChangeHistoryMaintained()
	{
		$this->markTestIncomplete("Pricing history is todo.");
	}
}