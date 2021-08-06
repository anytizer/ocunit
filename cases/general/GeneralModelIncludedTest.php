<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

class GeneralModelIncludedTest extends TestCase
{
	public function testModelIsIncludedOnDemand()
	{
		// create order
		// cancel order
		// return order
		// credit issued

		// include OC Framework
		// $controller->model();

		$pdo = new MySQLPDO();
		$this->markTestIncomplete("OC Framework not loaded for now.");
	}
}