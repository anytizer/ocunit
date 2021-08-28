<?php
namespace cases\core;

use Opencart\System\Library\Url;
use PHPUnit\Framework\TestCase;

require_once DIR_OPENCART."system/library/url.php";

class URLTest extends TestCase
{
    public function testConstructHomepageUrl()
    {
        $url = new Url(HTTP_CATALOG);
        $link = $url->link("common/home");
        $this->assertEquals(HTTP_CATALOG . "index.php?route=common/home", $link, "Could not construct homepage URL");
    }
}
