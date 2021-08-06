<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

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

	public function testPriceChangeHistoryMaintained()
	{
		$this->markTestIncomplete("Pricing history is todo.");
	}
}