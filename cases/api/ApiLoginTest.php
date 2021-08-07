<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \api as api;

/**
 * @see https://docs.opencart.com/en-gb/system/users/api/
 */
class ApiLoginTest extends TestCase
{
	private function getAPiToken()
	{

		// data={'username':username, 'key':key};
		$_GET = [
			"route" => "api/login",
		];

		// @todo Read username and key from private config file
		$_POST = [
			"username" => "test",
			"key" => "9acd35f146d93542c062e73697564373f0eac52ebf84ace1d9f59f2face8c5c4ed67d2939ebe86756e6fe4f1fbeb7bf3189d195883b8556b79339d9f3fbb518c32f9a72ab4226a495c2a6aa0f4508a7f8662d1d8fc7d5cfba81a89294556ba10338771247914482be7ce08e4c196af019802a8b69874a82f50863c7f89f64dcc",
		];
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$html = $relay->fetch(HTTP_SERVER."index.php");
		$data = json_decode($html, true);

		return $data["api_token"];
	}

	public function testGetApiToken()
	{
		$api_token = $this->getAPiToken();
		// print_r($data);
		// echo $html;
		// {"success":"Success: API session successfully started!","api_token":"f5a254e32400369e587457dfd9"}
		$this->assertEquals(strlen("f5a254e32400369e587457dfd9"), strlen($api_token), "API Token length mismatched");
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

	public function testRoutes()
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
	}
}