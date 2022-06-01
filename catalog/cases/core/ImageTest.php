<?php

namespace cases\core;

use Exception;
use Opencart\System\Library\Image;
use PHPUnit\Framework\TestCase;

# require_once DIR_SYSTEM . "library/image.php";

class ImageTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testParsePngImageForWidthAndHeight()
    {
        $images = [
            DIR_IMAGE . "no_image.png",
            DIR_IMAGE . "placeholder.png",
            DIR_IMAGE . "profile.png",
        ];
        foreach ($images as $filename) {
            $image = new Image($filename);

            $width = $image->getWidth();
            $height = $image->getHeight();

            $this->assertTrue($width > 0, "GD failed parsing placeholder image's - width.");
            $this->assertTrue($height > 0, "GD failed parsing placeholder image's - height.");
        }
    }
}
