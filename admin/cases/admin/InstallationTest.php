<?php

namespace ocunit\admin\cases\admin;
use PHPUnit\Framework\TestCase;

class InstallationTest extends TestCase
{
    function testTouchStoreConfigurationFile()
    {
        global $configurations;
        touch($configurations["opencart"]["store"]."/config.php");

        $this->assertTrue(file_exists($configurations["opencart"]["store"]."/config.php"));
        $this->assertFalse(filesize($configurations["opencart"]["store"]."/config.php") == 0, "Please install the software!");
    }

    function testTouchAdminConfigurationFile()
    {
        global $configurations;
        touch($configurations["opencart"]["admin"]."/config.php");

        $this->assertTrue(file_exists($configurations["opencart"]["admin"]."/config.php"));
        $this->assertFalse(filesize($configurations["opencart"]["admin"]."/config.php") == 0, "Please install the software!");
    }
}