<?php

namespace ocunit\business\cases;

use ocunit\library\Category;
use ocunit\library\Image;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @see Category
     */
    public function testBuildProducts()
    {
        // from store > categories > products > images[]
        // products imported while looping through categories.

        $this->markTestSkipped();
    }
}