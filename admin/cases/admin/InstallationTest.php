<?php

namespace ocunit\admin\cases\admin;

use PHPUnit\Framework\TestCase;

class FileToucher
{
    /**
     * @param string $file
     * @return int File size in bytes
     */
    public function touch($file="")
    {
        touch($file);

        assert(is_file($file));
        return filesize($file);
    }
}

class InstallationTest extends TestCase
{
    private $admin_config_file = "";
    private $store_config_file = "";

    public function setUp(): void
    {
        global $configurations;
        $this->admin_config_file = $configurations["opencart"]["admin"]."/config.php";
        $this->store_config_file = $configurations["opencart"]["store"]."/config.php";
    }

    function testTouchAdminConfigurationFile()
    {
        $toucher = new FileToucher();
        $filesize = $toucher->touch($this->admin_config_file);

        $this->assertTrue($filesize > 0, "Install the OpenCart software.");
    }

    function testTouchStoreConfigurationFile()
    {
        $toucher = new FileToucher();
        $filesize = $toucher->touch($this->store_config_file);

        $this->assertTrue($filesize > 0, "Install the OpenCart software.");
    }
}