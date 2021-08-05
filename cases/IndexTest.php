<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;

class IndexTest extends TestCase
{
	public function testIndexContainsUniqueCategoryName()
	{
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$html = $relay->fetch(HTTP_SERVER);

		$search = "Perfumes";
		$found = str_contains($html, $search);
		$this->assertTrue($found, "Failed loading categories in index page.");
	}
}