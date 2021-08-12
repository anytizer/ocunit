<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;

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

        /**
         * Following folders should NOT appear in the directory name
         */
        $restrictions = [
            "upload",
            "public_html",
            "htdocs",
            "www",
            "web"
        ];
        foreach($restrictions as $folder)
        {
            $this->assertFalse(str_contains($parent, $folder), "/storage area is not outside of {$folder}.");
        }
    }

    public function testInstallFolderIsRemoved()
	{
		$install = DIR_OPENCART."install";
		$this->assertFalse(is_dir($install), "Remove install folder!");
	}

	public function testAdminFolderBeRenamed()
	{
		$admin = DIR_OPENCART."admin";
		$this->assertFalse(is_dir($admin), "Rename admin folder to something difficult!");
	}

    public function testSystemFilePermissions()
    {
        $folders = [
            DIR_STORAGE."backup",
            DIR_STORAGE."cache",
            DIR_STORAGE."download",
            DIR_STORAGE."logs",
            DIR_STORAGE."marketplace",
            DIR_STORAGE."session",
            DIR_STORAGE."upload",
            DIR_STORAGE."vendor",

            // @todo look for subfolders as well
            DIR_IMAGE,
        ];
        foreach($folders as $folder)
        {
            $can_write = is_writable($folder);
            $this->assertTrue($can_write, "Cannot write to {$folder}.");
        }
        
        
        // images, images/category/n.png, sql backup logs,
        // $this->markTestIncomplete("Look for system file permissions.");
    }

    public function testHtaccessDisablesDirectoryListing()
    {
        $this->markTestIncomplete("Look for Options -Indexes.");
    }
}
