<?php

use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    function testImportImages()
    {
        $path = "D:/desktop/stores";

        $categories = [];
        $everything = array_diff(scandir($path), [".", ".."]);
        foreach ($everything as $category) {
            $fullpath = $path . "/" . $category;
            if (is_dir($fullpath)) {
                $categories[] = $fullpath;
            }
        }

        foreach ($categories as $category) {
            $slug = (new Slug())->create_from_path($category);
            echo "\r\nSlug: ", $slug;
            /*
            $images = scandir($category);
            $price = price();
            $description = $description();
            $name = name();
            $slug = slug();
            */

            // create category and description in default language
            // assign pictures in slug folder

            // INSERT INTO oc_product_to_category SELECT product_id, 59 FROM oc_product;
            //
        }


        # print_r($categories);
    }
}