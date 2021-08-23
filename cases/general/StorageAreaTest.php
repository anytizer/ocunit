<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class StorageAreaTest extends TestCase
{
    public function testStorageAreaIsOutOfUpload()
    {
        $parent = dirname(realpath(DIR_STORAGE));

        /**
         * Following folders should NOT appear in the directory name for ./storage/
         *
         * In most linux systems: /home/USER/public_html/opencart/upload/storage/
         * In some dedicated systems: /var/www/html/opencart/upload/storage/
         */
        $restrictions = [
            /**
             * Default www rot paths
             */
            "upload",
            "public_html",
            "htdocs",
            "www",
            "web",

            /**
             * OpenCart storage area
             */
            "opencart",
            "store",
            "shop",
        ];
        foreach($restrictions as $folder)
        {
            $this->assertFalse(str_contains($parent, $folder), "/storage area is not outside of {$folder}.");
        }
    }

    public function testInstallFolderIsRemoved()
    {
        $install = DIR_OPENCART."install";
        $this->assertFalse(is_dir($install), "Remove install/ folder!");
    }

    public function testAdminFolderIsRenamed()
    {
        // @todo Replace "admin" with a variable
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

            // @todo look for sub-folders as well
            DIR_IMAGE,
        ];
        foreach($folders as $folder)
        {
            $can_write = is_writable($folder);
            $basename = basename($folder);
            $this->assertTrue($can_write, "Cannot write to storage/{$basename}.");
        }

        // images, images/category/n.png, sql backup logs,
    }
}
