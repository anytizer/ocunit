<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\api as api;

/**
 * @see https://docs.opencart.com/en-gb/system/users/api/
 */
class ApiLoginTest extends TestCase
{
	public function testGetApiToken()
	{
		$api = new api();
		$api_token_html = $api->get_token_html();
		$data = json_decode($api_token_html, true);

		$this->assertTrue(array_key_exists("api_token", $data), "api_token - key missing in html response.");
		$api_token = $data["api_token"];
		// {"success":"Success: API session successfully started!","api_token":"f5a254e32400369e587457dfd9"}
		
		$this->assertEquals(strlen("f5a254e32400369e587457dfd9"), strlen($api_token), "API Token length mismatched.");
	}

	public function testListOfAllApis()
	{
		$api = new api();
		$apis = $api->list_all_api();
        
        $usernames = [];
        foreach($apis as $api)
        {
            $usernames[] = strtolower($api["username"]);
        }

        /**
         * These API usernames are not allowed.
         */
        $searches = [
            "test",
            "default",
			"demo",
			"admin",
			"customer",
        ];

        foreach($searches as $search)
        {
            $this->assertFalse(in_array($search, $usernames), "API Username `{$search}` found in APIs. Remove such user.");
        }
	}

	public function testAccessRoutes()
	{
		$_GET = [
			"route" => "api/cart/add",
		];

		// api/login: username, key => api_token
		// api/shipping/address
		// api/currency
		// api/cart/add
		// api/cart/edit
		// api/cart/remove
		// api/cart/products
		// api/coupon
		// api/customer
		// api/voucher
		// api/voucher/add
		// api/shipping/address
		// api/shipping/methods
		// api/reward
		// api/reward/avaliable
		// api/order/add
		// api/order/edit
		// api/order/delete
		// api/order/info
		// api/order/history
		// api/payment/address
		// api/payment/methods
		// api/payment/method

		$this->markTestIncomplete("Unable to test routes.");
	}
}