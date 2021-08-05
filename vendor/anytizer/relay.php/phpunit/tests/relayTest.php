<?php

use anytizer\relay;
use PHPUnit\Framework\TestCase;

/**
 * Generate and Use tokens before actual API is being accessed
 */
class relayTest extends TestCase
{
    public function setup(): void
    {
        $_GET = array();
        $_POST = array();
    }

    public function testIpAddressFromIpify()
    {
        $_GET = array(
            "format" => "json",
        );

        /**
         * Courtesy use only
         * @see https://www.ipify.org/
         */
        $url = "https://api.ipify.org/";

        $relay = new relay();
        $result = $relay->fetch($url);

        $data = json_decode($result, true);
        $ip = $data["ip"];

        $this->assertArrayHasKey("ip", $data);

        $ipv4 = "0.0.0.0"; // compose with single digit
        $ipv6 = "0000:0000:0000:0000:0000:0000:0000:0000"; // compose with 4 digits

        $this->assertTrue(strlen($ip) >= strlen($ipv4));
        $this->assertTrue(strlen($ip) <= strlen($ipv6));
    }
}