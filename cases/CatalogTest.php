<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;

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
		$this->html = $relay->fetch(HTTP_SERVER."/index.php");
		# http://localhost/opencart/upload/index.php?route=product/category&language=en-gb&path=66_63
	}

	public function testProducts()
	{
		/**
		 * Some list of products in a specific category
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
		$this->assertTrue(str_contains($this->html, "<span class=\"price-tax\">Ex Tax: $10.00</span>"), "Failed loading tax tag.");
	}
}