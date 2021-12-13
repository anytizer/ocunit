<?php

namespace cases\api;

use anytizer\relay;
use library\api;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
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

    public function testApiCustomer()
    {
        $_GET = [
            "route" => "api/customer",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "firstname" => "Jane",
            "lastname" => "Doe",
            "email" => "test@example.com",
            "telephone" => "+0 000-000-0000",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . "index.php");
        # echo $html;
        # <p>The page you requested cannot be found.</p>
    }
}
