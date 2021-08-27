<?php
namespace cases\api;

use anytizer\relay;
use library\api;
use library\BusinessRules;
use PHPUnit\Framework\TestCase;

class VoucherTest extends TestCase
{
    private string $api_token;
    public function setUp(): void
    {
        $this->api_token = $this->token();
        $this->br = new BusinessRules();
    }

    private function token()
    {
        $api = new api();
        $api_token_html = $api->get_token_html();
        $data = json_decode($api_token_html, true);

        $api_token = $data["api_token"];

        return $api_token;
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
}
