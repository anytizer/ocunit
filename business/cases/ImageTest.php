<?php

namespace ocunit\business\cases;

use ocunit\library\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testTruncateImages()
    {
        $image = new Image();
        $image->truncate();

        $this->fail();
    }

    public function testBuildImages()
    {
        // @see CategoryTest::testBuildCategories()
        // from store > categories > products > images[]
    }
}