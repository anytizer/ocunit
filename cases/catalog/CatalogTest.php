<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\catalog as catalog;
use \library\MySQLPDO;

class CatalogTest extends TestCase
{
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

	public function testIndexPage()
	{
		$catalog = new catalog();
		$html = $catalog->browse_index();

		$this->assertTrue(str_contains($html, "<div id=\"toast\"></div>"), "Failed checking index page contains toast placeholder.");
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
		$this->markTestSkipped();
		return;

		$client_links = [
			"Login" => "route=account/login",
			"Register" => "route=account/register",
			"Forgotten Password" => "route=account/forgotten",
			"My Account" => "route=account/account",
			"Address Book" => "route=account/address",
			"Wish List" => "route=account/wishlist",
			"Order History" => "route=account/order",
			"Downloads" => "route=account/download",
			"Recurring payments" => "route=account/recurring",
			"Reward Points" => "route=account/reward",
			"Returns" => "route=account/returns",
			"Transactions" => "route=account/transaction",
			"Newsletter" => "route=account/newsletter",
		];

		foreach($client_links as $link_name => $route)
		{
			// open link
			// html must see LOGIN REQUIRJED
			$_GET = [
				"route" => $route,
				"language" => "en-gb",
			];
			$relay = new relay();
			$relay->headers([
				"X-Protection-Token" => "",
			]);
			
			$html = $relay->fetch(HTTP_SERVER."index.php");
		}

		 $this->markTestIncomplete("Navigating to these links require a login.");
	}
}