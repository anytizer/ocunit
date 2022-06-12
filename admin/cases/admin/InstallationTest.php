<?php

namespace ocunit\admin\cases\admin;

use ocunit\library\FileToucher;
use PHPUnit\Framework\TestCase;

class InstallationTest extends TestCase
{
    private $admin_config_file = "";
    private $store_config_file = "";

    public function setUp(): void
    {
        global $configurations;

        $this->admin_config_file = $configurations["opencart"]["admin"] . "/config.php";
        $this->store_config_file = $configurations["opencart"]["store"] . "/config.php";
    }

    function testTouchAdminConfigurationFile()
    {
        $toucher = new FileToucher();
        $filesize = $toucher->touch($this->admin_config_file);

        $this->assertNotEquals(0, $filesize, "Admin might have been already installed.");
    }

    function testTouchStoreConfigurationFile()
    {
        $toucher = new FileToucher();
        $filesize = $toucher->touch($this->store_config_file);

        $this->assertNotEquals(0, $filesize, "Store might have been already installed.");
    }
}