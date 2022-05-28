<?php

namespace cases\business;

use ocunit\library\DatabaseExecutor;
use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class ProductImagesTest extends TestCase
{
    public function testCreateProductImages()
    {
        $dbx = new DatabaseExecutor();
        $products = $dbx->products();

        foreach ($products as $p => $product) {
            $image_file = DIR_IMAGE . $product["image"];

            if (!is_file($image_file)) {
                $dir = dirname($image_file);
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }

                copy(DIR_IMAGE . "placeholder.png", $image_file);
            }

            $this->assertTrue(is_file($image_file), "Missing image for product id: #" . $product["product_id"]);
        }
    }

    /**
     * @todo Empty the image data before running this test.
     */
    public function testFixProductImagesDatabaseRecords()
    {
        $pdo = new MySQLPDO();

        // UPDATE oc_product SET image=null;

        $modified = 0;
        $dbx = new DatabaseExecutor();
        $products = $dbx->products();
        foreach ($products as $p => $product) {
            if (empty($product["image"])) {
                $update_sql = "UPDATE `" . DB_PREFIX . "product` SET image=:image WHERE product_id=:product_id;";

                $store = "store"; // @todo Replace with proper store name
                $product_id = $product["product_id"];
                $pdo->raw($update_sql, [
                    ":image" => "catalog/{$store}/products/{$product_id}-800x400.png",
                    ":product_id" => $product["product_id"],
                ]);

                ++$modified;
            }
        }

        /**
         * By design:
         *    On first run, caches error.
         *    On second run, it is ok.
         */
        $this->assertEquals(0, $modified, "Product images have been auto assigned.");
    }
}
