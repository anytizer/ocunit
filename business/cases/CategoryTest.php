<?php

namespace ocunit\business\cases;

use Exception;
use ocunit\library\Category;
use ocunit\library\Product;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testTruncateCategories()
    {
        $product = new Product();
        $product->truncate();

        $category = new Category();
        $category->truncate();

        $this->fail();
    }

    /**
     * @throws Exception
     */
    public function testBuildCategories()
    {
        // from store > categories > products > images[]
        $category = new Category();
        $category->patch();

        $this->fail();
    }
}