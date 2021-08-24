<?php
namespace cases\core;

use Opencart\System\Library\Image;
use PHPUnit\Framework\TestCase;

require_once DIR_SYSTEM."library/image.php";

class ImageTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testParsePngImageWidthHeight()
    {
        $filename = DIR_IMAGE."placeholder.png";
        $image = new Image($filename);

        $width = $image->getWidth();
        $height = $image->getHeight();

        $this->assertTrue($width > 0, "GD failed parsing placeholder image's - width.");
        $this->assertTrue($height > 0, "GD failed parsing placeholder image's - height.");
    }
}
