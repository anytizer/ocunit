<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;

class AdminOrderCancelTest extends TestCase
{
	public function testOrderCancelledProperly()
	{
		// create order
		// cancel order
		// list recent orders: to be missing last cancelled order

		$this->markTestIncomplete("Cancel an order.");
	}
}