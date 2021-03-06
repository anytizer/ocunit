<?php

namespace ocunit\admin\cases\admin;

use ocunit\library\DatabaseExecutor as DatabaseExecutor;
use PHPUnit\Framework\TestCase;

class DownloadsTest extends TestCase
{
    private $downloadables = [];

    public function setUp(): void
    {
    }

    public function testDownloadShouldExist()
    {
        $dbx = new DatabaseExecutor();
        $downloadables = $dbx->downloads();
        if (count($downloadables)) {
            foreach ($downloadables as $download) {
                $download["filename"] = basename($download['filename']);
                $masked_file = DIR_STORAGE . "download/{$download['filename']}";

                $download_exists = is_file($masked_file);
                $this->assertTrue($download_exists, "Missing download file for id #{$download['download_id']}: {$download['name']}.");

                $extension = pathinfo(basename($download["mask"]))["extension"];
                $this->assertEquals("zip", $extension, "Offer downloads in .zip file format only: {$download['mask']}");
            }
        } else {
            $this->fail();
        }
    }

    public function testProductMustHaveAFileLinked()
    {
        $dbx = new DatabaseExecutor();
        $downloadable_products = $dbx->downloadable_products();

        if (count($downloadable_products)) {
            foreach ($downloadable_products as $product) {
                // check downloadable record exists
                $download_found = false;
                foreach ($this->downloadables as $download) {
                    if ($download["product_id"] == $product["product_id"]) {
                        $download_found = true;
                    }
                }

                $this->assertTrue($download_found, "Failed linking a downloadable product for Product ID: #{$product['product_id']}.");
            }
        } else {
            $this->fail();
        }
    }

    public function testDownloadableFileIsAZipArchive()
    {
        $dbx = new DatabaseExecutor();
        $masks = $dbx->file_masks();

        foreach ($masks as $mask) {
            $this->assertStringEndsWith(".zip", $mask["mask"]);
        }
    }

    public function testDownloadFilesAreProtected()
    {
        // for each downloadable product
        // download product is masked
        // download product is actively linked
        // customer who purchased a download can successfully download file
        // download links are protected with login
        // logged in customer cannot download another file, unless purchased
        // apply file size limits
        // apply download limits, show number of downloads remaining
        $this->fail();
    }

    public function testOthers()
    {
        // @see ini/config.ini -> [business_rules][downloadable_product_tax_class_id]
        // SELECT product_id FROM `oc_product` WHERE tax_class_id=10;
        // restrict others but .zip: reject!
        // A product can have multiple files attached. All files should exist.
        $this->markTestIncomplete("Other tests");
    }
}
