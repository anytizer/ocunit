<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\catalog as catalog;
use \library\MySQLPDO;

class CatalogCategoriesTest extends TestCase
{
	/*
	public function testCategories()
	{
		$catalog = new catalog();
		$html = $catalog->browse_categories();

		$product = "Raspberry Pi";
		$found = str_contains($html, $product);
		$this->assertTrue($found, "Categories Test failed.");
	}
	
	public function testProduct()
	{
		$catalog = new catalog();
		$html = $catalog->browse_product();

		$product_tag = "<h1>Micro SD Card 32GB</h1>";
		$found = str_contains($html, $product_tag);
		$this->assertTrue($found, "Product lookup failed.");
	}
	*/
}
