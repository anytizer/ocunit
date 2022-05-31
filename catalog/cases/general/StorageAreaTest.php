<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class StorageAreaTest extends TestCase
{
    public function testStorageAreaIsOutOfUpload()
    {
        // @todo Also test when upload/ becomes public_html
        $parent = dirname(realpath(DIR_OPENCART));

        /**
         * Following folders should NOT appear in the directory name for ./storage/
         *
         * In most linux systems: /home/USER/public_html/OPENCART/upload/storage/
         * In some dedicated systems: /var/www/html/OPENCART/upload/storage/
         */
        $restricted_folders = [
            /**
             * Control panel web root paths
             */
            "upload",
            "public_html",
            "htdocs",
            #"httpdocs",
            #"httpsdocs",
            "www",
            "web",

            /**
             * OpenCart possible areas
             */
            "opencart",
            "store",
            "shop",
//          "buy",
//          "sell",
//          "merchant",
//          "products",
//          "purchase",
        ];

        foreach ($restricted_folders as $folder) {
            // @todo Logic not enough to filter folders.
            $this->assertFalse(str_contains($parent, $folder), "/storage area is not outside of {$folder}.");
        }
    }

    public function testInstallFolderIsRemoved()
    {
        $install = DIR_OPENCART . "install";
        $this->assertFalse(is_dir($install), "Remove install/ folder!");
    }

    public function testAdminFolderIsRenamed()
    {
        // @todo: config.ini > opencart > admin
        $this->assertFalse(is_dir(DIR_OPENCART . "admin"), "It is important to rename admin folder!");
    }

    public function testStorageFoldersPermissions()
    {
        $folders = [
            DIR_STORAGE . "backup",
            DIR_STORAGE . "cache",
            DIR_STORAGE . "download",
            DIR_STORAGE . "logs",
            DIR_STORAGE . "marketplace",
            DIR_STORAGE . "session",
            DIR_STORAGE . "upload",
            DIR_STORAGE . "vendor",
        ];
        foreach ($folders as $folder) {
            $can_write = is_writable($folder);
            $basename = basename($folder);
            $this->assertTrue($can_write, "Cannot write to storage/{$basename}.");
        }
    }

    public function testOtherFoldersPermissions()
    {
        $folders = [
            DIR_IMAGE,
        ];
        foreach ($folders as $folder) {
            $can_write = is_writable($folder);
            $basename = basename($folder);
            $this->assertTrue($can_write, "Cannot write to OTHER FOLDER: {$basename}.");
        }
    }
}
