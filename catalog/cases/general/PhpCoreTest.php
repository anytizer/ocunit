<?php

use PHPUnit\Framework\TestCase;

class PhpCoreTest extends TestCase
{
    public function testNegativeOne()
    {
        $integer = (int)-1;
        $this->assertTrue($integer === -1);
    }

    public function testIniGetWrongQuery()
    {
        $stringed_integer = ini_get("something.erroneous");
        $this->assertFalse($stringed_integer);
    }

    public function testIniGetGoodQuery()
    {
        $string = ini_get("display_errors");
        $this->assertTrue($string == "stderr");
    }
}
