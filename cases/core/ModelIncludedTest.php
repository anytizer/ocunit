<?php
namespace cases\core;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\MySQLPDO;

class ModelIncludedTest extends TestCase
{
	public function testOpencartModelIsIncludedOnDemand()
	{
		// create order
		// cancel order
		// return order
		// credit issued

		// include OC Framework
		// $controller->load(model);
		// $controller->language(en-gb);

		$this->markTestIncomplete("OC Framework not loaded for now.");
	}
}