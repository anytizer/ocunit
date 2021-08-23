<?php
namespace cases\core;

use Opencart\System\Library\Url as Url;
use PHPUnit\Framework\TestCase;

class URLTest extends TestCase
{
    public function testConstructHomepageUrl()
    {
        $url = new Url(HTTP_SERVER);
        $link = $url->link("common/home");
        $this->assertEquals(HTTP_SERVER . "index.php?route=common/home", $link, "Could not construct homepage URL");
    }
}
