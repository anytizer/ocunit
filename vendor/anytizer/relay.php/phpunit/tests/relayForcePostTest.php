<?php

use anytizer\relay;
use PHPUnit\Framework\TestCase;

/**
 * POST forced
 */
class relayForcePostTest extends TestCase
{
    public function setup(): void
    {
        $_GET = array();
        $_POST = array();
    }

    public function testNoIpAddressFromIpify()
    {
        $_GET = array(
            "format" => "json",
        );

        /**
         * Courtesy use only
         * When POSTed, it should not result any data
         * @see https://api.ipify.org/?format=json
         */
        $url = "https://api.ipify.org/";

        $relay = new relay();

        /**
         * Do not remove this line
         */
        $relay->force_post();

        $result = $relay->fetch($url);
        $this->assertEquals("", $result);
    }
}