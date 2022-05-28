<?php

namespace cases\api;

use anytizer\relay;
use ocunit\library\api;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private string $api_token = "";

    public function setUp(): void
    {
        $this->api_token = $this->token();
    }

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

    public function testApiCartAdd()
    {
        $_GET = [
            "route" => "api/cart/add",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "product_id" => "100",
            "quantity" => "1",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . "index.php");
        $this->assertFalse(str_contains($html, "Your shopping cart is empty!"), "Your shopping cart is empty!");
        # echo $html;
        // {"error":"Warning: Currency code is invalid!"}
        // {"success":"Success: Your currency has been changed!"}
        #$result = json_decode($html, true);
        #$this->assertArrayHasKey("success", $result, "Unable to change session currency.");
    }

    public function testApiCartEdit()
    {
        $_GET = [
            "route" => "api/cart/edit",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "key" => "10",
            "quantity" => "1",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . "index.php");
        #$this->assertFalse(str_contains($html, "Your shopping cart is empty!"), "Your shopping cart is empty!");
        # echo $html;
    }

    public function testApiCartRemove()
    {
        $_GET = [
            "route" => "api/cart/remove",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "key" => "10",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . "index.php");
        #$this->assertFalse(str_contains($html, "Your shopping cart is empty!"), "Your shopping cart is empty!");
        # print_r($html);
        # The page you requested cannot be found.
    }

    public function testApiCartProducts()
    {
        $_GET = [
            "route" => "api/cart/products",
            "api_token" => $this->api_token,
        ];

        $_POST = [
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . "index.php");
        #echo $html;
        #$this->assertFalse(str_contains($html, "Your shopping cart is empty!"), "Your shopping cart is empty!");
    }
}
