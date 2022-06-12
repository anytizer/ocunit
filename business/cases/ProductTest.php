<?php

namespace ocunit\business\cases;

use ocunit\library\Image;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testTruncateImages()
    {
        $product = new Image();
        $total = $product->truncate();

        $this->assertTrue($total >= 1);
    }

    public function testBuildProducts()
    {
        // from store > categories > products > images[]
        // products imported while looping through categories.
        // @see Category.php
    }
}