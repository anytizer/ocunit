<?php
namespace cases\api;

use library\BusinessRules;
use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\api as api;

class ApiTest extends TestCase
{
    private string $api_token = "";
    private BusinessRules $br;

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

    public function testInappropriateApiUsers()
    {
        $api = new api();
        $apis = $api->list_all_api();

        $usernames = [];
        foreach($apis as $api)
        {
            /**
             * @todo Replace numerals with empty strings.
             * eg. admin1 becomes admin.
             */
            $usernames[] = strtolower($api["username"]);
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

        foreach($searches as $search)
        {
            $this->assertFalse(in_array($search, $usernames), "Remove such API User: `{$search}`.");
        }
    }

    public function setUp(): void
    {
        $this->api_token = $this->token();
        $this->br = new BusinessRules();
    }

    public function testAccessApiLogin()
    {
        $_GET = [
            "route" => "api/login",
        ];

        $_POST = [
            "username" => $this->br->credentials[6]->username,
            "key" => $this->br->credentials[6]->password,
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG."index.php");
        $result = json_decode($html, true);
        $this->assertArrayHasKey("success", $result, "success flag");
        $this->assertArrayHasKey("api_token", $result, "API Token missing");
    }

    public function testChangeSessionCurrency()
    {
        $_GET = [
            "route" => "api/currency",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "currency" => "CAD",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG."index.php");
        # echo $html;
        // {"error":"Warning: Currency code is invalid!"}
        // {"success":"Success: Your currency has been changed!"}
        $result = json_decode($html, true);
        $this->assertArrayHasKey("success", $result, "Unable to change session currency.");
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

        $html = $relay->fetch(HTTP_CATALOG."index.php");
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

        $html = $relay->fetch(HTTP_CATALOG."index.php");
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

        $html = $relay->fetch(HTTP_CATALOG."index.php");
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

        $html = $relay->fetch(HTTP_CATALOG."index.php");
        #echo $html;
        #$this->assertFalse(str_contains($html, "Your shopping cart is empty!"), "Your shopping cart is empty!");
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

        $html = $relay->fetch(HTTP_CATALOG."index.php");
        #echo $html;
        #$this->assertFalse(str_contains($html, "Your shopping cart is empty!"), "Your shopping cart is empty!");
        # <b>Warning</b>: Undefined array key "model_extension_total_coupon" in <b>system\engine\registry.php</b> on line <b>51</b>Missing model_extension_total_coupon
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

        $html = $relay->fetch(HTTP_CATALOG."index.php");
        # echo $html;
        # <p>The page you requested cannot be found.</p>
    }

    public function testApiVoucher()
    {
        $_GET = [
            "route" => "api/voucher",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "voucher" => "VOU-7271",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG."index.php");
        # echo $html;
        # {"error":"Warning: Gift Voucher is either invalid or the balance has been used up!"}
    }

    public function testApiVoucherAdd()
    {
        $_GET = [
            "route" => "api/voucher/add",
            "api_token" => $this->api_token,
        ];

        $_POST = [
            "from_name" => "MyOpenCart Admin",
            "from_email" => "admin@example.com",
            "to_name" => "Dear Customer",
            "to_email" => "customer@example.com",
            "amount" => "100",
            "code" => "VOU-7177",
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG."index.php");
        # echo $html;
        # <p>The page you requested cannot be found.</p>
    }






    public function testAccessRoutes()
    {
        $this->markTestIncomplete("API login check necessary.");
        return;

        $api_token = $this->token();

        $this->br = new BusinessRules();

        // look into the ways of accessing various api endpoints
        // @see https://docs.opencart.com/en-gb/system/users/api/
        $endpoints = [
            # "api/login", // login not necessary?
            # "api/currency",
            #"api/cart/add", # error
            #"api/cart/edit",
            #"api/cart/remove",
            #"api/cart/products",
            #"api/coupon",
            #"api/customer",
            #"api/voucher", // [error] => Warning: Gift Voucher is either invalid or the balance has been used up!
            #"api/voucher/add", // [error] => Warning: Gift Voucher is either invalid or the balance has been used up!
            "api/shipping/address",
            "api/shipping/methods",
            "api/reward",
            "api/reward/available",
            "api/order/add",
            "api/order/edit",
            "api/order/delete",
            "api/order/info",
            "api/order/history",
            "api/payment/address",
            "api/payment/methods",
            "api/payment/method",
        ];
        foreach($endpoints as $route)
        {
            $_GET = [
                "route" => $route,
                "api_token" => $api_token,
            ];
            $_POST = [
                "username" => $this->br->credentials[6]->username,
                "key" => $this->br->credentials[6]->password,
            ];

            $relay = new relay();
            $relay->headers([
                "X-Protection-Token" => "",
            ]);

            $html = $relay->fetch(HTTP_CATALOG."index.php");
            $result = json_decode($html, true);
            # assert(is_array($error));
            // {"error":{"key":"Warning: Incorrect API Key!"}}
            echo "\r\n", $route;
            #$this->assertArrayHasKey("error", $result, "API {$route} is NOT protected!");
            print_r($result); // , "API {$route} is NOT protected!");
        }
    }
}
