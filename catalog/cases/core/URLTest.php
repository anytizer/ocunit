<?php

namespace cases\core;

use Opencart\System\Library\Url as Url;
use PHPUnit\Framework\TestCase;

class URLTest extends TestCase
{
    public function testConstructHomepageUrl()
    {
        $url = new Url(HTTP_CATALOG);
        $link = $url->link("common/home");

        $this->assertEquals(HTTP_CATALOG . "index.php?route=common/home", $link, "Could not construct homepage URL");
    }
}
