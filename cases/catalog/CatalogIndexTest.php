<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\catalog as catalog;
use \library\MySQLPDO;

class CatelogIndexTest extends TestCase
{
	public function testIndexPage()
	{
		$catalog = new catalog();
		$html = $catalog->browse_index();

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

	public function testSearchesInPages()
	{
		global $searches_in_html_pages;

		foreach($searches_in_html_pages as $post_query)
		{
			$page = $post_query->page;
			$_GET = $post_query->get;
			$_POST = $post_query->post;
			$lookups = $post_query->lookups;

			$relay = new relay();
			$relay->headers([
				"X-Protection-Token" => "",
			]);
			$html = $relay->fetch(HTTP_SERVER.$page);

			foreach($lookups as $lookup)
			{
				$found = str_contains($html, $lookup);
				$this->assertTrue($found, "\033[1;31mFAILED:\033[0m searching [ {$lookup} ] in HTML.");
			}
		}
	}
}
