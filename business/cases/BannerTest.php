<?php

namespace ocunit\business\cases;

use ocunit\library\Banner;
use PHPUnit\Framework\TestCase;

class BannerTest extends TestCase
{
    public function testTruncateBanners()
    {
        $banner = new Banner();
        $banner->truncate();

        $this->fail();
    }
}