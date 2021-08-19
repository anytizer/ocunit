<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;

class SettingsTest extends TestCase
{
	public function testDatabaseConstantsDefined()
    {
        $this->assertTrue(defined("DB_DRIVER"));        
        $this->assertTrue(defined("DB_HOSTNAME"));
        $this->assertTrue(defined("DB_USERNAME"));
        $this->assertTrue(defined("DB_PASSWORD"));
        $this->assertTrue(defined("DB_DATABASE"));
        $this->assertTrue(defined("DB_PORT"));
        $this->assertTrue(defined("DB_PREFIX"));
    }

    public function testOtherSettingsDefined()
    {
        $this->assertTrue(defined("OPENCART_SERVER"));
    }
}
