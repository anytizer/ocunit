<?php

use anytizer\relay;
use PHPUnit\Framework\TestCase;

/**
 * Generate and Use tokens before actual API is being accessed
 */
class relayHookBinTest extends TestCase
{
    public function setup(): void
    {
        $_GET = array();
        $_POST = array();
    }

    public function testHookBinCalled()
    {
        $_GET = array(
            "format" => "json",
        );

        $_POST = [
            "data1" => "D001",
            "data2" => "D002",
        ];

        /**
         * Courtesy use only
         * see https://hookbin.com/xxxxxxxxxxx
         */
        $url = "https://hookb.in/xxxxxxxxxxx";

        $relay = new relay();
        $result = $relay->fetch($url);

        /**
         * Check the data in Hook Bin site
         */
        $this->assertTrue(true);
    }
}
