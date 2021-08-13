<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\catalog as catalog;
use \library\MySQLPDO;

class CatalogTest extends TestCase
{
	public function testIndexPage()
	{
		$catalog = new catalog();
		$html = $catalog->browse_index();

		$this->assertTrue(str_contains($html, "<div id=\"toast\"></div>"), "Failed checking index page contains toast placeholder.");
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
			// html must see LOGIN REQUIRED
			$_GET = [
				"route" => $route,
				"language" => "en-gb",
			];
			$_POST = [];
			$relay = new relay();
			$relay->headers([
				"X-Protection-Token" => "",
			]);
			
			$html = $relay->fetch(HTTP_SERVER."index.php");
		}

		 $this->markTestIncomplete("Navigating to these links require a login.");
	}
}