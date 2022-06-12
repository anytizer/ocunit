<?php

namespace ocunit\business\cases;

use Exception;
use ocunit\library\Category;
use ocunit\library\Product;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testTruncateProducts()
    {
        $category = new Category();
        $total = $category->truncate();

        $this->assertTrue($total >= 1);
    }

    public function testTruncateCategories()
    {
        $product = new Product();
        $total = $product->truncate();

        $this->assertTrue($total >= 1);
    }

    /**
     * @throws Exception
     */
    public function testBuildCategories()
    {
        // from store > categories > products > images[]
        $category = new Category();
        $total = $category->patch();

        $this->assertTrue($total >= 1);
    }
}