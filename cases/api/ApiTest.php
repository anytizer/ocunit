<?php
namespace cases\api;

use \PHPUnit\Framework\TestCase;
use \library\api;

class ApiTest extends TestCase
{
    private string $api_token = "";

    private function token()
    {
        $api = new api();
        $api_token_html = $api->get_token_html();
        $data = json_decode($api_token_html, true);

        //$this->assertArrayHasKey("api_token", $data, "`api_token` key missing in HTML/token-json response.");
        assert(array_key_exists("api_token", $data));
        $api_token = $data["api_token"];
        // {"success":"Success: API session successfully started!","api_token":"f5a254e32400369e587457dfd9"}

        return $api_token;
    }

    public function setUp(): void
    {
        $this->api_token = $this->token();
    }

    public function testGetApiToken()
    {
        $this->assertEquals(strlen("f5a254e32400369e587457dfd9"), strlen($this->api_token), "API Token length mismatched.");
    }

    public function testAccessRoutes()
    {
        $this->markTestIncomplete("API test routes.");
        return;

//        // look into the ways of accessing various api endpoints
//        // @see https://docs.opencart.com/en-gb/system/users/api/
//        $endpoints = [
//            # "api/login", // login not necessary?
//            # "api/currency",
//            #"api/cart/add", # error
//            #"api/cart/edit",
//            #"api/cart/remove",
//            #"api/cart/products",
//            #"api/coupon",
//            #"api/customer",
//            #"api/voucher", // [error] => Warning: Gift Voucher is either invalid or the balance has been used up!
//            #"api/voucher/add", // [error] => Warning: Gift Voucher is either invalid or the balance has been used up!
//            "api/shipping/address",
//            "api/shipping/methods",
//            "api/reward",
//            "api/reward/available",
//            "api/order/add",
//            "api/order/edit",
//            "api/order/delete",
//            "api/order/info",
//            "api/order/history",
//            "api/payment/address",
//            "api/payment/methods",
//            "api/payment/method",
//        ];
//        foreach($endpoints as $route)
//        {
//            $_GET = [
//                "route" => $route,
//                "api_token" => $this->api_token,
//            ];
//
//            $_POST = [
//                "username" => $this->br->credentials[6]->username,
//                "key" => $this->br->credentials[6]->password,
//            ];
//
//            $relay = new relay();
//            $relay->headers([
//                "X-Protection-Token" => "",
//            ]);
//
//            $html = $relay->fetch(HTTP_CATALOG."index.php");
//            $result = json_decode($html, true);
//            # assert(is_array($error));
//            // {"error":{"key":"Warning: Incorrect API Key!"}}
//            echo "\r\n", $route;
//            #$this->assertArrayHasKey("error", $result, "API {$route} is NOT protected!");
//            print_r($result); // , "API {$route} is NOT protected!");
//        }
    }
}
