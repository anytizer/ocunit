<?php

namespace cases\api;

use anytizer\relay;
use library\api;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
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

    public function testGetApiToken()
    {
        // $api_token = $this->token();
        $this->assertEquals(strlen("f5a254e32400369e587457dfd9"), strlen($this->api_token), "API Token length mismatched.");
    }

    public function testInappropriateApiUsersDenied()
    {
        $api = new api();
        $users = $api->list_all_api_users();

        $usernames = [];
        foreach ($users as $user) {
            /**
             * @todo Replace numerals with empty strings.
             * eg. admin1 becomes admin.
             */
            $usernames[] = preg_replace("/[\d+]/", "", strtolower($user["username"]));
        }

        /**
         * These API usernames are not allowed.
         */
        $searches = [
            "admin",
            "api",
            "customer",
            "default",
            "demo",
            "example",
            "key",
            "test",
            "user",
            "value",
        ];

        foreach ($searches as $search) {
            $this->assertFalse(in_array($search, $usernames), "Remove such API User: `{$search}`.");
        }
    }

    public function testAccessApiLogin()
    {
        global $configurations;
        $credentials = $configurations["credentials"]["api_valid"];

        $_GET = [
            "route" => "api/login",
        ];

        $_POST = [
            "username" => $credentials["username"],
            "key" => $credentials["password"],
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . "index.php");
        $result = json_decode($html, true);
        $this->assertArrayHasKey("success", $result, "success flag");
        $this->assertArrayHasKey("api_token", $result, "API Token missing");
    }
}
