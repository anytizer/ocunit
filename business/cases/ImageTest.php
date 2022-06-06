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

        $this->assertFalse(false);
    }

    public function testBuildImages()
    {
        // from store > categories > products > images[]
    }
}