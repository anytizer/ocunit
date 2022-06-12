<?php

namespace ocunit\business\cases;

use ocunit\library\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testTruncateImages()
    {
        $image = new Image();
        $total = $image->truncate();

        $this->assertTrue($total >= 1);
    }

    /**
     * @see CategoryTest::testBuildCategories()
     */
    public function testBuildImages()
    {
        // from store > categories > products > images[]
        $this->markTestSkipped();
    }
}