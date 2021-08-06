<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;

class IndexTest extends TestCase
{
	public function testIndexContainsUniqueCategoryNames()
	{
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$html = $relay->fetch(HTTP_SERVER."index.php");

		/**
		 * Categories that should be visible in home page
		 */
		$categories = [
			"Apparels",
			"Perfumes",
			"Toys",
		];

		foreach($categories as $category)
		{
			$found = str_contains($html, $category);
			$this->assertTrue($found, "Failed loading proper categories in home page.");
		}
	}
}