<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

class CatalogTest extends TestCase
{
	private $html = "";

	public function setUp(): void
	{
		$_GET = [
			"route" => "product/category",
			"language" => "en-gb",
			"path" => "66_63",
		];
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$this->html = $relay->fetch(HTTP_SERVER."index.php");
		# http://localhost/opencart/upload/index.php?route=product/category&language=en-gb&path=66_63
	}

	public function testProductsListedUnderAPage()
	{
		/**
		 * Few list of products in a specific category defined in setup page
		 */
		$products = [
			"Raspberry Pi",
			"Camcorder",
			"Piano",
			"Headphones",
			"Micro SD Card",
		];
		foreach($products as $product)
		{
			$this->assertTrue(str_contains($this->html, $product), "Failed loading proper product: ".$product);
		}
	}
	
	public function testTaxTagPresent()
	{
		$this->assertTrue(str_contains($this->html, "<span class=\"price-tax\">Ex Tax: $10.00</span>"), "Failed loading exclusive of tax tag.");
	}

	public function testInnerPagesNeedLogin()
	{
		/**
		Login => "http://localhost/opencart/upload/index.php?route=account/login&language=en-gb",
		Register
		Forgotten Password
		My Account
		Address Book
		Wish List
		Order History
		Downloads
		Recurring payments
		Reward Points
		Returns
		Transactions
		Newsletter
		 */

		 $this->markTestIncomplete("Navigating to these links require a login.");
	}
}