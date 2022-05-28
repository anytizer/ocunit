<?php

namespace cases\api;

use anytizer\relay;
use ocunit\library\api;
use PHPUnit\Framework\TestCase;

class CouponTest extends TestCase
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

    public function testApiCoupon()
    {
        $_GET = [
            "route" => "api/coupon",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "coupon" => "2222",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . "index.php");
        #echo $html;
        #$this->assertFalse(str_contains($html, "Your shopping cart is empty!"), "Your shopping cart is empty!");
        # <b>Warning</b>: Undefined array key "model_extension_total_coupon" in <b>system\engine\registry.php</b> on line <b>51</b>Missing model_extension_total_coupon
    }
}
