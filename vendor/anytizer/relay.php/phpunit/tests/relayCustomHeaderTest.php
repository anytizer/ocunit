<?php

use anytizer\relay;
use PHPUnit\Framework\TestCase;

/**
 * Relay a custom header
 */
class relayCustomHeaderTest extends TestCase
{
    public function setup(): void
    {
        $_GET = array();
        $_POST = array();
    }

    public function testCustomHeader()
    {
        /**
         * URL that verifies the header
         * Copy web/custom-headers.php into localhost.
         *
         * @see web/custom-headers.php
         */
        $url = "http://localhost/custom-headers.php";

        $relay = new relay();
        $relay->headers(array(
            "X-Protection-Token" => "00000000-0000-0000-0000-000000000000",
        ));
        $result = $relay->fetch($url);
        $expected = json_encode(array("success" => true));
        $this->assertEquals($expected, $result, "Missing custom-headers.php");
    }
}