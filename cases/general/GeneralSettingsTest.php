<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \MySQLPDO as MySQLPDO;

class SettingsTest extends TestCase
{
	public function testDatabaseConstantsDefined()
    {
        $this->assertTrue(defined('DB_DRIVER'));        
        $this->assertTrue(defined('DB_HOSTNAME'));
        $this->assertTrue(defined('DB_USERNAME'));
        $this->assertTrue(defined('DB_PASSWORD'));
        $this->assertTrue(defined('DB_DATABASE'));
        $this->assertTrue(defined('DB_PORT'));
        $this->assertTrue(defined('DB_PREFIX'));
    }

    public function testOtherSettingsDefinedInFrontend()
    {
        $this->assertTrue(defined('APPLICATION'));        
        $this->assertTrue(defined('HTTP_SERVER'));
        $this->assertTrue(defined('DIR_OPENCART'));
        $this->assertTrue(defined('DIR_APPLICATION'));
        $this->assertTrue(defined('DIR_EXTENSION'));
        $this->assertTrue(defined('DIR_IMAGE'));
        $this->assertTrue(defined('DIR_SYSTEM'));
        $this->assertTrue(defined('DIR_STORAGE'));        
        $this->assertTrue(defined('DIR_LANGUAGE'));
        $this->assertTrue(defined('DIR_TEMPLATE'));
        $this->assertTrue(defined('DIR_CONFIG'));
        $this->assertTrue(defined('DIR_CACHE'));
        $this->assertTrue(defined('DIR_DOWNLOAD'));
        $this->assertTrue(defined('DIR_LOGS'));
        $this->assertTrue(defined('DIR_SESSION'));
        $this->assertTrue(defined('DIR_UPLOAD'));
    }

    public function testStorageAreaIsOutOfUpload()
    {
        $parent = dirname(realpath(DIR_STORAGE));
        $this->assertFalse(str_contains($parent, "upload"));
        //$this->markTestIncomplete("Storage area has not been moved.");
    }
}
