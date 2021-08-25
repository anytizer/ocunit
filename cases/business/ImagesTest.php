<?php

namespace cases\business;

use library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class ImagesTest extends TestCase
{
    /**
     * @todo Empty the image data before running this test.
     */
    public function testFixProductImages()
    {
        $pdo = new MySQLPDO();

        // UPDATE oc_product SET image=null;

        $modified = 0;
        $products_sql = "SELECT product_id, image FROM `".DB_PREFIX."product`;";
        $products = $pdo->query($products_sql);
        foreach($products as $p => $product)
        {
            if(empty($product["image"]))
            {
                $update_sql = "UPDATE `".DB_PREFIX."product` SET image=:image WHERE product_id=:product_id;";

                $store = "store"; // @todo Replace with proper store name
                $product_id = $product["product_id"];
                $pdo->raw($update_sql, [
                    ":image" => "catalog/{$store}/products/{$product_id}-800x400.png",
                    ":product_id" => $product["product_id"],
                ]);

                ++$modified;
            }
            else
            {
                $dir = dirname(DIR_IMAGE.$product["image"]);
                if(!is_dir($dir))
                    mkdir($dir, 0777, true);

                copy(DIR_IMAGE."placeholder.png", DIR_IMAGE.$product["image"]);
                $image_file = DIR_IMAGE.$product["image"];
                $this->assertTrue(is_file($image_file), "Missing image for product id: #".$product["product_id"]);
            }
        }

        /**
         * By design:
         *    On first run, caches error.
         *    On second run, it is ok.
         */
        $this->assertEquals(0, $modified, "Product images have been auto assigned.");
    }

    /**
     * @todo Empty the image data before running this test.
     */
    public function testFixCategoryImages()
    {
        $pdo = new MySQLPDO();

        // UPDATE oc_category SET image=null;

        $modified = 0;
        $categories_sql = "SELECT category_id, image FROM `".DB_PREFIX."category`;";
        $categories = $pdo->query($categories_sql);
        foreach($categories as $c => $category)
        {
            if(empty($category["image"]))
            {
                $update_sql = "UPDATE `".DB_PREFIX."category` SET image=:image WHERE category_id=:category_id;";

                $store = "store"; // @todo Replace with proper store name
                $category_id = $category["category_id"];
                $pdo->raw($update_sql, [
                    ":image" => "catalog/{$store}/categories/{$category_id}-200x200.png",
                    ":category_id" => $category["category_id"],
                ]);

                ++$modified;
            }
            else
            {
                $dir = dirname(DIR_IMAGE.$category["image"]);
                if(!is_dir($dir))
                    mkdir($dir, 0777, true);

                if(!is_file(DIR_IMAGE.$category["image"]))
                {
                    copy(DIR_IMAGE."placeholder.png", DIR_IMAGE.$category["image"]);
                }
                $image_file = DIR_IMAGE.$category["image"];
                $this->assertTrue(is_file($image_file), "Missing image for category id: #".$category["category_id"]);
            }
        }

        /**
         * By design:
         *    On first run, caches error.
         *    On second run, it is ok.
         */
        $this->assertEquals(0, $modified, "Category images have been auto assigned.");
    }
}
