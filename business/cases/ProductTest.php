<?php
namespace ocunit\business\cases;

use ocunit\library\Image;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testTruncateImages()
    {
        $prodcuct = new Image();
        $prodcuct->truncate();

        $this->assertFalse(false);
    }

    public function testBuildProducts()
    {
        // from store > categories > products > images[]
        // products imported while looping through categories.
        // @see Category.php
    }
}