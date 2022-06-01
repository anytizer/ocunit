<?php

namespace cases\business;

use ocunit\library\DatabaseExecutor;
use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class CategoryImagesTest extends TestCase
{
    private function _copy_images($categories)
    {
        foreach ($categories as $c => $category) {
            $image_file = DIR_IMAGE . $category["image"];

            if (!is_file($image_file)) {
                $dir = dirname($image_file);
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }

                copy(DIR_IMAGE . "placeholder.png", $image_file);
            }
        }
    }

    /**
     * @todo Empty the image data before running this test.
     */
    public function testFixCategoryImagesDatabaseRecords()
    {
        $dbx = new DatabaseExecutor();
        $categories = $dbx->categories();

        $pdo = new MySQLPDO();

        // UPDATE oc_category SET image=null;

        $modified = 0;
        foreach ($categories as $c => $category) {
            if (empty($category["image"])) {
                $update_sql = "UPDATE `" . DB_PREFIX . "category` SET image=:image WHERE category_id=:category_id;";

                $store = "store"; // @todo Replace with proper store name
                $category_id = $category["category_id"];
                $pdo->raw($update_sql, [
                    ":image" => "catalog/{$store}/categories/{$category_id}/200x200.png",
                    ":category_id" => $category["category_id"],
                ]);

                ++$modified;
            }
        }

        /**
         * By design:
         *    On first run, caches error.
         *    On second run, it is ok.
         */
        $this->assertEquals(0, $modified, "Category images have been auto assigned.");
    }

    public function testCreateCategoryImages()
    {
        $dbx = new DatabaseExecutor();
        $categories = $dbx->categories();

        $this->_copy_images($categories);

        foreach ($categories as $c => $category) {
            $image_file = DIR_IMAGE . $category["image"];

            $this->assertTrue(is_file($image_file), "Missing image for category id: #" . $category["category_id"]);
        }
    }
}
