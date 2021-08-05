<?php

use anytizer\relay;
use PHPUnit\Framework\TestCase;

/**
 * Service not functional
 */
class hookbinTest extends TestCase
{
    private $relay = null;

    public function setup(): void
    {
        $_GET = array();
        $_POST = array();
        $this->relay = new relay();
    }

    public function testHookBin()
    {
        $_GET = array(
            "format" => "json",
        );

        $_POST = array(
            "from" => "UnitTest",
        );

        /**
         * Courtesy use
         * Create an endpoint first
         * @see https://hookbin.com/
         * @see https://hookbin.com/XXXXXXXXXXXXXXXXXXXX
         */
        $url = "https://hookb.in/XXXXXXX";

        $relay = new relay();
        $result = $relay->fetch($url);

        $this->markTestIncomplete();
    }
}